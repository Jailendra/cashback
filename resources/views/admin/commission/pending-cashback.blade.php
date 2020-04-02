@extends('admin.layouts.default')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Commission</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Pending Cashback</h6>
  </div>
  <div class="card-body">
    @include('shared.errors')
    @include('shared.success')
    <div class="table-responsive">
      <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
        <thead>
          <tr>
            <th>User</th>
            <th>Mode</th>
            <th>Amount</th>
            <th>Date</th>
            <th></th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>User</th>
            <th>Mode</th>
            <th>Amount</th>
            <th>Date</th>
            <th></th>
          </tr>
        </tfoot>
        <tbody>
        @foreach($list as $item)
          <tr>
            <td class="text-capitalize"><a href="{{ route('admin.user.view', ['userId' => $item->user()->first()->id]) }}">{{ $item->user()->first()->name }}</a></td>
            <td class="text-capitalize">{{ $item->mode }}</td>
            <td>$ {{ $item->amount }}</td>
            <td>{{ date ('F d, Y', strtotime($item->request_date)) }}</td>
            <td><a href="{{ route('request-cashback-detail', ['userId' => $item->user_id]) }}" class="btn btn-link cursor-pointer">View</a></td>
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