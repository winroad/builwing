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
    <th scope="col">認証</th>
    <th scope="col">Role</th>
    <th scope="col">Group</th>
  </tr>
</thead>
@foreach($users as $user)
  <tr>
    <td>
@if($user->deleted_at== null)
    {{ HTML::link('admin/user/view/'.$user->id,$user->name) }}
@else
    {{ $user->name }}
@endif
    </td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->activate }}</td>
    <td>{{ $user->role->name }}</td>
    <td>{{ $user->group->name }}</td>
  </tr>
@endforeach
</table>
{{ $users->links() }}
@stop