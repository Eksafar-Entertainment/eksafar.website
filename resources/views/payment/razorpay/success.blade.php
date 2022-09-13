@extends('frontend.index')
@section('content')
@include('frontend.header')
<div class="container" style="margin-top: 50px; margin-bottom:50px">
  <article class="text-center">
    <img src="{{url('/images/check-mark-verified.gif')}}" style="width: 120px" />
    <h3 style="margin: 10px 0;">Booking Successful</h3>
    <p>Your ticket booking is successful. The ticket has been sent to {{$order->email}}.</p>
    <div style="width:300px; border-radius: 8px; background-color:#e5e5e5;padding: 10px 15px; margin: auto">
      <small>
        Order Id: <span class="text-success">{{$order->id}}</span>
       <!-- Payment Id: <span class="text-success">{{$order->payment_id}}</span> -->
      </small>
    </div>
  </article>
</div>
@include('frontend.footer')