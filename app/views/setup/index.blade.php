@extends('layouts.f4.base')
@section('content')
@if(isset($warning))
<h4 style="color:red;text-align:center">{{ $warning }}</h4>
<p><br>
@endif</p>
<table width="100%" border="0">
  <tr>
    <td>1</td>
    <td>{{ HTML::link('setup/users','ユーザーテーブルの作成') }}</td>
  </tr>
  <tr>
    <td>2</td>
    <td>{{ HTML::link('setup/profiles','プロフィールテーブルの作成') }}</td>
  </tr>
  <tr>
    <td>3</td>
    <td>{{ HTML::link('setup/roles','ロールテーブルの作成') }}</td>
  </tr>
  <tr>
    <td>4</td>
    <td>{{ HTML::link('setup/groups','グループテーブルの作成') }}</td>
  </tr>
  <tr>
    <td>5</td>
    <td>{{ HTML::link('setup/belongs','所属テーブルの作成') }}</td>
  </tr>
  <tr>
    <td>6</td>
    <td>{{ HTML::link('setup/items','itemsテーブルの作成') }}</td>
  </tr>
  <tr>
    <td>7</td>
    <td>{{ HTML::link('setup/categories','catagoriesテーブルの作成') }}</td>
  </tr>
  <tr>
    <td>8</td>
    <td>{{ HTML::link('setup/histories','更新履歴テーブルの作成') }}</td>
  </tr>
  <tr>
    <td>9</td>
    <td>{{ HTML::link('setup/history-profile','ピポットテーブルの作成') }}</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>12</td>
    <td>{{ HTML::link('setup/all','上記全テーブルの一括作成') }}</td>
  </tr>
</table>
@stop