<?php

namespace App\Http\Controllers;

use App\Http\Repository\QuestTypeRepository;
use App\Http\Requests\QuestTypeShowRequest;
use App\Http\Requests\QuestTypeStoreRequest;
use App\Http\Requests\QuestTypeUpdateRequest;
use Exception;
use Illuminate\Http\Request;

class QuestTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $questType = (new QuestTypeRepository($request))->forDatatable();
            return $questType;
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage()];
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestTypeStoreRequest $request)
    {
        try {
            $questType = (new QuestTypeRepository($request))->create();
            return ['message' => "Berhasil tambah data", "data" => $questType];
        } catch (Exception $th) {
            return ['message' => $th->getMessage()];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try {
            $questType = (new QuestTypeRepository($request))->get();
            return $questType;
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage()];
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(QuestTypeUpdateRequest $request)
    {
        try {
            $questType = (new QuestTypeRepository($request))->update();
            return ['message' => "Berhasil ubah data", "data" => $questType];
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage()];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuestTypeShowRequest $request)
    {
        try {
            $questType = (new QuestTypeRepository($request))->delete();
            return ['message' => "Berhasil hapus data", "data" => $questType];
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage()];
        }
    }
}
