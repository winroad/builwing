@extends('layouts.f4.user.base')
@section('content')
@if(isset($message))
<div data-alert class="alert-box alert radius">
	{{ $message }}
  <a href="#" class="close">&times;</a>
</div>
@endif
	{{ Form::open(array('url'=>'profile/item')) }}
  {{ Form::label('項目名') }}
  {{ Form::text('name','',array('style'=>'ime-mode:active')) }}
  @if($errors->has('name'))
		<h5 style="color:red;text-align:center">
    {{ $errors->first('name') }}
    </h5>
	@endif
  {{ Form::label('項目内容') }}
  {{ Form::text('detail','',array('style'=>'ime-mode:active')) }}
  @if($errors->has('detail'))
		<h5 style="color:red;text-align:center">
    {{ $errors->first('detail') }}
    </h5>
   @endif
  {{ Form::submit('送信',array('class'=>'button')) }}
  {{ Form::hidden('item',$item) }}
  {{ Form::close() }}
@stop