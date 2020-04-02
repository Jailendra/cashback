@extends('admin.layouts.default')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Commission</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Report</h6>
  </div>
  <div class="card-body">
    @include('shared.errors')
    @include('shared.success')
    <div class="table-responsive">
      <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
        <thead>
          <tr>
            <th>User</th>
            <th>Commission Type</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Disbursed?</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>User</th>
            <th>Commission Type</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Disbursed?</th>
          </tr>
        </tfoot>
        <tbody>
        @foreach($list as $item)
          <tr>
            <td class="text-capitalize"><a href="{{ route('admin.user.view', ['userId' => $item->user()->first()->id]) }}">{{ $item->user()->first()->name }}</a></td>
            <td class="text-capitalize">{{ $item->commission_type }}</td>
            <td>$ {{ $item->amount }}</td>
            <td>{{ $item->created_at->format('F d, Y') }}</td>
            <td>{{ $item->disburse ? 'Yes' : 'No' }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<!-- /.container-fluid -->
{{ $list->links() }}

@endsection