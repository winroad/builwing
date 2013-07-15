<?php

/*
|--------------------------------------------------------------------------
| アプリケーションとルートのフィルター
|--------------------------------------------------------------------------
|
| アプリケーションへのリクエストの前後に何か動作をさせるための
| "before"と"after"イベントに対するコードが下で定義されています。
| また、カスタムルートフィルターもここで定義します。
|
*/

App::before(function($request)
{
/*ユーザーエージェントによる振り分け
$ua=$_SERVER['HTTP_USER_AGENT'];
//iPone,iPod,Androidの文字を含んでいたら				if((strpos($ua,'iPhone'))||(strpos($ua,'iPod')!==false)||(strpos($ua,'Android')!==false)) {
	return 'mobile';
	}
	return 'PC';*/
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| 認証フィルター
|--------------------------------------------------------------------------
|
| 以下のフィルターはユーザーが現在のセッションでアプリケーションに
| ログイン中であるか調べるためのものです。さらに"guest"フィルターは
| 逆の働きをします。両方ともリダイレクトしています。
|
*/

Route::filter('auth', function(){
	if (Auth::guest()) return Redirect::guest('login');
});

Route::filter('admin', function(){
	if(Auth::guest()):
		return Redirect::guest('login');
	elseif(!Auth::user()->is(array('Super Admin','Admin','Director'))):
		return Redirect::intended('user');	
	endif;
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| ゲストフィルター
|--------------------------------------------------------------------------
|
| "guest"フィルータは認証フィルターとは全く逆の働きをし、単にユーザーが
| ログインしていないことをチェックします。リダイレクトのレスポンスが
| 問題になるようでしたら、ご自由に変更してください。
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRFへの保護フィルター
|--------------------------------------------------------------------------
|
| CSRFフィルターはクロスサイト・リクエスト・フォージェリ攻撃に対して
| アプリケーションを保護します。リクエストに含まれる特別なトークンが、
| セッションに保存されているものと一致しない場合、無効とします。
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});