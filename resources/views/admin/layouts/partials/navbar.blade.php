<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
        <div class="container-lg">
            <a class="navbar-brand" href="{{ url('/admin') }}" style="letter-spacing: 2px">
                {{-- {{ config('app.name', 'Laravel') }} --}}
                <img height="20px" src="{{ url('images/logo.svg') }}" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto flex-grow-1 justify-content-center">
                    <li class="nav-item"><a href="/admin" class="nav-link">{{ __('Home') }}</a></li>
                    @auth
                        @role('Admin')
                            <li class="nav-item dropdown">
                                <a id="usersDropdown" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false" v-pre>{{ __('Users')}}</a>
                                <ul class="dropdown-menu" aria-labelledby="usersDropdown">
                                    <li><a href="{{ route('users.index') }}" class="dropdown-item">{{ __('Users')}}</a></li>
                                    <li><a href="{{ route('roles.index') }}" class="dropdown-item">{{ __('Roles')}}</a></li>
                                    <li><a href="{{ route('permissions.index') }}" class="dropdown-item">{{ __('Permissions')}} </a></li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="usersDropdown" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false" v-pre>{{ __('Website')}}</a>
                                <ul class="dropdown-menu" aria-labelledby="usersDropdown">
                                    <li><a href="{{ route('banner.index') }}" class="dropdown-item">{{ __('Banners')}}</a></li>
                                    <li><a href="{{ route('gallery.index') }}" class="dropdown-item">{{ __('Gallery')}}</a></li>
                                </ul>
                            </li>
                        @endrole           
                        <li class="nav-item dropdown">
                            <a id="usersDropdown" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" v-pre>{{ __('Catelog')}}</a>
                            <ul class="dropdown-menu" aria-labelledby="usersDropdown">
                                @if (Auth::user()->can('event:list'))
                                    <li><a href="/admin/event" class="dropdown-item">{{ __('Events')}}</a></li>
                                @endif
                                <li><a href="{{ route('venue.index') }}" class="dropdown-item">{{ __('Venues')}}</a></li>
                                <li><a href="{{ route('artist.index') }}" class="dropdown-item">{{ __('Artists')}}</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a href="/admin/promoters" class="nav-link">{{ __('Promoters')}}</a></li>
                        <li class="nav-item"><a href="/admin/gallery" class="nav-link">{{ __('Gallery')}}</a></li>
                        <li class="nav-item"><a href="/admin/coupon" class="nav-link">{{ __('Coupons')}}</a></li>
                    @endauth
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
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

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
</header>
