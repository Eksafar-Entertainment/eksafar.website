<form action="/payment/razorpay/freeCheckout" method="post" onsubmit="checkForm(event)">
    @csrf
    <input type="hidden" name="event_id" value="{{ $event->id }}" />
    <input type="hidden" name="promoter_id" value="{{ app('request')->input('promoter') }}" />
    <div class="modal-body p-0">
        <div class="row gx-0">
            <div class="col-md">
                <div class="h-100 p-4 ">
                    <div>
                        <h4 class="mb-0">{{ $event->name }} @ {{ $venue->name }}</h4>
                        <small class="text-muted">
                            <i class="fas fa-calendar me-2"></i>
                            {{ \Carbon\Carbon::parse($event->start_date)->format('d-M-Y') }} | 07:00 PM Onwards
                        </small>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-ms mt-3">
                            
                            @foreach ($tickets as $n => $event_ticket)
                                <tr data-row="ticket">
                                    <td width="50%" class="ps-0">
                                        <h6 class="mb-0 text-light">{{ $event_ticket->name }}
                                            <span class="badge bg-danger">
                                                {{ \Carbon\Carbon::parse($event_ticket->start_datetime)->format('d-m-Y') }}
                                            </span>
                                        </h6>
                                        <small class="text-muted">{{ $event_ticket->description }}</small><br />
                                        <span class="text-light"> @money($event_ticket->price)</span>
                                    </td>
                                    <td class="align-middle pe-0 pr-0" width="1%">
                                        <input type="hidden" name="items[{{ $n }}][event_ticket_id]"
                                            value="{{ $event_ticket->id }}" class="" />
                                        <input type="hidden" value="{{ $event_ticket->price }}" data-field="price" />
                                        <div class="input-group" style="width: 100px;transform: scale(0.8)">
                                            <button type="button" class="btn btn-danger btn-number btn-sm"
                                                data-field="minus">
                                                <span class="fa fa-minus"></span>
                                            </button>
                                            <input type="number" class="form-control form-control-sm bare text-center"
                                                data-field='quantity' name="items[{{ $n }}][quantity]"
                                                value="0" @if ($event_ticket->status == 'SOLD') disabled @endif />
                                            <button type="button" class=" btn btn-danger btn-number btn-sm"
                                                data-field="plus">
                                                <span class="fa fa-plus"></span>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="fs-6 align-middle pe-0 text-nowrap text-end text-light d-sm-table-cell d-none"
                                        width="1%" style="min-width: 60px" data-field="total-price">
                                        @if ($event_ticket->status == 'SOLD')
                                            <span class="badge bg-danger"> Sold Out</span>
                                        @else
                                            <span class="text-light">@money(0)</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>



            <div class="col-md-auto">
                <div class="h-100 p-4">
                    <table class="table fs-6" style="min-width: 250px">
                        <tr>
                            <td class="ps-0 border-bottom-0 text-light">Total Quantity</td>
                            <td class="pe-0 border-bottom-0 text-light" id="total-quantity">0</td>
                        </tr>

                        <tr>
                            <td class="ps-0 text-light">Total Amount</td>
                            <td class="pe-0 text-light" id="total-amount">@money(0)</td>
                        </tr>

                        <tr>
                            <td class="ps-0 border-bottom-0 text-light">Grand Total</td>
                            <td class="pe-0 border-bottom-0 text-light" id="grand-total">@money(0)</td>
                        </tr>

                        <tr class="discount-field d-none">
                            <td class="ps-0 border-bottom-0 text-light">Discount Applied</td>
                            <td class="pe-0 border-bottom-0 text-light" id="discount-total">- @money(0)</td>
                        </tr>

                        <tr class="discount-field d-none">
                            <td class="ps-0 border-bottom-0 text-light">Net Total</td>
                            <td class="pe-0 border-bottom-0 text-light" id="net-total">@money(0)</td>
                        </tr>

                    </table>
                    <div>
                        <hr />
                        <!-- Discount Container -->
                        <input type="hidden" name="discount" value="0" />
                        <div id="discount-container" class="input-group mb-3">
                            <input type="text" id="coupon" name="coupon" placeholder="Discount Coupon"
                                class="form-control" />
                            <button class="btn btn-danger" type="button"> Redeem </button>
                        </div>
                        {{-- @guest
                            <div>
                                <hr />
                                <!-- Email Container -->
                                <div id="email-container">
                                    <div class="mb-3">
                                        <input type="email" id="email" name="email" placeholder="Email"
                                            class="form-control" />
                                    </div>
                                    <button class="btn btn-primary w-100" type="button">Continue</button>
                                </div>
                                <!-- login Container -->
                                <div id="login-container" style="display: none">
                                    <div class="mb-3" class="password">
                                        <input type="password" placeholder="Password" name="password"
                                            class="form-control" />
                                    </div>
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" style="color:lightgrey" target="_blank" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    <button class="btn btn-primary w-100" type="button">Login</button>
                                </div>
                                <!-- register Container -->
                                <div id="register-container" style="display: none">
                                    <div class="mb-3" class="name">
                                        <input type="text" placeholder="Full name" class="form-control"
                                            name="name" />
                                    </div>
                                    <div class="mb-3" class="mobile">
                                        <input type="number" placeholder="Phone" name="mobile" class="form-control" />
                                    </div>

                                    <div class="mb-3" class="password">
                                        <input type="password" placeholder="Password" name="password"
                                            class="form-control" />
                                    </div>
                                    <button class="btn btn-primary w-100" type="button">Register</button>
                                </div>
                            </div>
                        @endguest --}}
                        <hr/>
                        <div>
                            <div class="mb-3">
                                <input type="text" placeholder="Full name" class="form-control" name="name" />
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text text-dark" id="basic-addon1">+91</span>
                                <input type="number" placeholder="Phone" name="mobile" class="form-control" />
                            </div>

                            <div class="mb-3">
                                <input type="email" placeholder="Email" name="email" class="form-control" />
                            </div>

                            <button class="btn btn-primary w-100" id="checkout" type="submit">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-link position-absolute top-0 end-0 text-light" aria-label="Close"
        data-bs-dismiss="modal"><i class="fas fa-close"></i></button>
</form>


