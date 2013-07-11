<?php
class LoginController extends BaseController{
/*
|----------------------------------------
| コンストラクター
|----------------------------------------
*/
 public function __construct(){
 //全POSTにcsrfフィルターの適用
 $this->beforeFilter('csrf',array('on'=>'post'));
 }
/*
|------------------------------------
| TOPページ(ログイン)
|------------------------------------
*/
 public function getIndex(){
	 return View::make('login/index');	 
 }
 public function postIndex(){
 //受信データの整理
 $inputs=Input::only('name','password');
 //バリデーションの指定
 $rules=array(
 'name'=>'required',
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
 if(Auth::attempt($inputs)){
 	return Redirect::intended('/');
 }
	 return 'ログインできません';
 
 }
/*
|-----------------------------------
| ユーザー新規作成
|-----------------------------------
| 1.GETでビューの表示
| 2.POSTでユーザー登録
*/
 //GETの処理
 public function getCreate(){
	 //Role名リスト作成
	 $data['roles']=Role::lists('name','id');
 			return View::make('login/create',$data);
 }
 //POSTの処理
 public function postCreate(){
 //受信データの整理
 $inputs=Input::except('_token','group_id');
 //return dd(Input::all());
 $role_id=Input::get('role_id');
 //return dd($inputs);
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
 
 /*******************************
  *  新規作成
	*******************************/
	
	$user=User::create($inputs);
	
	$profile['id']=$user->id;
	//profileの作成
	$pro=Profile::create($profile);
	//$user->profile_id=$pro->id;
	//$user->work_id=$user->id;
	$user->save();
	$work['id']=$user->id;
	//workの作成
	Work::create($work);
	//コントローラアクションへパラメーターを渡し、リダレクト
	return Redirect::to('admin/user');
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