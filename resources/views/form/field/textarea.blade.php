<div class="row mb-3">
    <label for="name" class="col-md-4 col-form-label text-md-end">{{$field->label}}</label>

    <div class="col-md-6">
        <textarea id="{{$field->name}}" class="form-control" placeholder='{{$field->placeholder}}' name="{{$field->name}}" required="{{$field->required}}">{{$field->value}}</textarea>
    </div>
</div>