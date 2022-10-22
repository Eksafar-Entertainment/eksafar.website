@extends('frontend.layouts.bare')

@section('custom_css')
<link href="{{ asset('css/front/ticket.css') }}" rel="stylesheet">
@endsection

@section('content')

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

@endsection