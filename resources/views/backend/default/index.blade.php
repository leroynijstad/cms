@extends('backend.layouts.layout')

@section('content')
	<div class="container-fluid">
		<div class="menu_top col-md-12">
			<a href="/administrator">go back</a>
			<a href="/administrator/module/{{$classname}}/create" style="float: right;">
				<img width="25px" height="25px" src="/images/new.png" alt="add" title="add">
			</a>
		</div>
	<table class="table table-hover">
		<thead class="bg-primary">
			<tr>
				@foreach($fields as $field)
					<th id="{{$field->name}}">{{ucfirst($field->name)}}</th>
				@endforeach
				<th colspan="2">options</th>
			</tr>
		</thead>
		<tbody>
			@foreach($objects as $object)
				<tr>
					@foreach($fields as $field)
						<td headers="{{$field->name}}">{{ $object->{$field->name} }}</td>
					@endforeach
					<td style="width: 30px;">
						<a href="/administrator/module/{{$classname}}/{{$object->id}}/edit">
							<img width="25px" height="25px" src="/images/edit_blue.png" alt="delete" title="delete">
						</a>
					</td>
					<td style="width: 30px;">
						<a href="/administrator/module/{{$classname}}/{{$object->id}}/delete">
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