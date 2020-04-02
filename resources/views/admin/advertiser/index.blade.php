@extends('admin.layouts.default')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Dashboard</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Advertiser List</h6>
  </div>

  <div class="card-body">
    @include('shared.errors')
    @include('shared.success')
  
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
          <th>Image</th>
          <th>Advertiser ID</th>
          <th>Advertiser Name</th>
          <th>Aggregator Name</th>
          <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
          <th>Image</th>
          <th>Advertiser ID</th>
          <th>Advertiser Name</th>
          <th>Aggregator Name</th>
          <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
        @foreach($advertisers as $advertiser)
        <tr>
          <td>
            <div class="media">
              <img class="mr-3 img-logo" src="{{ $advertiser->logo }}" alt="{{ $advertiser->advertiser_name }}"/>
            </div>
          </td>
          <td>{{ $advertiser->advertiser_id }}</td>
          <td>{{ $advertiser->advertiser_name }}</td>
          <td>{{ $advertiser->aggregator()->first()->name }}</td>
          <td class="coupon-action">
            <a href="{{ route('advertiser.view', $advertiser->id) }}"> <i class="fas fa-edit"></i>    </a>
          </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<!-- /.container-fluid -->

{{ $advertisers->links() }}

@endsection