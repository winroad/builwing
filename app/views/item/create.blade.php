@extends('layouts.f4.admin.base')
@section('content')
@if(isset($message))
<div data-alert class="alert-box alert radius">
	{{ $message }}
  <a href="#" class="close">&times;</a>
</div>
@endif
	{{ Form::open(array('url'=>'item/create')) }}
  {{ Form::label('項目名') }}
  {{ Form::text('name','',array('style'=>'ime-mode:active')) }}
  @if($errors->has('name'))
		<h5 style="color:red;text-align:center">
    {{ $errors->first('name') }}
    </h5>
	@endif
  {{ Form::label('カテゴリ') }}
  {{ Form::select('category_id',$categories) }}
  {{ Form::submit('送信',array('class'=>'button')) }}
  {{ Form::close() }}
@stop