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
    <h1 class="mainHeading">Special Coupons</h1>
    @include('coupon.special-coupons')
  </div>
</section>
<!-- End Coupon Codes and Deals --> 
@endsection