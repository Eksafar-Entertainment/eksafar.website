@extends('frontend.index')
@section('content')
    @include('frontend.header')
    @include('frontend.brandcam')
    <div class="py-5" style="background-image: url({{ url('/img/banner/banner.png') }})">

       
        <div class="container text-center">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#book-ticket-modal">
            Book Now
          </button>
        </div>

        <div class="modal fade text-light" tabindex="-1" role="dialog" id="book-ticket-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="/payment/checkout" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title">Book Ticket</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="event_id" value="1" />
                            <input type="hidden" name="promoter_id" value="{{ app('request')->input('promoter') }}" />
                            <div class="input-group-icon mt-10">
                                <div class="icon"><i class="fa fa-user" aria-hidden="true"></i></div>
                                <input type="text" name="name" placeholder="Name" id="name"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'" required
                                    class="single-input">
                            </div>
                            <div class="input-group-icon mt-10">
                                <div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                                <input type="email" name="email" placeholder="Email address" id="email"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required
                                    class="single-input">
                            </div>
                            <div class="input-group-icon mt-10">
                                <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                                <input type="number" name="mobile" placeholder="Mobile No." id="mobile"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone no'" required
                                    class="single-input">
                            </div>
                            <div class="mt-4">
                                @if (isset($event_tickets))
                                    <table class="table table-sm">
                                        @forelse($event_tickets as $ticket)
                                            <tr class="event-ticket-row" event-ticket-id="{{ $ticket->id }}">
                                                <td>
                                                    {{ $ticket->name }}<br />
                                                    <small>{{ $ticket->description }}</small>
                                                </td>
                                                <td width="2%" nowrap class="text-right" style="vertical-align:middle">
                                                    ₹{{ $ticket->price }} x </td>
                                                <td width="3%" nowrap style="vertical-align:middle">
                                                    <input class="form-control form-control-sm quantity"
                                                        style="min-width: 50px;" type="number"
                                                        name="items[{{ $ticket->id }}][quantity]" value=""
                                                        min="0" max="20">
                                                    <input type="hidden" name="items[{{ $ticket->id }}][event_ticket_id]"
                                                        value="{{ $ticket->id }}">
                                                    <input type="hidden" class="form-control rate"
                                                        value="{{ $ticket->price }}">
                                                </td>
                                                <td width="1%" nowrap class="text-right d-none"
                                                    style="vertical-align:middle;min-width:100px">
                                                    ₹<span class="price"></span>
                                                </td>


                                            </tr>
                                        @empty
                                            <p>No users</p>
                                        @endforelse
                                    </table>
                                @endif

                           
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-block">Pay <span id="button-price">₹0</span></button>
                        </div>
                    </form>
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


                    let total_price = 0;
                    document.querySelectorAll(".price").forEach((el)=>total_price+=parseInt(el.innerText)>0?parseInt(el.innerText):0);
                    document.querySelector("#button-price").innerText = "₹"+total_price;
                })
            });
        </script>
        @include('frontend.footer')
    @endsection
