<?php

namespace App\Http\Controllers;

use App\Http\Repository\FaskesRepository;
use App\Http\Repository\UserRepository;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    function index()
    {
        return view('pages.auth.login');
    }
    function daftar()
    {
        return view('pages.auth.register');
    }
    public function login(LoginRequest $request)
    {

        try {

            $auth = Auth::attempt(['username' => $request->username, 'password' => $request->password]);

            if (!$auth) return back()->withErrors('Mohon maaf. periksa kembali password anda')->with('username', $request->username);

            $user = Auth::user();

            Auth::login($user);

            return redirect()->intended('/dashboard');
        } catch (\Throwable $th) {
            return redirect('')->withErrors($th->getMessage());
        }
    }
    public function regist(RegistRequest $request)
    {

        try {

            DB::beginTransaction();

            $faskes = (new FaskesRepository($request))->create();
            $request->merge(['role_id' => 2, 'faskes_id' => $faskes->id_faskes]);
            $user = (new UserRepository($request))->create();
            DB::commit();

            return redirect('')->with('success', 'Selamat Puskesmas anda berhasil didaftarkan silahkan login.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect('/daftar')->withErrors($th->getMessage());
        }
    }

    function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->flush();
            return redirect('')->with('success', 'Selamat anda berhasil keluar dari platform.');
        } catch (\Throwable $th) {
            return redirect('/daftar')->withErrors($th->getMessage());
        }
    }
}
