@extends('front.layouts.default')
@section('head')
    <title>Payment Processed</title>
@endsection
@section('content')
    <div class="container my-5 py-5">
        <article class="text-center m-auto" style="max-width: 600px;">
            <h1 class="display-1">
                @if($status === "FAILED")
                <i class="fa-solid fa-circle-exclamation text-danger"></i>
                @elseif($status === "SUCCESS")
                <i class="fa-solid fa-circle-check text-success"></i>
                @elseif($status === "PENDING")
                <i class="fa-solid fa-triangle-exclamation text-warning"></i>
                @endif      
            </h1>
            <h3 style="margin: 10px 0;">
                @if($status === "FAILED")
                Your reservation is failed.
                @elseif($status === "SUCCESS")
                Your reservation is processed.
                @elseif($status === "PENDING")
                Your reservation is processed.
                @endif
            </h3>
            <p>
                @if($status === "FAILED")
                Your ticket order has been is failed 
                @elseif($status === "SUCCESS")
                Your ticket order has been handled. Once payment has been received, the ticket has been delivered to <a href="">{{ $order->email }}</a>.
                @elseif($status === "PENDING")
                Your ticket order has been handled. Once payment has been received, the ticket has been delivered to <a href="">{{ $order->email }}</a>.
                @endif
                
            </p>
            <div>
                <kbd>
                    Order Id: #{{ $order->id }}
                </kdb>
            </div>
        </article>
    </div>
@endsection
