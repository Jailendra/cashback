@extends('admin.layouts.default')

@section('content')
<style>
.material-switch > input[type="checkbox"] {
    display: none;   
}

.material-switch > label {
    cursor: pointer;
    height: 0px;
    position: relative; 
    width: 40px;  
}

.material-switch > label::before {
    background: rgb(0, 0, 0);
    box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
    border-radius: 8px;
    content: '';
    height: 16px;
    margin-top: -8px;
    position:absolute;
    opacity: 0.3;
    transition: all 0.4s ease-in-out;
    width: 40px;
}
.material-switch > label::after {
    background: rgb(255, 255, 255);
    border-radius: 16px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
    content: '';
    height: 24px;
    left: -4px;
    margin-top: -8px;
    position: absolute;
    top: -4px;
    transition: all 0.3s ease-in-out;
    width: 24px;
}
.material-switch > input[type="checkbox"]:checked + label::before {
    background: inherit;
    opacity: 0.5;
}
.material-switch > input[type="checkbox"]:checked + label::after {
    background: inherit;
    left: 20px;
}
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Dashboard</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Aggregator List</h6>
  </div>
  <div class="card-body">
    @include('shared.errors')
    @include('shared.success')
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
          </tr>
        </tfoot>
        <tbody>
        @foreach($aggregators as $aggregator)
          <tr>
          <td>{{ $aggregator->id }}</td>
          <td class="text-capitalize">{{ $aggregator->name }}</td>
          <td>
          {{-- <form id="form-{{$aggregator->id}}" action="{{ route('aggregator.update', ['id' => $aggregator->id]) }}" method="POST">
            @method('PATCH')
            @csrf
            @if($aggregator->active) 
            <a href="javascript:$('#form-{{ $aggregator->id }}').submit();">Active</a>
            @else
            <a href="javascript:$('#form-{{ $aggregator->id }}').submit();">Inactive</a>
            @endif
          </form> --}}  

          <form id="form-{{$aggregator->id}}" action="{{ route('aggregator.update', ['id' => $aggregator->id]) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="material-switch">
              <input id="someSwitchOptionSuccess_{{$aggregator->id}}" name="someSwitchOption001" type="checkbox" onclick="$('#form-{{ $aggregator->id }}').submit()" {{ $aggregator->active == 1 ? 'checked' : '' }} />
            OFF <label for="someSwitchOptionSuccess_{{$aggregator->id}}" class="label-success"></label>  ON
            </div>
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

@endsection