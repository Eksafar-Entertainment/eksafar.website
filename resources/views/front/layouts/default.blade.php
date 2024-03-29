<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/front/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/front/dark/app.css') }}" rel="stylesheet" id="main-css">
    <link rel="icon" href="{{ url('/favicon.ico') }}" type="image/icon">


    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '816550026455403');
        fbq('track', 'PageView');
    </script><noscript> <img height="1" width="1"
            src="https://www.facebook.com/tr?id=816550026455403&ev=PageView&noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Y5EVW7L56Z"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-Y5EVW7L56Z');
    </script>
    <script src="{{ asset('js/front/custom.js') }}" defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"
        integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @yield('head')
</head>

<body>
    <div id="app">
        <x-front.navbar />
        <!-- Navbar -->
    </div>
    <main>
        @yield('content')
    </main>

    <footer class="text-light pt-5 border-top bg-black">

        <div class="container footer-margin">
            <div class="row">
                <div class="col-lg-12 col-md-12 f-icons">
                    <a href="{{ url('/') }}">
                        <img src="{{ url('/images/eksafar-bottom.png') }}" alt="eksafar-logo" style="height: 75px;" />
                    </a>
                </div>
            </div>
            <div class="mt-4">
                <div class="row">
                    <div class="col-lg-12 col-md-12 f-icons">
                        <a href="https://www.facebook.com/eksafar.club"><i
                                class="fab fa-facebook-f fa-2x gray-footer"></i></a>&nbsp;&nbsp;&nbsp;
                        <a href="https://twitter.com/eksafarclub"><i
                                class="fab fa-twitter fa-2x gray-footer"></i></a>&nbsp;&nbsp;&nbsp;
                        <a href="https://www.instagram.com/eksafar.club/"><i
                                class="fab fa-instagram fa-2x gray-footer"></i></a>&nbsp;&nbsp;&nbsp;
                        <a href="https://www.youtube.com/channel/UCJZM7qVyoC4unVIuyYZEUcQ"><i
                                class="fab fa-youtube fa-2x gray-footer"></i></a>&nbsp;&nbsp;&nbsp;
                        <a
                            href="https://wa.me/919148158728?text=Welcome%20to%20Eksafar%20Club.%20How%20can%20we%20help%20you%20today."><i
                                class="fab fa-whatsapp fa-2x gray-footer"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container py-2 footer-margin">
            <div class="row">
                <div class="col-lg-12 col-md-12 f-icons">

                    <span style="display: inline; padding-right: 20px"><a class="gray-footer"
                            href="{{ url('terms') }}">Terms & Condition</a></span>
                    <span style="display: inline; padding-right: 20px"><a class="gray-footer"
                            href="{{ url('payment-policy') }}">Refund &
                            Cancellation Policy</a></span>
                    <span style="display: inline; padding-right: 20px"><a class="gray-footer"
                            href="{{ url('privacy') }}">Privacy
                            Policy</a></span>
                    </ul>
                </div>
            </div>
        </div>
        <div class="py-2 border-top text-center">
            &copy; Copyright 2023 <strong class="date-glow---"> Eksafar Entertainment</strong> All Rights reserved
        </div>
    </footer>
    @if ((new \Jenssegers\Agent\Agent())->isMobile())
        <div style="height: 60px"></div>
    @endif
</body>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    })
</script>

<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        slidesPerGroup: 3,
        loop: true,
        loopFillGroupWithBlank: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>
</html>
