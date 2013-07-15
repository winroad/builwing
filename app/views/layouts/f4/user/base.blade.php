{{--ユーザー用ベーステンプレート--}}
<!DOCTYPE HTML>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="ja"><!--<![endif]--><head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Builwing</title>
{{ HTML::style('f4/css/foundation.min.css') }}
{{ HTML::style('f4/css/normalize.css') }}
{{ HTML::style('f4/css/mystyle.css') }}
{{ HTML::script('f4/js/vendor/custom.modernizr.js') }}
	</head>
<body>
@section('topbar')  
{{ View::make('layouts/f4/user/topbar') }}
@show
    <div class="row">
   <div class="large-9 push-3 columns">

@yield('content')

    
  </div>
  <div class="large-3 pull-9 columns">
@section('sidebar')
{{ View::make('layouts.f4.user.sidebar') }}
@show
  </div>
</div>


@section('footer')
{{ View::make('layouts.f4.user.footer') }}
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
