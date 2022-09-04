<div class="row mb-3">
    <label for="name" class="col-md-4 col-form-label text-md-end">{{$field->label}}</label>

    <div class="col-md-6">
        <select id="{{$field->name}}" type="{{$field->input_type}}" class="form-control" placeholder='{{$field->placeholder}}' name="{{$field->name}}" value="{{$field->value}}" {{$field->required?"required":""}}>
            @foreach($field->options as $value=>$label)
                <option {{$field->value==$value?"selected":""}} value="{{$value}}">{{$label}}</option>
            @endforeach
        </select>
    </div>
</div>