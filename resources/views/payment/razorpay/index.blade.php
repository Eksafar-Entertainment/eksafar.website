<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>   -->

<!-- Ticket Modal -->
<div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div style="text-align: center">
          <h5 class="modal-title" id="ticketModalLabel">Buy Ticket</h5>
        </div>
        <br />
        <form action="/payment/checkout" method="post">
          @csrf
          <input type="hidden" name="event_id" value="1"/>
          <div class="input-group-icon mt-10">
            <div class="icon"><i class="fa fa-user" aria-hidden="true"></i></div>
            <input type="text" name="name" placeholder="Name" id="name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'" required class="single-input">
          </div>
          <div class="input-group-icon mt-10">
            <div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
            <input type="email" name="email" placeholder="Email address" id="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required class="single-input">
          </div>
          <div class="input-group-icon mt-10">
            <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
            <input type="number" name="mobile" placeholder="Mobile No." id="mobile" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone no'" required class="single-input">
          </div>
          <div>
            @if(isset($ticket_type))
            <table class="text-light table-divider table table-sm">
              @forelse($ticket_type as $ticket)
              <tr class="event-ticket-row" event-ticket-id="{{$ticket->id}}">
                <td>
                  {{$ticket->name}}<br />
                  <small>{{$ticket->description}}</small>
                </td>
                <td>₹{{$ticket->price}} x</td>
                <td width="3%">
                  <input class="form-control form-control-sm quantity" style="min-width: 100px;" type="number" name="items[{{$ticket->id}}][quantity]" value="0" min="1" max="20">
                  <input type="hidden" name="items[{{$ticket->id}}][event_ticket_id]" value="{{$ticket->id}}">
                  <input type="hidden" class="form-control rate" value="{{$ticket->price}}">
                </td>
                <td style="white-space: nowrap; width: 120px; text-align: right">
                  ₹<span class="price"></span>
                </td>


              </tr>
              @empty
              <p>No users</p>
              @endforelse
            </table>
            @endif
          </div>
          <button type="submit" class="primary btn-block">Buy Now</button>
        </form>

      </div>
    </div>
  </div>
</div>
<script>
  document.querySelectorAll(".event-ticket-row").forEach((el) => {
    const event_ticket_id = el.getAttribute("event-ticket-id");
    const quantity_field = el.querySelector("input.quantity");
    const price = el.querySelector(".price");
    const rate_field = el.querySelector("input.rate");

    quantity_field.addEventListener("keyup", () => {
      price.innerHTML = parseInt(quantity_field.value) * parseInt(rate_field.value);
    })


  });
</script>