@extends('admin.layouts.default')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Dashboard</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Update Advertiser</h6>
  </div>
  <div class="card-body">
      <div class="box top-box">
      <div class="box-body">
        @include('shared.errors')
        @include('shared.success')
        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap">
          <div class="form-group">
            <label for="advertiser_id">{{ __('Advertiser-ID') }}</label>
            <label class="font-weight-bold" for="advertiser_id">{{ $advertiser->advertiser_id }}</label>
          </div>
          <form method="POST" action="{{ route('advertiser.update', ['id' => $advertiser->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            
            <div class="form-group">
              <label for="brand">{{ __('Advertiser-Name') }}</label>
              <input class="form-control @error('brand') is-invalid @enderror" id="brand" placeholder="Brand Name" name="advertiser_name" value="{{ old('advertiser_name') ?? $advertiser->advertiser_name ?? null }}" required autocomplete="advertiser_name" maxlength="100" autofocus>
              @error('brand')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="trademark">{{ __('Logo') }}</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="logo" name="image" />
                <label class="custom-file-label @error('image') is-invalid @enderror" for="logo">Choose file...</label>
              </div>
              @error('image')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            @if(isset($advertiser->id))
            <div class="form-group">
              <img class="w-25" src = "{{$advertiser->logo}}">
            </div>
            @endif

            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>
</div>
<!-- /.container-fluid -->

@endsection

