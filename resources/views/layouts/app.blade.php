<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="iRacing race planner and season guide">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>myRacing - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@forevolve/bootstrap-dark@1.1.0/dist/css/bootstrap-dark.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css?v=3') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>
<body>

<div id="loader">
    <div class="loader-content absolute-center">
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

<div class="shadow-lg sticky navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <div class="container">
        <div class="ml-3 logo">
            <a href="{{ route('dashboard') }}"><img src="/img/logo.png"/></a>
        </div>
        <nav class="navbar">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link {{ (Route::currentRouteName() == 'dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Route::currentRouteName() == 'planner') ? 'active' : '' }}" href="{{ route('planner') }}">Planner</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Route::currentRouteName() == 'stats') ? 'active' : '' }}" href="{{ route('stats') }}">Stats</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<main class="container">
    <div class="p-1 rounded">
        @yield('content')
    </div>
</main>

<hr/>
<footer class="d-flex justify-content-center flex-nowrap mb-3">
    <div>
        <a href="https://github.com/mwgg/myRacing_v2" target="_blank">Source code</a>
        <span>·</span>
        <a href="{{ route('export') }}">Export / Import</a>
        <span>·</span>
        <a href="{{ route('help') }}">Help</a>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
<script src="{{ url('/js/myracing.js?v=7') }}"></script>
@stack('scripts')
</body>
</html>
