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
	//return View::make('hello');
	return var_dump(Profile::item('body'));
});

Route::controller('setup','SetupController');
Route::controller('user','UserController');
Route::controller('admin','AdminController');
Route::controller('profile','ProfileController');
