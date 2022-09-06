@extends('frontend.index')

@section('content')

    @include('frontend.header')
    @include('frontend.brandcam')
    <div  class="container" style="margin-top: 5%; margin-bottom: 5%; text-align: center">
   <h1> Refund </h1>
<p>Tickets once successfully purchased for an event listed on Eksafar cannot be cancelled, and that amount will not be refunded. Eksafar does not support cancellation of registration/ticket purchase on the website/App right now.</p>

<p>In case, the transaction has been declined or is unsuccessful, but the payment has been deducted from the account, the refund process will be initiated once notified. The amount that had been deducted will be refunded into the account from which the payment was being attempted.</p>

<p>Eksafar will not entertain any refund/cancellation request in case of any issues related to payment gateway/method (including wallets such as Mobikwik, PayTM, PayPal etc.) offer. Any issues related to such offers will be addressed by the payment gateway/method itself.</p>
    </div>
    @include('frontend.footer')

@endsection