@extends('layouts.app')

@section('content')
<!-- Page Content -->
<section class="innerPage">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="registerSetting">
                    <div class="registerSettingInner">
                        <h2>LOGIN</h2>
                        <div class="profileInner">
                            @include('shared.errors')
                            @include('shared.success')
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="email">{{ __('E-Mail Address') }}</label>
                                        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" autocomplete="off" />

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="password" class="d-block">Password </label>
                                        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" autocomplete="off">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form row">
                                    <div class="form-group col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" value="{{ old('remember') ? 'checked' : '' }}">

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12 text-right">
                                        @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                        @endif
                                        <button type="submit" class="btn btn-lg btn-primary">Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Page Content --> 
@endsection
