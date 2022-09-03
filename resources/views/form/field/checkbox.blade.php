<div class="row mb-3">
    <label for="name" class="col-md-4 col-form-label text-md-end">{{$field->label}}</label>

    <div class="col-md-6">
        <input id="{{$field->name}}" type="checkbox" class="form-checkbox" name="{{$field->name}}" value="{{$field->value}}" {{$field->checked?"checked":""}}  {{$field->required?"required":""}}>
    </div>
</div>