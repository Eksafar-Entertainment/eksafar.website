@extends('frontend.main.index')

@section('content')

    @include('frontend.main.header')
    @include('frontend.main.trending')
    @include('frontend.main.area')
    @include('frontend.main.intro')
    @include('frontend.main.video')
    @include('frontend.main.top')
    @include('frontend.main.footer')

   {{-- @include('frontend.top-bar') --}} 
   {{-- @include('frontend.header') --}} 
   {{-- @include('frontend.landing.slider') --}} 
   {{-- @include('frontend.landing.gallery') --}} 
   {{-- @include('frontend.newsletter') --}} 
   {{-- @include('frontend.footer') --}} 

@endsection