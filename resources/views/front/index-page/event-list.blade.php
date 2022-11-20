<section class="py-5 border-top border-bottom">
    <div class="container my-5">
        <div class="row">
            <div class="col-4">
                <div class="row text-center mb-5">
                    <h1><span class="glow">E</span>vents</h1>
                    <h5 style="max-width: 500px" class="m-auto fw-normal">Checkout The best upcomming events in your city
                        that
                        you won't want to miss...</h5>
                </div>
            </div>
            <div class="col-8">
                <div class="row gx-5 gy-5">

                    <div id="event-carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($events as $event)
                                <div class="carousel-item active">
                                    <div class="card card-1"
                                        style="background-image:url('https://cdn.pixabay.com/photo/2016/11/21/16/55/high-heels-1846436__340.jpg'); padding-top: 40%; background-size:cover; background-position:center;background-size: 400px 400px;background-repeat: no-repeat;">

                                        @if ($event->status === 'CLOSED')
                                            <div class="position-absolute badge bg-danger"
                                                style="right:-23px; top:20px; transform:rotate(45deg); padding-left:20px; padding-right:20px">
                                                COMPLETED</div>
                                        @endif
                                        <div class="position-absolute top-0 start-0 w-100 h-100"
                                            style="background: linear-gradient(180deg, rgba(0,0,0,0) 54%, rgba(0,0,0,0.7) 83%);  ">

                                            <div class="position-absolute bottom-0 start-0 card-body text-light  w-100">
                                                <h1 class="entry-title">
                                                    <a href="{{ url('/event/' . $event->slug) }}">{{ $event->name }}</a>
                                                </h1>
                                                <small>@ <a href="">Catchup Banglore</a></small><br />
                                                <span
                                                    class="date-glow">{{ \Carbon\Carbon::parse($event->start_date)->format('d-m-Y') }}</span><br />
                                                <a href="#" style="color: lightgray; float: right;">Learn More</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach



                            <!-- <div class="iklan">
                                <p>Upcomming New Year Party</p>
                                <a href="#" target="_blank">Learn More <strong>Here</strong></a>
                            </div> -->




                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#event-carousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#event-carousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>


<section id="slider" class="pt-5">
  <div class="container">
    <h1 class="text-center"><b>Responsive Owl Carousel</b></h1>
      <div class="slider">
                <div class="owl-carousel">
                <div class="slider-card">
                        <div class="d-flex justify-content-center align-items-center mb-4">
                            <img src="images/slide-2.jpg" alt="">
                        </div>
                        <h5 class="mb-0 text-center"><b>Wordpress Tutorials</b></h5>
                        <p class="text-center p-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam temporibus quidem magni qui doloribus quasi natus inventore nisi velit minima.</p>
                    </div>
                    <div class="slider-card">
                        <div class="d-flex justify-content-center align-items-center mb-4">
                            <img src="images/slide-3.jpg" alt="">
                        </div>
                        <h5 class="mb-0 text-center"><b>PHP MySQL Tutorials</b></h5>
                        <p class="text-center p-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam temporibus quidem magni qui doloribus quasi natus inventore nisi velit minima.</p>
                    </div>
                    <div class="slider-card">
                        <div class="d-flex justify-content-center align-items-center mb-4">
                            <img src="images/slide-4.jpg" alt="">
                        </div>
                        <h5 class="mb-0 text-center"><b>Javascript Tutorials</b></h5>
                        <p class="text-center p-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam temporibus quidem magni qui doloribus quasi natus inventore nisi velit minima.</p>
                    </div>
                    <div class="slider-card">
                        <div class="d-flex justify-content-center align-items-center mb-4">
                            <img src="images/slide-5.jpg" alt="">
                        </div>
                        <h5 class="mb-0 text-center"><b>Bootstrap Tutorials</b></h5>
                        <p class="text-center p-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam temporibus quidem magni qui doloribus quasi natus inventore nisi velit minima.</p>
                    </div>
                </div>
            </div>
  </div>

  <script>
// Owlcarousel
$(document).ready(function(){
  $(".owl-carousel").owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    center: true,
    navText: [
        "<i class='fa fa-angle-left'></i>",
        "<i class='fa fa-angle-right'></i>"
    ],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:3
        }
    }
  });
});
  </script>
</section>
