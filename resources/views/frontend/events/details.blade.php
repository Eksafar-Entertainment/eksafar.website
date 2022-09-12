@extends('frontend.index')
@section('content')
@include('frontend.events.top-bar')
@include('frontend.header')

<div id="fh5co-couple" class="fh5co-section-gray">
  <div class="container">

    <div class="row animate-box">
      <div class="col-md-8 col-md-offset-2">
        <div class="col-md-12 text-center heading-section">
          <h2>Dandiya Disco Night</h2>
        </div>
      </div>
    </div>
    <div class="row row-bottom-padded-md animate-box">
      <div class="col-md-6 col-md-offset-3 text-center">
        <div class="col-md-5 col-sm-5 col-xs-5 nopadding">
          <img src="images/groom.jpg" class="img-responsive" alt="event">
          <h3>Dandiya</h3>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2 nopadding">
          <h2 class="amp-center"><i class="icon-music2"></i></h2>
        </div>
        <div class="col-md-5 col-sm-5 col-xs-5 nopadding">
          <img src="images/bride.png" class="img-responsive" alt="live music">
          <h3>Live Music</h3>
        </div>
      </div>
    </div>
    <div class="row animate-box">
      <div class="col-md-8 col-md-offset-2">
        <div class="col-md-12 text-center heading-section">
          <p><strong>on Oct 3, 2022 &mdash; Catch up, Bangalore</strong></p>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#book-ticket-modal">
            Book Now
          </button>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade text-light" tabindex="-1" role="dialog" id="book-ticket-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background-color: rgba(0,0,0,0);">

      <table class="wrapper all-font-sans" width="100%" height="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
          <td align="center" style="padding: 24px;" width="100%">
            <table class="sm-w-full" width="600" cellpadding="0" cellspacing="0" role="presentation">
              <tr>
                <!-- <td class="sm-hidden" style="padding-top: 40px; padding-bottom: 40px;" width="160">
                  <img src="images/ticket.png" alt="Double room" style="border: 0; line-height: 100%; vertical-align: middle; border-top-left-radius: 4px; border-bottom-left-radius: 4px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, .1), 0 4px 6px -2px rgba(0, 0, 0, .05);" width="160">
                </td> -->
                <td align="left" class="sm-p-20 sm-dui17-b-t" style="border-radius: 2px; padding: 40px; position: relative; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, .1), 0 4px 6px -2px rgba(0, 0, 0, .05); vertical-align: top; z-index: 50;" bgcolor="#ffffff" valign="top">
                  <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                      <td width="80%">
                        <h1 class="sm-text-lg all-font-roboto" style="font-weight: 700; line-height: 100%; margin: 0; margin-bottom: 4px; font-size: 24px;">Booking Details</h1>
                        <p class="sm-text-xs" style="margin: 0; color: #a0aec0; font-size: 14px;">Please enter the detials below</p>
                      </td>
                      <td style="text-align: right;" width="20%" align="right">

                      </td>
                    </tr>
                  </table>
                  <div style="line-height: 32px;">&zwnj;</div>

                  <form action="/payment/checkout" method="post">
                    @csrf
                    <input type="hidden" name="event_id" value="1" />
                    <input type="hidden" name="promoter_id" value="{{ app('request')->input('promoter') }}" />

                    <table class="sm-leading-32" style="line-height: 28px; font-size: 14px;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                      <tr>
                        <td class="sm-inline-block" style="font-weight: 600; padding-bottom: 10px;" width="100%">
                          <input class="form-control form-control-sm quantity" style="min-width: 100px; color: #a0aec0;" type="text" name="name" placeholder="Name" id="name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'" required>
                        </td>
                      </tr>
                      <tr>
                        <td class="sm-inline-block" style="font-weight: 600; padding-bottom: 10px;" width="100%">
                          <input class="form-control form-control-sm quantity" style="min-width: 100px; color: #a0aec0;" type="email" name="email" placeholder="Email address." id="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required>
                        </td>
                      </tr>
                      <tr>
                        <td class="sm-w-3-4 sm-inline-block" style="font-weight: 600;" width="100%">
                          <input class="form-control form-control-sm quantity" style="min-width: 100px; color: #a0aec0;" type="number" name="mobile" placeholder="Mobile No." id="mobile" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone no'" required>
                        </td>
                      </tr>
                    </table>

                    @if (isset($event_tickets))
                    <table class="table table-sm" style="font-size: 14px; margin-top: 20px;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                      @forelse($event_tickets as $ticket)
                      <tr class="event-ticket-row" event-ticket-id="{{ $ticket->id }}">
                        <td>
                          <p class="all-font-roboto" style="font-weight: 600; margin: 0; color: #000000;">{{ $ticket->name }}</p>
                          <p class="all-font-roboto" style="margin: 0; margin-bottom: 4px; color: #a0aec0; font-size: 10px; text-transform: uppercase;">
                            {{ $ticket->description }}
                          </p>
                        </td>
                        <td width="2%" nowrap class="text-right" style="vertical-align:middle; font-family: Menlo, Consolas, monospace; font-weight: 600; color: #cbd5e0; letter-spacing: -1px;">
                          ₹{{ $ticket->price }} x </td>
                        <td width="3%" nowrap style="vertical-align:middle">
                          <input class="form-control form-control-sm quantity" style="min-width: 100px; color: #a0aec0;" type="number" name="items[{{ $ticket->id }}][quantity]" value="" min="0" max="20">
                          <input type="hidden" name="items[{{ $ticket->id }}][event_ticket_id]" value="{{ $ticket->id }}">
                          <input type="hidden" class="form-control rate" value="{{ $ticket->price }}">
                        </td>
                        <td style="vertical-align: middle">
                           {{$ticket->persons}} <i class="icon-user2 text-primary"></i>
                        </td>
                        <td width="1%" nowrap class="text-right d-none" style="vertical-align:middle;min-width:100px; color: #68d391">
                          ₹<span class="price"></span>
                        </td>


                      </tr>
                      @empty
                      <p>No users</p>
                      @endforelse
                    </table>
                    @endif

                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary btn-block">Pay <span id="button-price">₹0</span></button>
                    </div>
                  </form>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>

    </div>
  </div>
