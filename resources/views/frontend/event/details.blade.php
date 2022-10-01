@extends('frontend.layouts.default')

@section('content')
    <section class="py-4 pt-0">

        <!-- Mobile Slider--->
        <div class="">
            @if ((new \Jenssegers\Agent\Agent())->isMobile())
                <div id="main-carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @for ($n = 0; $n < 1; $n++)
                            <div class="carousel-item active">
                                <img src="{{ url($event->cover_image) }}" class="w-100" />
                            </div>
                        @endfor
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#main-carousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#main-carousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            @endif
        </div>
        <!--- END Corasel --->
        <div class="container">
            <div class="row">
                <!----- left panel--->
                <div class="col-md-8">
                    <div class="pt-4">
                        <!--- Desktop Slider -->
                        <div class="">
                            @if ((new \Jenssegers\Agent\Agent())->isDesktop())
                                <div id="main-carousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @for ($n = 0; $n < 1; $n++)
                                            <div class="carousel-item active">
                                                <img src="{{ url($event->cover_image) }}" class="w-100" />
                                            </div>
                                        @endfor
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#main-carousel"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#main-carousel"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <!---- End Slider --->



                        <div class=" d-none">
                            @for ($n = 0; $n < 3; $n++)
                                <span class="badge rounded-pill bg-info fs-6 fw-normal">Secondary</span>
                            @endfor
                        </div>

                        <!-- Mobile Quick view -->
                        <div>
                            @if ((new \Jenssegers\Agent\Agent())->isMobile())
                                <div class="">
                                    <div class="pb-4 pb-3">
                                        <div class="d-flex">
                                            <h4 class="flex-grow-1">{{ $event->name }}</h4>
                                            <div class="d-none">
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-heart"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="pb-2 pt-2 d-flex">
                                            <div><i class="fas fa-bookmark"></i></div>
                                            <div class="flex-grow-1 ps-3">Music</div>
                                        </div>

                                        <div class="pb-2 d-flex">
                                            <div><i class="fas fa-calendar"></i></div>
                                            <div class="flex-grow-1 ps-3">September 24 | 5PM</div>
                                        </div>

                                        <div class="d-flex">
                                            <div><i class="fa-solid fa-location-dot"></i></div>
                                            <div class="flex-grow-1 ps-3">{{ $venue->name }}, {{ $venue->location }}</div>
                                        </div>
                                    </div>

                                    <div class="py-2 bg-light text-info">
                                        <div class="d-flex">
                                            <div><i class="fa-solid fa-shoe-prints"></i></div>
                                            <div class="flex-grow-1 ps-3">Step out and enjoy this event</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <h5>Event Guide</h5>
                                    <div class="d-flex">
                                        <div class="fs-3 text-secondary"><i class="fa-solid fa-person-walking"></i></div>
                                        <div class="flex-grow-1 ps-4">
                                            <small class="text-muted mb-0 d-flex">For Age</small>
                                            <span>{{ $event->min_age }}+</span>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-3">
                                        <div class="fs-3 text-secondary"><i class="fa-solid fa-globe"></i></div>
                                        <div class="flex-grow-1 ps-4">
                                            <small class="text-muted mb-0 d-flex">Language</small>
                                            <span>{{ $event->language }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-3">
                                        <div class="fs-3 text-secondary"><i class="fa-solid fa-microphone-lines"></i></div>
                                        <div class="flex-grow-1 ps-4">
                                            <small class="text-muted mb-0 d-flex">Live Performance</small>
                                            <span>Enjoy a unique experience</span>
                                        </div>
                                    </div>

                                </div>
                            @endif
                        </div>
                        <!-- End Mobile Quick view-->

                        <div class="mt-5">
                            <h4>Description</h4>
                            {!! $event->description !!}
                        </div>

                        <div class="mt-5">
                            <h4>Artists</h4>

                            @foreach ($artists as $n => $artist)
                                <div class="card card-body mt-5">
                                    <div class="row align-items-end">
                                        <div class="col-auto">
                                            <div style="margin-top: -40px;">
                                                <img src="{{ url($artist->image != '' ? $artist->image : 'images/singer.png') }}"
                                                    class="rounded border bg-primary" width="80px" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <strong>{{ $artist->name }}</strong>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p class="mb-0">{{ $artist->excerpt }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-5">
                            <h4>Terms & Conditions</h4>
                            {!! $event->terms !!}
                        </div>
                    </div>

                </div>


                @if ((new \Jenssegers\Agent\Agent())->isDesktop())
                    <!-- Right Panel -->
                    <div class="col-md-4">
                        <div class="sticky-top pt-4">
                            <div class="card">
                                <div class="p-4 pb-3">
                                    <div class="d-flex">
                                        <h4 class="flex-grow-1">{{ $event->name }}</h4>
                                        <div class="d-none">
                                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-heart"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="pb-2 pt-2 d-flex">
                                        <div><i class="fas fa-bookmark"></i></div>
                                        <div class="flex-grow-1 ps-3">Music</div>
                                    </div>

                                    <div class="pb-2 d-flex">
                                        <div><i class="fas fa-calendar"></i></div>
                                        <div class="flex-grow-1 ps-3">
                                            {{ \Carbon\Carbon::parse($event_tickets[0]->start_datetime)->format('d/m/Y | h:i A') }}
                                            Onwards</div>
                                    </div>

                                    <div class="d-flex">
                                        <div><i class="fa-solid fa-location-dot"></i></div>
                                        <div class="flex-grow-1 ps-3">{{ $venue->name }}, {{ $venue->location }}</div>
                                    </div>
                                </div>

                                <div class="px-4 py-2 bg-light text-info">
                                    <div class="d-flex">
                                        <div><i class="fa-solid fa-shoe-prints"></i></div>
                                        <div class="flex-grow-1 ps-3">Step out and enjoy this event</div>
                                    </div>
                                </div>

                                <div class="p-4 pt-3 d-flex">
                                    <div class="fs-4"><i class="fas fa-wallet"></i> </div>
                                    <div class="flex-grow-1 ps-3 fs-4 fw-bold">@money($event_tickets[0]->price)</div>
                                    <div>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">Book Now</button>
                                    </div>

                                </div>
                            </div>

                            <div class="card mt-4 card-body">
                                <h5>Event Guide</h5>
                                <hr />
                                <div class="d-flex">
                                    <div class="fs-3 text-secondary"><i class="fa-solid fa-person-walking"></i></div>
                                    <div class="flex-grow-1 ps-4">
                                        <small class="text-muted mb-0 d-flex">For Age</small>
                                        <span>{{ $event->min_age }}+</span>
                                    </div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="fs-3 text-secondary"><i class="fa-solid fa-globe"></i></div>
                                    <div class="flex-grow-1 ps-4">
                                        <small class="text-muted mb-0 d-flex">Language</small>
                                        <span>{{ $event->language }}</span>
                                    </div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="fs-3 text-secondary"><i class="fa-solid fa-microphone-lines"></i></div>
                                    <div class="flex-grow-1 ps-4">
                                        <small class="text-muted mb-0 d-flex">Live Performance</small>
                                        <span>Enjoy a unique experience</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                @endif

            </div>
        </div>
    </section>

    @if ((new \Jenssegers\Agent\Agent())->isMobile())
        <!--- Bottom Ribbon -->
        <div class="position-fixed bottom-0 start-0 w-100 bg-white border-top border-grey p-4 py-2 d-flex">
            <div class="fs-4"><i class="fas fa-wallet"></i> </div>
            <div class="flex-grow-1 ps-3 fs-4 fw-bold">
                @money($event_tickets[0]->price)
            </div>
            <div>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Book
                    Now</button>
            </div>
        </div>
        <!--- Bottom Ribbon End --->
    @endif
    <!------- Booking Modal ---->
    <div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content position-relative  bg-transparent">
                    <div class="modal-body p-0">
                        <div class="row gx-0">
                            <div class="col-md">
                                <div class="bg-white rounded h-100 p-4 border" style="border-style: dashed !important; ">
                                    <div>
                                        <h4 class="mb-0">{{ $event->name }} @ {{ $venue->name }}</h4>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-2"></i>
                                            16th October, 2022 | 04:00 PM Onwards
                                        </small>
                                    </div>
                                    <table class="table table-ms mt-3">
                                        @foreach ($event_tickets as $n => $event_ticket)
                                            <tr data-row="ticket">
                                                <td class="ps-0">
                                                    <h6 class="mb-0">{{ $event_ticket->name }}</h6>
                                                    <small class="text-muted">{{ $event_ticket->description }}</small><br>
                                                    <span class="text-success"> @money($event_ticket->price)</span>
                                                </td>
                                                <td width="1%" class="align-middle">
                                                    <input type="hidden"
                                                        name="items[{{ $n }}][event_ticket_id]"
                                                        value="{{ $event_ticket->id }}" />
                                                    <input type="hidden" value="{{ $event_ticket->price }}"
                                                        data-field="price" />
                                                    <input type="number" class="form-control form-control-sm"
                                                        data-field='quantity' placeholder="Qtde." style="min-width: 80px"
                                                        name="items[{{ $n }}][quantity]" />
                                                </td>
                                                <td class="fs-6 align-middle pe-0 text-nowrap text-end" width="90px"
                                                    data-field="total-price">
                                                    @money(0)
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>



                            <div class="col-md-auto">
                                <div class="bg-white rounded h-100 p-4 border" style="border-style: dashed !important; ">
                                    <table class="table fs-6" style="min-width: 250px">
                                        <tr>
                                            <td class="ps-0 border-bottom-0">Total Quantity</td>
                                            <td class="pe-0 border-bottom-0" id="total-quantity">0</td>
                                        </tr>

                                        <tr>
                                            <td class="ps-0">Total Amount</td>
                                            <td class="pe-0" id="total-amount">@money(0)</td>
                                        </tr>

                                        <tr>
                                            <td class="ps-0 border-bottom-0">Grand Total</td>
                                            <td class="pe-0 border-bottom-0" id="grand-total">@money(0)</td>
                                        </tr>
                                    </table>
                                    <div>
                                        <div class="mb-3">
                                            <input type="text" placeholder="Full name" class="form-control" />
                                        </div>

                                        <div class="mb-3">
                                            <input type="email" placeholder="Email" class="form-control" />
                                        </div>

                                        <div class="mb-3">
                                            <input type="number" placeholder="Phone" class="form-control" />
                                        </div>
                                        <button class="btn btn-primary w-100" type="submit">Checkout</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-default position-absolute top-0 end-0"
                        aria-label="Close" data-bs-dismiss="modal"><i class="fas fa-close"></i></button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function calculateSummery() {
            const total_quantity_el = document.getElementById("total-quantity");
            const total_amount_el = document.getElementById("total-amount");
            const grand_total_el = document.getElementById("grand-total");

            total_quantity_el.innerHTML = (() => {
                let all = 0;
                document.querySelectorAll("[data-field=quantity]").forEach((current) => all += parseInt(current
                    .value));
                return all;
            })();
            total_amount_el.innerHTML = money((() => {
                let all = 0;
                document.querySelectorAll("[data-field=total-price]").forEach((current) => all += parseInt(
                    current.getAttribute("amount")));
                return all;
            })());
            grand_total_el.innerHTML = total_amount_el.innerHTML;
        }
        $(function() {

            document.querySelectorAll("[data-row=ticket]").forEach(_row => {
                const _quantity_field = _row.querySelector("[data-field=quantity]");
                const _price_field = _row.querySelector("[data-field=price]");
                const _total_price_field = _row.querySelector("[data-field=total-price]");

                _quantity_field.addEventListener("keyup", (_evt) => {
                    const _quantity = parseInt(_evt.target.value) < 0 ? 0 : parseInt(_evt.target
                        .value);
                    const _total_price = parseInt(_price_field.value) * parseInt(_quantity) > 0 ?
                        parseInt(_price_field.value) * parseInt(_quantity) : 0;

                    _quantity_field.value = _quantity;
                    _total_price_field.innerHTML = money(_total_price);
                    _total_price_field.setAttribute("amount", _total_price);

                    calculateSummery()
                });
            });
        })
    </script>
@endsection
