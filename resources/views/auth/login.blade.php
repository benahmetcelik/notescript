@extends('layouts.app')

@section('content')


<div class="form">
    <div class="texts">
        <h1>Login Form</h1>
        <span>
            <a href="{{ route('register') }}">You haven't an account?</a>
        </span>
    </div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" class=" @error('email') is-invalid @enderror" placeholder="E-Mail" />
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
        <input type="password"  class=" @error('password') is-invalid @enderror" placeholder="Password"  name="password" required autocomplete="current-password" />


        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
        <input type="submit" value="Login" />
    </form>
</div>


@endsection
