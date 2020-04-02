@extends('layouts.app')

@section('content')

<!-- Page Content -->
<section class="innerPage">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="registerSetting">
                    <div class="registerSettingInner">
                        <h2>Reset Password</h2>
                        <div class="profileInner">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <form method="POST" action="{{ route('password.email') }}">
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
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-lg btn-primary">{{ __('Send Password Reset Link') }}</button>
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
