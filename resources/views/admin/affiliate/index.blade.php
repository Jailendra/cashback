@extends('admin.layouts.default')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Dashboard</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Affiliate Commission</h6>
  </div>
  <div class="card-body">
    @include('shared.errors')
    @include('shared.success')
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
          <th>Type:Level</th>
          <th>Beneficiary:Level</th>
          <th>Commission</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
          <th>Type:Level</th>
          <th>Beneficiary:Level</th>
          <th>Commission</th>
          </tr>
        </tfoot>
        <tbody>
        @foreach($affiliates as $affiliate)
          <tr>
          <td class="text-capitalize">{{ $affiliate->type }}</td>
          <td class="text-capitalize">{{ $affiliate->beneficiary }} {{ $affiliate->level ? ': level-'.$affiliate->level : null }}</td>
          <td>{{ $affiliate->commission }}%</td>
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