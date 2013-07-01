<div class="docs section-container accordion" data-section data-options="one_up: false">
<section class="section active">
<p class="title">{{ HTML::link('#','ユーザー情報管理') }}</p>
<div class="content">
<ul class="side-nav">
<li>
{{ Form::open(array('url'=>'admin/user')) }}
<div class="row">
<div class="small-11 columns">
<div class="row collapse">
<div class="small-9 columns">
{{ Form::text('search','',array('placeholder'=>'ユーザー検索','style'=>'ime-mode:active')) }}
</div>
<div class="small-3 columns">
{{ Form::submit('検索',array('class'=>'button prefix')) }}
</div>
</div>
</div>
</div>
{{ Form::close() }}
</li>
<li>{{ HTML::link('admin/user','ユーザーリスト') }}</li>
<li>{{ HTML::link('admin/create','新規作成') }}</li>
<li>{{ HTML::link('admin/deleted','削除ユーザー一覧') }}</li>
<li>
{{ Form::open(array('url'=>'admin/deleted')) }}
<div class="row">
<div class="small-11 columns">
<div class="row collapse">
<div class="small-9 columns">
{{ Form::text('search','',array('placeholder'=>'削除ユーザー検索','style'=>'ime-mode:active')) }}
</div>
<div class="small-3 columns">
{{ Form::submit('検索',array('class'=>'button prefix')) }}
</div>
</div>
</div>
</div>
{{ Form::close() }}
</li>
</ul>
</div>
</section>
<section class="section active">
<p class="title">{{ HTML::link('#','元請情報管理') }}</p>
<div class="content">
<ul class="side-nav">
</li>
<li>{{ HTML::link('#','Code') }}</li>
<li>{{ HTML::link('#','Design') }}</li>
<li>{{ HTML::link('#','Fun') }}</li>
<li>{{ HTML::link('#','Weasels') }}</li>
</ul>
</div>
</section>
<section class="section active">
<p class="title">{{ HTML::link('#','現場情報管理') }}</p>
<div class="content">
<ul class="side-nav">
<li>{{ HTML::link('#','一覧') }}</li>
<li>{{ HTML::link('#','Code') }}</li>
<li>{{ HTML::link('#','Design') }}</li>
<li>{{ HTML::link('#','Fun') }}</li>
<li>{{ HTML::link('#','Weasels') }}</li>
</ul>
</div>
</section>
<section class="section active">
<p class="title">{{ HTML::link('#','特殊作業') }}</p>
<div class="content">
<ul class="side-nav">
<li>
<li>
	{{ Form::open(array('url'=>'admin/deleted')) }}
	<div class="row">
		<div class="small-11 columns">
			<div class="row collapse">
				<div class="small-9 columns">
					{{ Form::text('search','',array('placeholder'=>'削除ユーザー検索')) }}
				</div>
				<div class="small-3 columns">
					{{ Form::submit('検索',array('class'=>'button prefix')) }}
				</div>
			</div>
		</div>
	</div>
	{{ Form::close() }}
</li>
</li>
<li>{{ HTML::link('admin/deleted','削除ユーザー一覧') }}</li>
<li>{{ HTML::link('#','Design') }}</li>
<li>{{ HTML::link('#','Fun') }}</li>
<li>{{ HTML::link('#','Weasels') }}</li>
</ul>
</div>
</section>
 
<div class="panel">
<h5>ログインユーザー</h5>
<ul>
<li>{{ Auth::user()->name }}</li>
<li>{{ Auth::user()->email }}</li>

</div>
 
</div> 
