<?php
class UserController extends BaseController{
/*
|----------------------------------------
| コンストラクター
|----------------------------------------
*/
 public function __construct(){
 //authフィルター
 $this->beforeFilter('auth');//,array(
 			//'except'=>array('getIndex')));
 //全POSTにcsrfフィルターの適用
 $this->beforeFilter('csrf',array('on'=>'post'));
 }
 //カラム内の配列の取得
 private function order($column){
	 $work=Work::find(Auth::user()->id);
	 $order=isset($work->$column) ? unserialize($work->$column) : null;
		 return $order;
	}
/*
|------------------------------------
| TOPページ
|------------------------------------
*/
 public function getIndex(){
	 $message=$this->order('message');
	 $comment=$this->order('comment');
	 if(count($message) != 0){
		 $data['message']=count($message).'件の未読メッセージがあります。
		 			ここをクリックして確認してください。';
		}
	 if(count($comment) != 0){
		 $data['comment']=count($comment).'件の未読コメントがあります。
		 			ここをクリックして確認してください。';
	 }
	 $data=isset($data) ? $data : array();
	 return View::make('user/index',$data);
 }
/*
|-----------------------------------
| 新規作成
|-----------------------------------
| 1.GETでビューの表示
| 2.POSTでユーザー仮登録
| 3.仮登録後、アクティベートメールの送信
*/
 //GETの処理
 public function getCreate(){
 return View::make('user/create');
 }
 //POSTの処理
 public function postCreate(){
 //受信データの整理
 $inputs=Input::only('name','email','password');
 //バリデーションの指定
 $rules=array(
 'name'=>'required|unique:users',
 'email'=>'required|email|unique:users',
 'password'=>'required|min:4',
 );
 //バリデーションチェック
 $val=Validator::make($inputs,$rules);
 //バリデーションNGなら
 if($val->fails()){
 return Redirect::back()
 ->withErrors($val)
 ->withInput();
 }
 //ユーザーの新規作成
 $role_id=isset($role->id) ? $role->id : 8;
 $inputs['onepass']=md5(Input::get('name').time());
 $user=User::create($inputs);
 $user->roles()->sync(array($role_id));
//アクティベートメールの送信
 $data['onepass']=$inputs['onepass'];
 $data['username']=Input::get('name');
 Mail::send('emails.auth.activate',$data,function($m){
 $m->to(Input::get('email'),Input::get('name'))
 ->subject('アクティベート手続き');
 });
 return $user->name.'さん。<br>メールを送信しましたので、アクティベート手続きをして下さい。';
 }
/*
|-----------------------------------------
| アクティベート（authフィルターの除外）
|-----------------------------------------
*/
 Public function getActivate($onepass=null){
 //メール添付のワンパス検索OKなら
 if($user=User::where('onepass','=',$onepass)->first()){
 //アクティベート
 $user->activate=1;
 //ワンパスの変更
 $user->onepass=md5($user->username.time());
 //データ保存
 $user->save();
 //トップページへリダイレクト
 return Redirect::to('user');
 //一致するワンパスがなければ
 }else{
 return 'アクティベートできません。';
 }
 }
 /*
|-----------------------------------------
| ログイン（authフィルターの除外）
|-----------------------------------------
*/
 public function getLogin(){
	 return View::make('user/login');
 }
 public function postLogin(){
 //受信データの整理
 $inputs=Input::only('name','password');
 //バリデーションの指定
 $rules=array(
 //'name'=>'required',
 //'email'=>'required|email',
 'password'=>'required|min:4',
 );
 //バリデーションチェック
 $val=Validator::make($inputs,$rules);
 //バリデーションNGなら
 if($val->fails()){
 return Redirect::back()
 ->withErrors($val)
 ->withInput();
 }
 //ログイン認証
 //$inputs['activate']=1;
 if(Auth::attempt($inputs)){
 	return Redirect::intended('/');
 }
	 return 'ログインできません';
 }
 /*
|-----------------------------------------
| ログアウト
|-----------------------------------------
*/
 public function getLogout(){
	 Auth::logout();
	 return Redirect::to('/');
 }
 /*
|-----------------------------------------
| パスワードの変更
|-----------------------------------------
*/
	public function getPassword($id){
		//ユーザーの特定
		$user=Auth::user();
		if($id == $user->id){
			return View::make('user/password');
		}
		return View::make('user/index')
				->with('warning','Password更新権利がありません。');
	}
	public function postPassword($action=null,$id=null){
		if($action == 'reset' and $id == Auth::user()->id){
			$inputs=Input::only('password');
			$rules=array('password'=>'required|alpha_dash|between:4,16');
			$val=Validator::make($inputs,$rules);
			if($val->fails()){
				return Redirect::back()
						->withInput()
						->withErrors($val);
			}
			//Passwordの変更処理
			$user=Auth::user();
			$user->password=Input::get('password');
			$user->save();
		}
		return View::make('user/index');
	}
}