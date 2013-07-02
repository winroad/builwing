@extends('layouts.f4.user.base')
@section('content')
<table width="100%" border="1">
  <tr>
    <th width="34%" scope="row">氏名</th>
    <td width="30%">アドレス情報</td>
    <td width="36%">資格情報</td>
  </tr>
  @foreach($profiles as $profile)
  <tr>
    <th scope="row">{{ $profile->user->name }}</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  @endforeach
</table>

@stop