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


    <hr>

    <div class="panel">
      <h3>Get going!</h3>
      <h5 class="subheader">Now that you understand the gist of what Foundation is and how it works, it's time to start a project! We've got two different ways for you to build projects with Foundation, a Compass Gem using Scss or a with plain CSS.</h5>
      <a href="./sass.html" class="button">Using the Gem</a></li>
      <a href="http://foundation.zurb.com/migration.php" class="button secondary">Quickstart with CSS</a></li>
    </div>
    
  </div>
  
@section('sidebar')
{{ View::make('layouts.f4.user.sidebar') }}
@show

<p><a href="http://foundation.zurb.com/download.php" class="button expand" style="margin-bottom: 0;">Download Foundation 4</a></p>

<div class="jobs hide-for-small">
  <h5>Awesome product jobs:</h5>
  <script type="text/javascript" src="http://www.zurb.com/jobs/widgets/jobs.js?limit=3&variation=foundation-sidebar"></script>
  <a id="via" href="http://zurbjobs.com">via&nbsp;<span class="jobs-link">ZURBjobs</span></a>
</div>

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
