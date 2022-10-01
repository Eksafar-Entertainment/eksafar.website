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


    <section class="py-5">
        <div class="container my-5">

            <div class="text-center mb-5">
                <h1>{{ __('Events') }}</h1>
                <h5 style="width: 500px" class="m-auto fw-normal">{{ $faker->text() }}</h5>
            </div>

            <div class="row gx-5 gy-5">
                @for ($n=0; $n<4 ; $n++)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="row">
                                <div class="col-sm-5">
                                    <img src="https://picsum.photos/300/230" class="w-100" />
                                </div>
                                <div class="col-sm-7">
                                    <div class="card-body">
                                        <h4>{{$faker->text(60)}}</h4>
                                        <p class="text-danger mb-0">Wed, Oct 2021, 7:30PM</p>
                                        <small class="text-secondary d-block">Catchup @ Banglore</small>
                                        <a class="text-primary mt-2 d-block">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

    </section>

    <section class="py-5 bg-white">
        <div class="container my-5">

            <div class="text-center mb-5">
                <h1>{{ __('Gallery') }}</h1>
                <h5 style="width: 500px" class="m-auto fw-normal">{{ $faker->text() }}</h5>
            </div>

            <div class="row gx-5 gy-5">
                @foreach ($gallery as $image)
                    <div class="col-md-3">
                        <img src="{{ url('storage/uploads/' . $image->path) }}" class="w-100" />
                    </div>
                @endforeach
            </div>
        </div>

    </section>
@endsection
