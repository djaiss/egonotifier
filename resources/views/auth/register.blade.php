@extends('layouts.app')

@section('content')
<div class="mw7 center ph3-ns mt4">
  <div class="cf ph2-ns">
    <div class="box bg-white pa3 mb3">
      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group row mb3">
          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

          <div class="col-md-6">
            <input id="name" type="text" class="br2 f5 w-100 ba b--black-40 pa2 outline-0 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group row mb3">
          <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

          <div class="col-md-6">
            <input id="email" type="email" class="br2 f5 w-100 ba b--black-40 pa2 outline-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group row mb3">
          <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

          <div class="col-md-6">
            <input id="password" type="password" class="br2 f5 w-100 ba b--black-40 pa2 outline-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group row mb3">
          <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

          <div class="col-md-6">
            <input id="password-confirm" type="password" class="br2 f5 w-100 ba b--black-40 pa2 outline-0" name="password_confirmation" required autocomplete="new-password">
          </div>
        </div>

        <div class="form-group row mb-0">
          <div class="col-md-6 offset-md-4">
            <button type="submit" class="pointer btn btn bg-white f5 ph3 pv2 fw4 br3 di-ns db w-100 w-20-ns mt3 mt0-ns mr3">
              {{ __('Register') }}
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
