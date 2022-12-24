<form onsubmit="handleOnSubmitTicketForm(event)">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Ticket Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" value="{{ $event->id }}" name="event_id">
            <input type="hidden" value="{{ $event_ticket->id }}" name="event_ticket_id">
            <div class="form-group">
                <label for="name-input">Name</label>
                <input type="text" class="form-control" id="name-input" placeholder="Enter Name" name="name"
                    value="{{ $event_ticket->name }}">
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="form-group">
                        <label for="persons-input">Persons</label>
                        <div class="input-group">

                            <span class="input-group-text" id="basic-price"><i class="fas fa-user text-grey"></i></span>

                            <input type="number" class="form-control" id="persons-input" placeholder="Enter Persons"
                                name="persons" value="{{ $event_ticket->persons }}">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="price-input">Price</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-price">₹</span>

                            <input type="number" class="form-control" id="price-input" placeholder="Enter Price"
                                name="price" value="{{ $event_ticket->price }}">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="price-input">Status</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-price">₹</span>

                            <select class="form-select" name="status">
                                <option {{ $event_ticket->status === 'CREATED' ? 'selected' : '' }}>CREATED</option>
                                <option {{ $event_ticket->status === 'ACTIVE' ? 'selected' : '' }}>ACTIVE</option>
                                <option {{ $event_ticket->status === 'SOLD' ? 'selected' : '' }}>SOLD</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-6">
                    <div class="form-group">
                        <label for="start_datetime-input">Start At</label>
                        <div class="input-group">

                            <span class="input-group-text" id="basic-start_datetime"><i
                                    class="fas fa-calendar text-grey"></i></span>

                            <input type="datetime" class="form-control" id="start_datetime-input"
                                placeholder="Enter Start Datetime" name="start_datetime"
                                value="{{ $event_ticket->start_datetime }}">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="end_datetime-input">End At</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-end_datetime"><i
                                    class="fas fa-calendar text-grey"></i></span>

                            <input type="datetime" class="form-control" id="end_datetime-input"
                                placeholder="Enter End Datetime" name="end_datetime"
                                value="{{ $event_ticket->end_datetime }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mt-3">
                <label for="description-input">Description</label>
                <textarea type="text" class="form-control" id="description-input" placeholder="Enter Description" name="description">{{ $event_ticket->description }}</textarea>
            </div>



        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Ticket</button>

        </div>
    </div>
</form>
