<?php
class UserController extends BaseController{
/*
|----------------------------------------
| コンストラクター
|----------------------------------------
*/
 public function __construct(){
 //authフィルター
 $this->beforeFilter('auth',array(
 			'only'=>array('getIndex')));
 //全POSTにcsrfフィルターの適用
 $this->beforeFilter('csrf',array('on'=>'post'));
 }
 
 private function unread(){
	 $work=Work::find(Auth::user()->id);
	 if(isset($work)){
		 $unread=unserialize($work->message);
		 return $unread;
	 }else{
		 return null;
	 }
 }
/*
|------------------------------------
| TOPページ
|------------------------------------
*/
 public function getIndex(){
	 $data['unread']=$this->unread();
	 $count=count($this->unread()).'件の未読メッセージがあります。';
	 if($count != 0){
	 $data['message']=Auth::user()->name.'さんに'.$count.'ここをクリックして確認してください。';
	 }
	 $comment=Work::find(Auth::user()->id)->pluck('comment');
	 $comment_id=unserialize(isset($comment) ? $comment : null);
	 $comment_count=count($comment_id);
	 //return dd($comment_count);
	 $data['comment']=Auth::user()->name.'さんに'.$comment_count.'件の新しいコメントがあります。ここをクリックして確認してください。';
	 //return dd($data['message']);
	 //return dd($data['midoku']);
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
 $inputs['onepass']=md5(Input::get('name').time());
 $user=User::create($inputs);
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
 
}