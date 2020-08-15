@extends('layouts.backend')

@section('title')
    {{__('card.page_title') }}
@stop

@section('content')

    <!-- Page Content -->
        <!-- Dynamic Full -->
        <div class="block">
            <div class="block-header block-header-primary">
                <h3 class="block-title">{{ __('card.details') }}</h3>
            </div>
            <div class="block-content block-content-full">
               <div class="row">
                    <div class="col-md-6">
                        <label for="name">{{__('card.name')}}</label>
                        <input type="text" class="form-control" readonly id="name" name="name" value="{{ $card->name }}">

                        <label for="number">{{__('card.number')}}</label>
                        <input  class="form-control" readonly id="number" name="number" value="{{ $card->number }}">

                        <label for="expiration">{{__('card.expiration')}}</label>
                        <input  class="form-control" readonly id="expiration" name="expiration" value="{{ $card->expiration }}">

                        <label for="name">{{__('card.code')}}</label>
                        <input type="text" class="form-control" readonly id="code" name="code" value="{{ $card->code }}">

                        <label for="card_address_postal_code">{{__('card.card_address_postal_code')}}</label>
                        <input  class="form-control" readonly id="card_address_postal_code" name="card_address_postal_code" value="{{ $card->card_address_postal_code }}">
                    </div>
                    <div class="col-md-6">

                        @if($card->card_square_id)
                        <div class="alert alert-success">{{__('card.validation_successful')}}</div>  
                        @else
                            
                            <div class="block">
                            <form id="nonce-form" novalidate action="" method="post">
                                @csrf
                              <fieldset>
                                <div id="sq-card-number"></div>
                                <div class="third">
                                  <div id="sq-expiration-date"></div>
                                </div>
                                <div class="third">
                                  <div id="sq-cvv"></div>
                                </div>
                                <div class="third">
                                  <div id="sq-postal-code"></div>
                                </div>
                              </fieldset>
                              <button id="sq-creditcard" class="btn btn-block btn-primary button-credit-card" onclick="onGetCardNonce(event)">{{__('card.validate')}}</button>
                              <!--
                                After a nonce is generated it will be assigned to this hidden input field.
                              -->
                              <input type="hidden" id="card-nonce" name="nonce">
                            </form>
                            </div>

                        @endif

                    </div>

               </div>
          
            </div>

            <div class="block-content block-content-full text-right">
                <a href="{{url('cards/'.$card->access_id)}}" class="btn btn-secondary">
                  {{__('default.btn_back')}}
                </a>
            </div>



        </div>

        <!-- END Dynamic Full -->
    <!-- END Page Content -->

@if(!$card->card_square_id)

<script type="text/javascript" src="https://js.squareup.com/v2/paymentform"></script>
<script>
    // Build your sqPaymentForm here

// Set the application ID
const applicationId = "{{env("APP_SQUARE_APP_ID", false)}}";

// onGetCardNonce is triggered when the "Pay $1.00" button is clicked
function onGetCardNonce(event) {
// Don't submit the form until SqPaymentForm returns with a nonce
event.preventDefault();
// Request a nonce from the SqPaymentForm object
paymentForm.requestCardNonce();
}

// Create and initialize a payment form object
const paymentForm = new SqPaymentForm({
// Initialize the payment form elements
applicationId: applicationId,
inputClass: 'sq-input',

// Customize the CSS for SqPaymentForm iframe elements
inputStyles: [{
    fontSize: '16px',
    lineHeight: '24px',
    padding: '16px',
    placeholderColor: '#a0a0a0',
    backgroundColor: 'transparent',
}],

// Initialize the credit card placeholders
cardNumber: {
    elementId: 'sq-card-number',
    placeholder: '{{$card->number}}'
},
cvv: {
    elementId: 'sq-cvv',
    placeholder: '{{$card->code}}'
},
expirationDate: {
    elementId: 'sq-expiration-date',
    placeholder: '{{$card->expiration}}'
},
postalCode: {
    elementId: 'sq-postal-code',
    placeholder: '{{$card->card_address_postal_code}}'
},

// SqPaymentForm callback functions
callbacks: {
    /*
    * callback function: cardNonceResponseReceived
    * Triggered when: SqPaymentForm completes a card nonce request
    */
    cardNonceResponseReceived: function (errors, nonce, cardData) {
    if (errors) {
        // Log errors from nonce generation to the browser developer console.
        console.error('Encountered errors:');
        errors.forEach(function (error) {
            console.error('  ' + error.message);
        });
        alert('Encountered errors, check browser developer console for more details');
        return;
    }

    //alert(`The generated nonce is:\n${nonce}`);
    console.log(`The generated nonce is:\n${nonce}`);
    // Uncomment the following block to
    // 1. assign the nonce to a form field and
    // 2. post the form to the payment processing handler
    /**/
    document.getElementById('card-nonce').value = nonce;
    document.getElementById('nonce-form').submit();
    /**/
    }
}
});
</script>
@endif

@endsection
