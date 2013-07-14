<?php
class CommentController extends BaseController{
/*
|----------------------------------------
| コンストラクター
|----------------------------------------
*/
 public function __construct(){
 //adminフィルター
 $this->beforeFilter('auth');
 //全POSTにcsrfフィルターの適用
 $this->beforeFilter('csrf',array('on'=>'post'));
 }
 
	//ユーザー受信コメント
	public function own(){
		$user=Auth::user();
		$role=$user->roles->first();
		$query=Comment::where('recipient_id',$user->id)
			->orWhere('role_id','>=',$role->id)
	 		->orderBy('created_at','desc');
		return $query;
	}
	//ユーザー送信コメント
	public function sent(){
		$user=Auth::user();
		$query=Comment::where('user_id',$user->id)
	 		->orderBy('created_at','desc');
		return $query;
	}
 
/*
|----------------------------------------
| トップページ（コメント一覧）
|----------------------------------------
*/
	public function getIndex($action=null){
		//基本情報のセット
		$user=Auth::user();
		$role_id=$user->roles()->pluck('id');
		if($action == 'sent'):
			//ユーザー送信コメント
			$comments=$this->sent()->paginate();
			$data['title']='送信コメント一覧';
			$data['action']='sent';
		else:
			//ユーザー受信コメント
			$comments=$this->own()->paginate();
			$data['title']='受信コメント一覧';
			$data['action']=null;
		endif;
		$data['comments']=(count($comments) != 0) ? $comments : null;
		return View::make('comment/index',$data);
 }
/*
|----------------------------------------
| トップページ（コメント一覧）
|----------------------------------------
*/
 public function getCreate($id=null){
	 $data['message']=Message::find($id);
	 return View::make('comment/create',$data);
	}
	//コメント作成
 public function postCreate(){
	 $inputs=Input::all();
	 //dd($inputs);
	 $rules=array('body'=>'required');
	 $val=Validator::make($inputs,$rules);
	 //return dd($inputs);
	 if($val->fails()){
		 return Redirect::back()
		 		->withInput()
				->withErrors($val);
		}
		$inputs['user_id']=Auth::user()->id;
		$comment=Comment::create($inputs);
		$message=$comment->message;
	
	/*****************************************
	 * 未読処理
	 * worksテーブルのcomment項目に配列保存
	 *****************************************/
		
		//個人宛メッセージのコメントなら
		if(isset($message->recipient_id)){
			//受信メッセージの整理
			$work=Work::find($message->recipient_id);
			//旧コメント
			$old=isset($work->comment) ? unserialize($work->comment) : array();
			//return dd($old);
			//新コメント
			$new=array($comment->id);
			//return dd($new);
			//配列の併合
			$merge=isset($old) ? array_merge($old,$new) : $new;
			//登録データの保存
			//return dd(serialize($merge));
			$work->comment=serialize($merge);
			//return dd($work->comment);
			$work->save();
		//Role宛てメッセージなら
		}else{
			//新コメント
			$new=array($comment->id);
			//return dd($new);
			//指定ロール以上のIDリスト取得
			$role_id=Role::where('id','<=',Input::get('role_id'))->lists('id');
			//dd($role_id);
			//指定ロール以上のユーザーを取得
			$users=User::whereIn('id',$role_id)->get();
			//return dd($users);
			//ユーザーの数だけ繰り返し
			foreach($users as $user):
				//旧メッセージの取得
				$work=Work::find($user->id);
				//return dd($user->id);
				$old=isset($work->comment) ? unserialize($work->comment) : array();
				//配列の併合
				$merge=isset($old) ? array_merge($old,$new) : $new;
				//return var_dump($merge);
				//登録データの保存
				$work->comment=serialize($merge);
				$work->save();
			endforeach;
		}
	//トップページへ移動
	return Redirect::to('comment/index');
	}
/*
|------------------------------------
| 未読コメント
|------------------------------------
*/
	public function getUnread($id=null,$key=null){
		//worksから未読コメントの配列を取得
		$comments=Work::order('comment');
		//return dd($comments)->lists('id');
		//未読コメントがなければ
		if(!isset($comments) or count($comments) ==0 ){
			return View::make('comment/unread')
				->with('warning','未読コメントはありません');
		}
		//指定IDが未読メッセージの中にあれば
		if(isset($id) and in_array($id,$comments)){
				//未読コメントIDの配列を取得
				$unread=$comments;
					//未読メッセージを削除
					array_pull($unread,$key);
					//配列のキーを前に詰める
					$unread=array_values($unread);
					//return dd($unread);
				$comment=serialize($unread);
				$work=Work::find(Auth::user()->id);
				$work->comment=$comment;
				$work->save();
				//$id=Comment::find($id)->message_id;
				//return dd($id);
				//削除後に明細ページへ移動
				$data['comments']=Comment::find($id);
				return View::make('comment/view',$data);
		}
		//配列の数だけオブジェクトを取得
		foreach($comments as $key=>$value):
			$data['comments'][]=Comment::find($value);
			//return dd(Comment::find($value));
		endforeach;
		return View::make('comment/unread',$data);
	}
/*
|------------------------------------
| 未読コメント
|------------------------------------
*/
	public function getView($id=null){
		if(isset($id)){
			$data['comments']=Comment::find($id);
		return View::make('comment/view',$data);
	}
	return View::make('comment/view');
	}
	
/*
|------------------------------------
| コメント検索
|------------------------------------
*/
	public function postSearch(){
		$input=Input::get('search');
		$action=Input::get('action');
		$comments=Comment::where('body','LIKE','%'.$input.'%')
			->orderBy('created_at','desc');
		if($action == 'sent'):
			$data['comments']=$comments->where('user_id',Auth::user()->id)
				->paginate();
			$data['title']='送信コメント検索';
			$data['action']='sent';
		else:
			$data['comments']=$comments->paginate();
			$data['title']='受信コメント検索';
			$data['action']=null;
		endif;
		return View::make('comment/index',$data);
	}
}