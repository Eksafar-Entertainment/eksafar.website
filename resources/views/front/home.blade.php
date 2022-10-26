@extends('front.layouts.default')

@section('head')
<title>Eksafar Club</title>
@endsection

@section('content')
    <!-- Slider--->
    <div class="">

        <div id="main-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($banners as $banner)
                    <div class="carousel-item active" style="background-image: url({{ route('resources:images', [ 'src' => $banner->image,'width'=>1080])}})">
                        <div style="backdrop-filter: blur(20px)">
                            <a href="{{ $banner->url }}">
                                <img src="{{ url($banner->image) }}" class="w-100"
                                    style="height: 500px; object-fit:contain; object-position:center" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#main-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#main-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div>


    <section class="py-5 border-top border-bottom">
        <div class="container my-5">

            <div class="text-center mb-5">
                <h1>{{ __('Events') }}</h1>
                <h5 style="max-width: 500px" class="m-auto fw-normal">Checkout The best upcomming events in your city that
                    you won't want to miss...</h5>
            </div>

            <div class="row gx-5 gy-5">
                @foreach ($events as $event)
                    <div class="col-md-6">
                        <div class="card">

                            <div>
                                <a class="" href="{{ url('/event/' . $event->slug) }}">
                                    <div class="w-100 position-relative card border-0 overflow-hidden"
                                        style="background-image:url('{{ route('resources:images', [
                                            'src' => $event->cover_image,
                                            'size'=>"lg"
                                            ]) }}'); padding-top: 70%; background-size:cover; background-position:center;">
                                        @if($event->status==="CLOSED")
                                            <div class="position-absolute badge bg-danger" style="right:-23px; top:20px; transform:rotate(45deg); padding-left:20px; padding-right:20px">COMPLETED</div>
                                        @endif
                                        <div class="position-absolute top-0 start-0 w-100 h-100"
                                            style="background: linear-gradient(180deg, rgba(0,0,0,0) 54%, rgba(0,0,0,0.7) 83%);  ">
                                        </div>

                                        <div class="position-absolute bottom-0 start-0 card-body text-light  w-100">

                                            <h4>{{ $event->name }}</h4>
                                            <p class=" mb-0">
                                                {{ \Carbon\Carbon::parse($event->start_date)->format('d-m-Y') }} onwards |
                                                Catchup @ Banglore</p>


                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>

    <section class="py-5 bg-white">
        <div class="container my-5">

            <div class="text-center mb-5">
                <h1>{{ __('Gallery') }}</h1>
                <h5 style="max-width: 500px" class="m-auto fw-normal">Checkout the Gallery for the past events that have
                    conducted in your city.</h5>
            </div>

            <div class="row gx-5 gy-5">
                @foreach ($gallery as $image)
                    <div class="col-md-3">
                        <div class="border"
                            style="padding-top: 100%; background-size:cover; background-image: url(' {{ route('resources:images', [ 'src' => 'storage/uploads/' . $image->path,'size'=>"md"])}}')">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>
@endsection
