@extends('frontend.layouts.default')

@section('content')
    <!-- Mobile Slider--->
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

            <div class="text-center mb-3">
                <h1>{{ __('Gallery') }}</h1>
                <h5 style="width: 500px" class="m-auto">{{ $faker->text() }}</h5>
            </div>

            <div class="row mt-5 gx-5 gy-5">

                @foreach ($gallery as $image)
                    <div class="col-md-3">
                        <img src="{{ url('storage/uploads/' . $image->path) }}" class="w-100" />
                    </div>
                @endforeach
            </div>
        </div>

    </section>
@endsection
