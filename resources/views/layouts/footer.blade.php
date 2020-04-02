<!-- Main Footer -->
<footer class="mainFooter">
  <div class="footerTop">
    <div class="container">
      <h2>Follow Us</h2>
      <ul class="socialMedia">
        <li><a href="javascript:void(0)" class="facebook"><i class="fab fa-facebook-f"></i></a></li>
        <li><a href="javascript:void(0)" class="twitter"><i class="fab fa-twitter"></i></a></li>
        <li><a href="javascript:void(0)" class="pinterest"><i class="fab fa-pinterest-p"></i></a></li>
        <li><a href="javascript:void(0)" class="instagram"><i class="fab fa-instagram"></i></a></li>
        <li><a href="javascript:void(0)" class="youtube"><i class="fab fa-youtube"></i></a></li>
      </ul>
    </div>
  </div>
  <div class="footerMiddle">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="countryLanguage">
            <form>
              <div class="form-group">
                <label for="Country">Country</label>
                <select class="form-control form-control-lg">
                  <option>Select Country</option>
                  <option>Country 1</option>
                  <option>Country 2</option>
                  <option>Country 3</option>
                  <option>Country 4</option>
                  <option>Country 5</option>
                </select>
              </div>
              <div class="form-group">
                <label for="Language">Language</label>
                <select class="form-control form-control-lg">
                  <option>Select Language</option>
                  <option>Language 1</option>
                  <option>Language 2</option>
                  <option>Language 3</option>
                  <option>Language 4</option>
                  <option>Language 5</option>
                </select>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="footerMenu">
            <h3>About</h3>
            <ul class="footerLink">
              <li><a href="javascript:void(0)">About US</a></li>
              <li><a href="javascript:void(0)">How Cash Back Works</a></li>
              <li><a href="javascript:void(0)">Blog</a></li>
              <li><a href="javascript:void(0)">Investor Relations</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="footerMenu">
            <h3>Help</h3>
            <ul class="footerLink">
              <li><a href="javascript:void(0)">Frequently Asked Questions</a></li>
              <li><a href="javascript:void(0)">Customer Support</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="footerMenu">
            <h3>Saving Tools</h3>
            <ul class="footerLink">
            @guest<li><a href="{{ route('register') }}">{{ __('Join / Sign In') }}</a></li>
              <li><a href="\VIP">In Get VIP</a></li>@endguest
              <li><a href="javascript:void(0)">Compare Savings</a></li>
              <li><a href="{{ route('refer') }}">{{ __('Refer-a-Friend') }}</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footerBottom">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <div class="copyright">Powered by  © 2019 Cash Back Network. All rights reserved.</div>
        </div>
        <div class="col-md-5">
          <div class="policyLink"> <a href="javascript:void(0)">Term of Use Privacy Policy</a> | <a href="javascript:void(0)">Term of Use</a> </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/main.min.js') }}"></script>
<!-- End Main Footer --> 