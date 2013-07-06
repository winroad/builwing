@extends('layouts.f4.admin.base')
@section('content')
<h2>プロフィール明細</h2>
<table width="100%" border="0">
  <tr>
    <th width="26%" scope="row">氏名</th>
    <td width="74%">{{ $name }}</td>
  </tr>
  <tr>
    <th scope="row">電話番号</th>
    <td>{{ $tel }}</td>
  </tr>
  <tr>
    <th scope="row">住所情報</th>
    <td>
    @if(isset($address))
    @foreach($address as $key=>$value)
    {{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">身体情報</th>
    <td>
    @if(isset($body))
    @foreach($body as $key=>$value)
    {{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">資格情報</th>
    <td>
    @if(isset($license))
    @foreach($license as $key=>$value)
    {{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">労務情報</th>
    <td>
    @if(isset($labor))
    @foreach($labor as $key=>$value)
    {{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">家族情報</th>
    <td>
    @if(isset($family))
    @foreach($family as $key=>$value)
    {{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">備考</th>
    <td>
    @if(isset($note))
    @foreach($note as $key=>$value)
    {{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">Message</th>
    <td>
    @if(isset($message))
    @foreach($messge as $key=>$value)
    {{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">Todo</th>
    <td>
    @if(isset($todo))
    @foreach($todo as $key=>$value)
    {{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">作成日</th>
    <td>{{ $created_at }}</td>
  </tr>
  <tr>
    <th scope="row">更新日</th>
    <td>{{ $updated_at }}</td>
  </tr>
</table>
@stop