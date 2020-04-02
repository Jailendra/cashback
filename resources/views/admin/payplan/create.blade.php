@extends('admin.layouts.default')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Payplans</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">        
            <div class="box top-box">
                <div class="box-header">
                    <h3 class="box-title">{{ isset ($payplan) ? 'Update' : 'Create' }} Payplan</h3>
                </div>
                <div class="box-body">
                    @include('shared.errors')
                    @include('shared.success')
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap">
                        <form method="POST" action="{{ isset ($payplan) ? route('admin.payplan.update', ['id' => $payplan->id]) : route('payplan.store') }}">
                            @csrf
                            @if (isset ($payplan))
                                @method ('PUT')
                            @endif

                            <div class="form-group">
                                <label>Product Name</label>
                                <input maxlength="50" placeholder="VIP REWARDS MEMBERSHIP" class="form-control @error('name') is-invalid @enderror" name="product_name" value="VIP REWARDS MEMBERSHIP" readonly autocomplete="product_name" autofocus />
                                @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Nickname</label>
                                <input placeholder="Nickname of plan" class="form-control @error('nickname') is-invalid @enderror" name="nickname" value="{{ $payplan->nickname ?? old('nickname') }}" required autocomplete="nickname" autofocus />
                                @error('validity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Interval</label>
                                <select name="interval" class="form-control @error('interval') is-invalid @enderror">
                                <option value="">Select Interval</option>
                                <option value="15 days">15 Days</option>
                                <option value="month">1 Month</option>
                                <option value="year">1 Year</option>
                                </select>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Currency</label>
                                <select name="currency" class="form-control @error('currency') is-invalid @enderror">
                                <option value="">Select Currency</option>
                                <option value="usd">USD</option>
                                </select>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Amount(USD)</label>
                                <input placeholder="Amount (number)" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ $payplan->amount ?? old('amount') }}" required autocomplete="amount" autofocus />
                                @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <input placeholder="Description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $payplan->description ?? old('description') }}" required autocomplete="description" autofocus />
                                @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">{{ isset ($payplan) ? 'Update' : 'Save' }}</button>
                        </form>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>

@endsection