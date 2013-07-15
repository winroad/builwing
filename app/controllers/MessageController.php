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
 
	//ユーザー受信メッセージ
	protected function own(){
		$user=Auth::user();
		$role_id=DB::table('role_user')
					->where('user_id',$user->id)
					->lists('role_id');
		$role_names=Role::whereIn('id',$role_id)->lists('name');
		$query=Message::where('recipient_id',$user->id)
	 			->orderBy('created_at','desc');
			foreach($role_names as $role_name):
				$query->orWhere('role_name','LIKE',"%$role_name%");
			endforeach;
				$query->where('user_id','<>',$user->id);
		return $query;
	}
	//ユーザー送信メッセージ
	protected function sent(){
		$user=Auth::user();
		$query=Message::where('user_id',$user->id)
	 		->orderBy('created_at','desc');
		return $query;
	}
 //カラム内の配列の取得
 protected function order($column){
	 $work=Work::find(Auth::user()->id);
	 $order=count($work->$column == 0) ? unserialize($work->$column) : null;
		 return $order;
	}
 
/*
|------------------------------------
| TOPページ
|------------------------------------
*/
	public function getIndex($action=null){
		if($action == 'sent'):
			$messages=$this->sent()->paginate();
			$data['title']='送信メッセージ一覧';
			$data['action']='sent';
		else:
			//ユーザーの受信メッセージを取得
			$messages=$this->own()->paginate();
			$data['title']='受信メッセージ一覧';
			$data['action']=null;
		endif;
		$data['messages']=(count($messages) != 0) ? $messages : null;
		return View::make('message/index',$data);
	}	
	
/*
|------------------------------------
| 新規メッセージ作成View
|------------------------------------
*/
	public function getCreate($action=null){
		if($action == 'user'){
			$recipi=User::all()->lists('name','id');
			$data['user']=array_except($recipi,array(1));
			$data['title']='個人宛メッセージ';
			$url='/user';
		}elseif($action == 'role'){
			$roles=Role::all()->lists('name','id');
			$data['roles']=array_except($roles,array(1));
			$data['title']='グループ宛メッセージ';
			$url='/role';
		}else{
			$roles=Role::all()->lists('name','id');
			$data['roles']=array_except($roles,array(1));
			$data['title']='全体メッセージ';
			$url='/create';
		}
		return View::make('message'.$url,$data);
	}
	
/*
|------------------------------------
| 新規メッセージ作成POST処理
|------------------------------------
*/

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
		//データ登録
		$role_name=Input::get('role_name');
		$role_name=isset($role_name) ? serialize($role_name) : null;
		$inputs['role_name']=$role_name;
		$message=Message::create($inputs);

	/*****************************************
	 * 未読処理
	 * worksテーブルのmessage項目に配列保存
	 *****************************************/
		
		$recipient_id=Input::get('recipient_id');
		//個人宛メッセージなら
		if(isset($inputs['recipient_id'])){
			//受信メッセージの整理
			$work=Work::find($recipient_id);
			//旧メッセージ
			$old=isset($work->message) ? unserialize($work->message) : array();
			//新メッセージ
			$new=array($message->id);
			//配列の併合
			$merge=!isset($old) ? array_merge($old,$new) : $new;
			//登録データの保存
			$work->message=serialize($merge);
			$work->save();
			
	/*****************************************
	 * メール送信
	 *****************************************/
	 
	 		$data['recipient']=User::find($recipient_id)->name;
			$data['sender']=Auth::user()->name;
			$data['title']=Input::get('subject');
			$data['body']=Input::get('body');
	 		Mail::send('emails.user.message',$data,function($m){
				$user=User::find(Input::get('recipient_id'));
				$email=$user->email;
				$name=$user->name;
				$m->to($email,$name)->subject('Builwing通信');
				});
			
		//Role宛てメッセージなら
		}else{
			//新メッセージ
			$new=array($message->id);
			//指定ロールIDを取得
			$role_id=Role::whereIn('name',Input::get('role_name'))->lists('id');
			//指定ユーザーIDを取得
			$user_id=DB::table('role_user')
					->whereIn('role_id',$role_id)
					->lists('user_id');
			//指定ユーザーを取得
			$users=User::whereIn('id',$user_id)->get();
			//ユーザーの数だけ繰り返し
			foreach($users as $user):
				//旧メッセージの取得
				$work=Work::find($user->id);
				$old=isset($work->message) ? unserialize($work->message) : array();
				//配列の併合
				$merge=isset($old) ? array_merge($old,$new) : $new;
				//登録データの保存
				$work->message=serialize($merge);
				$work->save();
			endforeach;
	/*****************************************
	 * メール送信
	 *****************************************/
	 if(Input::get('mail') == 1){
		 //メール送信手続き
	 		$data['recipient']=Role::find(Input::get('role_name'))->name;
			$data['sender']=Auth::user()->name;
			$data['body']=Input::get('body');
	 		Mail::send('emails.user.message',$data,function($m){
					//指定ロールIDを取得
					$role_id=Role::whereIn('name',Input::get('role_name'))
								->lists('id');
					//指定ユーザーIDを取得
					$user_id=DB::table('role_user')
								->whereIn('role_id',$role_id)
								->lists('user_id');
					//指定ユーザーを取得
					$users=User::whereIn('id',$user_id)
								->get();
					//ユーザーの数だけ繰り返し
					foreach($users as $user):
						$m->cc($user->email,$user->name);
					endforeach;
				$m->subject(Input::get('subject'));
				});
	 }
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
		//未読メッセージのID配列取得
		$message=$this->order('message');
		//dd($message);
		//未読メッセージがなければ
		if(count($message)== 0 or $message == null){
			return View::make('message/unread')
				->with('warning','　未読メッセージはありません');
		}
		//指定IDが未読メッセージの中にあれば
		if(isset($id) and in_array($id,unserialize($work->message))){
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
		//配列の数だけオブジェクトを取得
		foreach($message as $key=>$value):
			$data['message'][$key]=Message::find($value);
		endforeach;
		return View::make('message/unread',$data);
	}
/*
|------------------------------------
| 明細ページ
|------------------------------------
*/
	public function getView($id=null){
		$own=$this->own()->where('id',$id)->get();
	 	if($own->count() == 0 ):
			$data['title']='指定のメッセージはありません';
			$data['action']=null;
	 		return View::make('message/index',$data);
	 endif;
			$data['message']=Message::find($id);
	 		$data['title']='メッセージ明細';
			
	 return View::make('message/view',$data);
 }
	
/*
|------------------------------------
| メッセージ検索
|------------------------------------
*/
	public function postSearch(){
		$input=Input::get('search');
		$action=Input::get('action');
		if($action == 'sent'):
			$data['messages']=$this->sent()
				->where('subject','LIKE','%'.$input.'%')
				->paginate();
			$data['title']='送信メッセージ検索';
			$data['action']='sent';
		else:
			$data['messages']=$this->own()
				->where('subject','LIKE','%'.$input.'%')
				->paginate();
			$data['title']='受信メッセージ検索';
			$data['action']=null;
		endif;
		return View::make('message/index',$data);
	}

}