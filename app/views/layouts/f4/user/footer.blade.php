    <div id="copyright">
      <div class="row full-width">
        <div class="large-4 columns">
          <p>Site content &copy; 2013 Builwing, inc.</p>
        </div>
        <div class="large-8 columns">
          <ul class="inline-list right">
            <li>{{ HTML::link('/','TOP') }}</li>
            <li>{{ HTML::link('user','マイページへ') }}</li>
            @if(Auth::user()->is(array('Super Admin','Admin')))
            <li>{{ HTML::link('admin','管理室へ') }}</li>
            @endif
          </ul>
        </div><!--/large-8 columns-->
      </div><!--/row full-width-->
    </div><!--/copyright-->
