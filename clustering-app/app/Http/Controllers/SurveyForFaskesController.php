<?php

namespace App\Http\Controllers;

use App\Http\Repository\SurveyRepository;
use Illuminate\Http\Request;

class SurveyForFaskesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            $survey = (new SurveyRepository($request))->surveyForFaskes();
            return $survey;
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage()];
        }
    }
}
