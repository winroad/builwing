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
    $roles=Auth::user()->roles->first()->name;
		 
    return dd($roles);
});