@extends('layouts.app')


@section('content')
<div class="profile">
    <div class="profile-header">
        <di
v class="profile-header-item">
            <h1>Edit Account</h1>
        </di>
    </div>
    <form action="{{ route('user.update') }}" method="POST">

        @csrf
        <div class="profile-info">
            <div class="profile-info-item">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" />
            </div>
            <div class="profile-info-item">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" />
            </div>
            <div class="profile-info-item">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" />
            </div>
            <div class="profile-info-item">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" name="confirm-password" id="confirm-password" />
            </div>

            <div class="profile-info-item">
                <button type="submit">Save</button>
            </div>
        </div>
    </form>
</div>



@endsection
