@extends('frontend.index')

@section('content')

    @include('frontend.top-bar')
    @include('frontend.header')
    <div id="fh5co-groom-bride">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
						<h2>Groom &amp; Bride</h2>
					</div>
				</div>
				<div class="row padding">
					<div class="couple-wrap">
						<div class="col-md-6 nopadding animate-box">
							<img src="/images/groom.jpg" class="img-responsive" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
						</div>
						<div class="col-md-6 nopadding animate-box">
							<div class="couple-desc">
								<h3>Jack Wood</h3>
								<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius molestias accusamus alias autem provident. Odit ab aliquam dolor eius. Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
								<p class="fh5co-social-icons">
									<a href="#"><i class="icon-twitter2"></i></a>
									<a href="#"><i class="icon-facebook2"></i></a>
									<a href="#"><i class="icon-instagram"></i></a>
									<a href="#"><i class="icon-dribbble2"></i></a>
									<a href="#"><i class="icon-youtube"></i></a>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row padding">
					<div class="couple-wrap">
						<div class="col-md-6 col-md-push-6 nopadding animate-box">
							<img src="/images/bride.jpg" class="img-responsive" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
						</div>
						<div class="col-md-6 col-md-pull-6 nopadding animate-box">
							<div class="couple-desc">
								<h3>Rose Thomas</h3>
								<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius molestias accusamus alias autem provident. Odit ab aliquam dolor eius. Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
								<p class="fh5co-social-icons">
									<a href="#"><i class="icon-twitter2"></i></a>
									<a href="#"><i class="icon-facebook2"></i></a>
									<a href="#"><i class="icon-instagram"></i></a>
									<a href="#"><i class="icon-dribbble2"></i></a>
									<a href="#"><i class="icon-youtube"></i></a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    @include('frontend.newsletter')
    @include('frontend.footer')

@endsection