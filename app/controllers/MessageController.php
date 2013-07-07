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
 
	//個人宛メッセージの取得
	private function person(){
		$message=Message::where('recipient_id','=',Auth::user()->id)
	 		->orderBy('created_at','desc')
			->paginate();
		return $message;
	}
	//ロールの取得
	private function role(){
		$message=Message::where('role_id','>=',Auth::user()->role_id)
	 		->orderBy('created_at','desc')
			->paginate();
		return $message;
	}
	//ログインユーザーのロール宛てメッセージの取得
	private function owner(){
		$message=Message::where('recipient_id','=',Auth::user()->id)
			->orWhere('role_id','>=',Auth::user()->role_id)
	 		->orderBy('created_at','desc')
			->paginate();
		if(isset($message)){
			return $message;
		}
		return null;
	}
	//未読メッセージの取得
	private function unread(){
		$work=Work::where('user_id',Auth::user()->id);
		return $work;
	}
/*
|------------------------------------
| TOPページ
|------------------------------------
*/
	public function getIndex(){
		$data['messages']=$this->person();
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
		
		if(!isset($inputs['role_id'])){
			$inputs['role_id']=6;
		}
		//データ登録
		$message=Message::create($inputs);

	/********************************
	 * 未読処理
	 * workテーブルのmessage項目に配列保存
	 ********************************/
		
		//個人宛メッセージなら
		if(isset($inputs['recipient_id'])){
			//$old=array();
			//$new=array();
			//受信メッセージの整理
			$work=Work::where('user_id',$inputs['recipient_id'])->first();
			//旧メッセージ
			$old=isset($work->message) ? unserialize($work->message) : array();
			//新メッセージ
			$new=array($message->id);
			//配列の併合
			$merge=isset($old) ? array_merge($old,$new) : $new;
			//登録データの整理
			$work->message=serialize($merge);
			$work->save();
		}
	//トップページへ移動
	return Redirect::to('message/unread');
	}
/*
|------------------------------------
| 未読メッセージ
|------------------------------------
*/
	public function getUnread($id=null,$key=null){
		//ログインユーザーのWorkオブジェクトを取得
		$work=Work::where('user_id',Auth::user()->id)->first();
		//未読メッセージがなければ
		if($work->message == null or unserialize($work->message) == null){
			return '未読メッセージはありません';
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
				return Redirect::to('message/unread');
		}
		//未読メッセージの配列取得
		$unread=isset($work) ? unserialize($work->message) : null;
		//return var_dump($unread);
		//配列の数だけオブジェクトを取得
		foreach($unread as $key=>$value):
			$data['message'][]=Message::find($value);
		endforeach;
		//return var_dump($data['message']);
		return View::make('message/unread',$data);
	}
}