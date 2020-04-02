@extends('admin.layouts.default')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Subscriptions</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">        
            <div class="box top-box">
                <div class="box-header">
                    <h3 class="box-title">{{ isset ($subscription) ? 'Update' : 'Create' }} Subscription</h3>
                </div>
                <div class="box-body">
                    @include('shared.errors')
                    @include('shared.success')
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap">
                        <form method="POST" action="{{ isset ($subscription) ? route('subscription-update', ['subscriptionId' => $subscription->id]) : route('subscription-store') }}">
                            @csrf
                            @if (isset ($subscription))
                                @method ('PUT')
                            @endif
                            <div class="form-group">
                                <label>Name</label>
                                <input maxlength="50" placeholder="Name of Subscription Plan" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $subscription->name ?? old('name') }}" required autocomplete="name" autofocus />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <input maxlength="191" placeholder="Description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $subscription->description ?? old('description') }}" required autocomplete="description" autofocus />
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Benifits</label>
                                <div id="benifits">
                                @php
                                $i = 0;
                                $length =  isset ($subscription) ? count ($subscription->benifits) : count((array) old('benifits'));
                                do {
                                @endphp
                                    <div class="input-group">
                                        <input placeholder="Benifits" class="form-control @error('benifits') is-invalid @enderror" name="benifits[]" value="{{ $subscription->benifits[$i] ?? old('benifits')[$i] }}" required autocomplete="benifits" autofocus />
                                        <span class="input-group-addon btn btn-secondary px-5 rounded-0 mb-1" onClick="addBenifits(this)">
                                        @if (($length && $i === ($length-1)) || (!$length && !$i))
                                        +
                                        @else
                                        -
                                        @endif
                                        </span>
                                    </div>
                                    @php
                                $i++;
                                } while ($i < $length)
                                @endphp
                                </div>
                                @error('benifits')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Amount</label>
                                <input placeholder="Amount (number)" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ $subscription->amount ?? old('amount') }}" required autocomplete="amount" autofocus />
                                @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Validity</label>
                                <input placeholder="Validity of Subscription Plan (Days)" class="form-control @error('validity') is-invalid @enderror" name="validity" value="{{ $subscription->validity ?? old('validity') }}" required autocomplete="validity" autofocus />
                                @error('validity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">{{ isset ($subscription) ? 'Update' : 'Save' }}</button>
                        </form>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>

@endsection

<script src="{{ asset('js/admin-create-subscription.min.js') }}"></script>