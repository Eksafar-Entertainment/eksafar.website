<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/front/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/front/dark/app.css') }}" rel="stylesheet" id="main-css">
    <link rel="icon" href="{{ url('/images/ek-logo.png') }}" type="image/icon type">


    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

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
        <nav class="navbar navbar-expand-md shadow-sm navbar-dark border-bottom">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ url('/images/logo.svg') }}" alt="eksafar-logo" style="height: 25px;" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!--- default Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="/">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/gallery">{{ __('Gallery') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contact">{{ __('Contact') }}</a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"
                                    style="z-index: 9999">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                    {{-- <button class="btn btn-primary" id="btnSwitch">Switch</button> --}}
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>



        <section class="py-5 text-light">
            <div class="container my-4">
                <div class="row align-items-center gy-5 gx-5">
                    <div class="col-md-6">
                        <div>
                            <h2>No More Screens. Only LIVE Scenes.</h2>
                            <p class="mt-4 fs-5">Kiss the couch goodbye and make a checklist of the things you’ve
                                missed! Concerts.
                                Comedy. Cricket. Camping. Cool Scenes.</p>
                            <p class="mt-4 fs-5">Set your destination to: ‘Anywhere, but home.’ Find experiences in &
                                around your
                                city
                                - Step out with the Eksafar Club today.</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-4">
                        <div>
                            <img src="{{ url('images/ek.gif') }}"
                                style="width: 100%; clip-path: polygon(0% 15%, 15% 15%, 15% 0%, 85% 0%, 85% 15%, 100% 15%, 100% 85%, 85% 85%, 85% 100%, 15% 100%, 15% 85%, 0% 85%);" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="text-light pt-5 border-top">

            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <h4>Useful Links</h4>
                        <ul class="nav flex-column">
                            <li class="nav-item"><a class="text-light" href="{{ url('') }}">Home</a></li>
                            <li class="nav-item"><a class="text-light" href="{{ url('about') }}">About us</a></li>
                            <li class="nav-item"><a class="text-light" href="{{ url('terms') }}">Terms &
                                    Condition</a>
                            </li>
                            <li class="nav-item"><a class="text-light" href="{{ url('payment-policy') }}">Refund &
                                    Cancellation Policy</a></li>
                            <li class="nav-item"><a class="text-light" href="{{ url('privacy') }}">Privacy
                                    Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4>Our Services</h4>
                        <ul class="nav flex-column">
                            <li class="nav-item"><a class="text-light" href="#">Events</a></li>
                            <li class="nav-item"><a class="text-light" href="#">Entertainment</a></li>
                            <li class="nav-item"><a class="text-light" href="#">Concerts & Comedy</a></li>
                            <li class="nav-item"><a class="text-light" href="#">Trips & Camping</a></li>
                            <li class="nav-item"><a class="text-light" href="#">Cool Scenes</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h4>Contact Us</h4>
                        <p> HSR, 560087 <br> Bangalore<br> India <br><br> <strong>Phone:</strong>
                            +91 805 01 49240<br> <strong>Email:</strong> info@eksafar.club<br> </p>
                    </div>
                    <div class="col-lg-3 col-md-6 footer-info">
                        <h3>About Eksafar</h3>
                        <p>Kiss the couch goodbye and make a checklist of the things you’ve missed! Concerts. Comedy.
                            Cricket. Camping. Cool Scenes.
                            Set your destination to: ‘Anywhere, but home.’ Find experiences in & around your city -
                            Step out with the Eksafar club today..</p>
                    </div>
                </div>
            </div>

            <div class="container py-3">
                <div class="copyright"> &copy; Copyright <strong><span>Eksafar</span></strong>. All Rights Reserved
                </div>
                <div class="credits"> Designed by <a class="text-light" href="#">xpeed</a> </div>
            </div>
        </footer>
    </div>
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

</html>
