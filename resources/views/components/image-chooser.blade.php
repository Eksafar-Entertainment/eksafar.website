<label style="height: {{ $attributes['height'] }}; width:{{ $attributes['width'] }}" id="{{ $id }}-preview" for="{{ $id }}-input" class="{{$attributes['class']}}">
    <input type="text" name="{{$attributes['name']}}" id="{{ $id }}-field" class="d-none"/>
    <input type="file" id="{{ $id }}-input" class="d-none" />
</label>
<script>
    $(function() {
        const _id = "{{ $id }}";

        const _elm = document.querySelector("#{{ $id }}-input");
        const _preview = document.querySelector("#{{ $id }}-preview");
        const _field = document.querySelector("#{{ $id }}-field");
        _elm.onchange = (_event) => {
            const files = _event.target.files;
            const url = URL.createObjectURL(files[0]);
            _preview.style.backgroundImage = `url(${url})`;

            var form = new FormData();
            form.append("upload", files[0]);
            form.append('dir', '/');
            axios.post('/admin/files/uploader', form).then(res => {
                console.log(res);
                _field.value = res.data.path;
            }).catch(err => {
                console.log(res);
            });
        }
    });
</script>
