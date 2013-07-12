@extends('layouts.f4.admin.base')
@section('content')
{{ Form::open() }}
<h5>{{ Form::label('Permission') }}</h5>
{{ Form::text('name','') }}
@if($errors->has('name'))
<div data-alert class='alert-box alert'>
{{ $errors->first('name') }}
</div>
@endif
{{ Form::submit() }}
{{ Form::close() }}
@stop