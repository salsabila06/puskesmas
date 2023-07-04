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
    protected $fillable;

    public function __construct(Request $request)
    {
        $this->fillable = [
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'faskes_id' => $request->faskes_id,
        ];

        if ($request->password) {
            $this->fillable['password'] = Hash::make($request->password);
        }

        if ($request->role_id) {
            $this->fillable['role_id'] = $request->role_id;
        }
        $this->request = $request;
    }


    public function create()
    {
        try {
            return User::create($this->fillable);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
    public function update()
    {
        try {
            return User::find($this->request->user_id)->update($this->fillable);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
    public function delete()
    {
        try {
            return User::find($this->request->user_id)->delete();
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
}
