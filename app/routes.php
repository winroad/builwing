<?php

/*
|--------------------------------------------------------------------------
| アプリケーションルート
|--------------------------------------------------------------------------
|
| このファイルでアプリケーションの全ルートを定義します。
| 方法は簡単です。対応するURIをLaravelに指定してください。
| そしてそのURIに対応する実行コードをクロージャーで指定します。
|
*/

/*Route::get('/', array('before'=>'auth',function(){
	return Redirect::to('user/index');
}));*/

Route::get('/','UserController@getIndex');

Route::controller('setup','SetupController');
Route::controller('user','UserController');
Route::controller('admin','AdminController');
Route::controller('profile','ProfileController');
Route::controller('category','CategoryController');
Route::controller('item','ItemController');
Route::controller('history','HistoryController');
Route::controller('message','MessageController');
Route::controller('comment','CommentController');
Route::controller('group','GroupController');
Route::controller('login','LoginController');
Route::controller('role','RoleController');
Route::controller('permission','PermissionController');
//Route::resource('admin','AdminController');

View::composer('admin/*',function($view){
	$view->with('count',User::count());
});

Route::get('sample',function(){
	$roles=DB::table('role_user')
		->where('role_id','=',2)->lists('user_id');
	$users=DB::table('users')
			->whereIn('id',$roles)->get();
	foreach($users as $user):
		echo $user->email;
		echo $user->name.'<br>';
	endforeach;
	/*$roles=DB::table('role_user')
		->where('role_id','=',2)->lists('user_id');
	$users=DB::table('users')
			->whereIn('id',$roles)->get();
	foreach($users as $user):
		echo $user->email;
		echo $user->name.'<br>';
	endforeach;*/
	//return dd($emails);
	//$roles=Role::where('id','>',3)->get();
	//return dd($roles);
	/*$users=User::with(array('roles'=>function($query){
			$query->where('name','=','Admin');
	}))->get();
	foreach($users as $user):
		echo $user->name.'<br>';
	endforeach;
	/*foreach(Role::with('users')->where('id','>',2)->get() as $role):
		echo $role->users;
	endforeach;*/
});

Form::macro('myField',function(){
	return '<h1>Formマクロのテスト</h1>';
});

