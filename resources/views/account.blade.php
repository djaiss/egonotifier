@extends('layouts.app')

@section('content')
<div class="mw9 center ph3-ns">
  <div class="cf ph2-ns">
    <div class="fl w-100 w-20-ns pa2 pr4-ns">
      <ul class="list-app pa0 menu">
        <li class="bg-white pa3 bb b--moon-gray b"><a href="/home">Dashboard</a></li>
        <li class="bg-white pa3 active">Account</li>
      </ul>
    </div>

    <div class="fl w-100 w-80-ns pa2">
      <h2 class="fw5">Delete your account</h2>
      <p>Click here to <a href="/delete" onclick="return confirm('Are you sure?')">delete your account</a>.</p>
      <p>⚠️ There are no refunds, and we will destroy all of your account's data.</p>

    </div>
  </div>
</div>
@endsection
