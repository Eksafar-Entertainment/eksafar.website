<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/front/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/front/app.css') }}" rel="stylesheet">
    
    @yield('custom_css')
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ url('/img/ek-logo.png') }}" alt="eksafar-logo" style="height: 40px;" />
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    <strong style="letter-spacing: 2.2x; font-size: 20px" class="ms-2 text-primary">EKSAFAR</strong>
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
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>



        <section class="py-5 bg-secondary text-light">
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
                                - Step out with the Paytm Insider app today.</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-4">
                        <div>
                            <img src="https://media.insider.in/image/upload/c_crop,g_custom/v1637927732/pkle4f1xuhlf5kfwlcvg.gif"
                                style="width: 100%;" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="bg-primary text-light pt-5">

            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <h4>Useful Links</h4>
                        <ul class="nav flex-column">
                            <li class="nav-item"><a class="text-light" href="#">Home</a></li>
                            <li class="nav-item"><a class="text-light" href="#">About us</a></li>
                            <li class="nav-item"><a class="text-light" href="#">Services</a></li>
                            <li class="nav-item"><a class="text-light" href="#">Terms of service</a></li>
                            <li class="nav-item"><a class="text-light" href="#">Privacy policy</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4>Our Services</h4>
                        <ul class="nav flex-column">
                            <li class="nav-item"><a class="text-light" href="#">Web Design</a></li>
                            <li class="nav-item"><a class="text-light" href="#">Web Development</a></li>
                            <li class="nav-item"><a class="text-light" href="#">Product Management</a></li>
                            <li class="nav-item"><a class="text-light" href="#">Marketing</a></li>
                            <li class="nav-item"><a class="text-light" href="#">Graphic Design</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h4>Contact Us</h4>
                        <p> A108 Adam Street <br> New York, NY 535022<br> United States <br><br> <strong>Phone:</strong>
                            +1 5589 55488 55<br> <strong>Email:</strong> info@example.com<br> </p>
                    </div>
                    <div class="col-lg-3 col-md-6 footer-info">
                        <h3>About DevVE</h3>
                        <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita
                            valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
                    </div>
                </div>
            </div>

            <div class="container py-3">
                <div class="copyright"> &copy; Copyright <strong><span>DevVE</span></strong>. All Rights Reserved
                </div>
                <div class="credits"> Designed by <a class="text-light" href="#">SalvadorDevVE</a> </div>
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
