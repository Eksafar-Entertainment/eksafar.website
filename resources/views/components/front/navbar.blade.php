<nav class="navbar navbar-expand-lg bg-body-tertiary navbar-dark">
            <div class="container py-2">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('/images/logo.svg') }}" alt="Eksafar" style="height: 25px;" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="flex-grow-1"></div>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-end">
                        {{-- <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa-solid fa-location-dot"></i> {{ __('Bengaluru') }}
                                <i class="fa-solid keyboard-allow-down"></i>
                            </a>
                        </li>
                        <li class="nav-item"> <a class="nav-link">|</a> </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="/">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/gallery">{{ __('Gallery') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contact">{{ __('Contact') }}</a>
                        </li>
                    </ul>
                    <div class="px-2 d-sm-none d-md-inline-flex"> | </div>
                    <ul class="navbar-nav ms-auto">
                        <!--- default Links -->

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



        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-body">
                  
                </div>
              </div>
            </div>
          </div>