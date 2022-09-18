@extends('admin.layouts.admin')

@section('subnav')
@include('admin.event.manage.partials.subnav', ["active"=>"check-in"])
@endsection

@section('content')
<h4>Check In</h4>
<p class="text-muted d-none">Manage your order here.</p>
<div class="mt-2">
    @include('layouts.partials.messages')
</div>


<div class="mt-4">
    <form onsubmit="openCheckInDetails(event)" id="search-form">
        <div class="row">
            <input type="hidden" name="page" value="{{app('request')->input('page')}}" />
            <div class="col-auto">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">ID</span>
                    <input class="form-control" placeholder="Order ID" name="id" value="{{app('request')->input('id')}}" />
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>
</div>

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
            complete:(result)=>{

            },
            error:(error)=>{

            }
        });
    }

    function checkIn(order_id) {
        if(!confirm("Are you sure?")) return false;
        jQuery.ajax({
            url: "{{ url('/admin/event/'.$event->id.'/check-in') }}",
            method: 'post',
            data: {
                order_id: order_id
            },
            success: function(result) {
                openCheckInDetails({
                    target: document.getElementById("search-form"),
                    preventDefault: ()=>{}
                })
            }
        });
    }
</script>


@endsection