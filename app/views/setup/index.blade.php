@extends('layouts.f4.base')
@section('content')
@if(isset($warning))
<h4 style="color:red;text-align:center">{{ $warning }}</h4>

@endif
<h2>テーブル作成</h2>
<ul>
  <li>{{ HTML::link('setup/users','ユーザーテーブルの作成') }}</li>
  <li>{{ HTML::link('setup/profiles','プロフィールテーブルの作成') }}</li>
  <li>{{ HTML::link('setup/roles','ロールテーブルの作成') }}</li>
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
  <li>{{ HTML::link('setup/labors','労務管理(labor)の作成') }}</li>
  <li>{{ HTML::link('setup/todo','TODOの作成') }}</li>
  <li>{{ HTML::link('setup/messages','messagesの作成') }}</li>
  <li>一括作成
  	<ul>
  		<li>{{ HTML::link('setup/all','上記全テーブルの一括作成') }}</li>
  	</ul>
  </li>
</ul>
@stop