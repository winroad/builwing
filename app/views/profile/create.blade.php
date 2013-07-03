@extends('layouts.f4.user.base')
@section('content')
@if(!isset($message))
	<div data-alert class="alert-box success radius">
	{{ $description }}
  </div>
	{{ Form::open() }}
@foreach($items as $key=>$value)
  	{{ Form::label($key) }}
  	{{ Form::text($key,'',array('style'=>'ime-mode:active')) }}
@endforeach
  {{ Form::submit('送信',array('class'=>'button')) }}
  {{ Form::hidden('column',$column) }}
  {{ Form::hidden('id',Auth::user()->id) }}
  {{ Form::close() }}
@else  
	<div data-alert class="alert-box alert radius">
	{{ $message }}
  <a href="#" class="close">&times;</a>
</div>
@endif
@stop