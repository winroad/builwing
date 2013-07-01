<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta name="viewport" content="width=device-width,minimum-scale=1">
<title>ログイン</title>
{{ HTML::style('login.css')}}
</head>
<body>
{{ Form::open(array('class'=>'form-container')) }}
<!--<form class="form-container">
--><div class="form-title"><h2>Sign up</h2></div>
<div class="form-title">Mail</div>
{{ Form::text('email',Input::old('email',''),array('class'=>'form-field')) }}<br>
@if($errors->has('email'))
<h4 style="color:red;text-align:center">{{ $errors->first('email') }}</h4>
@endif
<div class="form-title">Password</div>
<input class="form-field" type="password" name="password" /><br />
@if($errors->has('password'))
<h4 style="color:red;text-align:center">{{ $errors->first('password') }}</h4>
@endif
<div class="submit-container">
<input class="submit-button" type="submit" value="Singn Up" />
</div>
{{ Form::close() }}
</body>
</html>
