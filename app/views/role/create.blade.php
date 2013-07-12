@extends('layouts.f4.admin.base')
@section('content')
@if(isset($warning))
<div data-alert class="alert-box alert">
{{ $warning }}
</div>
@else
<div data-alert class="alert-box success">
ロール新規作成
</div>
@endif
{{ Form::open() }}
<fieldset>
<div class="panel">
  <h3>{{ Form::label('','ロール名') }}</h3>
{{ Form::text('name',Input::old('name',''),array('style'=>'ime-mode:active')) }}
@if($errors->has('name'))
<h4 style="color:red;text-align:center">{{ $errors->first('name') }}</h4>
@endif
  <h3>{{ Form::label('','ロールlevel') }}</h3>
{{ Form::text('level','',array('style'=>'ime-mode:enable')) }}
@if($errors->has('level'))
<h4 style="color:red;text-align:center">{{ $errors->first('level') }}</h4>
@endif
{{--
<div class="panel">
<h3>{{ Form::label('','permission') }}</h3>
<h5>{{ Form::checkbox('1','admin') }} adminの全権限</h5>
  	{{ Form::checkbox('2','admin.view') }} admin.view
  	{{ Form::checkbox('3','admin.create') }} admin.create
  	{{ Form::checkbox('4','admin.delte') }} admin.delete
  	{{ Form::checkbox('5','admin.update') }} admin.update<br>
<h5>{{ Form::checkbox('6','user') }} userの全権限</h5>
  	{{ Form::checkbox('7','user.view') }} user.view
  	{{ Form::checkbox('8','user.create') }} user.create
  	{{ Form::checkbox('9','user.delete') }} user.delete
  	{{ Form::checkbox('10','uder.update') }} user.updae<br>
--}}
	<div class="small-3 small-centered columns">
	{{ Form::submit('新規作成',array('class'=>'button')) }}
</fieldset>
{{ Form::close() }}
@stop
