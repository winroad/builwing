<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
@section('header')
<title>ベーステンプレート</title>
@show
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=0.5,user-scalable=yes,initial-scale=1.0">
@section('css')
{{ HTML::style('grm/css/bootstrap.css') }}
{{ HTML::style('grm/css/responsive.css') }}
{{ HTML::style('grm/content/font/elusive-icons/css/elusive-webfont.min.css') }}
{{ HTML::style('grm/css/style.css') }}
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="content/font/elusive-icons/css/elusive-webfont.min.css">
<link rel="stylesheet" href="css/style.css">
<!--[if lte IE 8]><script src="/wp-content/themes/html5.theme/common/js/html5.js" type="text/javascript"></script><![endif]-->
@show
</head>

<body>
<ul class="nav">
@section('nav')
<li><a href='#'>TOP</a></li>
@show
</ul>
@yield('content')
<footer style="background-color:green;color:white;text-align:center">
@section('footer')
<h2><?php echo $corporation;?></h2>
@show
</footer>
</body>
</html>