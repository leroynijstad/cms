  <nav class="navbar" style="margin:0px;z-index: 15;">
    <div class="container" >
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <i class="fa fa-camera" aria-hidden="true"></i>
        </button>
        <a class="navbar-brand" href="/">
		<div class="mobile-logo"><img src="/images/logo_small_black.png" lt="small_logo"/></div>
		<div  class="website-logo"><img src="/images/logo.png" alt="logo"/></div>
	  </a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">

          <li><a href="/">Home</a></li>

          @foreach($pages as $page)
            <li><a href="/{{$page->link}}">{{$page->name}}</a></li>
          @endforeach
        </ul>
        <ul class="nav navbar-nav navbar-right">
		<li><a href="https://www.facebook.com/pages/Ruth-Kolthof-Fotografie/306151832895567" target="_blank"><div class="social_item facebook"></div></a></li>
		<li><a href="http://www.pinterest.com/ruthkolthof/ruth-kolthof-fotografie/" target="_blank"><div class="social_item pinterest"></div></a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>