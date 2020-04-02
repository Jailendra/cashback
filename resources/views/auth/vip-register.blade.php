@extends('layouts.app')

@section('content')

<!-- Page Content -->
<section class="innerPage">
  <div class="container">
    <div class="profileSetting">
      <div class="profileSettingInner">
        <h2>JOIN VIP REWARDS MEMBERSHIP</h2>
        <div class="profileInner">
        @include('shared.errors')
        @include('shared.success')
        <div id="card-errors"></div>
        <form method="POST" action="{{ route('store.vip') }}" id="payment-form">
            @csrf
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="form-group col-md-4">
                <label for="email">Email</label>
                <input id="email" type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="form-group col-md-4">
                <label for="mobile-number">Mobile Number</label>
                <input id="mobile-number" name="mobile_number" type="text" class="form-control" placeholder="Mobile Number" value="{{ old('mobile_number') }}">
                @error('mobile_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-4">
                <label for="password" class="d-block">Password <small class="float-right">Min. 8 alphanumeric characters</small></label>
                <div class="input-group">
                  <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" autocomplete="off">
                  <div class="input-group-append">
                    <button class="input-group-text" id="basic-addon1"><img src="images/eye.svg"></button>
                  </div>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
            </div>

            <div class="form-group col-md-4">
                <label for="confirm-password" class="d-block">Confirm Password <small class="float-right">Min. 8 alphanumeric characters</small></label>
                <div class="input-group">
                  <input id="confirm-password" type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                  <div class="input-group-append">
                    <button class="input-group-text" id="basic-addon2"><img src="images/eye.svg"></button>
                  </div>

                @error('confirm_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
            </div>

            <div class="form-group col-md-4">
                <label for="reference-code" class="d-block">Have a voucher/refer code? </label>
                <div class="input-group">
                  <input id="reference-code" type="text" name="reference_code" class="form-control" placeholder="Have a voucher/refer code?" value="{{ old('reference_code') }}" autocomplete="reference_code">
                </div>
              </div>
              @error('reference_code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Select Billing Plan</label><br>
                @foreach($payplans as $payplan)
                <div class="form-check form-check-inline">
                  <input class="form-check-input check" type="checkbox" name="plan" id="plan_{{$payplan->id}}" value="{{$payplan->id}}">
                  @error('plan')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  <label class="form-check-label" for="inlineRadio1">$ {{ number_format(($payplan->amount /100), 2, '.', ' ') }} /  {{ $payplan->interval_count }} {{ $payplan->interval }}</label>
                  
                </div>
                @endforeach
              </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <p><small>Your subscription will be renewed and billed automatically</small></p>
                </div>
            </div>
            
            <div class="stripeGateway">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Card holder name*</label>
                            <input type="text" id="card-holder-name" name="card_holder_name" class="form-control @error('card_holder_name') is-invalid @enderror" placeholder="Card holder name">
                            @error('card_holder_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- Stripe Elements Placeholder -->
                    <div class="col-md-8">
                        <div id="card-element"></div>
                    </div>
                </div>
            </div>
                
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-lg btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">SIGN ME UP FOR VIP REWARDS NOW</button>
                </div>
                    </div>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Page Content --> 
<script>

        const stripe = Stripe('{{ $stripe_key }}');

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        // Handle real-time validation errors from the card Element.
        cardElement.addEventListener('change', function(event) {
            console.log('test');    
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                document.getElementById("card-errors").className = "alert alert-danger";
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
                document.getElementById("card-errors").className = "";

            }
        });

        cardButton.addEventListener('click', async (e) => {
            
            e.preventDefault();
            const { setupIntent, error } = await stripe.handleCardSetup(
                clientSecret, cardElement, {
                    payment_method_data: {
                        billing_details: { name: cardHolderName.value ? cardHolderName.value : "Test" }
                    }
                }
            );
            if (error) {
                // Display "error.message" to the user...
                console.log(error);
            } else {
                // The card has been verified successfully...
                submitForm(setupIntent);
            }
        });

        // Submit the form with the token ID.
        function submitForm(setupIntent) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'paymentMethod');
            hiddenInput.setAttribute('value', setupIntent.payment_method);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
<script src="{{ asset('js/plan.js') }}"></script>
@endsection
