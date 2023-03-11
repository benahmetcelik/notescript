<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (!isset($note))
    @php
    $title = 'Home';
    @endphp
    @else
    @php
    $title = $note->title;
    @endphp
    @endif
    <title>{{ $title.' | '.$settings->site_title }}</title>

    <meta name="title" content="{{ $title.' | '.$settings->site_title }}">
<meta name="description" content="{{ $settings->site_description }}">
<meta name="keywords" content="{{ $settings->site_keywords }}">
<meta name="robots" content="index, follow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="language" content="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta name="author" content="Benahmetcelik">
<meta name="theme-color" content="{{ $colors->primary }}">
<meta name="msapplication-navbutton-color" content="{{ $colors->primary }}">
<meta name="apple-mobile-web-app-status-bar-style" content="{{ $colors->primary }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="{{ $settings->site_favicon }}" type="image/x-icon" />
<meta property="og:url"                content="{{ request()->url() }}" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="{{ $title.' | '.$settings->site_title }}" />
<meta property="og:description"        content="{{ $settings->site_description }}" />
<meta property="og:image"              content="{{ $settings->site_logo }}" />
    <style>
        /* :root{
    --primary-color: #e99c04;
    --secondary-color: #241a06;
    --tertiary-color: #00b0d7;
} */

:root{
    --primary-color: {{ $colors->primary }};
    --secondary-color: {{ $colors->second }};
    --tertiary-color: {{ $colors->tertiary }};
}
    </style>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />


</head>
<body>

        <div class="header">
            <a class="logo" href="{{ route('home') }}">
                <img src="{{ $settings->site_logo }}" alt="logo" />
            </a>

            <div class="actions">
                <ul>
                    @auth
                    @if (Auth::user()->role == 'admin')
                    <li><a href="{{ route('admin') }}">Admin Panel</a></li>
                    @endif
                    <li><a href="{{ route('user') }}">Edit Account</a></li>
                    <li><a href="{{ route('my-notes') }}">My Notes</a></li>
                    <li><a href="{{ route('fast-logout') }}">Logout</a></li>

                    @endauth
                    @guest
                    @if ($settings->register_status == 1)


                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                    @endif
                    @endguest


                </ul>
            </div>

        </div>


        <div class="body">


            @yield('content')



        </div>

        @stack('modal')


        <script src="/assets/js/scripts.js"></script>
        <div class="footer">
            <b>{{ $settings->site_footer }}</b>
        </div>


</body>
</html>
