@extends('admin.layouts.admin')

@section('subnav')
@include('admin.event.manage.partials.subnav', ['active' => 'tickets'])
@endsection

@section('content')
<h4>Tickets</h4>
<p class="text-muted">Manage your tickets here.</p>
<div class="mt-2 mb-4">
    @include('layouts.partials.messages')
</div>
<div class="row">
    @foreach ($event_tickets as $key => $event_ticket)
    <div class="col-md-4 mb-4">
        <div class="card" onclick="openForm('{{ $event_ticket->id }}')" style="cursor: pointer">
            <div class="card-header bg-primary text-light d-flex align-items-center">
                <div class="flex-grow-1">
                    <i class="fas fa-ticket"></i> {{$event_ticket->name}}
                </div>
                <span>
                    @money($event_ticket->price)
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col text-center">
                        <span class="fs-5">{{$event_ticket->total_sale_count}}</span><br />
                        <span class="text-primary">Tickets Sold</span>
                    </div>

                    <div class="col text-center">
                        <span class="fs-5">
                            @money($event_ticket->total_sale_amount)
                        </span><br />
                        <span class="text-primary">Revenue</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endforeach
</div>
<div class="d-flex mt-4">
    @include('admin.common.pagination', ['paginator' => $event_tickets])
</div>


<div class="modal fade" tabindex="-1" id="form-modal">
    <div class="modal-dialog">

    </div>
</div>
<script>
    let formModal = null;

    function openForm(event_ticket_id) {
        jQuery.ajax({
            url: "{{ url('/admin/event/' . $event->id . '/tickets/form') }}",
            method: 'post',
            data: {
                event_ticket_id: event_ticket_id
            },
            success: function(result) {
                $("#form-modal .modal-dialog").html(result.html);
                formModal = new bootstrap.Modal(document.getElementById('form-modal'), {});
                formModal.show();
            }
        });
    }

    function handleOnSubmitTicketForm(event) {
        event.preventDefault();
        jQuery.ajax({
            url: "{{ url('/admin/event/' . $event->id . '/tickets') }}",
            method: 'post',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(event.target),
            success: function(result) {
                alert(result.message);
                window.location.reload();
                formModal.hide();
            }
        });
    }
</script>
@endsection