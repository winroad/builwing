<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="ja"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="ja"> <!--<![endif]-->

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title>Foundation 4</title>

	{{ HTML::style('f4/css/normalize.css') }}
	{{ HTML::style('f4/css/foundation.css') }}
  {{ HTML::style('f4/css/mystyle.css') }}
  {{ HTML::script('f4/js/vendor/custom.modernizr.js') }}

</head>
<body>

@section('topbar')
{{ View::make('layouts.f4.topbar') }}
@show

<!-- Main Page Content and Sidebar --> 
<div class="row"> 
<!-- Main Content -->
<div class="large-9 columns" role="content"> 

@yield('content')

</div><!-- End Main Content -->

@section('sidebar')
{{ View::make('layouts.f4.sidebar') }}
@show

</div><!-- End Main Content and Sidebar -->

@section('footer')
<hr>
{{ View::make('layouts.f4.footer') }}
@show
<script>
<!--//
t_speed=5;//点滅スピード
		my_cnt=0;
		
	function tenmetu(){
		obj = document.all("t1");
		if(my_cnt==0)
				{
				obj.style.visibility = "visible";
				my_cnt=1;		
				}else{
				obj.style.visibility = "hidden";
				my_cnt=0;
				}
				setTimeout("tenmetu()", t_speed*100);			
				}
//-->
</script>
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