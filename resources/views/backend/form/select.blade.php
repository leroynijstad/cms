<div class="form-group row">
  <label for="{{$field->name}}" class="col-sm-1 col-form-label">{{$field->name}}</label>
  <div class="col-sm-3">
    <select class="form-control" name="{{$field->name}}" id="{{$field->name}}">
    	@foreach($field->default_values as $value)
    		@if($value === $field->value)
    			<option value="{{$value}}" selected>{{$value}}</option>
    		@else
    			<option value="{{$value}}">{{$value}}</option>
    		@endif
    	@endforeach
    </select>
  </div>
</div>