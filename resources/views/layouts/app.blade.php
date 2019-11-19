<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <script src="{{ mix('/js/app.js') }}" defer></script>
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:creator" content="@djaiss" />
  <meta property="og:title" content="Be warned when your Github's repository grows" />
  <meta property="og:description" content="Egonotifier monitors repositories you care about and sends you an email when they reach new milestones." />
  <meta property="og:image" content="https://egonotifier.com/img/twitter.png" />
</head>

<body>
  <div class="dn db-m db-l">
    <nav class="flex justify-between bb b--white-10 pa3">
      <div class="flex-grow pa2 flex items-center">
        <a href="/"><img src="/img/logo.png" width="116" height="19" /></a>
      </div>
      @if (Auth::check())
      <div class="flex-grow pa2 flex items-center">
        <a href="/logout">Logout</a>
      </div>
      @else
      <div class="flex-grow pa2 flex items-center">
        <ul class="list">
          <li class="di mr2">
            <a href="/register">Register</a>
          </li>
          <li class="di">
            <a href="/login">Login</a>
          </li>
        </ul>
      </div>
      @endif
    </nav>
  </div>

  @yield('content')

  <script src="https://js.stripe.com/v3/"></script>

  @if(Route::currentRouteName() == 'register')
  <script>
    // Custom styling can be passed to options when creating an Element.
    var style = {
      base: {
        // Add your base input styles here. For example:
        fontSize: '16px',
        color: "#32325d",
      }
    };
    var stripe = Stripe('{{ env('
      STRIPE_PK ') }}');

    // Create an instance of the card Element.
    var elements = stripe.elements();
    var card = elements.create('card', {
      style: style
    });

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Create a token or display an error when the form is submitted.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
      event.preventDefault();

      stripe.createToken(card).then(function(result) {
        if (result.error) {
          // Inform the customer that there was an error.
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
  @endif
</body>

</html>
