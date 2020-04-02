@extends('layouts.app')

@section('content')
<!-- Page Content -->
<section class="innerPage">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="registerSetting">
                    <div class="registerSettingInner">
                        <h2>JOIN AS A FREE MEMBER</h2>
                        <div class="profileInner">
                            @include('shared.errors')
                            @include('shared.success')
                            <div id="card-errors"></div>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="name">Name</label>
                                        <input id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}" autocomplete="off" />
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="email">Email</label>
                                        <input id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" autocomplete="off" />

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="password" class="d-block">Password <small class="float-right">Min. 8 alphanumeric characters</small></label>
                                        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" autocomplete="off">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="confirm-password" class="d-block">Confirm Password <small class="float-right">Min. 8 alphanumeric characters</small></label>
                                        <input id="confirm-password" type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" autocomplete="off" />
                                        @error('confirm_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="reference-code" class="d-block">Have a voucher/refer code? </label>
                                        <div class="input-group">
                                            <input id="reference-code" name="reference_code" class="form-control" placeholder="Have a voucher/refer code?" value="{{ old('reference_code') }}" autocomplete="reference_code" />
                                        </div>
                                        @error('reference_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12 text-right">
                                        <a href="/VIP" class="btn btn-link">Join as a VIP?</a>
                                        <button type="submit" class="btn btn-lg btn-primary">SIGN UP</button>
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
