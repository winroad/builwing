{{--Builwing用トップバー--}}
<nav class="top-bar">
<ul class="title-area">
<!-- Title Area -->
<li class="name">
<h1><a href="/">
{{ Auth::user()->name }}
</a></h1>
</li>
<li class="toggle-topbar menu-icon"><a href="#"><span>menu</span></a></li>
</ul>
<section class="top-bar-section">
<!-- Right Nav Section -->
<ul class="right">
<li class="divider"></li>
<li class="has-dropdown">
	<a href="#">メッセージ</a>
  <ul class="dropdown">
  	<li>{{ HTML::link('message','メッセージ一覧') }}
  	<li>{{ HTML::link('#','未読メッセージ') }}
  	<li>{{ HTML::link('#','既読メッセージ') }}
		<li class="has-dropdown">
		<a href="#">メッセージ作成</a>
  		<ul class="dropdown">
  			<li>{{ HTML::link('message/create','普通メッセージ') }}
  			<li>{{ HTML::link('message/create/user','個人指定ﾒｯｾｰｼﾞ') }}
  			<li>{{ HTML::link('message/create/role','ロール指定ﾒｯｾｰｼﾞ') }}
  		</ul>
		</li>
  </ul>
</li>
<li class="divider"></li>
<li class="has-dropdown">
{{ HTML::link('#','現場情報') }}
<ul class="dropdown">
<li><label>現場情報</label></li>
<li class="has-dropdown">
{{ HTML::link('#','Has Dropdown, Level 1') }}
<ul class="dropdown">
<li>{{ HTML::link('#','作業現場一覧') }}</li>
<li>{{ HTML::link('#','Dropdown Options') }}</li>
<li>{{ HTML::link('#','Level 2') }}</li>
<li>{{ HTML::link('#','Subdropdown Option') }}</li>
<li>{{ HTML::link('#','Subdropdown Option') }}</li>
<li>{{ HTML::link('#','Subdropdown Option') }}</li>
</ul>
</li>
<li>{{ HTML::link('#','本日作業一覧') }}</li>
<li>{{ HTML::link('#','現場検索') }}</li>
{{ Form::close() }}
<li class="divider"></li>
<li><label>予定情報</label></li>
<li>{{ HTML::link('#','Dropdown Options') }}</li>
<li>{{ HTML::link('#','Dropdown Options') }}</li>
<li>{{ HTML::link('#','Dropdown Options') }}</li>
<li class="divider"></li>
<li>{{ HTML::link('#','See all &rarr;') }}</li>
</ul>
</li>
<li class="divider"></li>
<li><a href="#">予定情報</a></li>
<li class="divider"></li>
<li class="divider"></li>
<li><a href="#">取引先情報</a></li>
<li class="divider"></li>
<li class="has-dropdown">
	<a href="#">社内情報</a>
  <ul class="dropdown">
  	<li>{{ HTML::link('message','メッセージ一覧') }}
  	<li>{{ HTML::link('message/create','メッセージ作成') }}
  </ul>
</li>
<li class="divider"></li>
<li class="has-dropdown">
<a href="#">{{ '個人情報' }}</a>
<ul class="dropdown">
<li class="has-dropdown">
{{ HTML::link('#','プロフィール') }}
	<ul class="dropdown">
		<li>{{ HTML::link('profile/view/'.Auth::user()->id,'詳細') }}</li>
		<li>{{ HTML::link('profile/update-list/'.Auth::user()->id,'修正') }}</li>
  </ul>
</li>
<li>{{ HTML::link('#','設定変更') }}</li>
<li>{{ HTML::link('history/index','修正履歴') }}</li>
<li class="divider"></li>
<li>{{ HTML::link('user/logout','ログアウト') }}</li>
</ul>
</li>
</ul>
</section>
</nav>
<!-- End Top Bar -->