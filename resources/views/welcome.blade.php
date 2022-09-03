@extends('frontend.index')

@section('content')

    @include('frontend.header')
    @include('frontend.landing.slider')
    @include('frontend.landing.performer')
    @include('frontend.landing.about')
    @include('frontend.landing.program-details')
    @include('frontend.landing.map')
    @include('frontend.landing.brand')
    @include('frontend.footer')

@endsection