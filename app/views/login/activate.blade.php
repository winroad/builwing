<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta name="viewport" content="width=device-width,minimum-scale=1">
<title>アクティベート</title>
{{ HTML::style('login.css')}}
</head>
<body>
{{ Form::open(array('url'=>'login/activate','class'=>'form-container')) }}
<div class="form-title"><h2>Activate手続き</h2></div>

<h3>発行されたパスワードを入力して、アクティベートを完了させてください。</h3>
<div class="form-title">Password</div>
<input class="form-field" type="password" name="password" /><br />
@if($errors->has('password'))
<h4 style="color:red;text-align:center">{{ $errors->first('password') }}</h4>
@endif
<div class="submit-container">
<input class="submit-button" type="submit" value="Activate" />
</div>
{{ Form::hidden('onepass',$onepass) }}
{{ Form::close() }}
</body>
</html>
