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
 
 private function labor(){
	 $labor=Labor::where('user_id',Auth::user()->id)->get();
	 if(count($labor) == 0){
		 return '0です';
	 }else{
		 return count($labor).'件のメッセージがあります。';
	 }
 }
/*
|------------------------------------
| TOPページ（authフィルターの適用）
|------------------------------------
*/
 public function getIndex(){
	 //return $this->labor();
	 
	 return View::make('user/index');
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
 'name'=>'required',
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
| アクティベート
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
| ログイン
|-----------------------------------------
*/
 public function getLogin(){
	 return View::make('user/login');
 }
 public function postLogin(){
 //受信データの整理
 $inputs=Input::only('email','password');
 //バリデーションの指定
 $rules=array(
 'email'=>'required|email',
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
 $inputs['activate']=1;
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