<div class="form-group row">
  <label for="{{$field->name}}" class="col-sm-1 col-form-label">{{$field->name}}</label>
  <div class="col-sm-10">
  	<textarea class="form-control" name="{{$field->name}}" id="{{$field->name}}" rows="5">{{$field->value}}</textarea>
  </div>
</div>