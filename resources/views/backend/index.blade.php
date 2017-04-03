@extends('backend.layouts.layout')

@section('content')


<div class="container-fluid">
	@foreach($modules as $module)
			<div class="col-md-3 modules">
				<a href="/administrator/module/{{$module->name}}">
					<div class="icon bg{{$module->color}}">
						<img class="" src="/images/{{$module->icon}}.png" alt="{{$module->name}}" title="{{$module->name}}">
					</div>
					<div class="title bg{{$module->color}} {{$module->color}} no-margin">
						{{$module->name}}
					</div>
				</a>
			</div>
@endforeach
</div>

@endsection