@extends('layouts.app')

@section('content')




<div class="form">
    <div class="texts">
        <h1>Register Form</h1>
        <span>
            <a href="login.html">You have an account?</a>
        </span>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <input id="name" placeholder="Name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus/>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <input id="email" placeholder="E-Mail" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <input id="password" placeholder="Pass" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    @error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
<input id="password-confirm" placeholder="Pass" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

        <input type="submit" value="Register" />
    </form>
</div>

@endsection
