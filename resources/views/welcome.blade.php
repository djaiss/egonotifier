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
        <a href="/home"><img src="/img/logo.png" width="86" height="19" /></a>
      </div>
      <div class="flex-grow pa2 flex items-center">
        <a href="/logout">Logout</a>
      </div>
    </nav>
  </div>

  <div class="mw7 center ph3-ns">
    <div class="cf ph2-ns">
      <div class="fl w-100 pa2 pr4-ns">
        <h2>Be warned when your Github's repository grows</h2>
        <p class="lh-copy">Egonotifier monitors repositories you care about and sends you an email when they reach new milestones.</p>

        <h3>Get started</h3>

        <p class="lh-copy">I have a repository on Github, but I keep missing important milestones, like when it reached 500 stars.</p>

        <h3>Can you relate to any of these?</h3>

        <ul>
          <li>
            You care a lot about your repository, but you forget to check if your repository grows.
          </li>
          <li>
            You care a lot about your repository, but you forget to check if your repository grows.
          </li>
          <li>
            You wish you were able to celebrate with your twitter followers every time you reach a new milestone.
          </li>
          <li>
            You don't have time to monitor your repository's statistics.
          </li>
        </ul>

        <p class="lh-copy">If any of these sounds like you, I have an awesome news for you! I came up with an easy, elegant and simple solution that will help you.</p>

        <h3>But wait, do you know what you are talking about?</h3>

        <p class="lh-copy">I have the same problems that you have. I have a decently popular repository on Github, but I forget to check the number of stars (aka the graal for us, developers). I wish I could celebrate important milestones, the minute it happens, and not three months later when I realize that my repository has reached 1000 stars.</p>

        <p class="lh-copy">I created Egonotifier because I care about my work, and I want to know if what I do is appreciated.</p>

        <h3>How does it work?</h3>

        <p class="lh-copy">It’s really simple and comes down to three steps:</p>

        <ul>
          <li>
            1. Create your account,
          </li>
          <li>
            2. Pay a one-time fee (more on that later),
          </li>
          <li>
            3. Indicate which repositories you want to monitor. It could be one of your repo, or any other public repo on Github.
          </li>
          <li>
            4. Wait for your repository to become popular and receive an email when it reaches specific milestone.
          </li>
        </ul>

        <p class="lh-copy">That's it. Egonotifier will take care of checking the repositories you care about every day. More than every day in fact. It will make 288 checks per day, for each one of your repositories.</p>

        <h3>Why are you charging for this service?</h3>

        <p class="lh-copy">Egonotifier will warn you by email. If you want to receive the email, I need to use a service that will make sure the email will actually be delivered to your inbox and not get caught in a spam filter somewhere. I use the awesome Postmark for this, but it’s not cheap. By charging a one-time fee, I make sure that I will cover these costs and the cost of the service itself.</p>

        <h3>Is it really a one-time fee?</h3>

        <p class="lh-copy">Yes. I don't want to add another subscription to your life. I provide a simple service with a great value, for a fair, fixed, non-recurring fee.</p>

        <h3>Can I cancel at anytime?</h3>

        <p class="lh-copy">Egonotifier doesn't have a subscription. There is a single, one-time fee. So you can't cancel. However, you can delete your account at anytime.</p>

        <h3>Am I limited to my own repositories?</h3>

        <p class="lh-copy">No. You can monitor any public repository on Github. Yours or someone else's.</p>

        <h3>Pff. I could build this system myself.</h3>

        <p class="lh-copy">Yeah, sure. It’s not rocket science to build something similar, but it takes time. If you really want to do it yourself, you know what? Egonotifier is actually open source, and you can run it yourself if you want. But... do you really want to?</p>

        <h3>What about my privacy?</h3>

        <p class="lh-copy">Like with my other webapp, I don't track users. I don't use any Google services: no Google Analytics, no Google Fonts. I don't sell data. The source code is available. As a matter of fact, there are no tracking scripts at all on this domain. Fuck ads, fuck tracking.</p>

        Get started

        <p class="lh-copy">Made by @djaiss in Canada. 2019. A <a href="https://monicahq.com">Monica</a> product.</p>
      </div>
    </div>
  </div>
</body>

</html>
