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
  <meta name="twitter:image" content="https://egonotifier.com/img/twitter.png" />
</head>

<body class="marketing">
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
          <li class="di ma2">
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

  <div class="mw7 center ph3-ns">
    <div class="cf ph2-ns">
      <div class="fl w-100 pa2 pr4-ns tc">
        <h1 class="fw4">Be warned when your Github's repository grows</h1>
        <h2 class="fw4 lh-copy f4">Egonotifier monitors repositories you care about and sends you an email when they reach new milestones.</h2>
      </div>
    </div>
  </div>

  <div class="mw8 center ph3-ns mb4">
    <div class="cf ph2-ns">
      <div class="fl w-100 pa2 pr4-ns">
        <img class="db center ba b screenshot b--near-white br3" srcset="/img/homepage-1x.png,
                                        /img/homepage-2x.png 2x" />
      </div>
    </div>
  </div>

  <div class="mw7 center ph3-ns">
    <div class="cf ph2-ns">
      <div class="fl w-100 pa2 pr4-ns">
        <p class="tc mb4"><a href="/register" class="ph4 pv3 cta br3 no-underline">Get started</a></p>

        <p class="tc mb5 f6">It’s a free service. No strings attached.</p>

        <p class="lh-copy quote tc mb5">"I have a repository on Github, but I keep missing important milestones, like when it reached 500 stars."</p>

        <h3 class="tc f3 fw4">Can you relate to any of these?</h3>

        <ul class="pl0">
          <li>
            😡 You care a lot about your repository, but you forget to check if your repository grows.
          </li>
          <li>
            😡 You wish you were able to celebrate with your twitter followers every time you reach a new milestone.
          </li>
          <li>
            😡 You don't have time to monitor your repository's statistics.
          </li>
        </ul>

        <p class="lh-copy mb5">If any of these sounds like you, I have an awesome news for you! I came up with an easy, elegant and simple solution that will help you.</p>

        <h3 class="tc f3 fw4">But wait, do you know what you are talking about?</h3>

        <p class="lh-copy">I have the same problems that you have. I have <a href="https://github.com/monicahq/monica">a decently popular repository on Github</a>, but I always forget to check the number of stars (aka the graal for us, open source developers). I wish I could celebrate important milestones, the minute it happens, and not three months later when I realize that my repository has reached 1000 stars.</p>

        <p class="lh-copy mb5">I created Egonotifier because I care about my work, and I want to know if what I do is appreciated.</p>

        <h3 class="tc f3 fw4">How does it work?</h3>

        <p class="lh-copy">It’s really simple and comes down to three steps:</p>

        <ol>
          <li>
            Create your account,
          </li>
          <li>
            Indicate which repositories you want to monitor. It could be one of your repo, or any other public repo on Github.
          </li>
          <li>
            Wait for your repository to become popular and receive an email when it reaches specific milestone.
          </li>
        </ol>

        <p class="lh-copy mb5">That's it. <strong>Egonotifier will take care of checking the repositories you care about every day</strong>. More than every day in fact. It will make 288 checks per day, for each one of your repositories.</p>

        <h3 class="tc f3 fw4">Why don't you charge for this service?</h3>

        <p class="lh-copy mb5">Because I believe that the world would be better if everyone would provide cool stuff for free. Also, reputation.</p>

        <h3 class="tc f3 fw4">Are there hidden fees?</h3>

        <p class="lh-copy mb5">There are no hidden fees. I don't want to add another subscription to your life. I provide a simple service that I hope you'll like. In return, you could <a href="https://twitter.com/djaiss">follow me on Twitter</a>.</p>

        <h3 class="tc f3 fw4">Can I cancel at anytime?</h3>

        <p class="lh-copy mb5">Egonotifier doesn't require a subscription. Therefore you can't cancel. However, you can delete your account at anytime.</p>

        <h3 class="tc f3 fw4">Are there refunds?</h3>

        <p class="lh-copy mb5">But I just said... Ok. Calm down. No, there are no refunds because the service is free.</p>

        <h3 class="tc f3 fw4">Am I limited to my own repositories?</h3>

        <p class="lh-copy mb5">No. You can monitor any public repository on Github. Yours or someone else's.</p>

        <h3 class="tc f3 fw4">Pff. I could build this system myself.</h3>

        <p class="lh-copy mb5">Yeah, sure. It’s not rocket science to build something similar, but it takes time. If you really want to do it yourself, you know what? Egonotifier is <a href="https://github.com/djaiss/egonotifier">actually open source</a>, and you can run it yourself if you want. But... do you really want to?</p>

        <h3 class="tc f3 fw4">What about my privacy?</h3>

        <p class="lh-copy mb5">Like with my other webapp, I don't track users. I don't use any Google services: no Google Analytics, no Google Fonts. I don't sell data. The source code is available and this is exactly this code that is actually running in production. As a matter of fact, there are no tracking scripts at all on this domain. Fuck ads, fuck tracking.</p>

        <h3 class="tc f3 fw4">Why no OAuth with Github?</h3>

        <p class="lh-copy mb5">That would have given me access to your account, even with very basic permissions. I don't want to access your account.</p>

        <p class="tc mb6"><a href="/register" class="ph4 pv3 cta br3 no-underline">Get started</a></p>

        <p class="lh-copy note tc mb4">Made by <a href="https://twitter.com/djaiss">@djaiss</a> in Montréal, Canada in the year 2019.</p>
        <ul class="pl0 tc footer">
          <li class="mr3">🙈 You are not being tracked, and I don't do anything with your data.</li>
          <li class="mr3"><a href="https://github.com/djaiss/egonotifier">This project is open source</a> 😇</li>
        </ul>
      </div>
    </div>
  </div>
</body>

</html>
