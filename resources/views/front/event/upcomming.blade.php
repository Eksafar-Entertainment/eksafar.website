<section class="py-4 pt-0">
<style>
            .owl-prev {
                width: 15px;
                height: 100px;
                position: absolute;
                top: 30%;
                margin-left: -25px !important;
                display: block !important;
                border: 0px solid black;
            }

            .owl-next {
                width: 15px;
                height: 100px;
                position: absolute;
                top: 30%;
                right: -25px;
                display: block !important;
                border: 0px solid black;
            }

            .owl-prev i,
            .owl-next i {
                color: #ccc;
            }
        </style>
        
    <div class="container">
        <h2 class="text-center mb-4"><span class="glow">U</span>pcoming</h2>
        <div class="owl-carousel owl-theme" id="gallery-carousel">
            @foreach ($upcommings as $upcomming)
            @if(Request::path() != 'event/' . $upcomming->slug)
            <div class="item">
                <div class="item-container ">
                    <a class="btn btn-light fw-lighter" href="{{ url('/event/' . $upcomming->slug) }}">
                        <img class="rounded" src="{{ url($upcomming->cover_image) }}" />
                    </a>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>


    <script>
            // Owlcarousel
            $(document).ready(function() {
                $(".owl-carousel").owlCarousel({
                    loop: true,
                    margin: 10,
                    nav: true,
                    autoplay: true,
                    autoplayTimeout: 3000,
                    autoplayHoverPause: true,
                    center: true,
                    navText: [
                        "<i class='fa fa-angle-left date-glow fs-4'></i>",
                        "<i class='fa fa-angle-right date-glow fs-4'></i>"
                    ],
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 1
                        },
                        1000: {
                            items: 3
                        }
                    }
                });
            });
        </script>

</section>