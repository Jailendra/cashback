@extends('layouts.app')

@section('content')
<!-- Page Content -->
<section class="innerPage">
  <div class="container">
    <div class="profileSetting">
      <h1>Bank Details</h1>
      <div class="profileSettingInner">
        <h2>Account</h2>
        @include('shared.errors')
        @include('shared.success')
        <div class="profileInner">
          <p><small>Note: If you want to change your fixed settings, contact the <a href="#">Customer Support Team</a></small></p>
          <form action="{{route('bank.update')}}" method="post">
          @method('PUT')
          @csrf
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Bank Name</label>
                <input type="text" name="bank_name" class="form-control" placeholder="Bank Name" value="{{old('bank_name') ?? $bank->bank_name ?? null }}">
              </div>
              <div class="form-group col-md-4">
                <label>Branch Name</label>
                <input type="text" name="branch_name" class="form-control" placeholder="Branch Name" value="{{ old('branch_name') ??$bank->branch_name ?? null }}">
              </div>
              <div class="form-group col-md-4">
                <label>Account Name</label>
                <input type="text" name="account_name" class="form-control" placeholder="Account Name" value="{{ old('account_name') ?? $bank->account_name ?? null}}">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Account Number</label>
                <input type="text" name="account_number" class="form-control" placeholder="Account Number" value="{{ old('account_number') ?? $bank->account_number ?? null}}">
              </div>
              <div class="form-group col-md-4">
                <label>Swift</label>
                <input type="text" name="swift" class="form-control" placeholder="Swift" value="{{ old('swift') ?? $bank->swift ?? null }}">
              </div>

              <div class="form-group col-md-4">
                <label>IBAN</label>
                <input type="text" name="iban" class="form-control" placeholder="IBAN" value="{{ old('iban') ?? $bank->iban ?? null }}">
              </div>
            </div>
            <div class="form-group text-right">
              <button type="submit" class="btn btn-lg btn-primary">SUBMIT</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Page Content --> @endsection