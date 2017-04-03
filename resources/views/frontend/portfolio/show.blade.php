@extends('frontend.layouts.layout')

@section ('content')
	<div class="container-fluid content">
		<div class="back"><a href="{{URL::previous()}}">Go back</a></div>
		<section id="photos">
			@foreach ($album->getPhotos as $photo)
				<img style="width: 100%;" src="/images/albums/{{$album->name}}/photos/{{$photo->image}}" alt="{{$album->name}}" />
			@endforeach
		</section>
	</div>
@stop