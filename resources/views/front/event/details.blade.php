@extends('front.layouts.default')

@section('head')
    <style>
        .soldout {
            opacity: 0.5;
            color: BLACK;
            position: absolute;
            text-align: center;
            width: 100%;
            height: 100%;
        }
    </style>
    <title>{{ $event->name }}</title>
@endsection

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
                                                <img src="{{ url($event->cover_image) }}" class="w-100 rounded" />
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
                                            <div class="flex-grow-1 ps-3">
                                                {{ \Carbon\Carbon::parse($event_tickets[0]->start_datetime)->format('d-M-Y') }}
                                                | 07:00 PM Onwards
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <div><i class="fa-solid fa-location-dot"></i></div>
                                            <div class="flex-grow-1 ps-3">{{ $venue->name }}, {{ $venue->location }}</div>
                                        </div>
                                    </div>

                                    <div class="py-2 px-2 text-info" style="background-color: rgba(0,0,0.03)">
                                        <div class="d-flex">
                                            <div><i class="fa-solid fa-shoe-prints"></i></div>
                                            <div class="flex-grow-1 ps-3">Step out and enjoy this event</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <h5>Event Guide</h5>
                                    <div class="d-flex">
                                        <div class="fs-3 text-secondary" style="width: 20px"><i
                                                class="fa-solid fa-person-walking"></i></div>
                                        <div class="flex-grow-1 ps-4">
                                            <small class="text-muted mb-0 d-flex">For Age</small>
                                            <span>{{ $event->min_age }}+</span>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-3">
                                        <div class="fs-3 text-secondary" style="width: 20px"><i
                                                class="fa-solid fa-language"></i></div>
                                        <div class="flex-grow-1 ps-4">
                                            <small class="text-muted mb-0 d-flex">Language</small>
                                            <span>{{ $event->language }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-3">
                                        <div class="fs-3 text-secondary" style="width: 20px"><i
                                                class="fa-solid fa-microphone-lines"></i></div>
                                        <div class="flex-grow-1 ps-4">
                                            <small class="text-muted mb-0 d-flex">Live Performance</small>
                                            <span>Enjoy a unique experience</span>
                                        </div>
                                    </div>

                                </div>

                                <div class="px-1 mt-5">
                                    <div class="card overflow-hidden">
                                        <iframe class="w-100" style="filter: invert(90%) hue-rotate(180deg)"
                                        src="https://maps.google.com/maps?q=12.9125613,77.6318928&hl=es&z=14&amp;output=embed"
                                            {{-- src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.924370889854!2d77.63082841526439!3d12.912582290894669!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae152ecf404d0f%3A0x57cc9839f5589dee!2sCatch%20Up%20Bangalore!5e0!3m2!1sen!2sin!4v1671526347987!5m2!1sen!2sin" --}}
                                            height="200"></iframe>
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
                                                    class="rounded border bg-primary" width="80px" height="80px"
                                                    style="object-fit: cover" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h5 class="mb-0">{{ $artist->name }}</h5>
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

                                @if ($event->status == 'CLOSED')
                                    <div class="soldout"
                                        style="background-image:url({{ asset('images/soldout.png') }}); background-size:cover; background-position:center;">
                                    </div>
                                @endif

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
                                            {{ \Carbon\Carbon::parse($event_tickets[0]->start_datetime)->format('d-M-Y') }}
                                            | 07:00 PM Onwards
                                        </div>
                                    </div>

                                    <div class="d-flex">
                                        <div><i class="fa-solid fa-location-dot"></i></div>
                                        <div class="flex-grow-1 ps-3">{{ $venue->name }}, {{ $venue->location }}</div>
                                    </div>
                                </div>

                                <div class="px-4 py-2 text-info" style="background-color: rgba(0,0,0.03)">
                                    <div class="d-flex">
                                        <div><i class="fa-solid fa-shoe-prints"></i></div>
                                        <div class="flex-grow-1 ps-3">Step out and enjoy this event</div>
                                    </div>
                                </div>

                                <div class="p-4 pt-3 d-flex">
                                    <div class="fs-4"><i class="fas fa-wallet"></i> </div>
                                    <div class="flex-grow-1 ps-3">
                                        <span class="fs-4 fw-bold">@money($event_tickets[0]->price)</span>
                                        <span>Onwards</span>
                                    </div>
                                    <div>
                                        @if ($event->status == 'CREATED')
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">Book Now</button>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="card overflow-hidden">
                                <iframe class="w-100" style="filter: invert(90%) hue-rotate(180deg)"
                                src="https://maps.google.com/maps?q=12.9125613,77.6318928&hl=es&z=14&amp;output=embed"
                                    {{-- src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.924370889854!2d77.63082841526439!3d12.912582290894669!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae152ecf404d0f%3A0x57cc9839f5589dee!2sCatch%20Up%20Bangalore!5e0!3m2!1sen!2sin!4v1671526347987!5m2!1sen!2sin" --}}
                                    height="200"></iframe>
                            </div>

                            <div class="card mt-4 card-body">
                                <h5>Event Guide</h5>
                                <hr />
                                <div class="d-flex">
                                    <div class="fs-3 text-secondary" style="width: 20px"><i
                                            class="fa-solid fa-person-walking"></i></div>
                                    <div class="flex-grow-1 ps-4">
                                        <small class="text-muted mb-0 d-flex">For Age</small>
                                        <span>{{ $event->min_age }}+</span>
                                    </div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="fs-3 text-secondary" style="width: 20px"><i
                                            class="fa-solid fa-language"></i></div>
                                    <div class="flex-grow-1 ps-4">
                                        <small class="text-muted mb-0 d-flex">Language</small>
                                        <span>{{ $event->language }}</span>
                                    </div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="fs-3 text-secondary" style="width: 20px"><i
                                            class="fa-solid fa-microphone-lines"></i></div>
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
        <div class="position-fixed bottom-0 start-0 w-100 bg-dark p-3" id="ticket" style="width: 100%; z-index:5">

            <div class="d-flex ">
                <div class="fs-4"><i class="fas fa-wallet"></i> </div>
                <div class="flex-grow-1 ps-3 initial">
                    <span class="fs-4 fw-bold">@money($event_tickets[0]->price)</span>
                    <span>Onwards</span>
                </div>
                <div class="book-amount">

                </div>
                <div>
                    <div class="initial">
                        @if ($event->status == 'CREATED')
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Book Now</button>
                        @else
                            <button type="button" class="btn btn-danger btn-sm" disabled="true">Sold Out</button>
                        @endif
                    </div>
                    <div class="book-amount">

                    </div>
                </div>
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
                <div class="modal-content position-relative ticket rounded" id="ticket">
                    <div class="ticket__box rounded">
                        <x-front.booking-form :event="$event" :venue="$venue" :tickets="$event_tickets" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    @include('front.event.upcomming')

    
    
@endsection
