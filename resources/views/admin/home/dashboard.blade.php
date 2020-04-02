@extends('admin.layouts.default')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><p>Additional Features</p></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="{{url('/admin/coupons')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a></div>
            </div>
            <div class="col-auto">
            <i class="far fa-credit-card fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><p>Advertisers</p></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="{{route('admin.advertiser')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a></div>
            </div>
            <div class="col-auto">
            <i class="far fa-credit-card fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><p>Affiliate Commission</p></div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a href="{{route('affiliate')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a></div>
                </div>
                
              </div>
            </div>
            <div class="col-auto">
            <i class="far fa-credit-card fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><p>Commission Reports<p></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="{{route('commission.report')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a></div>
            </div>
            <div class="col-auto">
            <i class="far fa-credit-card fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-dark shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><p>Aggregator List</p></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="{{route('admin.aggregator')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a></div>
            </div>
            <div class="col-auto">
            <i class="far fa-credit-card fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>
<!-- /.container-fluid -->
@endsection