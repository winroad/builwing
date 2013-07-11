@extends('layouts.f4.admin.base')
@section('content')
@if(isset($warning))
 {{ $warning }}
@endif
グループのindex.blade.phpです。
<table width="100%" border="1">
  <tr>
  <thead>
    <th scope="col">ID</th>
    <th scope="col">グループ名</th>
    <th scope="col">パーミッション</th>
  </tr>
 </thead>
@foreach($groups as $group)
  <tr>
  	<td>{{ HTML::link('admin/view/'.$group->id,$group->id) }}</td>
<!--    <td>{{ HTML::linkAction('AdminController@getGroupView',
    $group->abbreviation,
    array('id'=>$group->id)) }}</td>
-->    <td>{{ $group->name }}</td>
    <td>
    @foreach($group->permissions as $k=>$p)
    	{{ $k }} => {{ $p }}   
    @endforeach
    </td>
  </tr>
@endforeach
</table>
@stop