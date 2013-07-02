@extends('layouts.f4.user.base')
@section('content')
@if(isset($message))
<div data-alert class="alert-box alert radius">
	{{ $message }}
  <a href="#" class="close">&times;</a>
</div>
@endif
	{{ Form::open(array('url'=>'profile/create')) }}
  {{ Form::label('電話番号') }}
  {{ Form::text('tel','') }}
  @if($errors->has('tel'))
		<h5 style="color:red;text-align:center">
    {{ $errors->first('tel') }}
    </h5>
	@endif
  {{ Form::label('住所情報') }}
  {{ Form::text('address','') }}
  {{ Form::label('身体情報') }}
  {{ Form::text('body','') }}
  {{ Form::label('資格情報') }}
  {{ Form::text('license','') }}
  {{ Form::label('労務情報') }}
  {{ Form::text('labor','') }}
  {{ Form::label('家族情報') }}
  {{ Form::text('family','') }}
  {{ Form::label('その他') }}
  {{ Form::text('note','') }}
  {{ Form::hidden('user_id',Auth::user()->id) }}
  {{ Form::submit('送信',array('class'=>'button')) }}
  {{ Form::close() }}
@stop