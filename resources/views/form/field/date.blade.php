<div class="row mb-3">
    <label for="name" class="col-md-4 col-form-label text-md-end">{{$field->label}}</label>

    <div class="col-md-6">
        <input id="{{$field->name}}" type="{{$field->input_type}}" class="form-control" placeholder='{{$field->placeholder}}' name="name" value="{{$field->value}}" required="">
    </div>
</div>