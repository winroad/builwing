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
    <td>users</td>
    <td>{{ HTML::link('setup/users','ユーザー認証用のテーブル') }}</td>
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
    <td>throttle</td>
    <td>{{ HTML::link('setup/throttle','ユーザーとグループの認証制限用テーブル') }}</td>
  </tr>
  <tr>
    <td>5</td>
    <td>profiles</td>
    <td>{{ HTML::link('setup/profile','ユーザーのプロフィール用テーブル') }}</td>
  </tr>
  <tr>
    <td>6</td>
    <td>works</td>
    <td>{{ HTML::link('setup/works','ユーザーの業務管理用テーブル') }}</td>
  </tr>
  <tr>
    <td>7</td>
    <td>items</td>
    <td>{{ HTML::link('setup/items','項目名管理用テーブル') }}</td>
  </tr>
  <tr>
    <td>8</td>
    <td>categories</td>
    <td>{{ HTML::link('setup/categories','カテゴリー管理用テーブル') }}</td>
  </tr>
  <tr>
    <td>9</td>
    <td>histories</td>
    <td>{{ HTML::link('setup/histories','更新履歴管理用テーブル') }}</td>
  </tr>
  <tr>
    <td>10</td>
    <td>history_profile</td>
    <td>{{ HTML::link('setup/history-profile','プロフィールの更新履歴管理用ピボットテーブル') }}</td>
  </tr>
  <tr>
    <td>11</td>
    <td>messages</td>
    <td>{{ HTML::link('setupu/messages','メッセージ管理用テーブル') }}</td>
  </tr>
  <tr>
    <td>12</td>
    <td><p>comments</p></td>
    <td>{{ HTML::link('setup/comments','メッセージに対するコメント管理用テーブル') }}</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<ul>
  <li>{{ HTML::link('setup/users','ユーザーテーブルの作成') }}</li>
  <li>{{ HTML::link('setup/profiles','プロフィールテーブルの作成') }}</li>
  <li>{{ HTML::link('setup/groups','グループテーブルの作成') }}</li>
  <li>{{ HTML::link('setup/belongs','所属テーブルの作成') }}</li>
  <li>{{ HTML::link('setup/items','itemsテーブルの作成') }}</li>
  <li>{{ HTML::link('setup/categories','catagoriesテーブルの作成') }}</li>
  <li>{{ HTML::link('setup/histories','histories(更新履歴)の作成') }}</li>
  <li>{{ HTML::link('setup/history-profile','history_profileの作成') }}</li>
  <li>{{ HTML::link('setup/posts','postsの作成') }}</li>
  <li>{{ HTML::link('setup/comments','commentsの作成') }}</li>
  <li>{{ HTML::link('setup/comment-post','comment_postの作成') }}</li>
  <li>{{ HTML::link('setup/untreated','untreated(未読用)の作成') }}</li>
  <li>{{ HTML::link('setup/works','労務管理(work)の作成') }}</li>
  <li>{{ HTML::link('setup/todo','TODOの作成') }}</li>
  <li>{{ HTML::link('setup/messages','messagesの作成') }}</li>
  <li>一括作成
  	<ul>
  		<li>{{ HTML::link('setup/all','上記全テーブルの一括作成') }}</li>
  	</ul>
  </li>
</ul>
@stop