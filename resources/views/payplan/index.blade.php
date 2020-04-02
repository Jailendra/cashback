@extends('layouts.app')

@section('content')

<div class="container mb-5 mt-5">
    @include('shared.errors')
    @include('shared.success')
    <!-- Used to display form errors. -->
    <div id="card-errors"></div>
    <form method="POST" action="{{route('subscriptions-purchase')}}" id="payment-form">
    @csrf
    <div class="profileSetting">
      <h1 class="text-center">Subscription</h1>
      <div class="profileSettingInner">
        <h2>Card Details</h2>
        <div class="profileInner">
          <p><small>Note: If you want to change your fixed settings, contact the <a href="#">Customer Support Team</a></small></p>
          <div class="pricing card-deck flex-column flex-md-row mb-3">
        @foreach($payplans as $payplan)
        <div class="card card-pricing text-center px-3 mb-4">
            <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm text-capitalize">{{ $payplan->nickname }}</span>
            <div class="text-capitalize">
                {{ $payplan->metadata->description }}
            </div>
            <div class="bg-transparent card-header pt-4 border-0">
                <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="15">$<span class="price">{{ number_format(($payplan->amount /100), 2, '.', ' ') }}</span><span class="h6 text-muted ml-2">/ {{ $payplan->interval_count }} {{ $payplan->interval }}</span></h1>
            </div>
            <div class="card-body pt-0">
                <ul class="list-unstyled mb-2">
                </ul>
                <label class="switch">
                <input type="checkbox" name="plan" id="plan_{{$payplan->id}}" value="{{$payplan->id}}" class="check">
                <span class="slider round"></span>
                <span class="absolute-no">NO</span>
                </label>
            </div>
        </div>
        @endforeach
    </div>
    <div class="stripeGateway">
    <div class="row align-items-end">
    <div class="col-md-4">
        <div class="form-group">
            <label>Card holder name*</label>
            <input type="text" id="card-holder-name" name="card_holder_name" class="form-control" placeholder="Card holder name">
        </div>
        </div>
        <!-- Stripe Elements Placeholder -->
        <div class="col-md-8">
        <div id="card-element"></div>
        </div>
        </div>
        </div>
       
        <div class="form-group text-right">
            <button type="submit" class="btn btn-lg btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">SUBMIT</button>
        </div>
        </div>
      </div>
    </div>
    </form>

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
                        billing_details: { name: cardHolderName.value }
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
</div>

<script src="{{ asset('js/plan.js') }}"></script>
@endsection