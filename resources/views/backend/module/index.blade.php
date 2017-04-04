@extends('backend.layouts.layout')

@section('content')
	<div class="container-fluid">
		<div class="menu_top col-md-12">
			<a href="/administrator">go back</a>
			<a href="/administrator/module/{{$module}}/create" style="float: right;">
				<img width="25px" height="25px" src="/images/new.png" alt="add" title="add">
			</a>
		</div>
	<table class="table table-hover">
		<thead class="bg-primary">
			<tr>
				@foreach($columns as $column)
					<th id="{{$column}}">{{ucfirst($column)}}</th>
				@endforeach
				<th colspan="2">options</th>
			</tr>
		</thead>
		<tbody>
			@foreach($objects as $object)
				<tr>
					@foreach($columns as $column)
						<td headers="{{$column}}">{{$object->$column}}</td>
					@endforeach
					<td style="width: 30px;" headers="{{$column}}">
						<a href="/administrator/module/{{$module}}/{{$object->id}}/edit">
							<img width="25px" height="25px" src="/images/edit_blue.png" alt="delete" title="delete">
						</a>
					</td>
					<td style="width: 30px;" headers="{{$column}}">
						<a href="/administrator/module/{{$module}}/{{$object->id}}/delete">
							<img width="25px" height="25px" src="/images/delete_blue.png" alt="delete" title="delete">
						</a>			
					</td>
				</tr>
			@endforeach
		</tbody>
	 </table>
	</div>
</div>	
@endsection