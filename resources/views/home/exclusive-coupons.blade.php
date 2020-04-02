<div class="owl-carousel owl-theme">
    @foreach($coupons as $coupon)
    <div class="item">
        <div class="couponCodesInner">
            <div class="couponLogo"> <img src="{{ $coupon->trademark }}" class="img-fluid" alt=""> </div>
            <div class="couponDiscount">{{ $coupon->brand }}</div>
            <div class="couponDiscount"> Up to <span>{{ $coupon->discount }} %</span> </div>
            <div class="couponButton"> <a href="{{ $coupon->affiliate_url }}" class="btn btn-primary">Coupon & Deals</a> </div>
        </div>
    </div>
    @endforeach
</div>
<script src="{{ asset('js/owl.carousel.min.js') }}" type="text/javascript" defer></script>
<script src="{{ asset('js/exclusive-coupons.js') }}" type="text/javascript" defer></script>