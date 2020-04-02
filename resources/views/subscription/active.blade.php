@extends('layouts.app')

@section('content')

<div class="container mb-5 mt-5">
    @include('shared.errors')
    @include('shared.success')
    <div class="pricing card-deck flex-column flex-md-row mb-3">
    <table class="table table-bordered success">
        <thead>
            <tr>
                <th>Subscription Name</th>
                <td class="text-capitalize">{{ $subscription->plan->nickname ??  null }}</td>
            </tr>
            <tr>
                <th class="info">Amount</th>
                <td>$ {{ number_format(($subscription->plan->amount /100), 2, '.', ' ') }}</td>
            </tr>

            <tr>
                <th class="info">Valid for</th>
                <td>{{ $subscription->plan->interval_count ?? null }} {{ $subscription->plan->interval ?? null }}</td>
            </tr>
            <tr>
                <th class="info">Status</th>
                <td class="text-capitalize">{{ $subscription->status ?? null }}</td>
            </tr>
            <tr>    
                <th class="info">Joining Date</th>
                <td>{{ $subscription ? date('F d, Y', $subscription->current_period_start) : null }}</td>
            </tr>
            <tr>
                <th class="info">Expire At</th>
                <td>{{ $subscription ? date('F d, Y', $subscription->current_period_end) : null }}</td>
            </tr>
            <tr>
                <th class="info">Description</th>
                <td>{{ $subscription->plan->metadata->description ?? null }}</td>
            </tr>
        </thead>
    </table>
    </div>
</div>

@endsection