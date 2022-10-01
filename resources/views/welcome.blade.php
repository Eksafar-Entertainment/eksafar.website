@extends('frontend.layouts.default')

@section('content')
    <!-- Slider--->
    <div class="">

        <div id="main-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($banners as $banner)
                    <div class="carousel-item active">
                        <img src="{{$banner->image!=""?url($banner->image):'https://cdn.evbstatic.com/s3-build/fe/build/images/6aaf4a36e35b1b71bc077e200ac7429c-1_tablet_1067x470.jpg'}}" class="w-100" 
                        style="height: 450px; object-fit:cover; object-position:center" />
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
                <h5 style="max-width: 500px" class="m-auto fw-normal">{{ $faker->text() }}</h5>
            </div>

            <div class="row gx-5 gy-5">
                @foreach ($events as $event)
                    <div class="col-md-6">
                        <div class="card">

                            <div>
                                <a class="" href="{{ url('/event/' . $event->slug) }}">
                                <div class="w-100 position-relative card border-0"
                                    style="background-image:url('{{url($event->cover_image)}}'); padding-top: 70%; background-size:cover; background-position:center;">
                                    
                                    <div class="position-absolute top-0 start-0 w-100 h-100"
                                        style="background: linear-gradient(180deg, rgba(0,0,0,0) 54%, rgba(0,0,0,0.7) 83%);  ">
                                    </div>
                                 
                                    <div class="position-absolute bottom-0 start-0 card-body text-light  w-100">
                                     
                                            <h4>{{ $event->name }}</h4>
                                            <p class=" mb-0">
                                                {{ \Carbon\Carbon::parse($event->start_date)->format("d-m-Y") }} onwards | Catchup @ Banglore</p>
                                       
                                       
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
                <h5 style="max-width: 500px" class="m-auto fw-normal">{{ $faker->text() }}</h5>
            </div>

            <div class="row gx-5 gy-5">
                @foreach ($gallery as $image)
                    <div class="col-md-3">
                        <div class="border"
                            style="padding-top: 100%; background-size:cover; background-image: url('{{ url('storage/uploads/' . $image->path) }}')">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>
@endsection
