@extends('admin.layouts.default')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Users</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">List</h6>
  </div>
  <div class="card-body">
    @include('shared.errors')
    @include('shared.success')
    <div class="table-responsive">
      <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile Number</th>
            <th>View</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile Number</th>
            <th>View </th>
          </tr>
        </tfoot>
        <tbody>
        @foreach($users as $user)
          <tr>
            <td>{{ $user->id }}</td>
            <td class="text-capitalize"><a href="{{ route('admin.user.view', ['userId' => $user->id]) }}">{{ $user->name }}</a></td>
            <td> {{ $user->email }} </td>
            <td> {{ $user->profile()->first() ? $user->profile()->first()->mobile_number : null }} </td>
            <td><a href="{{ route('admin.user.view', ['userId' => $user->id]) }}"><i class="fas fa-eye"></i></a></td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<!-- /.container-fluid -->
{{ $users->links() }}

@endsection