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
            <th>Amount</th>
            <th>Mode</th>
            <th>Commission Type</th>
            <th>Request Date</th>
            <th>$ <span id="total">0.0</span></th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>User</th>
            <th>Amount</th>
            <th>Mode</th>
            <th>Commission Type</th>
            <th>Request Date</th>
            <th>
                <!-- form to submit payment to user -->
                <form method="POST" action="{{ route('cashback-process') }}">
                    @csrf
                    <input type="hidden" name="ids"/>
                    <button class="btn btn-sm btn-primary">Disburse</button>
                </form>
            </th>
          </tr>
        </tfoot>
        <tbody>
        @foreach($list as $item)
          <tr>
            <td class="text-capitalize"><a href="{{ route('admin.user.view', ['userId' => $item->user()->first()->id]) }}">{{ $item->user()->first()->name }}</a></td>
            <td>$ {{ $item->amount }}</td>
            <td class="text-capitalize">{{ $item->mode }}</td>
            <td class="text-capitalize">{{ $item->commission_type }}</td>
            <td class="text-capitalize">{{ date ('F d,Y h:i a', strtotime ($item->request_date)) }}</td>
            <td><input type="checkbox" onChange="selectCommission(this, {{ $item->amount }} , {{ $item->id }})"/></td>
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

<script src="{{ asset('js/pending-cashback-user-detail.blade.js') }}"></script>