<div class="position-relative text-end {{ $attributes['class'] }}"
    style="height: {{ $attributes['height'] }}; width:{{ $attributes['width'] }}; background-size:cover; background-position:center; background-image:url('{{ url(isset($attributes['value']) ? $attributes['value'] : '/images/placeholder.png') }}')"
    id="{{ $id }}-preview" value="{{ $attributes['value'] || '' }}">
    <input type="text" name="{{ $attributes['name'] }}" id="{{ $id }}-field" class="d-none" />


    <div
        style="height: 100%; width: 100%; background: linear-gradient(45deg, rgba(3,0,36,0) calc(100% - 35px), rgba(9,9,121,0.7) calc(100% - 35px)); position: absolute; top:0;left:0; z-index:0">
    </div>
    <label for="{{ $id }}-input" class="position-absolute" style="top: 5px; right: 5px">
        <a class="d-inline-block  text-light" style="cursor: pointer"><i class="fas fa-camera"></i> </a>
        <input type="file" id="{{ $id }}-input" class="d-none" />
    </label>
    {{ $slot }}
</div>
<script>
    $(function() {
        const _id = "{{ $id }}";

        const _elm = document.querySelector("#{{ $id }}-input");
        const _preview = document.querySelector("#{{ $id }}-preview");
        const _field = document.querySelector("#{{ $id }}-field");
        _elm.onchange = (_event) => {
            const files = _event.target.files;
            const url = URL.createObjectURL(files[0]);

            ask("Are you sure?").then(() => {
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
            }).catch(e => {

            })

        }
    });
</script>
