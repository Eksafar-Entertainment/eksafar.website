@extends('frontend.index')

@section('content')

    @include('frontend.header')
    @include('frontend.brandcam')
    <article class="bg-secondary">  
    <div class="card-body text-center">
    <h2 class="text-white">Congrats! you are in<br></h2>
    <p>Below are your payemt details</p>
    <br>
    <table class="table table-dark" style="text-transform: uppercase">
  <!-- <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">type</th>
    </tr>
  </thead> -->
  <tbody>
    <tr>
      <td>Name</td>
      <td>{{$payment->user}}</td>
    </tr>
    <tr>
      <td>Entry Type</td>
      <td>{{$payment->product_id}}</td>
    </tr>
    <tr>
      <td>No. of Persons</td>
      <td>{{$payment->persons}}</td>
    </tr>
  </tbody>
</table>
    <p><a class="btn btn-warning" target="_blank" href="/"> Eksafar.club
     <i class="fa fa-window-restore "></i></a></p>
    </div>
    </article>
    @include('frontend.footer')
@endsection