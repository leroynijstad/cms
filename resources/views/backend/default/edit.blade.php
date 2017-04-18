@extends('backend.layouts.layout')

@section('content')
	<div class="container-fluid">
		<div class="menu_top col-md-12">
			<a href="/administrator/module/{{$classname}}">go back</a>
		</div>
	</div>
		<div class="container-fluid">				
			<form action="/administrator/module/{{$classname}}/{{$id}}" method="POST" accept-charset="utf-8">
				{{ csrf_field() }}
				<input name="_method" type="hidden" value="PATCH">
				@foreach($fields as $field)
					@include("backend.form.{$field->type}")
				@endforeach
				<div class="form-group row">
				  <div class="col-md-2" style="float:right;">
				    <button type="submit" class="btn btn-primary">edit {{$classname}}</button>
				  </div>
				</div>
			</form>
		</div>
	</div>
</div>	
@endsection