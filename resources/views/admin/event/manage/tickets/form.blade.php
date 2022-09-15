<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Ticket Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="email-input">Name</label>
            <input type="text" class="form-control" id="email-input" placeholder="Enter Name">
        </div>
        <div class="row mt-3">
            <div class="col">
                <div class="form-group">
                    <label for="persons-input">Persons</label>
                    <input type="number" class="form-control" id="email-persons" placeholder="Enter Persons">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="price-input">Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-price">₹</span>
                        </div>
                        <input type="number" class="form-control" id="price-input" placeholder="Enter Price">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group mt-3">
            <label for="description-input">Description</label>
            <textarea type="text" class="form-control" id="description-input" placeholder="Enter Description"></textarea>
        </div>



    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Check In</button>

    </div>
</div>
