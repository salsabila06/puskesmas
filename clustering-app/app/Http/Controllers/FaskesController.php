<?php

namespace App\Http\Controllers;

use App\Http\Repository\FaskesRepository;
use App\Http\Repository\UserRepository;
use App\Http\Requests\FaskesShowRequest;
use App\Http\Requests\FaskesStoreRequest;
use App\Http\Requests\FaskesUpdateRequest;
use App\Http\Resources\FaskesResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaskesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $faskes = (new FaskesRepository($request))->forDatatable();
            return $faskes;
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage()];
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FaskesStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $faskes = (new FaskesRepository($request))->create();
            $request->merge(['role_id' => ROLE_FASKES, 'faskes_id' => $faskes->id_faskes]);
            $user = (new UserRepository($request))->create();
            DB::commit();
            return ['message' => "Berhasil tambah data", "data" => $faskes];
        } catch (Exception $th) {
            DB::rollBack();
            return ['message' => $th->getMessage()];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FaskesShowRequest $request)
    {
        try {
            $faskes = (new FaskesRepository($request))->get();
            return new FaskesResource($faskes);
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage()];
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaskesUpdateRequest $request)
    {
        try {
            DB::beginTransaction();
            $questType = (new FaskesRepository($request))->update();
            (new UserRepository($request))->update();
            DB::commit();
            return ['message' => "Berhasil ubah data", "data" => $questType];
        } catch (\Throwable $th) {
            DB::rollBack();
            return ['message' => $th->getMessage()];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FaskesShowRequest $request)
    {
        try {
            DB::beginTransaction();
            (new FaskesRepository($request))->delete();
            (new UserRepository($request))->delete();
            DB::commit();
            return ['message' => "Berhasil hapus data"];
        } catch (\Throwable $th) {
            DB::rollBack();
            return ['message' => $th->getMessage()];
        }
    }
}
