<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        try {
            return District::all(['id_district', 'district_name']);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
