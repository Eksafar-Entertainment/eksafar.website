@extends('frontend.index')

@section('content')

    @include('frontend.top-bar')
    @include('frontend.header')
    <div id="fh5co-when-where" class="fh5co-section-gray">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
						<h2>Who are &amp; We</h2>
					</div>
				</div>
				<div class="row row-bottom-padded-md">
					<div class="col-md-6 text-center animate-box">
						<div class="wedding-events">
							<div class="ceremony-bg" style="background-image: url(images/wed-ceremony.jpg);"></div>
							<div class="desc">
								<h3>Event Organisers</h3>
								<p><strong>Music is the way to life</strong></p>
								<p>Our vision is to chart the roads of informative & entertaining events. We work on 
									established systems and processes which ensure a seamless flow of work from beginning to end. 
									We break barriers when we need to and go that extra mile.</p>
							</div>
						</div>
					</div>
					<div class="col-md-6 text-center animate-box">
						<div class="wedding-events">
							<div class="ceremony-bg" style="background-image: url(images/wed-party.jpg);"></div>
							<div class="desc">
								<h3>Vacation and Tour Planners</h3>
								<p><strong>Travel to find yourself</strong></p>
								<p>We inspire to create events that mesmerize you soul. We just don't create events, we create dreams 
									for you. We strive to make the event day special & memorable for you and your guests. We believe in 
									long term relationship with our valued customers.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.924370889863!2d77.63082841482138!3d12.912582290894665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae152ecf404d0f%3A0x57cc9839f5589dee!2sCatch%20Up%20Bangalore!5e0!3m2!1sen!2sin!4v1662706205354!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
				</div>
			</div>
		</div>
    @include('frontend.newsletter')
    @include('frontend.footer')

@endsection