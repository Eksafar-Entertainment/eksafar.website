@extends('front.layouts.default-bare')
@section('head')
    <title>Register</title>
@endsection
@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-center">
            <div class="flex-grow-1" style="max-width: 450px">
                <div class="card">
                    <div class="card-body p-5">

                        <div class="mb-4 text-center">
                            <h4>{{ __('Register') }}</h4>
                            <p>Please fill all the information to create account</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="col-form-label">{{ __('Name') }}</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="mb-3">
                                <label for="email" class="col-form-label">{{ __('Email Address') }}</label>


                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">

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
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="mb-3">
                                <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>


                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">

                            </div>

                            <div class="mb-0 text-center mt-4">

                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Register') }}
                                </button>
                                <small>
                                    I agree to the <a href="/terms-and-conditions" target="_blank" class="text-muted">Terms
                                        &amp; Conditions</a> &amp; <a href="/privacy" target="_blank"
                                        class="text-muted">Privacy Policy</a>
                                </small>

                            </div>

                            <div class="mt-4 text-grey text-small text-center">
                                <p class="mb-0">Already registered? <a href="{{ route('login') }}"
                                        class="text-white">Login</a></p>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
