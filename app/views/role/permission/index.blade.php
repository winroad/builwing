@extends('layouts.f4.admin.base')
@section('content')
<h4>permission一覧</h4>
<ul class="button-group right">
  <li>{{ HTML::link('role/create','ロール作成',array('class'=>'small button')) }}</li>
  <li>{{ HTML::link('permission/create','パーミッション作成',array('class'=>'small button')) }}</li>
  <li><a href="#" class="small button">Button 3</a></li>
</ul>
<table width="100%" border="0">
  <tr>
    <th width="14%" scope="col">ID</th>
    <th width="35%" scope="col">permission名</th>
    <th width="51%" scope="col">level</th>
  </tr>
  @if(isset($permissions))
  @foreach($permissions as $prrmission)
  <tr>
    <td>{{ $permission->id }}</td>
    <td>{{ $permission->name }}</td>
    <td>{{ $permission->level }}</td>
  </tr>
  @endforeach
  @endif
</table>
@stop