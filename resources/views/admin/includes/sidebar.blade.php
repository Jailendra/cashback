  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.home')}}">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Cashback<sup>DASH</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="{{route('admin.home')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Interface
    </div>

    <li class="nav-item">
      <a class="nav-link" href="{{route('admin.users')}}">
        <i class="fas fa-fw fa-table"></i>
        <span>Users</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-table"></i>
        <span>Coupon</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{url('/admin/coupons/create')}}">Add</a>
          <a class="collapse-item" href="{{url('/admin/coupons')}}">List</a>
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.advertiser') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Advertisers</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCommission" aria-expanded="true" aria-controls="collapseCommission">
        <i class="fas fa-fw fa-table"></i>
        <span>Commissions</span>
      </a>
      <div id="collapseCommission" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{ route('affiliate') }}">Affiliates</a>
          <a class="collapse-item" href="{{ route('commission.report') }}">Report</a>
          <a class="collapse-item" href="{{ route('request-cashback-list') }}">Cashback Request</a>
          <a class="collapse-item" href="{{ route('processed-cashback') }}">Cashback Processed</a>
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{route('admin.aggregator')}}">
        <i class="fas fa-fw fa-table"></i>
        <span>Aggregators</span></a>
    </li>

    {{--<li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSubs" aria-expanded="true" aria-controls="collapseSubs">
        <i class="fas fa-fw fa-table"></i>
        <span>Subscriptions</span>
      </a>
      <div id="collapseSubs" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{ route('subscription-create') }}">Create</a>
          <a class="collapse-item" href="{{ route('subscription-list') }}">List</a>
        </div>
      </div>
    </li>--}}

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePay" aria-expanded="true" aria-controls="collapsePay">
        <i class="fas fa-fw fa-table"></i>
        <span>Payplans</span>
      </a>
      <div id="collapsePay" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{ route('payplan.create') }}">Create</a>
          <a class="collapse-item" href="{{ route('admin.payplans') }}">List</a>
        </div>
      </div>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->
