@extends('front.layouts.default')

@section('head')
    <title>Eksafar Club</title>
@endsection

@section('content')
    <!-- Slider--->
    <section class="">
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
    </section>
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


    @include('front.index-page.event-list')
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
                        <div class="card">

                            <div>
                                <a class="" href="{{ url('/event/' . $event->slug) }}">
                                    <div class="w-100 position-relative overflow-hidden"
                                        style="background-image:url('{{ route('resources:images', [
                                            'src' => $event->cover_image,
                                            'size' => 'lg',
                                        ]) }}'); padding-top: 80%; background-size:cover; background-position:center;">
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
                            <div class="card-body pt-0">
                                <span
                                    class="text-danger">{{ \Carbon\Carbon::parse($event->start_date)->format('D d M,Y') }}</span><br />
                                <span>{{ $event->venue_name }}</span>
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
