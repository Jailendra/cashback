@extends('admin.layouts.default')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">User</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">        
            <div class="box top-box">
                <div class="box-header">
                    <h5 class="box-title font-weight-bold">Profile-Details</h4>
                </div>
                <div class="box-body">
                    @include('shared.errors')
                    @include('shared.success')
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap">
                        <table class="table table-bordered success">
                            <thead>
                                <tr>
                                    <th style="width:40%">Name</th>
                                    <td class="text-capitalize">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th class="info">Email</th>
                                    <td>
                                        {{ $user->email }} 
                                        @if ($user->email_verified_at)
                                        <small class="text-sm text-success">Verified</small>
                                        @else
                                        <small class="text-sm text-warning">Not Verified</small>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="info">Role</th>
                                    <td class="text-capitalize">{{ $user->role }}</td>
                                </tr>
                                <tr>
                                    <th class="info">Refered By</th>
                                    <td class="text-capitalize">
                                    @if ($user->refered_by)
                                        <a href="{{ route('admin.user.view', ['userId' => $user->referBy()->first()->id]) }}" class=" btn-link">{{ $user->referBy()->first()->name }}</a>
                                    @else
                                        N/A
                                    @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="info">Refrence Code</th>
                                    <td>{{ $user->reference_code }}</td>
                                </tr>
                                <tr>
                                    <th class="info">Joining Date</th>
                                    <td>{{ $user->created_at->format('F d, Y') }}</td>
                                </tr>
                                <tr>
                                    <th class="info">Subscription</th>
                                    <td>
                                            
                                    @if($user->subscription()->latest()->first())
                                        @php
                                            $subscription = $user->subscription()->latest()->first();
                                        @endphp
                                        <a href="" class="btn-link text-capitalize">{{ $subscription->name }}</a> <small>Expire At <span class="text-info">{{ isset($subscription->ends_at) ? $subscription->ends_at->format('F d, Y') : '' }}</span></small></td>
                                    @endif
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="box top-box">
                <div class="box-header">
                    <h5 class="box-title font-weight-bold">Bank-Details</h5>
                </div>
                @if($user->bank()->first())
                    @php
                        $bank = $user->bank()->first();
                    @endphp
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap">
                            <table class="table table-bordered success">
                                <thead>
                                    <tr>
                                        <th style="width:40%">Bank Name</th>
                                        <td class="text-capitalize">{{ $bank->bank_name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="info">Branch Name</th>
                                        <td>
                                            {{ $bank->branch_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="info">Account Name</th>
                                        <td class="text-capitalize">{{ $bank->account_name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="info">Account Number</th>
                                        <td>
                                            {{ $bank->account_number }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="info">Swift</th>
                                        <td>{{ $bank->swift }}</td>
                                    </tr>
                                    <tr>
                                        <th class="info">IBAN</th>
                                        <td>{{ $bank->iban }}</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection