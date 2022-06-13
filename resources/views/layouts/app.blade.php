<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    @yield('admin-style')
</head>
<body>
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>

    <script src="{{ mix('/js/app.js') }}" defer></script>
    @yield('admin-scripts')
</body>
</html>
