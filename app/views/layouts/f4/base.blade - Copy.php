<!DOCTYPE HTML>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="ja"><!--<![endif]--><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Builwing</title>
{{ HTML::style('f4/css/foundation.min.css') }}
{{ HTML::style('f4/css/normalize.css') }}
    
<!--  <link rel="stylesheet" href="http://foundation.zurb.com/docs/assets/normalize.css">
    <link rel="stylesheet" href="http://foundation.zurb.com/docs/assets/docs.css">
    <script src="http://foundation.zurb.com/docs/assets/vendor/custom.modernizr.js"></script>
-->  </head>
<body class="antialiased">
@section('topbar')  
{{ View::make('layouts/f4/topbar') }}
@show

@section('header')
{{ View::make('layouts.f4.header') }}
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
  
@section('sidemenu')
{{ View::make('layouts.f4.sidemenu') }}
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
{{ View::make('layouts.f4.footer') }}
@show


    <script>
      document.write('<script src="http://foundation.zurb.com/docs/assets/vendor/'
        + ('__proto__' in {} ? 'zepto' : 'jquery')
        + '.js"><\/script>');
    </script>
    <script src="http://foundation.zurb.com/docs/assets/docs.js"></script>
    <script>
      $(document)
      
        .foundation();
      

      // For Kitchen Sink Page
      $('#start-jr').on('click', function() {
        $(document).foundation('joyride','start');
      });
    </script>
    
  </body>
</html>
