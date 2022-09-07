@extends('frontend.index')

@section('content')

    @include('frontend.top-bar')
    @include('frontend.header')
    <div id="fh5co-when-where" class="fh5co-section-gray">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
						<h2>When &amp; Where</h2>
					</div>
				</div>
				<div class="row row-bottom-padded-md">
					<div class="col-md-6 text-center animate-box">
						<div class="wedding-events">
							<div class="ceremony-bg" style="background-image: url(images/wed-ceremony.jpg);"></div>
							<div class="desc">
								<h3>Wedding Ceremony</h3>
								<p><strong>Saturday, December 28, 2017, 4.00 PM - 5.00PM @ Boracay Beach</strong></p>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
							</div>
						</div>
					</div>
					<div class="col-md-6 text-center animate-box">
						<div class="wedding-events">
							<div class="ceremony-bg" style="background-image: url(images/wed-party.jpg);"></div>
							<div class="desc">
								<h3>Wedding Party</h3>
								<p><strong>Saturday, December 28, 2017, 6.00 PM - 11.00PM @ Boracay Beach</strong></p>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div id="map" class="fh5co-map"></div>
					</div>
				</div>
			</div>
		</div>
    @include('frontend.newsletter')
    @include('frontend.footer')

@endsection