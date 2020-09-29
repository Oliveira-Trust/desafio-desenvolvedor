@extends('layouts.app')
@section('title','Carrinho')
@section('content',)

<div class="row">
	<div class="col-sm-6 col-md4 col-md-offset-4  col-md-offset-3">

		<form action="{{url ('pagamento')}}" method="post" id="payment-form">
			@csrf
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
						<label for="nome">Nome:</label>
						<input type="text" id="nome" class="form-control" value= "Leonardo"required>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="form-group">
						<label for="endereco">Endereço:</label>
						<input type="text" id="endereco" class="form-control" value= "Leonardo" required>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="form-group">
						<label for="nomeCartao">Nome no Cartão:</label>
						<input type="text" id="nomeCartao" class="form-control" value= "Leonardo" required="">
					</div>
				</div>

			</div>
			<div class="col-xs-12">
				<div class="form-group">
					<label for="card-element">
						Credit or debit card
					</label>
					<div id="card-element">
						<!-- A Stripe Element will be inserted here. -->
					</div>

					<!-- Used to display form errors. -->
					<div id="card-errors" role="alert">
						
					</div>
				</div>
			</div>
		
		<button id="checkout-button" type="submit" class="btn btn-success">Comprar</button>
		<div class="col-sm-16 col-md-6 col-md-offset-3 col-sm-offset-3">
			<strong>Total: {{$total}}</strong>
		</div>		</div>
	</form>
</div>
</div>
<script>
	// Create a Stripe client.
	var stripe = Stripe('pk_test_51HUvI5LQLXuCAcHb4JuHjpBbMHHjwc8oUzJnOXOyoDRQm8S7ZesH9I0CagfCoy9PZNn6sXZjFRxOW63rYUiPgzBe00Vw1Xyfjg');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
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
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
	var displayError = document.getElementById('card-errors');
	if (event.error) {
		displayError.textContent = event.error.message;
	} else {
		displayError.textContent = '';
	}
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
	event.preventDefault();

	stripe.createToken(card).then(function(result) {
		if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
  } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
  }
});
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
</script>
@endsection

