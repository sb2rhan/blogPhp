<h1>Sign in</h1>

@if(\Route::has('register'))
    <a href="{{ route('register') }}">Sign up</a>
@endif

<form action="{{ route('login') }}" method="post">
    @csrf

    <div>
        <label for="email">Email</label>
        <input value="{{ old('email') }}" name="email" id="email" type="email" required autofocus />
        @error('email')
        <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required/>
        @error('password')
        <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="remember">
            <input {{ old('remember') ? 'checked' : '' }} type="checkbox" name="remember" />
            Remember
        </label>
    </div>

    <button>Sign in</button>
</form>
