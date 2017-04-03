@extends('backend.layouts.layout')

@section('content')
	<div class="container-fluid">
		<div class="menu_top col-md-12">
			<a href="/administrator">go back</a>
		</div>
	</div>
		<div class="container-fluid">				
			<form action="/administrator/module/{{$module}}/{{$id}}" method="post" accept-charset="utf-8">
				{{ csrf_field() }}
				{{ method_field('PATCH') }}
				@foreach($columns as $column)
					@include("backend.form.{$column['type']}")
				@endforeach
				<div class="form-group row">
				  <div class="col-md-2" style="float:right;">
				    <button type="submit" class="btn btn-primary">edit {{$module}}</button>
				  </div>
				</div>
			</form>
		</div>
	</div>
</div>	
@endsection