@extends('frontend.layouts.layout')

@section('content')

	<!-- Carousel
	    ================================================== -->
	    <div id="myCarousel" class="carousel slide" data-ride="carousel">
	      <ol class="carousel-indicators">
	        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	        <li data-target="#myCarousel" data-slide-to="1"></li>
	        <li data-target="#myCarousel" data-slide-to="2"></li>
	        <li data-target="#myCarousel" data-slide-to="3"></li>
	      </ol>
	      <!-- Indicators -->
	      <div class="carousel-inner" role="listbox">
	      	@foreach($banners['main'] as $main)
				<div class="item @if($main->first) active @endif">
					<img class="first-slide" src="/images/banners/main/{{$main->image}}" alt="First slide">

					<div class="container-fluid" style="padding:0px; margin:0px;">
						<div class="carousel-caption">
							<h1>{{$main->title}}</h1>
						</div>
					</div>
				</div>
	        @endforeach
	      </div>
    </div>
    <div class="container-fluid" style="background-color: #fff; z-inded: 99;">
      <div class="row" style=" margin:15px auto 0px auto;">

      	@foreach($banners['small'] as $small)
	        <div class="col-md-3">
			  <a class="banner" href="{{$small->link}}"><img class="small" src="/images/banners/small/{{$small->image}}"></a>
	        </div>
	        @endforeach
      </div>
@stop