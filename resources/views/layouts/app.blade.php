<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="dn db-m db-l">
        <nav class="flex justify-between bb b--white-10">
            <div class="flex-grow pa2 flex items-center">
                <inertia-link href="/home" class="mr3 no-underline pa2 bb-0">
                    <img src="/img/logo.svg" height="30" width="30" />
                </inertia-link>
                <div v-if="!noMenu">
                    <inertia-link :href="'/' + $page.auth.company.id + '/dashboard'" class="mr2 no-underline pa2 bb-0 special">
                        🏡 Home
                    </inertia-link>
                    <inertia-link :href="'/' + $page.auth.company.id + '/employees'" class="mr2 no-underline pa2 bb-0 special">
                        👫 Home
                    </inertia-link>
                    <a data-cy="header-find-link" class="mr2 no-underline pa2 bb-0 special" @click="showFindModal">
                        🔍 Home
                    </a>
                    <inertia-link v-if="$page.auth.company && $page.auth.employee.permission_level <= 200" :href="'/' + $page.auth.company.id + '/account'" data-cy="header-notifications-link" class="no-underline pa2 bb-0 special">
                        👮‍♂️ Adminland
                    </inertia-link>
                </div>
            </div>
            <div class="flex-grow pa2 flex items-center">
            </div>
        </nav>
    </div>

    @yield('content')
</body>

</html>
