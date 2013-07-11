<!-- Navigation -->
<nav class="top-bar">
<ul class="title-area">
<!-- Title Area -->
<li class="name">
<h1>
<a href="/">
@if(Auth::user()->is('Super Admin'))
SuperAdmin管理室
@else
Builwing
@endif
</a>
</h1>
</li>
<li class="toggle-topbar menu-icon"><a href="#"><span>menu</span></a></li>
</ul>
<section class="top-bar-section">
<!-- Right Nav Section -->
<ul class="right">
<li class="divider"></li>
<li class="has-dropdown">
{{ HTML::link('#','Main Item 1') }}
<ul class="dropdown">
<li><label>Section Name</label></li>
<li class="has-dropdown">
{{ HTML::link('#','Has Dropdown, Level 1') }}
<ul class="dropdown">
<li>{{ HTML::link('#','Dropdown Options') }}</li>
<li>{{ HTML::link('#','Dropdown Options') }}</li>
<li>{{ HTML::link('#','Level 2') }}</li>
<li>{{ HTML::link('#','Subdropdown Option') }}</li>
<li>{{ HTML::link('#','Subdropdown Option') }}</li>
<li>{{ HTML::link('#','Subdropdown Option') }}</li>
</ul>
</li>
<li>{{ HTML::link('#','Dropdown Options') }}</li>
<li>{{ HTML::link('#','Dropdown Options') }}</li>
<li class="divider"></li>
<li><label>Section Name</label></li>
<li>{{ HTML::link('#','Dropdown Options') }}</li>
<li>{{ HTML::link('#','Dropdown Options') }}</li>
<li>{{ HTML::link('#','Dropdown Options') }}</li>
<li class="divider"></li>
<li>{{ HTML::link('#','See all &rarr;') }}</li>
</ul>
</li>
<li class="divider"></li>
<li><a href="#">Main Item 2</a></li>
<li class="divider"></li>
<li class="has-dropdown">
<a href="#">Main Item 3</a>
<ul class="dropdown">
<li>{{ HTML::link('#','Dropdown Options') }}</li>
<li>{{ HTML::link('#','Dropdown Options') }}</li>
<li>{{ HTML::link('#','Dropdown Options') }}</li>
<li class="divider"></li>
<li>{{ HTML::link('#','See all &rarr;') }}</li>
</ul>
</li>
</ul>
</section>
</nav>
<!-- End Top Bar -->