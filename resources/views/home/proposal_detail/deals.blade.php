<div class="panel-heading flexWrap">
    <h5 class="panel-title">Flipkart Deals & Coupons</h5>
</div>

<div class="panel-body" id="deals">
    @foreach ($detail['proposals'] as $key => $proposal)
    <div class="flipkartDeals flexWrap d-none">
        <div class="flipkartDealsLeft">
            <p class="text-justify">
                <b>{{ $proposal->description() }}</b>
            </p>
            <p>+ UP TO <strong>{{ $proposal->commission() }}</strong> Rewards</p>
            <p><i class="far fa-clock"></i> Expires {{ $proposal->expiryDate() }}</p>
        </div>
        <div class="flipkartDealsRight">
            <a href="{{ Auth::user() ? $proposal->clickUrl() : '/login' }}" target="_blank" class="btn btn-block btn-primary text-uppercase">shop now</a>
        </div>
    </div>
    @endforeach
</div>

<div class="panel-footer">
    <div class="flexWrap">
        <small>Showing <span id="current-page">1</span> - <span id="total-visible-page">5</span> out of <span id="total-page">{{ $detail['paginate']->total() }}</span> entries</small>
        <span id="pagination"></span>
    </div>
</div>

<script src="{{ asset('js/pagination.min.js') }}"></script>