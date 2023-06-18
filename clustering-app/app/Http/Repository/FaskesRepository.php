<?php

namespace App\Http\Repository;

use App\Models\Faskes;
use Exception;
use Illuminate\Http\Request;

class FaskesRepository
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = [
            'faskes_name' => $request->faskes_name,
            'faskes_type_id' => $request->faskes_type,
            'district_id' => $request->district,
            'faskes_establish' => $request->faskes_establish,
            'faskes_code' => Faskes::GenerateCode(),
        ];
    }


    public function create()
    {
        try {
            return Faskes::create($this->request);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
}
