<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
</head>
<body>
<div>
    <a href="{{ route('index') }}">Main page</a>

    @auth
        <div style="display: flex;">
            {{ auth()->user()->name }}
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button>Sign out</button>
            </form>
        </div>
    @else
        <a href="{{ route('login') }}">Sign in</a>

        @if(\Route::has('register'))
            <a href="{{ route('register') }}">Sign up</a>
        @endif
    @endauth
</div>

@yield('content') {{-- some html code will be here --}}
</body>
</html>
