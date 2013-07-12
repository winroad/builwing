<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta name="viewport" content="width=device-width,minimum-scale=1">
<title>ログイン</title></head>
{{ HTML::style('login.css')}}
</head>
<body>
{{ Form::open(array('class'=&gt;'form-container')) }}
<!--<form class="form-container">
--><div class="form-title"><h2>Sign up</h2></div>
<div class="form-title">ユーザー名</div>
{{ Form::text('name',Input::old('name',''),array('class'=&gt;'form-field','style'=&gt;'ime-mode:active')) }}<br>
@if($errors-&gt;has('name'))
<h4 style="color:red;text-align:center">{{ $errors-&gt;first('name') }}</h4>
@endif
<div class="form-title">Password</div>
<input class="form-field" type="password" name="password"><br>
@if($errors-&gt;has('password'))
<h4 style="color:red;text-align:center">{{ $errors-&gt;first('password') }}</h4>
@endif
<div class="submit-container">
<input class="submit-button" type="submit" value="Singn Up">
</div>
{{ Form::close() }}
</body>
@if(isset($message))
{{ $message }}
@endif
</html>
