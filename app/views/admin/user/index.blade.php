@extends('layouts.f4.admin.base')
@section('content')
@if(isset($warning))
<div data-alert class="alert-box alert">
{{ $warning }}
</div>
@else
<div data-alert class="alert-box success">
ユーザー一覧
</div>
@endif
<table width="100%" border="1">
<thead>
  <tr>
    <th scope="col">ユーザー名</th>
    <th scope="col">Eメール</th>
    <th scope="col">処理</th>
  </tr>
</thead>
@foreach($users as $user)
  <tr>
    <td>
@if($user->deleted_at== null)
    {{ HTML::linkAction('AdminController@getView',$user->name,
    		array('id'=>$user->id)) }}
@else
    {{ $user->name }}
@endif
    </td>
    <td>{{ $user->email }}</td>
    <td>
@if($user->deleted_at== null)
    {{ HTML::linkAction('AdminController@getUpdate','修正',array('id'=>$user->id)) }}&nbsp;
    {{ HTML::linkAction('AdminController@getDelete','削除',array('id'=>$user->id)) }}
@else
    {{ HTML::linkAction('AdminController@getRestore','復活',array('id'=>$user->id)) }}
@endif    
    </td>
  </tr>
@endforeach
</table>
{{ $users->links() }}
@stop