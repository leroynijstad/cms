@extends('backend.layouts.layout')

@section('content')
	<div class="container-fluid">
		<div class="menu_top col-md-12">
			<a href="/administrator">go back</a>
		</div>
	</div>
		<div class="container-fluid">				
			<form action="/administrator/module/{{$module}}" method="POST" accept-charset="utf-8">
				{{ csrf_field() }}
				@foreach($columns as $column)
					@include("backend.form.{$column['type']}")
				@endforeach
				<div class="form-group row">
				  <div class="col-md-2" style="float:right;">
				    <button type="submit" class="btn btn-primary">add {{$module}}</button>
				  </div>
				</div>
			</form>
		</div>
	</div>
</div>	
@endsection