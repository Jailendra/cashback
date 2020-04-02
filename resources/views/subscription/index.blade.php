@extends('layouts.app')

@section('content')

<div class="container mb-5 mt-5">
    @include('shared.errors')
    @include('shared.success')
    <div class="pricing card-deck flex-column flex-md-row mb-3">
    @foreach($list as $item)
        <div class="card card-pricing text-center px-3 mb-4">
            <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm text-capitalize">{{ $item->name }}</span>
            <div class="text-capitalize">
                {{ $item->description }}
            </div>
            <div class="bg-transparent card-header pt-4 border-0">
                <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="15">$<span class="price">{{ $item->amount }}</span><span class="h6 text-muted ml-2">/ {{ $item->validity }} days</span></h1>
            </div>
            <div class="card-body pt-0">
                <ul class="list-unstyled mb-4">
                @foreach($item->benifits as $benifit)
                    <li class="text-capitalize">{{ $benifit }}</li>
                @endforeach
                </ul>
                <form method="POST" action="{{ route('subscriptions-purchase', ['subscriptionId' => $item->id]) }}">
                    @csrf
                    <button class="btn btn-outline-secondary mb-3">Order now</button>
                </form>
            </div>
        </div>
    @endforeach
    </div>
</div>

@endsection