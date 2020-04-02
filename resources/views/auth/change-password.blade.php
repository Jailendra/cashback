@extends('layouts.app')

@section('content')
<!-- Page Content -->
<section class="innerPage">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="registerSetting">
                    <div class="registerSettingInner">
                        <h2>{{ __('Change Password') }}</h2>
                        <div class="profileInner">
                            @include('shared.success')
                            <form method="POST" action="{{ route('update.password') }}">
                                @csrf

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="old_password" class="d-block">Old Password </label>
                                        <input id="old_password" type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" placeholder="Old Password" autocomplete="off">
                                        @error('old_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="new_password" class="d-block">New Password </label>
                                        <input id="new_password" type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="New Password" autocomplete="off">
                                        @error('new_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="confirm_password" class="d-block">Confirm Password </label>
                                        <input id="confirm_password" type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="Confirm Password" autocomplete="off">
                                        @error('confirm_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-lg btn-primary">{{ __('Change Password') }}</button>
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
