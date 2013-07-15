<div class="docs section-container accordion" data-section="data-section" data-options="one_up: false">
  <section class="section active">
    <p class="title"><a href="#">メッセージ情報</a></p>
    <div class="content">
      <ul class="side-nav">
        <li>{{ HTML::link('message','受信メッセージ')}}</li>
        <li>{{ HTML::link('message/index/sent','送信メッセージ')}}</li>
        <li>{{ HTML::link('comment','受信コメント')}}</li>
        <li>{{ HTML::link('comment/index/sent','送信コメント')}}</li>
        <li>{{ HTML::link('message/create','メッセージ作成')}}</li>
        <li>{{ HTML::link('message/create/user','メッセージ作成(個人宛）')}}</li>
      </ul>
    </div>
  </section>
  <section class="section">
    <p class="title"><a href="#">予定管理</a></p>
    <div class="content">
      <ul class="side-nav">
        <li>{{ HTML::link('#','予定チェック') }}</li>
        <li>{{ HTML::link('#','予定変更') }}</li>
        <li>{{ HTML::link('#','予定中止') }}</li>
        <li>{{ HTML::link('#','予定印刷') }}</li>
      </ul>
    </div>
  </section>
  <section class="section">
    <p class="title"><a href="#">現場管理</a></p>
    <div class="content">
      <ul class="side-nav">
        <li>{{ HTML::link('#','作業日報') }}</li>
        <li>{{ HTML::link('#','報告書') }}</li>
        <li>{{ HTML::link('#','リスト印刷') }}</li>
        <li>{{ HTML::link('#','リストメール') }}</li>
      </ul>
    </div>
  </section>
  <section class="section">
    <p class="title"><a href="#">Navigation</a></p>
    <div class="content">
      <ul class="side-nav">
        <li><a href="components/pagination.html">Pagination</a></li>
        <li><a href="components/side-nav.html">Side Nav</a></li>
        <li><a href="components/sub-nav.html">Sub Nav</a></li>
        <li><a href="components/top-bar.html">Top Bar</a></li>
        <li><a href="components/breadcrumbs.html">Breadcrumbs</a></li>
      </ul>
    </div>
  </section>
  <section class="section">
    <p class="title"><a href="#">Buttons</a></p>
    <div class="content">
      <ul class="side-nav">
        <li><a href="components/buttons.html">Buttons</a></li>
        <li><a href="components/button-groups.html">Button Groups</a></li>
        <li><a href="components/dropdown-buttons.html">Dropdown Buttons</a></li>
        <li><a href="components/split-buttons.html">Split Buttons</a></li>
      </ul>
    </div>
  </section>
  <section class="section">
    <p class="title"><a href="#">Forms</a></p>
    <div class="content">
      <ul class="side-nav">
        <li><a href="components/forms.html">Forms</a></li>
        <li><a href="components/custom-forms.html">Custom Forms</a></li>
        <li><a href="components/switch.html">Switch</a></li>
      </ul>
    </div>
  </section>
</div>
