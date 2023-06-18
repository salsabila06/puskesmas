@extends('layouts.auth')

@section('title')
    Register
@endsection

@section('content')
    <form method="POST" action="">
        @csrf
        <div class="form-group">
            <label for="fullname">Fullname</label>
            <input id="fullname" type="text" class="form-control" name="fullname" tabindex="1" autofocus>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input id="username" type="text" class="form-control" name="username" tabindex="2">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="text" class="form-control" name="email" tabindex="3">
        </div>
        <div class="form-group">
            <label for="faskes_name">Nama Puskesmas</label>
            <input id="faskes_name" type="text" class="form-control" name="faskes_name" tabindex="4">
        </div>

        <div class="form-group row">
            <div class="col">
                <label for="faskes_type">Tipe Puskesmas</label>
                <select class="custom-select faskes_type" name="faskes_type" id="faskes_type" tabindex="5">
                    <option selected disabled>Pilih Tipe</option>
                </select>
            </div>
            <div class="col">
                <label for="district">Kecamatan</label>
                <select class="custom-select" name="district" id="district" tabindex="6">
                    <option selected disabled>Pilih Kecamatan</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="faskes_establish" class="control-label">Tanggal Dibangun</label>
            <input id="faskes_establish" type="date" class="form-control" name="faskes_establish" tabindex="8">
        </div>
        <div class="form-group">
            <label for="password" class="control-label">Password</label>
            <input id="password" type="password" class="form-control" name="password" tabindex="9">
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="control-label">Konfimasi Password</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                tabindex="10">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block btn-lg btn-icon icon-right" tabindex="11">
                Daftar
            </button>
        </div>

        <div class="mt-5 text-center">
            Sudah punya akun? <a href="/">Login</a>
        </div>
    </form>

    @push('js')
        <script src="{{ asset('assets/js/register.js') }}"></script>
    @endpush
@endsection
