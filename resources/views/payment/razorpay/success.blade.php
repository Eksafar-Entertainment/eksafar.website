@extends('frontend.index')

@section('content')

@include('frontend.header')
@include('frontend.brandcam')
<article class="bg-secondary">
  <div class="card-body text-center">
    <h4>{{$content}}</h4>
    <table class="m-auto">
      <tr>
        <td>Order Id</td>
        <td>{{$order->id}}</td>
      </tr>
      <tr>
        <td>Payment Id</td>
        <td>{{$order->payment_id}}</td>
      </tr>
    </table>
  </div>
</article>
@include('frontend.footer')
@endsection