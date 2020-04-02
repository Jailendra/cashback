@extends('admin.layouts.default')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Dashboard</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
  
    <div class="box top-box">
    <div class="box-header">
      <h3 class="box-title">Add Coupon</h3>
    </div>
    <div class="box-body">
      @include('shared.errors')
      @include('shared.success')
      <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap">
        <form method="POST" action="{{ isset($coupon) ? route('coupon.update', ['id' => $coupon->id]) :  route('coupon.add') }}" enctype="multipart/form-data">
          @if(isset($coupon))
          @method('PUT')
          @endif
          @csrf
          <div class="form-group">
            <label for="brand">{{ __('Brand') }}</label>
            <input class="form-control @error('brand') is-invalid @enderror" id="brand" placeholder="Brand Name" name="brand" value="{{ old('brand') ?? $coupon->brand ?? null }}" required autocomplete="brand" maxlength="100" autofocus>
            @error('brand')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="affiliate_url">{{ __('Affiliate URL') }}</label>
            <input class="form-control @error('affiliate_url') is-invalid @enderror" id="affiliate_url" placeholder="Affiliate URL" name="affiliate_url" value="{{ old('affiliate_url') ?? $coupon->affiliate_url ?? null }}" required autocomplete="affiliate_url"/>
            @error('affiliate_url')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="callback_url">{{ __('Callback URL') }}</label>
            <input class="form-control @error('callback_url') is-invalid @enderror" id="callback_url" placeholder="Callback URL" name="callback_url" value="{{ old('callback_url') ?? $coupon->callback_url ?? null }}" required autocomplete="callback_url"/>
            @error('callback_url')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="offer_type">{{ __('Offer Type') }}</label>
            <select class="form-control @error('offer_type') is-invalid @enderror" id="offer_type" name="offer_type" required value="{{ old('offer_type') ?? $coupon->offer_type ?? null }}">
              <option value="cashback">Cashback</option>
              <option value="discount">Discount</option>
              <option value="free_shipping">Free Shipping</option>
            </select>
            @error('offer_type')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="discount">{{ __('Discount') }}</label>
            <input class="form-control @error('discount') is-invalid @enderror" id="discount" placeholder="Discount" name="discount" value="{{ old('discount') ?? $coupon->discount ?? null }}" autocomplete="discount"/>
            @error('discount')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="row">
            <div class="form-group col-md-6">
              <label for="start_date">{{ __('Start Date') }}</label>
              <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" placeholder="Start Date" required value="{{ old('start_date')  ?? explode(' ', @$coupon->start_date)[0] ?? null }}" name="start_date" data-date-format="dd/mm/yyyy"/>
              @error('start_date')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group col-md-6">
              <label for="end_date">End Date</label>
              <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" placeholder="End Date" required value="{{ old('end_date')  ?? explode(' ', @$coupon->end_date)[0] ?? null }}" name="end_date" data-date-format="dd/mm/yyyy"/>
              @error('end_date')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="form-group">
            <label for="trademark">{{ __('Trademark') }}</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="trademark" name="image" />
              <label class="custom-file-label @error('image') is-invalid @enderror" for="trademark">Choose file...</label>
            </div>
            @error('image')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <button type="submit" class="btn btn-primary">{{ isset($coupon) ? 'Update' : 'Save' }}</button>
        </form>
      </div>
    </div>
  </div>
      
  </div>
</div>
</div>
<!-- /.container-fluid -->
@endsection