@extends('layouts.f4.admin.base')
@section('content')
@if(isset($warning))
<div data-alert class="alert-box alert">
{{ $warning }}
</div>
@else
<div data-alert class="alert-box success">
AdminのViewページです
</div>
@endif
<ul class="button-group">
 <li>{{ HTML::link('admin/user','一覧',array('class'=>'small button')) }}</li>
 <li>{{ HTML::linkAction('AdminController@getUpdate','修正',array('id'=>$user->id),array('class'=>'small button')) }}</li>
 <li><a href="#" class="small button">削除</a></li>
 </ul><!--end of button-group-->
<table width="100%" border="1">
  <tr>
    <th scope="row">ID</th>
    <td>{{ $user->id }}</td>
  </tr>
  <tr>
    <th scope="row">氏名</th>
    <td>{{ $user->name }}</td>
  </tr>
  <tr>
    <th scope="row">Eメール</th>
    <td>{{ $user->email }}</td>
  </tr>
  <tr>
    <th scope="row">アクティベート</th>
    <td>{{ $user->activate>0 ? '認証済み' :'未認証' }}</td>
  </tr>
  <tr>
    <th scope="row">ロール（権限）</th>
    <td>{{ isset($user->role->name) ? $user->role->name :'' }}</td>
  </tr>
  <tr>
    <th scope="row">所属先</th>
    <td>{{ isset($user->group->name) ? $user->group->name :'' }}</td>
  </tr>
  <tr>
    <th scope="row">作成日</th>
    <td>{{ $user->created_at }}</td>
  </tr>
  <tr>
    <th scope="row">更新日</th>
    <td>{{ $user->updated_at }}</td>
  </tr>
  <tr>
    <th scope="row">プロフィール</th>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>@stop</p>
