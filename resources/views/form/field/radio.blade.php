<div class="row mb-3">
    <label for="name" class="col-md-4 col-form-label text-md-end">{{$field->label}}</label>

    <div class="col-md-6">
        @foreach($field->options as $value=>$label)
        <radio name="{{$field->name}}" value="{{$value}}" {{$field->value==$value?"selected":""}} {{$field->required?"required":""}} /> {{$label}}
        @endforeach
    </div>
</div>