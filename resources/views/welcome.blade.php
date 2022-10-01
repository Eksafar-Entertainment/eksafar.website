@extends('frontend.layouts.default')

@section('content')
    <!-- Slider--->
    <div class="">

        <div id="main-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @for ($n = 0; $n < 3; $n++)
                    <div class="carousel-item active">
                        <img src="https://picsum.photos/1080/580" class="w-100" style="height: 450px; object-fit:cover" />
                    </div>
                @endfor
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
                                <div class="w-100 position-relative card"
                                    style="background-image:url('https://picsum.photos/300/230'); padding-top: 50%; background-size:cover; background-position:center">
                                    <div class="position-absolute top-0 start-0 w-100 h-100"
                                        style="background: linear-gradient(180deg, rgba(0,0,0,0) 54%, rgba(0,0,0,0.7) 83%);">
                                    </div>
                                    <div class="position-absolute bottom-0 start-0 card-body text-light d-flex w-100 align-items-center">
                                        <div class="flex-grow-1">
                                            <h4>{{ $event->name }}</h4>
                                            <p class=" mb-0">Wed, Oct 2021, 7:30PM | Catchup @ Banglore</p>
                                        </div>
                                        <div>
                                            <a class="btn btn-sm btn-secondary" href="{{ url('/event/' . $event->slug) }}">Read
                                                More</a>
                                        </div>
                                    </div>
                                </div>
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
