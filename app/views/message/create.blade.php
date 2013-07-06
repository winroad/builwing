@extends('layouts.f4.user.base')
@section('content')
<h2>メッセージ作成</h2>
{{ Form::open()}}
@if(isset($user))
<h4>{{ Form::label('送信先') }}</h4>
{{ Form::select('recipient_id',$user) }}
@elseif(isset($role))
<h4>{{ Form::label('指定ロール先') }}</h4>
{{ Form::select('role_id',$role) }}
@endif
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
{{ Form::hidden('sender_id',Auth::user()->id) }}
{{ Form::submit('送信',array('class'=>'button')) }}
{{ Form::close() }}
@stop