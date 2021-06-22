@extends('layouts.main')
@section('title', 'Login')
@section('content')
<!-- login -->
<div class="login">
    <div class="container">
        <h2>Login</h2>
    
        <div class="login-form-grids animated wow slideInUp" data-wow-delay=".5s">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="email" name="email" placeholder="Email" class="@error('email') is-invalid @enderror" value="{{old('email')}}" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="password" name="password" placeholder="Password" class="@error('password') is-invalid @enderror" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="submit" value="Masuk">
            </form>
        </div>
        <h4>Don't have any account yet? Please sign up.</h4>
        <p><a href="{{route('register')}}">Sign Up</a></p>
    </div>
</div>
<!-- //login -->
@endsection