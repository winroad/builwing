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
    <td>{{ $user->verified }}</td>
    <td>
    @if(isset($user->roles->first()->name))
    {{ $user->roles->first()->name }}
    @endif
    </td>
  </tr>
@endforeach
</table>
{{ $users->links() }}
@stop