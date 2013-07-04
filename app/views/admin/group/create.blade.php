@extends('layouts.f4.admin.base')
@section('content')
@if(isset($warning))
<div data-alert class="alert-box alert">
{{ $warning }}
</div>
@else
<div data-alert class="alert-box success">
グループ新規作成
</div>
@endif
{{ Form::open() }}
<fieldset>
<div class="row">
  <div class="small-3 columns">
  {{ Form::label('','略称',array('class'=>'right')) }}
  </div>
  <div class="small-9 columns">
{{ Form::text('abbreviation',Input::old('abbreviation',''),array('style'=>'ime-mode:inactive')) }}
@if($errors->has('abbreviation'))
<h4 style="color:red;text-align:center">{{ $errors->first('abbreviation') }}</h4>
@endif
  </div>
</div>
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
  {{ Form::label('','レベル',array('class'=>'right')) }}
  </div>
  <div class="small-9 columns">
    {{ Form::text('level','',array('style'=>'ime-mode:inactive')) }}
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
