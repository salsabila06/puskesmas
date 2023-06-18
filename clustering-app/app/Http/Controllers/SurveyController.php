<?php

namespace App\Http\Controllers;

use App\Http\Repository\QuestRepository;
use App\Http\Repository\SurveyDetailRepository;
use App\Http\Repository\SurveyRepository;
use App\Http\Requests\SurveyShowRequest;
use App\Http\Requests\SurveyStoreRequest;
use App\Http\Requests\SurveyUpdateRequest;
use App\Models\Quest;
use App\Models\SurveyDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $survey = (new SurveyRepository($request))->forDatatable();
            return $survey;
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage()];
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SurveyStoreRequest $request)
    {
        try {

            DB::beginTransaction();

            $survey = (new SurveyRepository($request))->create();
            $quest = (new QuestRepository($request))->get()->pluck('id_quest');
            $request->merge(['quest_id' => $quest, 'id_survey' => $survey->id_survey]);
            (new SurveyDetailRepository($request))->create();

            DB::commit();
            return ['message' => "Berhasil tambah data", "data" => $survey];
        } catch (Exception $th) {
            DB::rollBack();
            return ['message' => $th->getMessage()];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SurveyShowRequest $request)
    {
        try {
            $questType = (new SurveyRepository($request))->get();
            return $questType;
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage()];
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(SurveyUpdateRequest $request)
    {
        try {

            DB::beginTransaction();
            $survey = (new SurveyRepository($request))->update();
            $quest = (new QuestRepository($request))->get()->pluck('id_quest');
            $request->merge(['quest_id' => $quest]);
            (new SurveyDetailRepository($request))->update();
            DB::commit();
            return ['message' => "Berhasil ubah data", "data" => $survey];
        } catch (\Throwable $th) {
            DB::rollBack();
            return ['message' => $th->getMessage()];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SurveyShowRequest $request)
    {
        try {

            $questType = (new SurveyRepository($request))->delete();

            return ['message' => "Berhasil hapus data", "data" => $questType];
        } catch (\Throwable $th) {

            return ['message' => $th->getMessage()];
        }
    }
}