</div>


@include('frontend.landing.countdown')
@include('frontend.landing.slider')
@include('frontend.footer')


<script>
  document.querySelectorAll(".event-ticket-row").forEach((el) => {
    const event_ticket_id = el.getAttribute("event-ticket-id");
    const quantity_field = el.querySelector("input.quantity");
    const price = el.querySelector(".price");
    const rate_field = el.querySelector("input.rate");

    quantity_field.addEventListener("keyup", () => {
      price.innerHTML = parseInt(quantity_field.value) > 0?parseInt(quantity_field.value) * parseInt(rate_field.value): 0;


      let total_price = 0;
      document.querySelectorAll(".price").forEach((el) => total_price += parseInt(el.innerText) > 0 ? parseInt(el.innerText) : 0);
      document.querySelector("#button-price").innerText = "₹" + total_price;
    })
  });
</script>

<script>
  // set the date we're counting down to
  var target_date = new Date('October, 2, 2022').getTime();

  // variables for time units
  var days, hours, minutes, seconds;

  // get tag element
  var countdown = document.getElementById('countdown');

  // update the tag with id "countdown" every 1 second
  setInterval(function() {

    // find the amount of "seconds" between now and target
    var current_date = new Date().getTime();
    var seconds_left = (target_date - current_date) / 1000;

    // do some time calculations
    days = parseInt(seconds_left / 86400);
    seconds_left = seconds_left % 86400;

    hours = parseInt(seconds_left / 3600);
    seconds_left = seconds_left % 3600;

    minutes = parseInt(seconds_left / 60);
    seconds = parseInt(seconds_left % 60);

    // format countdown string + set tag value
    countdown.innerHTML = '<span id="days">' + days + ' <small>Days</small></span> <span id="hours">' + hours + ' <small>Hours</small></span> <span id="minutes">' +
      minutes + ' <small>Minutes</small></span> <span id="seconds">' + seconds + ' <small>Seconds</small></span>';

  }, 1000);
</script>

@endsection