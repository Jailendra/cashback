@extends('layouts.app')

@section('content')
<!-- Page Content -->
<section class="innerPage">
  <div class="container">
    <div class="profileSetting">
      <h1>Account settings</h1>
      <div class="profileSettingInner">
        <h2>Profile</h2>
        <div class="profileInner">
          <p><small>Note: If you want to change your fixed settings, contact the <a href="#">Customer Support Team</a></small></p>
          <form action="{{route('user.profile.update')}}" method="post">
          @method('PUT')
          @csrf
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Country of residence</label>
                <input type="text" name="country" class="form-control" placeholder="Country of residence" value="{{$user->profile->country ?? null }}">
              </div>
              <div class="form-group col-md-4">
                <label>Currency</label>
                <input type="text" name="currency" class="form-control" placeholder="Currency" value="{{ $user->profile->currency ?? null }}">
              </div>
              <div class="form-group col-md-4">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{$user->email}}" readonly>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{$user->name}}">
              </div>
              <div class="form-group col-md-4">
                <label>Display Name</label>
                <input type="text" name="display_name" class="form-control" placeholder="Display Name" value="{{ $user->profile->display_name ?? null }}">
              </div>
              <div class="form-group col-md-4">
                <label>Gender</label>
                <select class="form-control" name="gender" value="{{ $user->profile->gender ?? null }}">
                  <option value="Male" {{ isset($user->profile->gender)=='Male' ? 'selected' : ""}}>Male</option>
                  <option value="Female" {{ isset($user->profile->gender)=="Female" ? "selected" : ""}}>Female</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Language</label>
                <input type="text" name="language" class="form-control" placeholder="Language" value="{{ $user->profile->language ?? null }}">
              </div>
              <div class="form-group col-md-4">
                <label class="d-block">Mobile Phone# <small class="float-right">Mandatory Field</small></label>
                <input type="text" name="mobile_number" class="form-control" placeholder="Mobile Phone#" value="{{ $user->profile->mobile_number ?? null }}">
              </div>
              <div class="form-group col-md-4">
              <label>Birthday</label>
              <input type="Date" name="dob" class="form-control" placeholder="Birthday" value="{{ $user->profile->dob ?? null }}">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Refer Code</label>
                <input type="text" name="reference_code" class="form-control" placeholder="Refer Code" value="{{ $user->reference_code ?? null }}" readonly>
              </div>
            </div>
            <div class="form-group text-right">
              <button type="submit" class="btn btn-lg btn-primary">SUBMIT</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="profileSetting">
      <div class="profileSettingInner">
        <h2>Account Security</h2>
        <div class="profileInner">
          <div class="row">
            <div class="col-lg-6">
              <div class="media"> <img src="images/Question-Mark.png" class="mr-3" alt="...">
                <div class="media-body">
                  <h5 class="my-0 mb-1">Security Questions <img src="images/warning-icon.png"> <span class="float-right"><a href="#">Add Security Questions</a></span></h5>
                  You might need to verify your identity before you can complete certain transactions on cashback.com. </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="media"> <img src="images/Question-Mark.png" class="mr-3" alt="...">
                <div class="media-body">
                  <h5 class="mt-0 mb-1">Account Password <span class="float-right"><a href="{{ route('change.password') }}">Change password</a></span></h5>
                  Password last modified at {{ Carbon\Carbon::parse(Auth::user()->updated_at)->format('d-m-Y') }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="profileSetting">
      <div class="profileSettingInner">
        <h2>MANAGE MEMBERSHIP</h2>
        <div class="profileInner">
          <div class="row">
            <div class="col-lg-4">
              <div class="row">
                <div class="col-lg-5">
                  <p><strong>Savings Status</strong></p>
                  <img src="images/electric-icon.png" width="50px" alt="..."> </div>
                <div class="col-lg-7">
                  <p>Premier level: <span>Active</span></p>
                  <p>VIP Membership: <span>Inactive</span></p>
                  <p><a href="#">View transactions</a></p>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <form>
                <div class="form-group row">
                  <label class="col-sm-6 col-form-label">VIP Member Since:</label>
                  <div class="col-sm-6">
                    <input type="text" readonly class="form-control form-control-plaintext" value="{{ isset(Auth::user()->subscription()->first()->created_at) ? Carbon\Carbon::parse(Auth::user()->subscription()->first()->created_at)->format('d-m-Y') : 'Not joined yet' }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-6 col-form-label">Joined Cashback.com:</label>
                  <div class="col-sm-6">
                    <input type="text" readonly class="form-control form-control-plaintext" value="{{ Carbon\Carbon::parse(Auth::user()->created_at)->format('d-m-Y') }}">
                  </div>
                </div>
              </form>
            </div>
            <div class="col-lg-4">
              <div class="media"> <img src="images/dolar.png" width="32px" class="mr-2" alt="...">
                <div class="media-body"> Maximize your Cash Back earnings and benefit from members-only savings. </div>
              </div>
              <p><a href="{{ route('subscriptions') }}">Upgrade to VIP Rewards Membership now</a></p>
              <p> <img src="images/Question-Mark.png" width="24px" alt="..."> <a href="#">Find out more</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Page Content --> 
@endsection