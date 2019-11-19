@extends('layouts.app')

@section('content')
<div class="mw7 center ph3-ns mt4">
  <div class="cf ph2-ns">
    <div class="box bg-white pa3 mb3">
      <p class="tc fw6 mb4">Create your account and start monitor your favorite repositories on Github!</p>
      <form method="POST" action="{{ route('register') }}" id="payment-form">
        @csrf

        <div class="mb3">
          <label for="email" class="mb1 dib">E-Mail Address</label>

          <div class="">
            <input id="email" type="email" class="br2 f5 w-100 ba b--black-40 pa2 outline-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
            <span class="mv3 db ba b--light-red pv2 ph3" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="mb3">
          <label for="password" class="mb1 dib">Password</label>

          <div class="">
            <input id="password" type="password" class="br2 f5 w-100 ba b--black-40 pa2 outline-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
            <span class=" br3" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="mb4">
          <label for="password-confirm" class="mb1 dib">Confirm Password</label>

          <div class="">
            <input id="password-confirm" type="password" class="br2 f5 w-100 ba b--black-40 pa2 outline-0" name="password_confirmation" required autocomplete="new-password">
          </div>
        </div>

        @if (env('PAY_DURING_REGISTRATION') == true)
        <label for="card-element" class="dib mb2">
          Credit or debit card for the <strong>$10 one-time fee</strong> (handled by <a href="https://stripe.com">Stripe</a>)
        </label>
        <div id="card-element" class="mb4">
          <!-- A Stripe Element will be inserted here. -->
        </div>
        <!-- Used to display Element errors. -->
        <div id="card-errors" role="alert"></div>
        @endif

        <div class="mb-0">
          <div class=" offset-md-4 tc">
            <button class="pointer btn btn bg-white f5 ph3 pv2 fw4 br3 di-ns db w-100 w-50-ns mt3 mt0-ns mr3">
              💪 Start monitoring repositories
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
