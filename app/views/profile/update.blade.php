@extends('layouts.f4.user.base')
@section('content')
@if(isset($message))
<div data-alert class="alert-box alert radius">
	{{ $message }}
  <a href="#" class="close">&times;</a>
</div>
@else
<div data-alert class="alert-box success radius">
項目作成です。
</div>
@endif
	{{ Form::open(array('url'=>'profile/update')) }}
  {{ Form::label('電話番号') }}
  {{ Form::text('tel',Auth::user()->tel) }}
  @if($errors->has('tel'))
		<h5 style="color:red;text-align:center">
    {{ $errors->first('tel') }}
    </h5>
	@endif
  @foreach($items as $key=>$value)
  	{{ Form::label($key) }}
    {{ Form::text($value) }}
  @endforeach
  {{ Form::hidden('user_id',Auth::user()->id) }}
  {{ Form::submit('送信',array('class'=>'button')) }}
  {{ Form::close() }}
@stop