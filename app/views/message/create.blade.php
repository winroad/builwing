@extends('layouts.f4.user.base')
@section('content')
{{ Form::open(array('class'=>'custom'))}}
<div class="panel">
<h3>{{ $title }}</h3>
<p>全体メッセージは、メールを送信するかどうかチェックを入れてください。</p>
</div>
<div class="large-4 columns">
<h4>{{ Form::label('送信先部署') }}</h4>
<?php $i=0;?>
<h5>
@foreach($roles as $role)
{{ Form::checkbox("role_name"."[$i]",$role,true) }} {{ $role }}<br>
<?php $i++;?>
@endforeach
</h5>
</div>
<div class="large-8 columns">
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
</div>
<div class="row">
	<div class="large-12 columns">
      <h5>{{ Form::radio('mail',1,true) }} メール送信</H5>
      <h5>{{ Form::radio('mail',0) }} メール未送信</h5>
	</div>
</div>
<div class="row">
	<div class="small-6 large-centered columns">
	{{ Form::submit('メッセージ送信',array('class'=>'button')) }}
	</div>
</div>
{{ Form::hidden('user_id',Auth::user()->id) }}
{{ Form::close() }}
@stop