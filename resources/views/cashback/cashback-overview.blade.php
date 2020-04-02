@extends('layouts.app')

@section('content')

<!-- Page Content -->
<section class="innerPageSecond">
  <div class="container">
    <div class="cashBackOverview">
      <div class="cashBackOverviewInner">
        <div class="cashBackBanner">
          <div class="row">
            <div class="col-lg-4">
              <h2>Cash Back Overview</h2>
              <ul class="payout-flow">
                <li>
                  <div class="payout-flow-item">Available Cash Back</div>
                  <div class="payout-flow-content-info">$ {{$cashback}} </div>
                </li>
                <li>
                  <div class="payout-flow-item">Annual VIP Cash Back</div>
                  <div class="payout-flow-content-info">₹0.00</div>
                </li>
                <li>
                  <div class="payout-flow-item">Pending Cash Back</div>
                  <div class="payout-flow-content-info">₹0.00</div>
                </li>
                <li>
                  <div class="payout-flow-item">VIP Cash Back </div>
                  <div class="payout-flow-content-info">₹0.00</div>
                </li>
                <li>
                  <div class="payout-flow-item">Earnings to date </div>
                  <div class="payout-flow-content-info">₹0.00</div>
                </li>
              </ul>
              <p>Savings Status</p>
              <div class="text-right"><a href="#" class="btn btn-lg btn-primary">JOIN THE VIP REWARDS</a></div>
            </div>
            <div class="col-lg-4">
              @include('shared.errors')
              @include('shared.success')
              <h2>Request Cash Back Payout</h2>
              <form method="POST" action="{{ route('request-cashback') }}">
                @csrf
                @method('PUT')
                <ul class="request-cash">
                  <li>
                    <div class="payout-flow-content-info-item-number"><img class="payout-flow-content-info-item-number-image" src="images/1.png"></div>
                    <select class="form-control form-control-lg" name="mode">
                      <option disabled>Select Payment Method</option>
                      <option value="bank">Bank Transfer</option>
                      <option value="bitcoin">Bitcoin</option>
                    </select>
                  </li>
                  <li>
                    <div class="payout-flow-content-info-item-number"><img class="payout-flow-content-info-item-number-image" src="images/1.png"></div>
                    <div class="input-group">
                      <input type="text" class="form-control form-control-lg disabled" value="{{$cashback}}" disabled placeholder="Enter Amount">
                      <div class="input-group-prepend">
                        <div class="input-group-text">USD</div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="payout-flow-content-info-item-number"><img class="payout-flow-content-info-item-number-image" src="images/3.png"></div>
                    <button class="btn btn-lg btn-block btn-primary">Submit Request</button> </li>
                </ul>
              </form>
            </div>
          </div>
        </div>
        <div class="boxItem">
          <h3>OVERVIEW OF YOUR RECENT TRANSACTIONS</h3>
          <a href="#">Missing a purchase?</a> <a href="#">Download PDF</a> </div>
        <div class="boxItem">
          <h3>Payment Information</h3>
          <p>Withdrawing your Cash Back is easy and secure with Cashback. We provide a variety of convenient options for our shoppers. Most options offer an eWallet withdrawal. You may use the funds from your eWallet as either an online payment or transfer to your bank account (fees may apply). Cash Back withdrawal requests will be paid approximately 7-10 working days after being submitted. If you need help withdrawing your Cash Back, please contact our Customer Support Team.</p>
          <h4>*APPLICABLE FEES WILL APPLY ON ALL TRANSFERS AS FOLLOWS:</h4>
          <p>Please note that some payment options charge load or transfer fees. You are required to pay all fees related to a withdrawal. All fees are deducted from the requested withdrawal amount.</p>
          <h4><small><strong>Paytm</strong></small></h4>
          <p><small>Paytm is a wallet withdrawal option available only in India. Withdrawal fees of 1.5% (+ tax) apply. Minimum withdrawal eligibility is ₹1000</small></p>
          <p><small>*Note: We do our best to update the fee schedule; however, some providers may change their fees without notifying us. In such cases, Cashback will not be responsible for any discrepancy in fees cited above. Please contact each provider directly for updated fee schedules.</small></p>
        </div>
        <div class="boxItem">
          <h3>Missing a purchase?</h3>
          <p>It takes stores an average of 30-90 days to pay commissions. Once we have received the commissions from our partner stores, the status of your purchase will change from “pending” to “completed” and your Cash Back will be available on your Dashboard. Tracked Cash Back will appear in your Overview as soon as the store provides a status update. If your purchase does not appear as “pending” in your account within 14 days, please submit the <strong>Missing Purchase form</strong> below.</p>
          <p>*For customers in India, if your purchase does not appear on your Dashboard within three days of the purchase date, please submit a missing purchase form</p>
          <h3>Order Information?</h3>
          <form>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Email</label>
                  <div class="col-sm-8">
                    <input type="email" class="form-control" placeholder="Email">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Country</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Country">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Name of the store</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Store">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Upload invoice</label>
                  <div class="col-sm-8">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                      <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                      <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div>
                    <small>Allowed file types: *.bmp, *.jpg, *.png, *.pdf; Maximum file size: 2MB</small> </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-9">Did you log into to Cashback.com before making a purchase?</div>
                  <div class="col-sm-3">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1">
                      <label class="form-check-label" for="gridCheck1"> Yes </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1">
                      <label class="form-check-label red" for="gridCheck1"> No </label>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-9">Did you use a coupon during checkout?</div>
                  <div class="col-sm-3">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1">
                      <label class="form-check-label" for="gridCheck1"> Yes </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1">
                      <label class="form-check-label red" for="gridCheck1"> No </label>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-9">Did you use SaveMate®?</div>
                  <div class="col-sm-3">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1">
                      <label class="form-check-label" for="gridCheck1"> Yes </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1">
                      <label class="form-check-label red" for="gridCheck1"> No </label>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-9">Did you use Mobile?</div>
                  <div class="col-sm-3">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1">
                      <label class="form-check-label" for="gridCheck1"> Yes </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1">
                      <label class="form-check-label red" for="gridCheck1"> No </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Order Date</label>
                  <div class="col-sm-8">
                    <input type="Date" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">ORDER ID</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="ORDER ID">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Order Amount</label>
                  <div class="col-sm-8">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">INR</div>
                      </div>
                      <input type="text" class="form-control" placeholder="Enter Amount">
                      <div class="input-group-append">
                        <div class="input-group-text">.00</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12"> <small>The order amount is the purchase price of the item before shipping, tax, VAT, GST or any other surcharges related to your order.</small>
                    <div class="note"><small>NOTE: Please allow two weeks for purchases to post. All travel reservations — including hotel, airline and car rental — must be completed before purchases are reported. Participating stores will only respond to purchase inquiries made within 90 days.</small></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-lg btn-primary">SUBMIT FORM</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Page Content --> 

@endsection