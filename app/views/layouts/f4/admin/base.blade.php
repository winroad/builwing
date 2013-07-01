{{--Admin用ベーステンプレート--}}
<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="ja"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="ja"> <!--<![endif]-->

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title>Builwing管理室</title>

	{{ HTML::style('f4/css/normalize.css') }}
	{{ HTML::style('f4/css/foundation.css') }}
  {{ HTML::style('f4/css/mystyle.css') }}
  {{ HTML::script('f4/js/vendor/custom.modernizr.js') }}

</head>
<body style="background:#FCF">

@section('topbar')
{{ View::make('layouts.f4.admin.topbar') }}
@show

<!-- メインコンテンツとサイドバー --> 
<div class="row"> 
<!-- メインコンテンツ -->
<div class="large-9 push-3 columns" role="content"> 

@yield('content')

</div><!-- メインコンテンツの終了 -->

<!-- サイドバー --> 
<aside class="large-3 pull-9 columns">

@section('sidebar')
{{ View::make('layouts.f4.admin.sidebar') }}
@show
</aside> 
<!-- サイドバーの終了 -->
</div><!-- メインコンテンツとサイドバーの終了 -->

@section('footer')
<hr>
{{ View::make('layouts.f4.admin.footer') }}
@show
 
<script>
document.write('<script src="http://bw.winroad.jp/f4/js/vendor/'
        + ('__proto__' in {} ? 'zepto' : 'jquery')
        + '.js"><\/script>');
    </script>
 {{ HTML::script('f4/js/foundation.min.js') }}
		<script>
    $(document).foundation();
  </script>

  </body>
</html>