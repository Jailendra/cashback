@extends('admin.layouts.default')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Dashboard</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Coupons List</h6>
  </div>
  <div class="card-body">
    @include('shared.errors')
    @include('shared.success')
    <a href="{{url('/admin/coupons/create')}}" class="btn btn-primary btn-icon-split add" style="margin-bottom: 8px">
      <span class="icon text-white-50">
      <i class="fas fa-plus"></i>
      </span>
      <span class="text">Add Coupon</span>
    </a>

    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
          <th>ID</th>
          <th>Brand</th>
          <th>Offer Type</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
          <th>ID</th>
          <th>Brand</th>
          <th>Offer Type</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
        @foreach($coupons as $coupon)
        <tr>
          <td>{{ $coupon->id }}</td>
          <td>
            <div class="media">
              <img class="mr-3" height="80" src="{{ $coupon->trademark }}" alt="{{ $coupon->brand }}"/>
              <span class="brand">{{ $coupon->brand }}</span>
            </div>
          </td>
          <td>{{ $coupon->offer_type }} {{ $coupon->discount }}</td>
          <td>{{ $coupon->start_date }}</td>
          <td>{{ $coupon->end_date }}</td>
          <td class="coupon-action">
          <a href="/admin/coupons/{{ $coupon->id }}"><i class="fas fa-edit"></i></a>
          <form id="form-{{$coupon->id}}" action="{{ route('coupon.delete', ['id' => $coupon->id]) }}" method="POST">
            @method('DELETE')
            @csrf
            <a href="javascript:$('#form-{{ $coupon->id }}').submit();"><i class="fas fa-trash"></i></a>
          </form>
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

{{ $coupons->links() }}

@endsection