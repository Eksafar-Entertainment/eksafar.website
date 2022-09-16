@extends('frontend.index')
@section('page_css')
<link rel="stylesheet" href="/css/date-cal.css">
@endsection
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
                    <img src="/images/groom.jpg" class="img-responsive" alt="event">
                    <h3>Dandiya</h3>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2 nopadding">
                    <h2 class="amp-center"><i class="icon-music2"></i></h2>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-5 nopadding">
                    <img src="/images/bride.png" class="img-responsive" alt="live music">
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
    <div class="modal-dialog" role="document" @if ($mobile) style="margin: 5px;" @endif>
        <div class="modal-content" style="background-color: rgba(0,0,0,0);">

            <table @if ($mobile) style="margin-top: 15%;" @endif>

                <td align="left" @if ($desktop) style="padding: 15px; border-radius: 2px; position: relative; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, .1), 0 4px 6px -2px rgba(0, 0, 0, .05); vertical-align: top; z-index: 50;" @endif @if ($mobile) style="border-radius: 2px; position: relative; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, .1), 0 4px 6px -2px rgba(0, 0, 0, .05); vertical-align: top; z-index: 50;" @endif bgcolor="#ffffff" valign="top">
                    <table width="100%" style="margin-top: 25px; margin-left: 25px;">
                        <tr>
                            <td width="80%">
                                <h1 class="sm-text-lg all-font-roboto" style="font-weight: 700; line-height: 100%; margin: 0; margin-bottom: 4px; font-size: 24px;">
                                    Booking Details</h1>
                                <p class="sm-text-xs" style="margin: 0; color: #a0aec0; font-size: 14px;">Please enter
                                    the detials below</p>
                            </td>
                            <td style="text-align: right;" width="20%" align="right">

                            </td>
                        </tr>
                    </table>
                    <div style="line-height: 32px;">&zwnj;</div>

                    <form action="/payment/checkout" method="post" class="form-inline">
                        @csrf
                        <input type="hidden" name="event_id" value="1" />
                        <input type="hidden" name="promoter_id" value="{{ app('request')->input('promoter') }}" />

                        <div class="row col-md-12 col-sm-12">
                            <div class="col-md-6 col-xs-6" style="font-weight: 600; padding-bottom: 10px;">
                                <input class="form-control form-control-sm quantity" style="color: #a0aec0; width:100%;" type="text" name="name" placeholder="Name" id="name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'" required>
                            </div>
                            <div class="col-md-6 col-xs-6" style="font-weight: 600;">
                                <input class="form-control form-control-sm quantity" style="color: #a0aec0; width:100%;" type="number" name="mobile" placeholder="Mobile No." id="mobile" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone no'" required>
                            </div>
                        </div>
                        <div class="form-group row col-md-12 col-sm-12">
                            <div class="col-md-6 col-xs-6" style="font-weight: 600; padding-bottom: 10px;">
                                <input class="form-control form-control-sm quantity" style="color: #a0aec0; width:100%;" type="email" name="email" placeholder="Email address." id="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required>
                            </div>
                            <div class="col-md-6 col-xs-6" style="font-weight: 600; padding-bottom: 10px;">

                                <div class="row">
                                    <!-- <div class="col-md-4 col-xs-4"><label style="font-size: 12px;font-weight: bold;padding:10px;">For Date</label></div> -->
                                    <div class="col-md-6 col-xs-12">
                                        <label>
                                            <input type="radio" checked name="date" value="3">
                                            <div class="btn btn-sık"><span>3rd Oct</span></div>
                                        </label>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <label>
                                            <input type="radio" name="date" value="4">
                                            <div class="btn btn-sık"><span>4th Oct</span></div>
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>

                        @if (isset($event_tickets))
                        <table class="table table-sm" style="font-size: 14px; margin-top: 20px;">
                            @forelse($event_tickets as $ticket)
                            <tr class="event-ticket-row" event-ticket-id="{{ $ticket->id }}">
                                <td>
                                    <p class="all-font-roboto" style="font-weight: 600; margin: 0; color: #000000;">
                                        {{ $ticket->name }}
                                    </p>
                                    <p class="all-font-roboto" style="margin: 0; margin-bottom: 4px; color: #a0aec0; font-size: 10px; text-transform: uppercase;">
                                        {{ $ticket->description }}
                                    </p>
                                </td>
                                <td width="2%" nowrap class="text-right" style="vertical-align:middle; font-family: Menlo, Consolas, monospace; font-weight: 600; color: #cbd5e0; letter-spacing: -1px;">
                                    ₹{{ $ticket->price }} x </td>
                                <td width="3%" nowrap style="vertical-align:middle">
                                    <input class="form-control form-control-sm quantity" style="min-width: 100px; color: #a0aec0;" type="number" name="items[{{ $ticket->id }}][quantity]" value="" min="0" max="20" maxlength="2">
                                    <input type="hidden" name="items[{{ $ticket->id }}][event_ticket_id]" value="{{ $ticket->id }}">
                                    <input type="hidden" class="form-control rate" value="{{ $ticket->price }}">
                                </td>
                                <td style="vertical-align: middle">
                                    {{ $ticket->persons }} <i class="icon-user2 text-primary"></i>
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
            quantity_field.value = quantity_field.value.slice(0, 2);
            const quantity = parseInt(quantity_field.value) > 0 ? parseInt(quantity_field.value) : 0;
            price.innerHTML = quantity > 0 ? quantity * parseInt(rate_field.value) : 0;
            let total_price = 0;
            document.querySelectorAll(".price").forEach((el) => total_price += parseInt(el.innerText) >
                0 ? parseInt(el.innerText) : 0);
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
        countdown.innerHTML = '<span id="days">' + days + ' <small>Days</small></span> <span id="hours">' +
            hours + ' <small>Hours</small></span> <span id="minutes">' +
            minutes + ' <small>Minutes</small></span> <span id="seconds">' + seconds +
            ' <small>Seconds</small></span>';

    }, 1000);
</script>

<script>
    $(document).ready(function() {
        $("#book-ticket-modal").modal('show');
    });
</script>

@endsection