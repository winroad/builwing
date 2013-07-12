@extends('layouts.f4.admin.base')
@section('content')
<h4>ロール一覧</h4>
<ul class="button-group right">
  <li>{{ HTML::link('role/create','ロール作成',array('class'=>'small button')) }}</li>
  <li>{{ HTML::link('permission/create','パーミッション作成',array('class'=>'small button')) }}</li>
  <li><a href="#" class="small button">Button 3</a></li>
</ul>
<table width="100%" border="0">
  <tr>
    <th width="14%" scope="col">ID</th>
    <th width="35%" scope="col">ロール名</th>
    <th width="51%" scope="col">level</th>
  </tr>
  @if(isset($roles))
  @foreach($roles as $role)
  <tr>
    <td>{{ $role->id }}</td>
    <td>{{ $role->name }}</td>
    <td>{{ $role->level }}</td>
  </tr>
  @endforeach
  @endif
</table>
@stop