<?php
class MessageController extends BaseController{
/*
|----------------------------------------
| コンストラクター
|----------------------------------------
*/
 public function __construct(){
 //authフィルター
 $this->beforeFilter('auth');
 //全POSTにcsrfフィルターの適用
 $this->beforeFilter('csrf',array('on'=>'post'));
 }
 
/*
|------------------------------------
| TOPページ
|------------------------------------
*/
	public function getIndex(){
		//ログインユーザーの全メッセージを取得
		$message=Message::own()->paginate();
		$data['messages']=(count($message) == 0) ? $message : null;
		return View::make('message/index',$data);
	}	
	
/*
|------------------------------------
| 新規メッセージ作成
|------------------------------------
*/
	public function getCreate($recipient=null){
		if($recipient=='user'){
			$data['user']=User::all()->lists('name','id');
		}
		if($recipient=='role'){
			$data['role']=Role::all()->lists('name','id');
		}else{
			$data['empty']='empty';
		}
		return View::make('message/create',$data);
	}
	
	public function postCreate(){
		$inputs=Input::all();
		//return dd($inputs);
		$rules=array(
	 			'subject'=>'required',
	 			'body'=>'required',
		);
		//バリデーション
		$val=Validator::make($inputs,$rules);
		if($val->fails()){
			return Redirect::back()
					->withInput()
					->withErrors($val);
		}
		//グループ指定が無ければ
		if(!isset($inputs['role_id'])){
			//Userを指定
			$inputs['role_id']=2;
		}
		//データ登録
		$message=Message::create($inputs);

	/*****************************************
	 * 未読処理
	 * worksテーブルのmessage項目に配列保存
	 *****************************************/
		
		//個人宛メッセージなら
		if(isset($inputs['recipient_id'])){
			//受信メッセージの整理
			$work=Work::find($inputs['recipient_id']);
			//旧メッセージ
			$old=isset($work->message) ? unserialize($work->message) : array();
			//return dd($old);
			//新メッセージ
			$new=array($message->id);
			//配列の併合
			$merge=isset($old) ? array_merge($old,$new) : $new;
			//登録データの保存
			//return dd($merge);
			$work->message=serialize($merge);
			$work->save();
		//Role宛てメッセージなら
		}else{
			//新メッセージ
			$new=array($message->id);
			//return dd($message->group_id);
			//指定グループのユーザーを取得
			$role=Role::find($message->role_id);
			$users=User::find($role);
			//ユーザーの数だけ繰り返し
			foreach($users as $user):
				//旧メッセージの取得
				$work=Work::find($user->id);
				$old=isset($work->message) ? unserialize($work->message) : array();
				//配列の併合
				$merge=isset($old) ? array_merge($old,$new) : $new;
				//return var_dump($merge);
				//登録データの保存
				$work->message=serialize($merge);
				$work->save();
			endforeach;
		}
	//トップページへ移動
	return Redirect::to('message/index');
	}
/*
|------------------------------------
| 未読メッセージ
|------------------------------------
*/
	public function getUnread($id=null,$key=null){
		//ログインユーザーのWorkオブジェクトを取得
		$work=Work::find(Auth::user()->id);
		//return dd($work->message);
		//未読メッセージがなければ
		if($work->message == null or unserialize($work->message) == null){
			return View::make('message/unread')
				->with('warning','　未読メッセージはありません');
		}
		//指定IDが未読メッセージの中にあれば
		if(isset($id) and in_array($id,unserialize($work->message))){
			//return $key;
				//未読メッセージIDの配列を取得
				$unread=unserialize($work->message);
					//未読メッセージを削除
					array_pull($unread,$key);
					//配列のキーを前に詰める
					$unread=array_values($unread);
				$message=serialize($unread);
				$work->message=$message;
				$work->save();
				//削除後に明細ページへ移動
				return Redirect::to('message/view/'.$id);
		}
		//未読メッセージの配列取得
		$unread=isset($work) ? unserialize($work->message) : null;
		//return dd($unread);
		//配列の数だけオブジェクトを取得
		foreach($unread as $key=>$value):
			$data['message'][]=Message::find($value);
		endforeach;
		return View::make('message/unread',$data);
	}
/*
|------------------------------------
| 明細ページ
|------------------------------------
*/
 public function getView($id=null){
	 $data['messages']=Message::find($id);
	 //$com=isset($mes->comment) ? unserialize($mes->comment) : null;
	 //return dd($com);
	 //$data=array('message'=>$mes,'comment'=>$com);
	 return View::make('message/view',$data);
 }
/*
|------------------------------------
| コメントページ
|------------------------------------
*/
	public function getComment($action=null,$id=null){
		//コメント作成
		if($action=='creaet'){
			$data['action']=$action;
			$data['key']=$id;
		return View::make('message/comment/create',$data);
		//未読コメントの表示
		}elseif($action=='unread'){
		//未読メッセージ
				$data['action']=$action;
				$unread=Work::find(Auth::user()->id)->pluck('comment');
				//return dd($unread);
				$data['action']=$action;
				$data['comments']=isset($unread) ? unserialize($unread) :null;
			return View::make('message/comment/unread',$data);
			//未読コメントのチェック
		}elseif($action=='check'){
			$data['action']=$action;
			$data['key']=$id;
			//未読コメントの削除
			return View::make('message/view/'.$id,$data);
		}
	}
	
	public function postComment($action=null,$id=null){
		//return var_dump($id);
		if($action = 'create'){
			$inputs=Input::only('comment');
			//return var_dump($inputs);
			$rules=array('comment'=>'required');
			$val=Validator::make($inputs,$rules);
			if($val->fails()){
				return Redirect::back()
					->withInput()
					->withErrors($val);
			}
			//新しいコメントを配列として取得
			$new=(array($inputs['comment'].' ( '.Auth::user()->name.' より )'));
			$message=Message::find($id);
			//古いコメントを配列として取得
			$old=isset($message->comment) ? unserialize($message->comment) : array();
			//配列の併合
			$merge=isset($old) ? array_merge($old,$new) : $new;
			//コメントをシリアライズで保存
			$message->comment=serialize($merge);
			$message->save();
			
			/***************************************
			 *  worksテーブルの未読コメントを登録
			 ***************************************/
			 //メッセージの受信者を取得
			 if(isset($message->recipient_id)){
				 $users=User::where('user_id',$message->recipient_id)->get();
			 }else{
				 $users=User::where('role_id','<=',$message->role_id)->get();
			 }
			 //return dd($users);
			   foreach($users as $user):
					$work=Work::where('user_id',$user->id)->first();
				 	//新しいコメントのメッセージID
					$new=(array($message->id));
				   //古いコメントを配列として取得
					$old=isset($work->comment) ? unserialize($work->comment) : array();
					//return dd($old);
					//配列の併合
				  $merge=isset($old) ? array_merge($old,$new) : $new;
					//return dd($merge);
					//$work=Work::find($user_id);
					//return dd($work->comment);
					//コメントをシリアライズで保存
					$work->comment=serialize($merge);
					$work->save();
				 endforeach;
		}
		//ログインユーザーの全メッセージを取得
		$data['messages']=Message::own()->paginate();
		return View::make('message/index',$data);
	}	
	
/*
|------------------------------------
| メッセージ検索
|------------------------------------
*/
	public function postSearch(){
		$input=Input::get('search');
		$data['messages']=Message::where('subject','LIKE','%'.$input.'%')
			->orWhere('body','LIKE','%'.$input.'%')
			->orWhere('comment','LIKE','%'.$input.'%')
			->orderBy('created_at','desc')
			->paginate();
		return View::make('message/index',$data);
	}
}