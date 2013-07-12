@extends('layouts.f4.base')
@section('content')
@if(isset($warning))
<h4 style="color:red;text-align:center">{{ $warning }}</h4>
@endif
<h2>テーブル作成</h2>
<table width="100%" border="1">
  <tr>
    <th width="10%" scope="col">NO.</th>
    <th width="25%" scope="col">テーブル名</th>
    <th width="65%" scope="col">備考</th>
  </tr>
  <tr>
    <td>1</td>
    <td><p>verify</p></td>
    <td>{{ HTML::link('setup/verify','Verify管理用5テーブル') }}<br>
    users,roles,permissions,role_user,permission_role
    </td>
  </tr>
  <tr>
    <td>2</td>
    <td>groups</td>
    <td>{{ HTML::link('setup/groups','グループ用テーブル') }}</td>
  </tr>
  <tr>
    <td>3</td>
    <td>users_groups</td>
    <td>{{ HTML::link('setup/group-user','usersとgroupsのピボットテーブル') }} </td>
  </tr>
  <tr>
    <td>4</td>
    <td>profiles</td>
    <td>{{ HTML::link('setup/profile','ユーザーのプロフィール用テーブル') }}</td>
  </tr>
  <tr>
    <td>5</td>
    <td>works</td>
    <td>{{ HTML::link('setup/works','ユーザーの業務管理用テーブル') }}</td>
  </tr>
  <tr>
    <td>6</td>
    <td>items</td>
    <td>{{ HTML::link('setup/items','項目名管理用テーブル') }}</td>
  </tr>
  <tr>
    <td>7</td>
    <td>categories</td>
    <td>{{ HTML::link('setup/categories','カテゴリー管理用テーブル') }}</td>
  </tr>
  <tr>
    <td>8</td>
    <td>histories</td>
    <td>{{ HTML::link('setup/histories','更新履歴管理用テーブル') }}</td>
  </tr>
  <tr>
    <td>9</td>
    <td>history_profile</td>
    <td>{{ HTML::link('setup/history-profile','プロフィールの更新履歴管理用ピボットテーブル') }}</td>
  </tr>
  <tr>
    <td>10</td>
    <td>messages</td>
    <td>{{ HTML::link('setupu/messages','メッセージ管理用テーブル') }}</td>
  </tr>
  <tr>
    <td>11</td>
    <td><p>comments</p></td>
    <td>{{ HTML::link('setup/comments','メッセージに対するコメント管理用テーブル') }}</td>
  </tr>
  <tr>
    <td>12</td>
    <td><p>activates</p></td>
    <td>{{ HTML::link('setup/activates','アクティベート管理用テーブル') }}</td>
  </tr>
</table>
@stop