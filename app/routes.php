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

Route::get('/', array('before'=>'auth',function(){
	return View::make('hello');
}));

Route::controller('setup','SetupController');
Route::controller('user','UserController');
Route::controller('admin','AdminController');
Route::controller('profile','ProfileController');
Route::controller('category','CategoryController');
Route::controller('item','ItemController');
Route::controller('history','HistoryController');
Route::controller('post','PostController');
Route::controller('message','MessageController');

View::composer('admin/*',function($view){
	$view->with('count',User::count());
});