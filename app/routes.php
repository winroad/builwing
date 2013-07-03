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

Route::get('/', function(){
	return View::make('hello');
});

Route::controller('setup','SetupController');
Route::controller('user','UserController');
Route::controller('admin','AdminController');
Route::controller('profile','ProfileController');
Route::controller('category','CategoryController');
Route::controller('item','ItemController');

Route::get('sample', function(){
	$data['roles']=Role::lists('name','level');
	return View::make('sample',$data);
});
