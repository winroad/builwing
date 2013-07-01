    <footer class="row full-width">
      <div class="large-5 columns">
        <h6><strong>Made by ZURB</strong></h6>
        <p>Foundation is made by <a href="http://www.zurb.com/">ZURB</a>, a product design company in Campbell, California. We've put more than 14 years of experience building web products, services and websites into this framework. <a href="http://foundation.zurb.com/about.php">Foundation Info and Goodies &rarr;</a></p>
      </div>

      <div class="large-3 columns">
        <h6><strong>Using Foundation?</strong></h6>
        <p>Let us know how you're using Foundation and we might feature you as an example! <a href="mailto:foundation@zurb.com?subject=I'm%20using%20Foundation">Get in touch &rarr;</a></p>
      </div>

      <div class="large-4 columns">
        <h6><strong>Need some help?</strong></h6>
        <p>For answers or help visit the <a href="http://foundation.zurb.com/docs/support.html">Support page</a>.</p>
      </div>
    </footer>

    <div id="copyright">
      <div class="row full-width">
        <div class="large-4 columns">
          <p>Site content &copy; 2013 Builwing, inc.</p>
        </div>
        <div class="large-8 columns">
          <ul class="inline-list right">
            <li>{{ HTML::link('/','TOP') }}</li>
            @if(Auth::user()->role_id==1)
            <li>{{ HTML::link('admin','管理室') }}</li>
            @endif
            @if(Auth::check())
            <li>{{ HTML::link('user','マイページへ') }}</li>
            <li>{{ HTML::link('user/logout','Logout') }}</li>
            @else
            <li>{{ HTML::link('user','マイページへ') }}</li>
            @endif
          </ul>
        </div><!--/large-8 columns-->
      </div><!--/row full-width-->
    </div><!--/copyright-->
