@extends('base.base-auth-index') 
@section('content') 
<div class="card card-plain">
    <div class="card-header pb-0 text-start">
        <h4 class="font-weight-bolder">{{ $submenu}}</h4>
        <p class="mb-0">{{ $subdesc }}</p>
    </div>
    <div class="card-body">
        <form action="{{ route('auth.auth-signin-post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="login">Email or Username</label>
                <input
                    type="text"
                    class="form-control"
                    name="login"
                    placeholder="Input username or Email">
                @error('login')
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
            <div class="text-center">
                <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">{{ $submenu }}</button>
            </div>
        </form>
        @include('sweetalert::alert')
    </div>
    <div class="card-footer text-center pt-0 px-lg-2 px-1">
        <p class="mb-4 text-sm mx-auto">
            Lupa password?
            <a href="javascript:;" class="text-primary text-gradient font-weight-bold">Silahkan hubungi admin</a>
        </p>
        <p class="mb-4 text-sm mx-auto">
            Belum punya akun?
            <a href="{{ route('auth.auth-signup') }}" class="text-primary text-gradient font-weight-bold">Daftar disini</a>
        </p>
    </div>
</div>
@endsection