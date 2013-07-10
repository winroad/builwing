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
	$user = Sentry::authenticate($inputs, false);
	 	return Redirect::intended('/');
	}
	catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
	{
    	echo 'ログインフィールドは必須です。';
	}
	catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
	{
    	echo 'パスワードフィールドは必須です。';
	}
	catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
	{
    echo 'ユーザーが見つかりませんでした。';
	}
	catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
	{
    	echo 'ユーザーはアクティベートされていません。';
	} 
	catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
	{
   	 echo 'ユーザー権限が停止されています。';
	}
	catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
	{
    	echo '禁止ユーザーです。';
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
	 //グループ名リスト作成
	 $data['groups']=Group::lists('name','id');
 			return View::make('login/create',$data);
 }
 //POSTの処理
 public function postCreate(){
 //受信データの整理
 $inputs=Input::except('_token','group_id');
 //return dd(Input::all());
 $group_id=Input::get('group_id');
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
	
	try{
 // ユーザーの作成
 $user = Sentry::getUserProvider()->create($inputs);
//グループIDを使用してグループを検索
 $adminGroup = Sentry::getGroupProvider()->findById($group_id);
// ユーザーにグループを割り当てる
 $user->addGroup($adminGroup);
}
catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
{
 echo 'ログインフィールドは必須です。';
}
catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
{
 echo 'パスワードフィールドは必須です。';
}
catch (Cartalyst\Sentry\Users\UserExistsException $e)
{
 echo 'このログインユーザーは存在します。';
}
catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
{
 echo 'グループは見つかりません。';
}	
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