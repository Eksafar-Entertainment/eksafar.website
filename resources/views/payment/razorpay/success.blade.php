@extends('frontend.index')
@section('content')
    @include('frontend.header')
    <div class="container" style="margin-top: 50px; margin-bottom:50px">
        <article class="text-center">
            <img src="{{ url('/images/check-mark-verified.gif') }}" style="width: 120px" />
            <h3 style="margin: 10px 0;">Your reservation is processed.</h3>
            <p>Your ticket order has been handled. Once payment has been received, the ticket has been delivered to {{$order->email}}.</p>
            <div style="width:300px; border-radius: 8px; background-color:#e5e5e5;padding: 10px 15px; margin: auto">
                <small>
                    #Order Id: <span class="text-success">{{ $order->id }}</span>
                </small>
            </div>
        </article>
    </div>
    @include('frontend.footer')
