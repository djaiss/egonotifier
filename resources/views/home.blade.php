@extends('layouts.app')

@section('content')
<div class="">
  @if (session('error'))
  <div class="alert alert-success">
    {{ session('error') }}
  </div>
  @endif
  <form method="POST" action="/create">
    @csrf
    <input type="text" name="username" value="{{ old('email') }}" required autofocus>
    <input type="text" name="repository" value="{{ old('email') }}" required autofocus>
    <button type="submit" class="btn btn-primary">Add</button>
  </form>

  <ul>
    @foreach ($sources as $source)
    <li>{{ $source['url'] }}</li>
    <li>{{ $source['watchers'] }} watchers | {{ $source['stars'] }} stars | {{ $source['forks'] }} forks</li>
    <li>Next warning: {{ $source['watchers_next_level'] }}</li>
    @endforeach
  </ul>
</div>
@endsection
