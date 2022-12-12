@extends('front.layouts.default')
@section('head')
    <title>Payment Processed</title>
@endsection
@section('content')
    <div class="container my-5 py-5">
        <article class="text-center m-auto" style="max-width: 600px;">
            <h1 class="display-1">
                @if($status === "FAILED")
                <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_yw3nyrsv.json"  background="transparent"  speed="1"  style="width: 150px; height: 150px; margin:auto"  autoplay></lottie-player>
                @elseif($status === "SUCCESS" )
                <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_s2lryxtd.json"  background="transparent"  speed="1"  style="width: 150px; height: 150px; margin:auto"  autoplay></lottie-player>
                @elseif($status === "PENDING")
                <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_qbuxqwzg.json"  background="transparent"  speed="1"  style="width: 150px; height: 150px; margin:auto"  autoplay></lottie-player>
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
                Your ticket order has been handled. Once payment has been received, the ticket has been delivered to <a href="" class="text-light">{{ $order->email }}</a>.
                @elseif($status === "PENDING")
                Your ticket order has been handled. Once payment has been received, the ticket has been delivered to <a href="" class="text-light">{{ $order->email }}</a>.
                @endif
                
            </p>
            <div>
                <kbd class="bg-danger text-light" style="font-size: 20px;">
                    Booking Id: #{{ $order->id }}
                </kdb>
            </div>
        </article>
    </div>
    <script src="{{url('js/plugins/lottie-player.min.js')}}"></script>
@endsection
