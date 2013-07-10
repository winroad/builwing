@extends('layouts.f4.admin.base')
@section('content')
@if(isset($message))
<div data-alert class="alert-box alert radius">
	{{ $message }}
  <a href="#" class="close">&times;</a>
</div>
@endif
	{{ Form::open(array('url'=>'category/create')) }}
  {{ Form::label('カテゴリ名') }}
  {{ Form::text('name','',array('style'=>'ime-mode:disabled')) }}
  @if($errors->has('name'))
		<h5 style="color:red;text-align:center">
    {{ $errors->first('name') }}
    </h5>
	@endif
  {{ Form::label('説明') }}
  {{ Form::text('description','',array('style'=>'ime-mode:active')) }}
  @if($errors->has('description'))
		<h5 style="color:red;text-align:center">
    {{ $errors->first('description') }}
    </h5>
   @endif
  {{ Form::submit('送信',array('class'=>'button')) }}
  {{ Form::close() }}
@stop