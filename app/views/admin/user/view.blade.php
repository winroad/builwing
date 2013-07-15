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
    <th scope="row">電話番号</th>
    <td>{{ isset($profile['tel']) ? $profile['tel']: null }}</td>
  </tr>
  <tr>
    <th scope="row">アクティベート</th>
    <td>{{ $user->verified > 0 ? '認証済み' :'未認証' }}</td>
  </tr>
  <tr>
    <th scope="row">ロール（権限）</th>
    <td>{{ isset($user->roles->name) ? $user->roles->name :'' }}</td>
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
    <th scope="row">住所関連情報</th>
    <td>
    @if(isset($profile['address']))
    @foreach($profile['address'] as $key=>$value)
    {{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">身体関連情報</th>
    <td>
    @if(isset($profile['body']))
    @foreach($profile['body'] as $key=>$value)
    {{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">資格関連情報</th>
    <td>
    @if(isset($profile['license']))
    @foreach($profile['license'] as $key=>$value)
    {{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">労務関連情報</th>
    <td>
    @if(isset($profile['work']))
    @foreach($profile['work'] as $key=>$value)
    {{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">家族関連情報</th>
    <td>
    @if(isset($profile['family']))
    @foreach($profile['family'] as $key=>$value)
    {{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">備考</th>
    <td>
    @if(isset($profile['note']))
    @foreach($profile['note'] as $key=>$value)
    {{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">未読メッセージ</th>
    <td>
    @if(isset($profile['message']))
    @foreach($profile['message'] as $key=>$value)
    {{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
  <tr>
    <th scope="row">未処理Todo</th>
    <td>
    @if(isset($profile['todo']))
    @foreach($profile['todo'] as $key=>$value)
    {{ $key }} : {{ $value }}<br />
    @endforeach
    @endif
    </td>
  </tr>
</table>
<p>@stop</p>
