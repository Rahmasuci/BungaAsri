@extends('layouts.main')
@section('title', 'Register')
@section('content')
<!-- register -->
<div class="register">
    <div class="container">
        <h2>Register</h2>
        <div class="login-form-grids">
            <h5>Personal Information</h5>
            <form method="POST" action="{{route('register')}}">
            @csrf
                <input type="text" class="@error('name') is-invalid @enderror" name="name" value="{{old('name')}}" placeholder="Full Name" required>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="text" class="@error('no_tlp') is-invalid @enderror" name="no_tlp" value="{{old('no_tlp')}}" placeholder="Phone Number" required maxlength="13">
                @error('no_tlp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="text" class="@error('address') is-invalid @enderror" name="address" value="{{old('address')}}" placeholder="Full Address" required>
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            
            <h6>Login Information</h6>
                
                <input type="email" class="@error('email') is-invalid @enderror" name="email" value="{{old('email')}}" placeholder="Email" required="@">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="Password" required>
                <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="submit" value="Sign in">
            </form>
        </div>
        <div class="register-home">
            <a href="{{route('index')}}">Cancel</a>
        </div>
    </div>
</div>
<!-- //register -->
@endsection