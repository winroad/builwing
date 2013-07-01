{{--Admin用トップバー--}}
<nav class="top-bar">
<!--タイトルエリア-->
<ul class="title-area">
<li class="name">
	<h1>{{ HTML::link('admin','Builwing管理室') }}</h1>
</li>
<!-- smallサイズ表示用 -->
<li class="toggle-topbar menu-icon"><a href="#"><span>menu</span></a></li>
</ul><!--タイトルエリア終了-->
<section class="top-bar-section">
<!--左メニュー開始-->
<ul><!--タイトルエリアの終了-->
	<li class="divider"></li>
	{{ Form::open(array('url'=>'admin/user')) }}
	<li>
		<div class="small-10 large-centered columns">
			<div class="row collapse">
				<div class="small-8 columns">
					{{ Form::text('search','',array('placeholder'=>'ユーザー検索')) }}</div>
				<div class="small-4 columns">
					{{ Form::submit('検索',array('class'=>'button')) }}</div>
  	</div>
	</li>
{{ Form::close() }}
</ul><!--左メニュー終了-->
<!--右メニュー開始-->
<ul class="right">
	<li class="divider"></li>
	<li class="has-dropdown">
		<a href="#">ユーザー管理</a>
		<ul class="dropdown">
			<li>{{ HTML::link('admin/user','登録ユーザー') }}</li>
			<li>{{ HTML::link('admin/deleted','削除ユーザー') }}</li>
			<li>{{ HTML::link('admin/create','ユーザー作成') }}</li>
			<li>{{ HTML::link('#','その他') }}</li>
		</ul>
	</li>
	<li class="divider"></li>
	<li class="has-dropdown">
		<a href="#">グループ管理</a>
		<ul class="dropdown">
			<li>{{ HTML::link('#','登録グループ') }}</li>
			<li>{{ HTML::link('#','削除グループ') }}</li>
			<li>{{ HTML::link('#','グループ作成') }}</li>
			<li>{{ HTML::link('#','その他') }}</li>
		</ul>
	</li>
	<li class="divider"></li>
	<li class="has-dropdown">
		<a href="#">ログ管理</a>
		<ul class="dropdown">
			<li>{{ HTML::link('#','一覧') }}</li>
			<li>{{ HTML::link('#','その他') }}</li>
		</ul>
	</li>
</ul><!--右メニュー終了-->
</section>
</nav>
