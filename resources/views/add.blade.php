@extends('layouts.app')

@section('content')
<div class="mw7 center ph3-ns mt4">
  <div class="cf ph2-ns">
    <div class="box bg-white pa3 mb3">
      <h3>Monitor a new repository on Github</h3>

      @if (session('error'))
      <div class="error ba pa2 mb3 br3">
        {{ session('error') }}
      </div>
      @endif
      <form method="POST" action="/create" class="mb1">
        @csrf

        https://github.com/
        <input class="br2 f5 w-30 ba b--black-40 pa2 outline-0" type="text" name="username" value="{{ old('username') }}" placeholder="username" required autofocus>
        /
        <input class="br2 f5 w-30 ba b--black-40 pa2 outline-0" type="text" name="repository" value="{{ old('repository') }}" placeholder="repository" required>
        <button type="submit" class="pointer btn btn bg-white f5 ph3 pv2 fw4 br3 di-ns db w-100 w-10-ns mt3 mt0-ns">Add</button>

        @if (env('PAY_TO_MONITOR') == true)
        <label for="card-element" class="dib mb2">
          Credit or debit card for the <strong>$10 one-time fee</strong> (handled by <a href="https://stripe.com">Stripe</a>)
        </label>
        <div id="card-element" class="mb4">
          <!-- A Stripe Element will be inserted here. -->
        </div>
        <!-- Used to display Element errors. -->
        <div id="card-errors" role="alert"></div>
        @endif
      </form>

      <p class="f7 silver">We'll check the repository every 5 minutes to check if statistics have changed.</p>
    </div>
  </div>
</div>
@endsection
