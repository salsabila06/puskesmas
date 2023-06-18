@extends('layouts.auth')

@section('title')
    Login
@endsection

@section('content')
    <form method="POST" action="">
        @csrf
        <div class="form-group">
            <label for="username">Username</label>
            <input id="username" type="text" class="form-control" name="username"
                value="{{ old('username') ?? session('username') }}" tabindex="1" autofocus>
        </div>
        <div class="form-group">
            <div class="d-block">
                <label for="password" class="control-label">Password</label>
            </div>
            <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
        </div>

        <div class="form-group text-right">
            <a href="auth-forgot-password.html" class="float-left mt-3">
                Lupa Password?
            </a>
            <button type="submit" class="btn btn-success btn-lg btn-icon icon-right" tabindex="4">
                Login
            </button>
        </div>

        <div class="mt-5 text-center">
            Belum punya akun? <a href="/daftar">Daftar</a>
        </div>
    </form>
@endsection
