<?php

namespace App\Http\Repository;

use App\Models\Access;
use App\Models\Faskes;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuRepository
{


    public function getByRole()
    {
        try {
            return Access::with('menu:id_menu,menu_name,menu_icon,menu_url')->where('role_id', Auth::user()->role_id)->get(['menu_id']);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
}
