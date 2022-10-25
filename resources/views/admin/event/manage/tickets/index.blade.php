@extends('admin.layouts.admin')
@section('subnav')
    @include('admin.event.partials.subnav')
@endsection
@section('content')
    <div>
        <div>
            <div class="row">
                <div class="col">
                    <h4>Tickets</h4>
                </div>
                <div class="col-auto">
                    <button type="button" onclick="openForm('')" class="btn btn-primary">New Ticket</button>
                </div>
            </div>

            <div class="mt-2">
                @include('admin.layouts.partials.messages')
            </div>


            <div class="row">
                @foreach ($event_tickets as $key => $event_ticket)
                    <div class="col-md-4 mb-4">
                        <div class="card" style="cursor: pointer">
                            <div class="card-header bg-primary text-light d-flex align-items-center">
                                <div class="flex-grow-1" onclick="openForm('{{ $event_ticket->id }}')">
                                    <i class="fas fa-ticket"></i> {{ $event_ticket->name }}
                                </div>
                                <span>
                                    @money($event_ticket->price)
                                </span>
                                <div class="ms-3">
                                    <select class="form-select form-select-sm border-0" inline-edit-table="event_tickets"
                                        inline-edit-field="status" inline-edit-where="id='{{ $event_ticket->id }}'">
                                        <option {{ $event_ticket->status === 'CREATED' ? 'selected' : '' }}>CREATED</option>
                                        <option {{ $event_ticket->status === 'ACTIVE' ? 'selected' : '' }}>ACTIVE</option>
                                        <option {{ $event_ticket->status === 'SOLD' ? 'selected' : '' }}>SOLD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col text-center">
                                        <span class="fs-5">{{ $event_ticket->total_sale_count }}</span><br />
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
        </div>
        <div>

            <div class="row">
                <div class="col">
                    <h4>Combo Tickets</h4>
                </div>
                <div class="col-auto">
                    <button type="button" onclick="openComboForm('')" class="btn btn-primary">New Combo Ticket</button>
                </div>
            </div>
            <div class="row">
                @foreach ($event_combo_tickets as $key => $event_combo_ticket)
                    <div class="col-md-4 mb-4">
                        <div class="card" onclick="openComboForm('{{ $event_combo_ticket->id }}')"
                            style="cursor: pointer">
                            <div class="card-header bg-primary text-light d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <i class="fas fa-ticket"></i> {{ $event_combo_ticket->name }}
                                </div>
                                <span>
                                    @money($event_combo_ticket->price)
                                </span>
                                <div class="ms-3">
                                    <select class="form-select form-select-sm border-0"
                                        inline-edit-table="event_combo_tickets" inline-edit-field="status"
                                        inline-edit-where="id='{{ $event_ticket->id }}'">
                                        <option {{ $event->event_combo_ticket === 'CREATED' ? 'selected' : '' }}>CREATED
                                        </option>
                                        <option {{ $event->event_combo_ticket === 'ACTIVE' ? 'selected' : '' }}>ACTIVE
                                        </option>
                                        <option {{ $event->event_combo_ticket === 'SOLD' ? 'selected' : '' }}>SOLD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">

                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="form-modal">
            <div class="modal-dialog">

            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="combo-form-modal">
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

        <script>
            let comboFormModal = null;

            function openComboForm(event_combo_ticket_id) {
                jQuery.ajax({
                    url: "{{ url('/admin/event/' . $event->id . '/tickets/combo/form') }}",
                    method: 'post',
                    data: {
                        event_combo_ticket_id: event_combo_ticket_id
                    },
                    success: function(result) {
                        $("#combo-form-modal .modal-dialog").html(result.html);
                        comboFormModal = comboFormModal ?? new bootstrap.Modal(document.getElementById(
                            'combo-form-modal'), {});
                        comboFormModal.show();
                    }
                });
            }

            function handleOnSubmitComboTicketForm(event) {
                event.preventDefault();
                jQuery.ajax({
                    url: "{{ url('/admin/event/' . $event->id . '/tickets/combo') }}",
                    method: 'post',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: new FormData(event.target),
                    success: function(result) {
                        alert(result.message);
                        window.location.reload();
                        comboFormModal.hide();
                    }
                });
            }
        </script>
    </div>
@endsection
