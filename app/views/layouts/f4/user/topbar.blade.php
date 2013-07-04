{{--Builwing用トップバー--}}
<nav class="top-bar">
<ul class="title-area">
<!-- Title Area -->
<li class="name">
<h1><a href="#">
Builwing
</a></h1>
</li>
<li class="toggle-topbar menu-icon"><a href="#"><span>menu</span></a></li>
</ul>
<section class="top-bar-section">
<!-- Right Nav Section -->
<ul class="right">
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
<li class="divider"></li>
<li><a href="#">社員情報</a></li>
<li class="divider"></li>
<li class="has-dropdown">
<a href="#">{{ Auth::user()->name }}</a>
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