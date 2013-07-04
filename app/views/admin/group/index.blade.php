@extends('layouts.f4.admin.base')
@section('content')
@if(isset($warning))
 {{ $warning }}
@endif
グループのindex.blade.phpです。
<table width="100%" border="1">
  <tr>
  <thead>
    <th scope="col">略称</th>
    <th scope="col">グループ名</th>
    <th scope="col">レベル</th>
  </tr>
 </thead>
@foreach($groups as $group)
  <tr>
  	<td>{{ HTML::link('admin/group-view/'.$group->id,$group->abbreviation) }}</td>
<!--    <td>{{ HTML::linkAction('AdminController@getGroupView',
    $group->abbreviation,
    array('id'=>$group->id)) }}</td>
-->    <td>{{ $group->name }}</td>
    <td>{{ $group->level }}</td>
  </tr>
@endforeach
</table>

@stop