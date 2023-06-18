<?php

namespace App\Http\Controllers;

use App\Models\FaskesType;
use Illuminate\Http\Request;

class FaskesTypeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            return FaskesType::all(['id_faskes_type', 'faskes_type_name']);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
