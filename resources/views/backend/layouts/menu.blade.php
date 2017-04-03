
<div class="col-md-1 menu">
	<div class="item">
	  <a href="/administrator">
	    <img src="/images/home.png" title="dashboard" alt="dashboard"/>
	  </a>
	</div>

	@foreach($modules as $menuitem)
		<div class="item">
			<a href="/administrator/module/{{$menuitem->name}}">
			<img src="/images/{{$menuitem->icon}}.png" title="{{$menuitem->name}}" alt="{{$menuitem->name}}"/>
			</a>
		</div>
	@endforeach
			
	<div class="item">
	  <a href="/administrator/module/module">
	    <img src="/images/module.png" title="module" alt="module"/>
	  </a>
	</div>
	<div class="item">
	  <a href="/logout">
	    <img src="/images/logout.png" title="logout" alt="logout"/>
	  </a>
	</div>
</div>