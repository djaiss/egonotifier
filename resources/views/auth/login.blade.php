@extends('layouts.app')

@section('content')
<div class="mw7 center ph3-ns mt4">
  <div class="cf ph2-ns">
    <div class="box bg-white pa3 mb3">
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb3">
          <label for="email" class="mb2 dib">{{ __('E-Mail Address') }}</label>

          <div class="col-md-6">
            <input id="email" type="email" class="br2 f5 w-100 ba b--black-40 pa2 outline-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="mb2">
          <label for="password" class="mb2 dib">{{ __('Password') }}</label>

          <div class="col-md-6">
            <input id="password" type="password" class="br2 f5 w-100 ba b--black-40 pa2 outline-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class=" mb4">
          <div class="col-md-6 offset-md-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

              <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
              </label>
            </div>
          </div>
        </div>

        <div class=" mb-0">
          <div class="col-md-8 offset-md-4">
            <button type="submit" class="pointer btn btn bg-white f5 ph3 pv2 fw4 br3 di-ns db w-100 w-10-ns mt3 mt0-ns mr3">
              {{ __('Login') }}
            </button>

            @if (Route::has('password.request'))
            <a class="no-underline mt0-ns mt3 db di-ns" href="{{ route('password.request') }}">
              {{ __('Forgot Your Password?') }}
            </a>
            @endif
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
