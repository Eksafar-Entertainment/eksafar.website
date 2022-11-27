@extends('front.layouts.default')

@section('head')
    <title>Eksafar Club</title>
@endsection

@section('content')
    <!-- Video slider --->
    <section id="banner-video">

        <video style="" autoplay loop muted>
            <source src="{{ url('/videos/banner.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="caption p-5 transparent-gradient-blur border">
            <p>People of Tomorrow,</p>

            <p>In 2023 you will witness the rise of a magnificent tale in the history of Tomorrowland's Great Library. Our
                destination lies high on the horizon. Prepare yourself for a beautiful adventure on July 21 & - 23 and July
                28 - 30.</p>

            <p>Pre-Registration starts on December 7 on adscendo.tomorrowland.com.</p>
        </div>
        <script>
            document.querySelector("#banner-video video")?.play();
        </script>

        <style>
            #banner-video {
                height: calc(100vh - 100px);
                width: 100vw;
                position: relative
            }

            #banner-video video {
                object-fit: cover;
                height: 100%;
                width: 100%
            }

            #banner-video::after {
                content: "";
                position: absolute;
                height: 100%;
                width: 100%;
                top: 0;
                left: 0;
                background-image: linear-gradient(rgba(0,0,0,.1),#111);
            }
            #banner-video .caption{
                position: absolute;
                max-width: 600px;
                bottom: 25px;
                left: 50%;
                transform: translateX(-50%);
                background-color: rgba(0,0,0,.3);
                z-index: 3;
            }
        </style>

    </section>
    <!-- Slider--->
    {{-- <section class="">
        <div class="owl-carousel owl-theme" id="main-carousel">
            @foreach ($banners as $banner)
                <div class="item">
                    <a href="{{ $banner->url }}" class="item-container">
                        <img src="{{ url($banner->image) }}" />
                    </a>
                </div>
            @endforeach
        </div>

        <script>
            $('#main-carousel').owlCarousel({
                responsive: {
                    0: {
                        margin: 0,
                        loop: false,
                        autoWidth: false,
                        items: 1,
                        center: true,
                        autoHeight: true
                    },
                    768: {
                        margin: 0,
                        loop: true,
                        autoWidth: true,
                        //items: 4,
                        center: true,
                        autoHeight: false,
                        animateOut: "fadeOut",
                        animateIn: "fadeIn",
                    }
                }
            })
        </script>
    </section> --}}
    <section class="py-5">
        <div class="container">
            <h3 class="text-center mb-4">Events</h3>
            <div class="owl-carousel owl-theme" id="gallery-carousel">
                @foreach ($banners as $banner)
                    <div class="item">
                        <div class="item-container">
                            <img src="{{ url($banner->image) }}" />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#gallery-carousel').owlCarousel({
                    loop: true,
                    margin: 15,
                    nav: true,
                    center: true,
                    autoplay: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        1000: {
                            items: 3
                        }
                    }
                })
            })
        </script>
    </section>


   {{-- @include('front.index-page.event-list') --}}
    <section class="py-5">
        <div class="container my-5">

            <div class="text-center mb-5">
                <h1>{{ __('Events') }}</h1>
                <h5 style="max-width: 500px" class="m-auto fw-normal">Checkout The best upcomming events in your city that
                    you won't want to miss...</h5>
            </div>

            <div class="row gx-5 gy-5 justify-content-center">
                @foreach ($events as $event)
                    <div class="col-md-4">
                        <div class="card card-01">

                            <div class="card-img-caption">
                                <a class="" href="{{ url('/event/' . $event->slug) }}">
                                    <div class="w-100 position-relative overflow-hidden"
                                        style="background-image:linear-gradient(0deg, rgba(255, 0, 150, 0.3), rgba(255, 0, 150, 0.3)), url('{{$event->cover_image}}'); padding-top: 80%; background-size:cover; background-position:center;">
                                        @if ($event->status === 'CLOSED')
                                            <div class="position-absolute badge bg-danger"
                                                style="right:-23px; top:20px; transform:rotate(45deg); padding-left:20px; padding-right:20px">
                                                COMPLETED</div>
                                        @endif
                                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-end text-white ps-3"
                                            style="background: linear-gradient(180deg, rgba(0,0,0,0.3) 54%, #333333);">
                                            <h4 class="mb-1">{{ $event->name }}</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="card-img-overlay text-center">
                              <h2 class="card-title" style="margin-top: 10%;">{{ $event->name }}</h2>
                              <p class="card-text">{!! Str::limit("$event->description", 90, ' ...') !!}</p>

                              <span class="date-glow">@if ($event->status === 'CLOSED') COMPLETED @else {{ \Carbon\Carbon::parse($event->start_date)->format('D d M,Y') }} @endif</span><br />
                              <span>@ {{ $event->venue_name }}</span>
                            </div>
                        </div>

                        <div class="mb-20" style="margin-top: -20%;">

                            <div class="text-center" >
                                <a class="btn btn-light fw-lighter" href="{{ url('/event/' . $event->slug) }}"> More Info > </a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>

    <section
        style="background-image: url(https://picsum.photos/1080/720?id=1);background-size: cover;background-position: center;background-attachment: fixed;">
        <div class="transparent-gradient-blur py-5 border-top border-bottom">
            <div class="container my-5">

                <div class="text-center mb-5">
                    <h1>{{ __('Gallery') }}</h1>
                    <h5 style="max-width: 500px" class="m-auto fw-normal">Checkout the Gallery for the past events that have
                        conducted in your city.</h5>
                </div>

                <div class="row gx-5 gy-5">
                    @foreach ($gallery as $image)
                        <div class="col-md-4">
                            <div class="border "
                                style="padding-top: 75%; background-size:cover; background-image: url(' {{ route('resources:images', ['src' => 'storage/uploads/' . $image->path, 'size' => 'md']) }}')">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
