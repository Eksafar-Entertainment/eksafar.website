@extends('front.layouts.default')
@section('head')
    <title>Payment Processed</title>
@endsection
@section('content')
    <div class="container my-5">
        <article class="text-center">
            <img src="{{ url('/images/check-mark-verified.gif') }}" style="width: 120px" />
            <h3 style="margin: 10px 0;">Your reservation is processed.</h3>
            <p>Your ticket order has been handled. Once payment has been received, the ticket has been delivered to
                {{ $order->email }}.</p>
            <div style="width:300px; border-radius: 8px; background-color:#e5e5e5;padding: 10px 15px; margin: auto">
                <small>
                    #Order Id: <span class="text-success">{{ $order->id }}</span>
                </small>
            </div>
        </article>
    </div>
@endsection
