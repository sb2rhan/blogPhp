<h1>Sign up</h1>

<a href="{{ route('login') }}">Sign in</a>

<form action="{{ route('register') }}" method="post">
    @csrf

    <div>
        <label for="name">Name</label>
        <input value="{{ old('name') }}" name="name" id="name" type="text" required autofocus />
        @error('name')
        <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="email">Email</label>
        <input value="{{ old('email') }}" name="email" id="email" type="email" required />
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
        <label for="password_confirmation">Confirm password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required/>
    </div>

    <button>Sign up</button>
</form>
