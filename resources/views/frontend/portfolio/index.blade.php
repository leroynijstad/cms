@extends('frontend.layouts.layout')

@section ('content')
	<div class="container-fluid content">
		@if(!$parent_id)	
		<section id="portfolioMenu">
			<a href="/portfolio/">Alles</a>
			<a href="/portfolio/categorie/studio">Studio</a>
			<a href="/portfolio/categorie/kinderen">Kinderen</a>
			<a href="/portfolio/categorie/reizen">Reizen</a>
			<a href="/portfolio/categorie/projecten">Projecten</a>
			<a href="/portfolio/categorie/familie">Familie</a>
		</section>
		@else
			<div class="back"><a href="/portfolio">Go back</a></div>
		@endif
		<div class="image-zoom-container">
		@foreach ($albums as $album)
			<div class="zoom-container">
				<a href="/portfolio/album/{{$album->id}}">
					<span class="zoom-caption">
						<h3>{{$album->name}}</h3>
					</span>
					<img src="/images/albums/{{$album->name}}/main.jpg" alt="{{$album->name}}">
				</a>
			</div>
		@endforeach
		</div>
	</div>
@stop