<?php

namespace App\Http\Controllers;

use App\Http\Repository\SurveyResultRepository;
use Illuminate\Http\Request;

class SurveyResultFaskesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try {


            $result = (new SurveyResultRepository($request))->show();

            return $result;
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage()];
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
