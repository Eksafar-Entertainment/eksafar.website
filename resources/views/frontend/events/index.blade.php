@extends('frontend.index')

@section('content')

    @include('frontend.events.top-bar')
    @include('frontend.header')
    @include('frontend.events.types')
    @include('frontend.newsletter')
    @include('frontend.footer')

@endsection