@extends('layouts.app')

@section('content')
<!-- Home Slider -->
<section class="homeSlider">
  @include('home.slider')
</section>
<!-- End Home Slider -->

<!-- Coupon Codes and Deals -->
<section class="couponCodes">
  <div class="container">
    <h1 class="mainHeading">COUPON CODES AND DEALS</h1>
    @include('home.proposals')
  </div>
  <!-- Cash Back -->
  <div class="cashBack">
    <div class="container">
      <h1 class="mainHeading">Special Coupons</h1>
      @include('home.exclusive-coupons')
    </div>
  </div>
  <!-- End Cash Back --> 
</section>
<!-- End Coupon Codes and Deals --> 
@endsection