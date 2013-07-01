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
<body style="background:#FCF">

@section('topbar')
<!-- Navigation -->
<nav class="top-bar">
<ul class="title-area">
<!-- Title Area -->
<li class="name">
<h1>
<a href="#">
管理室
</a>
</h1>
</li>
<li class="toggle-topbar menu-icon"><a href="#"><span>menu</span></a></li>
</ul>
<section class="top-bar-section">
<!-- Right Nav Section -->
<ul class="right">
<li class="divider"></li>
<li class="has-dropdown">
{{ HTML::link('#','予定管理') }}
<ul class="dropdown">
<li><label>Section Name</label></li>
<li class="has-dropdown">
{{ HTML::link('#','Has Dropdown, Level 1') }}
<ul class="dropdown">
<li>{{ HTML::link('#','Dropdown Options') }}</li>
<li>{{ HTML::link('#','Dropdown Options') }}</li>
<li>{{ HTML::link('#','Level 2') }}</li>
<li>{{ HTML::link('#','Subdropdown Option') }}</li>
<li>{{ HTML::link('#','Subdropdown Option') }}</li>
<li>{{ HTML::link('#','Subdropdown Option') }}</li>
</ul>
</li>
<li>{{ HTML::link('#','Dropdown Options') }}</li>
<li>{{ HTML::link('#','Dropdown Options') }}</li>
<li class="divider"></li>
<li><label>Section Name</label></li>
<li>{{ HTML::link('#','Dropdown Options') }}</li>
<li>{{ HTML::link('#','Dropdown Options') }}</li>
<li>{{ HTML::link('#','Dropdown Options') }}</li>
<li class="divider"></li>
<li>{{ HTML::link('#','See all &rarr;') }}</li>
</ul>
</li>
<li class="divider"></li>
<li><a href="#">Main Item 2</a></li>
<li class="divider"></li>
<li class="has-dropdown">
<a href="#">ユーザー管理</a>
<ul class="dropdown">
<li>{{ HTML::link('admin','ユーザー一覧') }}</li>
<li>{{ HTML::link('admin/create','ユーザー作成') }}</li>
<li>{{ HTML::link('#','ユーザー削除') }}</li>
<li class="divider"></li>
<li>{{ HTML::link('#','See all &rarr;') }}</li>
</ul>
</li>
</ul>
</section>
</nav>
<!-- End Top Bar -->
@show

<!-- Main Page Content and Sidebar --> 
<div class="row"> 
<!-- Main Content -->
<div class="large-9 push-3 columns" role="content"> 

@yield('content')

</div><!-- End Main Content -->

@section('sidebar')
{{ View::make('layouts.f4.admin.sidebar') }}
@show

</div><!-- End Main Content and Sidebar -->

@section('footer')
<hr>
{{ View::make('layouts.f4.footer') }}
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