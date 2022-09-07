@extends('frontend.index')

@section('content')

    @include('frontend.top-bar')
    @include('frontend.header')
    <div id="fh5co-guest">
			<div class="container">
				<div class="row animate-box">
					<div class="col-md-8 col-md-offset-2 text-center heading-section">
						<h2>The Groomsmen</h2>
					</div>
				</div>
				<div class="row row-bottom-padded-lg">
					<div class="col-md-3 text-center animate-box">
						<div class="groom-men">
							<img src="images/groom-men-1.jpg" class="img-responsive" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
							<h3>Arthur Stone</h3>
						</div>
					</div>
					<div class="col-md-3 text-center animate-box">
						<div class="groom-men">
							<img src="images/groom-men-2.jpg" class="img-responsive" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
							<h3>Mike Paterson</h3>
						</div>
					</div>
					<div class="col-md-3 text-center animate-box">
						<div class="groom-men">
							<img src="images/groom-men-3.jpg" class="img-responsive" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
							<h3>Brench Thompson</h3>
						</div>
					</div>
					<div class="col-md-3 text-center animate-box">
						<div class="groom-men">
							<img src="images/groom-men-4.jpg" class="img-responsive" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
							<h3>Blake Haste</h3>
						</div>
					</div>
				</div>
				<div class="row animate-box">
					<div class="col-md-8 col-md-offset-2 text-center heading-section">
						<h2>The Bridesmaids</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 text-center animate-box">
						<div class="groom-men">
							<img src="images/bridesmaid-1.jpg" class="img-responsive" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
							<h3>Arthur Stone</h3>
						</div>
					</div>
					<div class="col-md-3 text-center animate-box">
						<div class="groom-men">
							<img src="images/bridesmaid-2.jpg" class="img-responsive" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
							<h3>Mike Paterson</h3>
						</div>
					</div>
					<div class="col-md-3 text-center animate-box">
						<div class="groom-men">
							<img src="images/bridesmaid-3.jpg" class="img-responsive" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
							<h3>Brench Thompson</h3>
						</div>
					</div>
					<div class="col-md-3 text-center animate-box">
						<div class="groom-men">
							<img src="images/bridesmaid-4.jpg" class="img-responsive" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
							<h3>Blake Haste</h3>
						</div>
					</div>
				</div>
			</div>
		</div>

    @include('frontend.newsletter')
    @include('frontend.footer')

@endsection