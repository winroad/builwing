@extends('layouts.f4.user.base')
@section('content')
<table width="100%" border="1">
  <tr>
    <th width="23%" scope="row">ユーザー名</th>
    <td width="77%">{{Auth::user()->name}}</td>
  </tr>
  <tr>
    <th scope="row">電話番号</th>
    <td>{{$profile->tel}}</td>
  </tr>
  <tr>
    <th scope="row">Eメール</th>
    <td>{{$profile->user->email }}</td>
  </tr>
  <tr>
    <th scope="row">{{ HTML::link('profile/create/address','住所情報') }}</th>
    <td>
    @if($address)
    @foreach($address as $key=>$value)
    	{{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">{{ HTML::link('profile/create/body','身体情報') }}</th>
    <td>
    @if($body)
    @foreach($body as $key=>$value)
    	{{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">{{ HTML::link('profile/create/license','資格情報') }}</th>
    <td>
    @if($license)
    @foreach($license as $key=>$value)
    	{{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">{{ HTML::link('profile/create/work','労務情報') }}</th>
    <td>
    @if($work)
    @foreach($work as $key=>$value)
    	{{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">{{ HTML::link('profile/create/family','家族情報') }}</th>
    <td>
    @if($family)
    @foreach($family as $key=>$value)
    	{{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
</table>

@stop