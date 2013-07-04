@extends('layouts.f4.user.base')
@section('content')
@if(isset($message))
<div data-alert class="alert-box alert radius">
	{{ $message }}
  <a href="#" class="close">&times;</a>
</div>
@else
<div data-alert class="alert-box success radius">
項目修正です。
</div>
@endif
	{{ Form::open(array('url'=>'profile/update')) }}
  @foreach($itm as $key=>$value)
  {{ Form::label($key) }}
  {{ Form::text($key,$value,array('style'=>'ime-mode:active')) }}
  @if($errors->has($key))
		<h5 style="color:red;text-align:center">
    {{ $errors->first($key) }}
    </h5>
	@endif
  @endforeach
  {{ Form::label('変更理由') }}
  {{ Form::text('reason','',array('style'=>'ime-mode:active')) }}
  {{ Form::hidden('cat',$cat) }}
  {{ Form::hidden('old_itm',$value) }}
  {{ Form::hidden('itm',$key) }}
  {{ Form::submit('送信',array('class'=>'button')) }}
  {{ Form::close() }}
@stop