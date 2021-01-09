@extends('layouts.main')

@section('content')
<div class="container'fluid">
    <div class="row m-0 justify-content-center">
        <div class="col-md-12">
            <div class="row m-0">
                <div class="col-12 p-0 mt-3">
                    @include('booking-rooms.messages')
                </div>
            </div>
            <div class="card">
                <div class="card-header">My Credits</div>

                <div class="card-body">
                    <p>Your credit: ${{ number_format($user->credits / 100, 2) }}</p>
                    <hr/>
                    <form action="{{ route('balance.add') }}" method="POST" id="checkout-form">
                        @csrf
                        <input type="hidden" name="payment_method" id="payment_method" value="" />
                        <div class="form-group">
                            <label for="amount">Add more credits</label>
                            <select name="amount" id="amount" class="form-control">
                                @foreach([10, 50, 100] as $amount)
                                    <option value="{{ $amount * 100 }}">${{ $amount }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-4">

                                <input id="card-holder-name" type="text" placeholder="Card holder name" class="form-control">

                                <!-- Stripe Elements Placeholder -->
                                <div id="card-element"></div>

                                <br />
                                <button id="card-button" class="btn btn-primary">
                                    Add
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
      $(document).ready(function() {
        let stripe = Stripe('pk_test_51HcpVcBvDTZVSQWWyjPIGrbsaRXdIaMTMNQL8DWgMcxmu87VIbpPSDKV57UlXTCmdt19K62xCRPI6AakfEfhm1TB00dF8VNZJM')

        let elements = stripe.elements()
        let style = {
          base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
              color: '#aab7c4'
            }
          },
          invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
          }
        }

        let card = elements.create('card', {style: style})
        card.mount('#card-element')
        let paymentMethod = null
        $('#checkout-form').on('submit', function (e) {
          $('#card-button').prop('disabled',true);
          if (paymentMethod) {
            return true
          }
          stripe.confirmCardSetup(
            "{{ $intent->client_secret }}",
            {
              payment_method: {
                card: card,
                billing_details: {name: $('#card-holder-name').val()}
              }
            }
          ).then(function (result) {
            if (result.error) {
              console.log(result)
              alert('error')
            } else {
              paymentMethod = result.setupIntent.payment_method
              $('#payment_method').val(paymentMethod)
              $('#checkout-form').submit()
            }
          })
          return false
        })
      });
    </script>
@endsection

@section('style')
    <style>
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }
        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }
        .StripeElement--invalid {
            border-color: #fa755a;
        }
        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
@endsection
