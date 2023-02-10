@extends('front.layouts.default-bare')
@section('head')
    <title>Login</title>
@endsection
@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-center">
            <div class="flex-grow-1" style="max-width: 450px">
                <div class="card">

                    <div class="card-body p-5">
                        <div class="mb-4 text-center">
                        <h4>{{ __('Login') }}</h4>
                        <p>Please login to manage your account</p>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="col-form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="mb-3">
                                <label for="password" class="col-form-label">{{ __('Password') }}</label>


                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="row mb-3">
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col text-right d-flex justify-content-end">
                                    @if (Route::has('password.request'))
                                        <a class="btn-link text-muted" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-0">
                                <button type="submit" class="btn btn-secondary w-100">
                                    {{ __('Login') }}
                                </button>
                            </div>
                           

                            <div class="mt-4 text-grey text-small text-center">
                                <p class="mb-0">Not registered yet? <a href="{{ route('register') }}" class="text-white">Get started</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
