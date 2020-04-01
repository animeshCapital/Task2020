@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <select name="plan" id="plans">
                    @foreach($plans as $key=>$plan)
                        <option value="{{$plan}}">{{$key}}</option>
                    @endforeach        
                    </select>   
                    <input id="card-holder-name" type="text">

                    <!-- Stripe Elements Placeholder -->
                    <div id="card-element"></div>
                    
                    <button id="card-button" data-secret="{{ $intent->client_secret }}">
                        Update Payment Method
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        window.addEventListener('load', function() {
            const stripe = Stripe('{{env("STRIPE_KEY")}}');;
            const elements = stripe.elements();
            const cardElement = elements.create('card');
            cardElement.mount('#card-element');
            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;
            const plan = document.getElementById('plans').value;
            cardButton.addEventListener('click', async (e) => {
                const { setupIntent, error } = await stripe.handleCardSetup(
                    clientSecret, cardElement, {
                        payment_method_data: {
                            billing_details: { name: cardHolderName.value }
                        }
                    }
                );
                if (error) {
                    // Display "error.message" to the user...
                } else {
                    // The card has been verified successfully...
                    console.log('handling success', setupIntent.payment_method);
                    axios.post('/subscribe',{
                        payment_method: setupIntent.payment_method,
                        plan : plan
                    }).then((data)=>{
                        location.replace(data.data.success_url)
                    });
                }
            });
        })
    </script>
@stop
