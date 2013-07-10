@extends('layouts.f4.admin.base')
@section('content')
@if(isset($warning))
<div data-alert class="alert-box alert">
{{ $warning }}
</div>
@else
<div data-alert class="alert-box success">
ユーザー新規作成
</div>
@endif
{{ Form::open() }}
<fieldset>
<div class="row">
  <div class="small-3 columns">
  {{ Form::label('','氏名',array('class'=>'right')) }}
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
  {{ Form::label('','Eメール',array('class'=>'right')) }}
  </div>
  <div class="small-9 columns">
{{ Form::text('email',Input::old('email',''),array('style'=>'ime-mode:inactive')) }}
@if($errors->has('email'))
<h4 style="color:red;text-align:center">{{ $errors->first('email') }}</h4>
@endif
  </div>
</div>
<div class="row">
  <div class="small-3 columns">
  {{ Form::label('','password',array('class'=>'right')) }}
  </div>
  <div class="small-9 columns">
{{ Form::password('password','',array('style'=>'ime-mode:inactive')) }}
@if($errors->has('password'))
<h4 style="color:red;text-align:center">{{ $errors->first('password') }}</h4>
@endif
  </div>
</div>
<div class="row">
  <div class="small-3 columns">
  {{ Form::label('','アクティベート',array('class'=>'right')) }}
  </div>
  <div class="small-9 columns">
	{{ Form::radio('activated',1,true) }} 認証
 	{{ Form::radio('activate',null) }}　拒否
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
	{{ Form::submit('新規作成',array('class'=>'button')) }}
	</div>
</div>
</fieldset>
{{ Form::close() }}
@stop
