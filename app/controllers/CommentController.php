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
		$role_id=DB::table('role_user')
					->where('user_id',$user->id)
					->lists('role_id');
		$role_names=Role::whereIn('id',$role_id)->lists('name');
		$query=Comment::where('recipient_id',$user->id)
	 			->orderBy('created_at','desc');
			foreach($role_names as $role_name):
				$query->orWhere('role_name','LIKE',"%$role_name%");
			endforeach;
				$query->where('user_id','<>',$user->id);
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
	 $rules=array('body'=>'required');
	 $val=Validator::make($inputs,$rules);
		//dd($inputs);
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
			//dd($old);
			//新コメント
			$new=array($comment->id);
			//dd($new);
			//配列の併合
			$merge=isset($old) ? array_merge($old,$new) : $new;
			//登録データの保存
			//dd(serialize($merge));
			$work->comment=serialize($merge);
			//dd($work->comment);
			$work->save();
		
		//Role宛てメッセージのコメントなら
		}else{
			//新コメント
			$new=array($comment->id);
			//dd($new);
			//ロールの名前リスト取得
			$role_name=unserialize($comment->role_name);
			//ロールのIDリスト取得
			$role_id=Role::whereIn('name',$role_name)->lists('id');
			//dd($role_id);
			//指定ロールのユーザーを取得
			$user_id=DB::table('role_user')
					->whereIn('role_id',$role_id)->lists('user_id');
			//dd($user_id);
			$users=User::whereIn('id',$user_id)->get();
			//dd($users);
			//ユーザーの数だけ繰り返し
			foreach($users as $user):
				//旧メッセージの取得
				$work=Work::find($user->id);
				//dd($user->id);
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
		//dd($comments)->lists('id');
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
					//dd($unread);
				$comment=serialize($unread);
				$work=Work::find(Auth::user()->id);
				$work->comment=$comment;
				$work->save();
				//$id=Comment::find($id)->message_id;
				//dd($id);
				//削除後に明細ページへ移動
			$com=Comment::find($id);
			$mes=Message::find($com->message_id);
			$coms=Comment::where('message_id',$com->message_id)->get();
			$data=array('comment'=>$com,'message'=>$mes,'comments'=>$coms);
				return View::make('comment/view',$data);
		}
		//配列の数だけオブジェクトを取得
		foreach($comments as $key=>$value):
			$data['comments'][]=Comment::find($value);
			//dd(Comment::find($value));
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
			$com=Comment::find($id);
			$mes=Message::find($com->message_id);
			$coms=Comment::where('message_id',$com->message_id)->get();
			$data=array('comment'=>$com,'message'=>$mes,'comments'=>$coms);
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
			$data['comments']=$comments
						->where('user_id',Auth::user()->id)
						->paginate();
			$data['title']='送信コメント検索';
			$data['action']='sent';
		else:
			$data['comments']=$comments
						->where('role_name','LIKE',"%$input%")
						->paginate();
			$data['title']='受信コメント検索';
			$data['action']=null;
		endif;
		return View::make('comment/index',$data);
	}
}