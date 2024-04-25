@extends('base.base-auth-index') 
@section('content') 
<div class="card card-plain">
    <div class="card-header pb-0 text-start">
        <h4 class="font-weight-bolder">{{ $submenu}}</h4>
        <p class="mb-0">{{ $subdesc }}</p>
    </div>
    <div class="card-body">
        <form action="{{ route('auth.auth-signup-post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Full Name</label>
                <input
                    type="text"
                    class="form-control"
                    name="name"
                    placeholder="Input full name">
                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    class="form-control"
                    name="email"
                    placeholder="Input email">
                @error('email')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input
                    type="text"
                    class="form-control"
                    name="username"
                    placeholder="Input username">
                @error('username')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input
                    type="text"
                    class="form-control"
                    name="phone"
                    placeholder="Input phone number">
                @error('phone')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    class="form-control"
                    name="password"
                    placeholder="Input password">
                @error('password')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input
                    type="password"
                    class="form-control"
                    name="password_confirmation"
                    placeholder="Confirm password">
                @error('password_confirmation')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">{{ $submenu }}</button>
            </div>
        </form>
        @include('sweetalert::alert')
    </div>
    <div class="card-footer text-center pt-0 px-lg-2 px-1">
        <p class="mb-4 text-sm mx-auto">
            Sudah punya akun?
            <a href="{{ route('auth.auth-signin') }}" class="text-primary text-gradient font-weight-bold">Masuk di sini</a>
        </p>
    </div>
</div>
@endsection
