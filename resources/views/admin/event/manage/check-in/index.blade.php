@extends('admin.layouts.admin')
@section('subnav')
<!-- @include('admin.event.partials.subnav') -->
<div class="bg-white border-bottom" style="background-color: #eee;">
    <div class="container-lg">
        <form onsubmit="openCheckInDetails(event)" id="search-form" class="d-flex align-items-center">
            <div class="fs-5">
                ID
            </div>
            <input type="text" class="form-control form-control-lg border-0 bg-transparent flex-grow-1" placeholder="Please enter order id" name="id" value="{{app('request')->input('id')}}" />
        </form>
    </div>
</div>
@endsection
@section('content')
<div class="overflow-auto mt-4" id="details-container">

</div>

<script>
    function openCheckInDetails(event) {
        event.preventDefault();
        const order_id = (new FormData(event.target)).get("id");
        jQuery.ajax({
            url: "{{ url('/admin/event/'.$event->id.'/check-in/details') }}",
            method: 'post',
            data: {
                order_id: order_id
            },
            success: function(result) {
                console.log(result);
                $("#details-container").html(result.html);
            },
            complete: (result) => {

            },
            error: (error) => {
                $("#details-container").html("");
            }
        });
    }

    function checkIn(order_id) {
        if (!confirm("Are you sure?")) return false;
        jQuery.ajax({
            url: "{{ url('/admin/event/'.$event->id.'/check-in') }}",
            method: 'post',
            data: {
                order_id: order_id
            },
            success: function(result) {
                openCheckInDetails({
                    target: document.getElementById("search-form"),
                    preventDefault: () => {}
                })
            }
        });
    }
</script>


@endsection