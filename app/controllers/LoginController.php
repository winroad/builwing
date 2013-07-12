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
 try{
	 
 Auth::attempt($inputs);
 	return Redirect::intended('/');
 
 }
 catch(Exception $e){
 	return Redirect::back()
		->with('message',$e->getMessage());
 }
 
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
/*
|-----------------------------------------
| アクティベート
|-----------------------------------------
*/
 public function getActivate($onepass){
	 $data['onepass']=$onepass;
	 //return dd($data);
	 return View::make('login/activate',$data);
 }
 
 public function postActivate(){
	 //return dd(Input::all());
	 $inputs=Input::only('password');
	 $rules=array('password'=>'required|between:8,16');
	 $val=Validator::make($inputs,$rules);
	 		if($val->fails()){
				return Redirect::back()
					->InputErrors($val);
			}
	//本登録手続き
	$onepass=Input::get('onepass');
	//return dd($onepass);
	$password=Input::get('password');
	$limit=date('Y/m/d H:i:s');
	$activate=Activate::where('onepass',$onepass)
				->where('password',$password)
				->where('limit','>',$limit)
				->first();
	//return dd($activate);
	if(isset($activate)){
		//ユーザー登録
		$user=new User();
		$user->name=$activate->name;
		$user->password=$activate->password;
		$user->email=$activate->email;
		$user->verified=1;
		//userの作成
		$user->save();
		//ロールの作成
	  $user->roles()->sync(array($activate->role_id));
		$profile['id']=$user->id;
		//profileの作成
		$pro=Profile::create($profile);
		$work['id']=$user->id;
		//workの作成
		Work::create($work);
		
		//仮登録の削除
		$activate->delete();
		
		return View::make('/');
	
 //該当者がいなければ
 }else{
 return 'アクティベートできません。';
 }
 
 }
 
}