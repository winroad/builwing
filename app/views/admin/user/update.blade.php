@extends('layouts.f4.admin.base')
@section('content')
@if(isset($message))
<div data-alert class="alert-box alert">
{{ $message }}
</div>
@else
<div data-alert class="alert-box success">
ユーザー更新
</div>
@endif
{{ Form::open() }}
<fieldset>
<legend><h4>ID:{{$user->id}}</h4></legend>
<div class="row">
  <div class="small-3 columns">
  {{ Form::label('','氏名',array('class'=>'right')) }}
  </div>
  <div class="small-9 columns">
	{{ Form::text('name',$user->name,array('style'=>'ime-mode:active')) }}
@if($errors->has('name'))
<h4 style="color:red;text-align:center">{{ $errors->first('name') }}</h4>
@endif
  </div>
</div>
<div class="row">
  <div class="small-3 columns">
  {{ Form::label('','Eメール',array('class'=>'right')) }}
  </div>
  <div class="small-9 columns">
	{{ Form::text('email',$user->email,array('style'=>'ime-mode:inactive')) }}
@if($errors->has('email'))
<h4 style="color:red;text-align:center">{{ $errors->first('email') }}</h4>
@endif
  </div>
</div>
<div class="row">
  <div class="small-3 columns">
  {{ Form::label('','アクティベート',array('class'=>'right')) }}
  </div>
  <div class="small-9 columns">
  @if($user->activate==1)
	{{ Form::radio('activate','1',true)}} 認証済み
 	{{ Form::radio('activate','0') }}　未認証
  @else
	{{ Form::radio('activate','1')}} 認証済み
 	{{ Form::radio('activate','0',true) }}　未認証
  @endif
  </div>
</div>
<div class="row">
  <div class="small-3 columns">
  {{ Form::label('','ロール',array('class'=>'right')) }}
  </div>
  <div class="small-9 columns">
    {{ Form::select('role_id',$roles,isset($user->role_id) ? $user->role->id :null) }}
  </div>
</div>
<div class="row">
  <div class="small-3 columns">
  {{ Form::label('','グループ',array('class'=>'right')) }}
  </div>
  <div class="small-9 columns">
    {{ Form::select('group_id',$groups,isset($user->group_id) ? $user->group->id :null) }}
  </div>
</div>
<div class="row">
	<div class="small-3 small-centered columns">
	{{ Form::submit('更新',array('class'=>'button')) }}
	</div>
</div>
</fieldset>
{{ Form::hidden('id',$user->id) }}
{{ Form::close() }}
@stop
