<form onsubmit="handleOnSubmitComboTicketForm(event)">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Ticket Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" value="{{ $event->id }}" name="event_id">
            <input type="hidden" value="{{ $event_combo_ticket?->id || '' }}" name="event_combo_ticket_id">
            <div class="form-group">
                <label for="name-input">Name</label>
                <input type="text" class="form-control" id="name-input" placeholder="Enter Name" name="name"
                    value="{{ $event_combo_ticket->name }}">
            </div>

            <div class="form-group mt-3">
                <label for="name-input">Price</label>
                <input type="number" class="form-control" id="price-input" placeholder="Enter Price" name="price"
                    value="{{ $event_combo_ticket->price }}">
            </div>

            <div class="mt-3">

                @foreach ($event_tickets as $event_ticket)
                    <div class="form-check">
                        <input {{ $event_combo_ticket->id && in_array($event_ticket->id, $event_combo_ticket->event_tickets)? "checked": ""  }} class="form-check-input" type="checkbox" id="flexCheckDefault-{{$event_ticket->id}}" name="event_tickets[]" value="{{$event_ticket->id}}">
                        <label class="form-check-label" for="flexCheckDefault-{{$event_ticket->id}}">
                            {{$event_ticket->name}}
                        </label>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Ticket</button>

        </div>
    </div>
</form>
