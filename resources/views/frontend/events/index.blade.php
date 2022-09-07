@extends('frontend.index')

@section('content')

    @include('frontend.top-bar')
    @include('frontend.header')
    @include('frontend.events.types')
    @include('frontend.newsletter')
    @include('frontend.footer')

@endsection