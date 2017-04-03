<div class="form-group row">
  <label for="{{$column['column_name']}}" class="col-sm-1 col-form-label">{{$column['column_name']}}</label>
  <div class="col-sm-3">
    <select class="form-control" name="{{$column['column_name']}}" id="{{$column['column_name']}}">
    	@foreach($column['default_values'] as $value)
    		@if($value === $column['value'])
    			<option value="{{$value}}" selected>{{$value}}</option>
    		@else
    			<option value="{{$value}}">{{$value}}</option>
    		@endif
    	@endforeach
    </select>
  </div>
</div>