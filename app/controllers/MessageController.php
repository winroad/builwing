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
 
	private function person(){
		$message=Message::where('recipient_id','=',Auth::user()->id)
	 		->orderBy('created_at','desc')
			->paginate();
		return $message;
	}
	private function role(){
		$message=Message::where('role_id','>=',Auth::user()->role_id)
	 		->orderBy('created_at','desc')
			->paginate();
		return $message;
	}
	private function owner(){
		$message=Message::where('recipient_id','=',Auth::user()->id)
			->orWhere('role_id','>=',Auth::user()->role_id)
	 		->orderBy('created_at','desc')
			->paginate();
		return $message;
	}
/*
|------------------------------------
| TOPページ
|------------------------------------
*/
	public function getIndex(){
		$data['messages']=$this->owner();
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
	 * laborテーブルのmessage項目に配列保存
	 ********************************/
		
		//個人宛メッセージなら
		if(isset($inputs['recipient_id'])){
			//受信メッセージの整理
			$key=time();
			$labor[$key]=$message->id;
			//保存データの整理
			$data['user_id']=$inputs['recipient_id'];
			$data['message']=serialize($labor);
			//データ登録
				Labor::create($data);
		}
		
		
		
	
	//トップページへ移動
	return Redirect::to('message/index');
	}
}