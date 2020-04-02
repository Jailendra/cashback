@extends('admin.layouts.default')

@section('content')

@include('shared.errors')
@include('shared.success')

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Subscription List</h6>
    </div>
  <div class="card-body">
    @include('shared.errors')
    @include('shared.success')
    <a href="{{ route('subscription-create') }}" class="btn btn-primary btn-icon-split add mb-4">
      <span class="icon text-white-50">
        <i class="fas fa-plus"></i>
      </span>
      <span class="text">Create</span>
    </a>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Amount</th>
            <th>Validity (Days)</th>
            <th></th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Amount</th>
            <th>Validity (Days)</th>
            <th></th>
          </tr>
        </tfoot>
        <tbody>
        @foreach($paginate as $subscription)
          <tr>
            <td>{{ $subscription->name }}</td>
            <td>{{ $subscription->description }}</td>
            <td>{{ $subscription->amount }}</td>
            <td>{{ $subscription->validity }}</td>
            <td class="coupon-action">
              <a href="{{ route('subscription-update', ['subscriptionId' => $subscription->id]) }}">Edit</a>
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

{{ $paginate->links() }}

@endsection