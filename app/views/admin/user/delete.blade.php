@extends('layouts.f4.admin.base')
@section('content')
@if(isset($warning))
<div data-alert class="alert-box alert">
{{ $warning }}
</div>
@endif
<div data-alert class="alert-box alert">下記のデータを削除してもいいですか</div>
{{ HTML::link('admin/user','キャンセル',array('class'=>'success button')) }}
<table width="100%" border="1">
<thead>
  <tr>
    <th scope="col">ユーザー名</th>
    <th scope="col">Eメール</th>
  </tr>
</thead>
  <tr>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
</table>
{{ Form::open() }}
{{ Form::hidden('id',$user->id) }}
{{ Form::submit('削除',array('class'=>'alert button')) }}&nbsp;
{{ Form::close() }}
@stop