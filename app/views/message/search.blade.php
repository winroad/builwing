@extends('layouts.f4.user.base')
@section('content')
	{{ Form::open() }}
  {{ Form::label('検索') }}
  {{ Form::text('search','') }}
  {{ Form::submit() }}
  {{ Form::close() }}
  @if(isset($messages))
  {{ count($messages) }}<br>
  	@foreach($messages as $message)
    	{{ $message->body }}<br>
    @endforeach
  {{ $messages->links() }}
  @endif
@stop