<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
<div class="container p-4">
    <div class="row">
        <div class="col-3">
            <a class="btn btn-primary" href="{{ route('index') }}">Main page</a>
        </div>
        <div class="col-9 d-flex justify-content-end">
        @auth
            <div class="d-flex">
            <b>{{ auth()->user()->name }}</b>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button>Sign out</button>
            </form>
            </div>
        @else
            <div class="d-flex">
                <a class="mx-3" href="{{ route('login') }}">Sign in</a>

                @if(\Route::has('register'))
                    <a href="{{ route('register') }}">Sign up</a>
                @endif
            </div>
        @endauth
        </div>
    </div>
    @if(!auth()->user()->hasVerifiedEmail())
    <div class="row">
        <div class="col p-3">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Verify your account!</strong> You should verify it by clicking on the link in your email inbox
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif
</div>

<div class="container">
    @yield('content') {{-- some html code will be here --}}
</div>
</body>
</html>
