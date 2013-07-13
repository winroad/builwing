@extends('layouts.f4.user.base')
@section('content')
{{ Form::open(array('class'=>'custom'))}}
<div class="panel">
<h3>全体メッセージ</h3>
<p>全体メッセージは、メールを送信するかどうかチェックを入れてください。</p>
</div>
<h4>{{ Form::label('タイトル') }}</h4>
{{ Form::text('subject','',array('style'=>'ime-mode:active')) }}
	@if($errors->has('subject'))
		<div data-alert class="alert-box alert radius">
			{{ $errors->first('subject') }}
  	</div>
	@endif
<h4>{{ Form::label('内容') }}</h4>
{{ Form::textarea('body','',array('style'=>'ime-mode:active')) }}
	@if($errors->has('body'))
		<div data-alert class="alert-box alert radius">
			{{ $errors->first('body') }}
  	</div>
	@endif
  <br>
<div class="row">
	<div class="large-12 columns">
      <label for="radio1">
      <input name="radio1" type="radio" id="radio1" style="display:none;>
      <span class="custom radio checked"></span> メール送信
      </label>
      <label for="radio1">
      <input name="radio1" type="radio" id="radio1" style="display:none;" CHECKED>
      <span class="custom radio"></span> メール未送信
      </label>
	</div>
</div>
<div class="row">
	<div class="small-6 large-centered columns">
	{{ Form::submit('メッセージ送信',array('class'=>'button')) }}
	</div>
</div>
{{ Form::hidden('role_id',6) }}
{{ Form::hidden('user_id',Auth::user()->id) }}
{{ Form::close() }}
@stop