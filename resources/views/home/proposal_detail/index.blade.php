@extends('layouts.app')

@section('content')

<!-- Page Content -->
<section class="innerPage">
    <div class="container">
        <div class="flipkart">
            <div class="row">
                <div class="col-lg-8">
                    <!-- display offer summary and social links -->
                    @include('home.proposal_detail.summary')
                    <!-- display instructions -->
                    <!-- @include('home.proposal_detail.deals') -->
                    
                    <!-- display list of proposals offered by advertiser -->
                    <div class="panel panel-default">
                        @include('home.proposal_detail.deals')
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('home.proposal_detail.right_side')
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Page Content --> 

<!-- End Coupon Codes and Deals --> 
@endsection