@extends('front.layouts.default')
@section('head')
    <title>Gallery</title>
@endsection
@section('content')
    <div>
        <div class="container my-5">

            <div class="text-center mb-5">
                <h1>{{ __('Gallery') }}</h1>
                {{-- <h5 style="max-width: 500px" class="m-auto fw-normal"></h5> --}}
            </div>

            <div class="row gx-5 gy-5">
                @foreach ($gallery as $image)
                    <div class="col-md-3">
                        <div class="border"
                            style="padding-top: 100%; background-size:cover; background-image: url('{{ route('resources:images', [ 'src' => 'storage/uploads/' . $image->path,'size'=>"md"])}}')">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-2 text-end">
            @include('admin.common.pagination', ['paginator' => $gallery])
        </div>
    </div>
@endsection
