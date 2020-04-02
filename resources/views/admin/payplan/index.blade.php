@extends('admin.layouts.default')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Payplan List</h6>
    </div>
  <div class="card-body">
    @include('shared.errors')
    @include('shared.success')
    <a href="{{ route('payplan.create') }}" class="btn btn-primary btn-icon-split add mb-4">
      <span class="icon text-white-50">
        <i class="fas fa-plus"></i>
      </span>
      <span class="text">Create</span>
    </a>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
          <th>Plan-ID</th>
            <th>Amount(USD)</th>
            <th>Currency</th>
            <th>Intrevel</th>
            <th>Status</th>
            <th>Interval-Count</th>
            
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Plan-ID</th>
            <th>Amount</th>
            <th>Currency</th>
            <th>Intrevel</th>
            <th>Status</th>
            <th>Interval-Count</th>
            
          </tr>
        </tfoot>
        <tbody>
        @foreach($payplans as $payplan)
          <tr>
            <td>{{ $payplan->id }}</td>
            <td>$ {{ number_format(($payplan->amount /100), 2, '.', ' ') }}</td>
            <td>{{ $payplan->currency }}</td>
            <td>{{ $payplan->interval }}</td>
            <td>{{ $payplan->active }}</td>
            <td>{{ $payplan->interval_count }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<!-- /.container-fluid -->


@endsection