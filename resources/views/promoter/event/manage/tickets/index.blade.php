@extends('promoter.layouts.admin')
@section('subnav')
    @include('promoter.event.partials.subnav')
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
                @include('promoter.layouts.partials.messages')
            </div>


            <div class="row">
                @foreach ($event_tickets as $key => $event_ticket)
                    <div class="col-md-4 mb-4">
                        <div class="card position-relative overflow-hidden" style="cursor: pointer" onclick="openForm('{{ $event_ticket->id }}')">
                            <div class="card-header bg-primary text-light d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <i class="fas fa-ticket"></i> {{ $event_ticket->name }}<br />
                                    <small style="font-size: 12px">
                                        {{ \Carbon\Carbon::parse($event_ticket->start_datetime)->format('d/m/Y h:i A') }} 
                                        to
                                        {{ \Carbon\Carbon::parse($event_ticket->end_datetime)->format('d/m/Y h:i A') }}
                                    </small>
                                </div>
                                <span>
                                    @money($event_ticket->price)
                                </span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col text-center">
                                        <span class="fs-5">{{ $event_ticket->total_sale_count }}</span><br />
                                        <span class="text-primary">Tickets Sold</span>
                                    </div>

                                    {{-- <div class="col text-center">
                                        <span class="fs-5">
                                            @money($event_ticket->total_sale_amount)
                                        </span><br />
                                        <span class="text-primary">Revenue</span>
                                    </div> --}}
                                </div>
                            </div>

                            <div class="position-absolute bottom-0 right-0 end-0 bg-{{$status_colors[$event_ticket->status]}} px-2 text-light" style="border-top-left-radius: 8px">
                                <small>{{ $event_ticket->status }}</small>
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
    </div>
@endsection
