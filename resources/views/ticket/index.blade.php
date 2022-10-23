@extends('frontend.layouts.bare')

@section('custom_css')
@if ((new \Jenssegers\Agent\Agent())->isDesktop())
<link href="{{ asset('css/front/ticket.css') }}" rel="stylesheet">
@else
<link href="{{ asset('css/front/mobticket.scss') }}" rel="stylesheet">
@endif
@endsection

@section('content')

@if ((new \Jenssegers\Agent\Agent())->isDesktop())
<div class="ticket">
	<div class="despegable">
		<div class="barcode-container">
			<h1 class="barcode">
				<p>abcdefghijklmnopq</p>
				<div class="bar-number">
					<span>0</span>
					<span>7</span>
					<span>8</span>
					<span>9</span>
					<span>9</span>
					<span>9</span>
					<span>1</span>
					<span>0</span>
					<span>5</span>
				</div>
		</div>
		<div class="disclaimer">
			<p>Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Proin eget tortor risus. Donec sollicitudin.</p>
		</div>
	</div>
	<div class="ticket-body">
		<h1 class="vip">VIP</h1>
		<h2 class="event">Event</h2>
		<div class="location">
			<p>Admit 1</p>
			<p>SECTION B</p>
			<p> GATE 5</p>
		</div>
		<div class="details">
			<p class="details name"> Waving tour</p>
			<p class="details date"> 27/08</p>
			<span class="details gate"> Arena Music 7pm</span>
		</div>
	</div>
</div>
@else
<widget type="ticket" class="--flex-column"> 
   <div class="top --flex-column">
      <div class="bandname -bold">Ghost Mice</div>
      <div class="tourname">Home Tour</div>
      <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/199011/concert.png" alt="" />
      <div class="deetz --flex-row-j!sb">
         <div class="event --flex-column">
            <div class="date">3rd March 2017</div>
            <div class="location -bold">Bloomington, Indiana</div>
         </div>
         <div class="price --flex-column">
            <div class="label">Price</div>
            <div class="cost -bold">$30</div>
         </div> 
      </div> 
   </div>
   <div class="rip"></div>
   <div class="bottom --flex-row-j!sb">
      <div class="barcode">123456</div>
      <a class="buy" href="#">BUY TICKET</a>
   </div>
</widget>
@endif

@endsection