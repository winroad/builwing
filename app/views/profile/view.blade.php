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
    <th scope="row">{{ HTML::link('profile/item/address','住所情報') }}</th>
    <td>
    @if($address)
    @foreach($address as $key=>$value)
    	{{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">{{ HTML::link('profile/item/body','身体情報') }}</th>
    <td>
    @if($body)
    @foreach($body as $key=>$value)
    	{{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">{{ HTML::link('profile/item/license','資格情報') }}</th>
    <td>
    @if($license)
    @foreach($license as $key=>$value)
    	{{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">{{ HTML::link('profile/item/labor','労務情報') }}</th>
    <td>
    @if($labor)
    @foreach($labor as $key=>$value)
    	{{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">{{ HTML::link('profile/item/family','家族情報') }}</th>
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