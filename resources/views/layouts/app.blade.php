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
</head>

<body>
  <div class="dn db-m db-l">
    <nav class="flex justify-between bb b--white-10 pa3">
      <div class="flex-grow pa2 flex items-center">
        <a href="/"><img src="/img/logo.png" width="86" height="19" /></a>
      </div>
      @if (Auth::check())
      <div class="flex-grow pa2 flex items-center">
        <a href="/logout">Logout</a>
      </div>
      @else
      <div class="flex-grow pa2 flex items-center">
        <a href="/login">Login</a>
      </div>
      @endif
    </nav>
  </div>

  @yield('content')
</body>

</html>
