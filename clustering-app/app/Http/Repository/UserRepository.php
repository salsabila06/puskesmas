<?php

namespace App\Http\Repository;


use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = [
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'faskes_id' => $request->faskes_id,
            'role_id' => $request->role_id
        ];
    }


    public function create()
    {
        try {
            return User::create($this->request);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
}
