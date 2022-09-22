<div class="container">
    <div class="row">

        <div class="col-sm-7">
            <!-- resumt -->
            <div class="panel panel-default">
                <div class="panel-heading resume-heading">
                    <div class="row">

                        @include('frontend.events.details.carousel')

                        <div class="col-lg-12">
                            <div class="col-xs-12 col-sm-6">
                                <figure>
                                    <img class="img-circle img-responsive" alt=""
                                        src="http://placehold.it/300x300">
                                </figure>
                                <div class="row">
                                    <div class="col-xs-12 social-btns">
                                        <div class="col-xs-3 col-md-2 col-lg-2 social-btn-holder">
                                            <a href="#" class="btn btn-social btn-block btn-google">
                                                <i class="icon-google"></i> </a>
                                        </div>
                                        <div class="col-xs-3 col-md-2 col-lg-2 social-btn-holder">
                                            <a href="#" class="btn btn-social btn-block btn-facebook">
                                                <i class="icon-facebook"></i> </a>
                                        </div>
                                        <div class="col-xs-3 col-md-2 col-lg-2 social-btn-holder">
                                            <a href="#" class="btn btn-social btn-block btn-twitter">
                                                <i class="icon-twitter"></i> </a>
                                        </div>
                                        <div class="col-xs-3 col-md-2 col-lg-2 social-btn-holder">
                                            <a href="#" class="btn btn-social btn-block btn-linkedin">
                                                <i class="icon-linkedin"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6" style="margin-top: 5%;">
                                <ul class="list-group" style="text-align:center">
                                    <li class="list-group-item">Disco Dandiya Night </li>
                                    <li class="list-group-item">@Catch-Up</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @include('frontend.events.details.click-line')





                <div class="bs-callout bs-callout-danger" style="margin-top: 5%;">
                    <h4>Dates</h4>
                    <table class="table table-striped table-responsive ">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>From</th>
                                <th>Till</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>3rd Oct 2022</td>
                                <td>7:00 P.M.</td>
                                <td> 12:00 Night </td>
                            </tr>
                            <tr>
                                <td>4th Oct 2022</td>
                                <td>7:00 P.M.</td>
                                <td> 12:00 Night </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- resume -->

        @if ($desktop)
            <div class="col-sm-5">

                <table width="100%">
                    <tr>
                        <td>
                            <h1 class="sm-text-lg all-font-roboto"
                                style="font-weight: 700; line-height: 100%; margin: 0; margin-bottom: 4px; font-size: 24px;">
                                Booking Details for October</h1>
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

                    <div class=" row">
                        <div class="col-md-12 col-xs-12" style="font-weight: 600; padding-bottom: 10px;">
                            <input class="form-control form-control-sm quantity" style="color: #a0aec0; width:100%;"
                                type="text" name="name" placeholder="Name" id="name"
                                onfocus="this.placeholder=''" onblur="this.placeholder='Name'" required>
                        </div>
                        <div class="col-md-12 col-xs-12" style="font-weight: 600; padding-bottom: 10px;">
                            <input class="form-control form-control-sm quantity" style="color: #a0aec0; width:100%;"
                                type="number" name="mobile" placeholder="Mobile No." id="mobile"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone no'" required>
                        </div>
                        <div class="col-md-12 col-xs-12" style="font-weight: 600; padding-bottom: 10px;">
                            <input class="form-control form-control-sm quantity" style="color: #a0aec0; width:100%;"
                                type="email" name="email" placeholder="Email address." id="email"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required>

                        </div>

                    </div>

                    <div class="col-md-6 col-xs-6" style="font-weight: 600; padding-bottom: 10px;">

                        <div class="row">
                            <!-- <div class="col-md-4 col-xs-4"><label style="font-size: 12px;font-weight: bold;padding:10px;">For Date</label></div> -->
                            <div class="col-md-6 col-xs-12">
                                <label>
                                    <input type="radio" checked name="date" value="3">
                                    <div class="btn btn-sık"><span>3rd</span></div>
                                </label>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <label>
                                    <input type="radio" name="date" value="4">
                                    <div class="btn btn-sık"><span>4th</span></div>
                                </label>
                            </div>
                        </div>

                    </div>

                    @if (isset($event_tickets))
                        <table class="table table-sm" style="font-size: 14px; margin-top: 20px;">
                            @forelse($event_tickets as $ticket)
                                <tr class="event-ticket-row" event-ticket-id="{{ $ticket->id }}">
                                    <td>
                                        <p class="all-font-roboto"
                                            style="font-weight: 600; margin: 0; color: #000000;">
                                            {{ $ticket->name }}
                                        </p>
                                        <p class="all-font-roboto"
                                            style="margin: 0; margin-bottom: 4px; color: #a0aec0; font-size: 10px; text-transform: uppercase;">
                                            {{ $ticket->description }}
                                        </p>
                                    </td>
                                    <td width="2%" nowrap class="text-right"
                                        style="vertical-align:middle; font-family: Menlo, Consolas, monospace; font-weight: 600; color: #063765; letter-spacing: -1px;">
                                        ₹{{ $ticket->price }} x </td>
                                    <td width="3%" nowrap style="vertical-align:middle">
                                        <input class="form-control form-control-sm quantity"
                                            style="min-width: 100px; color: #a0aec0;" type="number"
                                            name="items[{{ $ticket->id }}][quantity]" value="" min="0"
                                            max="20" maxlength="2">
                                        <input type="hidden" name="items[{{ $ticket->id }}][event_ticket_id]"
                                            value="{{ $ticket->id }}">
                                        <input type="hidden" class="form-control rate" value="{{ $ticket->price }}">
                                    </td>
                                    {{-- <td style="vertical-align: middle">
                                            {{ $ticket->persons }} <i class="icon-user2 text-primary"></i>
                                        </td> --}}
                                    <td width="1%" nowrap class="text-right d-none"
                                        style="vertical-align:middle;min-width:100px; color: #68d391">
                                        ₹<span class="price"></span>
                                    </td>


                                </tr>
                            @empty
                                <p>No users</p>
                            @endforelse
                        </table>
                    @endif

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Pay <span
                                id="button-price">₹0</span></button>
                    </div>


                </form>


            </div>
        @endif


    </div>

</div>
