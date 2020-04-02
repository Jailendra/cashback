<!-- Main Menu -->
<nav class="navbar navbar-light navbar-expand-md">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav m-auto">
                <li class="nav-item dropdown megamenu-li"> <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop by Category</a>
                    <div class="dropdown-menu megamenu" aria-labelledby="dropdown01">
                        <div class="row">
                        <div class="col-12">
                            <style>
                                .cat-col .dropdown-item{padding:0; margin-bottom:5px; white-space:unset;
                                    -moz-column-break-inside: avoid;
                                    -webkit-column-break-inside: avoid;
                                    column-break-inside: avoid;}
                                .cat-col{column-count:4}
                            </style>
                            <h5>Links</h5>
                            <div class="cat-col" id="top-navigation-category"></div> 
                            </div>
                        <div class="col-sm-6 col-lg-3">
                    </div>
                </li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('coupons') }}">Coupons</a> </li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('refer') }}">{{ __('Refer-a-Friend') }}</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#">How It Works</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#">VIP Rewards</a> </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Main Menu -->