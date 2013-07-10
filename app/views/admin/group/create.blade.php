@extends('layouts.f4.admin.base')
@section('content')
@if(isset($warning))
<div data-alert class="alert-box alert">
{{ $warning }}
</div>
@else
<div data-alert class="alert-box success">
グループ新規作成yo
</div>
@endif
{{ Form::open() }}
<fieldset>
<div class="row">
  <div class="small-3 columns">
  {{ Form::label('','グループ名',array('class'=>'right')) }}
  </div>
  <div class="small-9 columns">
{{ Form::text('name',Input::old('name',''),array('style'=>'ime-mode:active')) }}
@if($errors->has('name'))
<h4 style="color:red;text-align:center">{{ $errors->first('name') }}</h4>
@endif
  </div>
</div>
<div class="row">
  <div class="small-3 columns">
  {{ Form::label('','permission',array('class'=>'right')) }}
  </div>
  <div class="small-9 columns">
  	{{ Form::checkbox('permission1',1) }} Adminの全権限
  	{{ Form::checkbox('permission2',2) }} AdminのView
  	{{ Form::checkbox('permission3',3) }} Userの全権限
		<select name="permission" size="10" multiple>
		<option value="1">admin</option>
		<option value="2" >user</option>
		<option value="3">admin.view</option>
		<option value="4">user.create</option>
		<option value="5">user.delete</option>
		<option value="6">user.view</option>
		<option value="7">user.update</option>
		</select>
  </div>
</div>
<div class="row">
	<div class="small-3 small-centered columns">
	{{ Form::submit('新規作成',array('class'=>'button')) }}
	</div>
</div>
</fieldset>
{{ Form::close() }}
@stop
