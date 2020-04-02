<div class="panel panel-default">
    <div class="panel-body">
        <div class="merchantDetails flexWrap">
            <div class="merchantLogo">
                <img src="{{$detail['advertiser']->logo ?? (current ($detail['proposals']))->imageUrl() }}" class="img-fluid">
            </div>
            <div class="merchantInfo">
                <h4><strong>{{ (current ($detail['proposals']))->name() }}</strong></h4>
                <p><i class="far fa-heart"></i> Favorite</p>
                <p>UP TO <strong>{{ (current ($detail['proposals']))->commission() }}</strong> Rewards</p>
            </div>
            <div class="merchantButton">
                <ul class="socialMedia">
                    <li><a href="javascript:void(0)" class="facebook"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="javascript:void(0)" class="twitter"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="javascript:void(0)" class="pinterest"><i class="fab fa-pinterest-p"></i></a></li>
                    <li><a href="javascript:void(0)" class="instagram"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="javascript:void(0)" class="youtube"><i class="fab fa-youtube"></i></a></li>
                </ul>
                <a href="#" class="btn btn-lg btn-block btn-primary">GO TO STORE</a>
            </div>
        </div>
    </div>
</div>