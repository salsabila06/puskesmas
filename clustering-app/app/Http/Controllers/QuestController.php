<?php

namespace App\Http\Controllers;

use App\Http\Repository\QuestRepository;
use App\Http\Requests\QuestShowRequest;
use App\Http\Requests\QuestStoreRequest;
use App\Http\Requests\QuestUpdateRequest;
use Exception;
use Illuminate\Http\Request;

class QuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $questType = (new QuestRepository($request))->forDatatable();
            return $questType;
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage()];
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestStoreRequest $request)
    {
        try {
            $questType = (new QuestRepository($request))->create();
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
            $questType = (new QuestRepository($request))->get();
            return $questType;
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage()];
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestUpdateRequest $request)
    {
        try {
            $questType = (new QuestRepository($request))->update();
            return ['message' => "Berhasil ubah data", "data" => $questType];
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage()];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuestShowRequest $request)
    {
        try {
            $questType = (new QuestRepository($request))->delete();
            return ['message' => "Berhasil hapus data", "data" => $questType];
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage()];
        }
    }
}
