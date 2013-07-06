@extends('layouts.f4.admin.base')
@section('content')
	{{ Form::open() }}
  {{ Form::label('電話番号') }}
  {{ Form::text('tel,'') }}
  {{ Form::submit() }}
  {{ Form::close() }}
@stop