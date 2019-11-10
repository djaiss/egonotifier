@extends('layouts.app')

@section('content')
<div class="mw9 center ph3-ns">
  <div class="cf ph2-ns">
    <div class="fl w-100 w-20-ns pa2 pr4-ns">
      <ul class="list pa0 menu">
        <li class="bg-white pa3 bb b--moon-gray b active">Dashboard</li>
        <li class="bg-white pa3"><a href="/account">Account</a></li>
      </ul>
    </div>

    <div class="fl w-100 w-80-ns pa2">
      <h2>Monitored repositories <a href="/add" class="fr-ns db mt3 mt0-ns btn bg-white f5 ph3 pv2-ns pv3 fw4 br3">+ Add a repository</a></h2>
      <p class="lh-copy">Egonotifier will send you an email (on <span>{{ $email }}</span>) as soon as a repository reaches the next milestone for one of the three criteria (stars, forks or watchers).</p>

      @foreach ($sources as $source)
      <div class="box bg-white pa3 mb3">
        <p class="url ma0 pa2 mb4">{{ $source['url'] }}</p>
        <div class="mw9 center ph3-ns">
          <div class="cf">
            <!-- stars -->
            <div class="fl w-100 w-third-ns b--moon-gray br-ns">
              <h3 class="ma0 mb3 fw4">⭐️ Stars</h3>
              <div class="center">
                <div class="cf">
                  <div class="fl w-100 w-50-ns mb0-ns mb3">
                    <p class="ma0 f7 silver mb1">Current</p>
                    <p class="ma0 f3">{{ number_format($source['stars']) }}</p>
                  </div>
                  <div class="fl w-100 w-50-ns mb0-ns mb3">
                    <p class="ma0 f7 silver mb1">Next email at</p>
                    <p class="ma0 f3">{{ number_format($source['stars_next_level']) }}</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- forks -->
            <div class="fl w-100 w-third-ns b--moon-gray br-ns pl3-ns">
              <h3 class="ma0 mb3 fw4">🏗 Forks</h3>
              <div class="center">
                <div class="cf">
                  <div class="fl w-100 w-50-ns mb0-ns mb3">
                    <p class="ma0 f7 silver mb1">Current</p>
                    <p class="ma0 f3">{{ number_format($source['forks']) }}</p>
                  </div>
                  <div class="fl w-100 w-50-ns mb0-ns mb3">
                    <p class="ma0 f7 silver mb1">Next email at</p>
                    <p class="ma0 f3">{{ number_format($source['forks_next_level']) }}</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- watchers -->
            <div class="fl w-100 w-third-ns pl3-ns">
              <h3 class="ma0 mb3 fw4">🕶 Watchers</h3>
              <div class="center">
                <div class="cf">
                  <div class="fl w-100 w-50-ns mb0-ns mb3">
                    <p class="ma0 f7 silver mb1">Current</p>
                    <p class="ma0 f3">{{ number_format($source['watchers']) }}</p>
                  </div>
                  <div class="fl w-100 w-50-ns mb0-ns mb3">
                    <p class="ma0 f7 silver mb1">Next email at</p>
                    <p class="ma0 f3">{{ number_format($source['watchers_next_level']) }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <p class="mt3 ma0 f7 tr silver">Last checked {{ $source['check_last_date'] }}</p>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
