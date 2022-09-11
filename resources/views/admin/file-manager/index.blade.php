@extends('admin.layouts.admin')

@section('content')


<div class="container">
    <div id="listing">

    </div>
</div>

<script>
    function getListing(dir = "") {
        jQuery.ajax({
            url: "{{ url('/admin/files/listing') }}",
            method: 'post',
            data: {
                dir: dir
            },
            success: function(result) {
                $("#listing").html(result.html);
            }
        });
    }
    window.onload = () => {
        getListing();
    }
</script>


@endsection