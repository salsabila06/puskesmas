<?php

namespace App\Http\Repository;

use App\Http\Resources\SurveyResultResource;
use App\Models\Faskes;
use App\Models\Survey;
use App\Models\SurveyResult;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SurveyResultRepository
{

    protected $request;

    public function __construct(Request $request)
    {

        $this->request = $request;
    }

    public function show()
    {
        try {

            $res = SurveyResult::with(['quest_type', 'faskes'])->where('survey_id', $this->request->survey_id)->when($this->request->user()->faskes_id, function ($q) {
                $q->where('faskes_id', $this->request->user()->faskes_id);
            })->get();

            return SurveyResultResource::collection($res);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
    public function getByFaskes()
    {
        try {

            $faskes = Faskes::join('t_survey_result AS b', 't_faskes.id_faskes', 'b.faskes_id')->groupBy(['id_faskes', 'faskes_name'])->where('survey_id', $this->request->survey_id)->get(['id_faskes', 'faskes_name']);

            foreach ($faskes as $key => $value) {
                $faskes[$key]->result = SurveyResult::with(['quest_type'])->where('survey_id', $this->request->survey_id)->where('faskes_id', $value->id_faskes)->get(['value_percentage', 'quest_type_id'])->pluck('value_percentage');
            }

            return $faskes;
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
    public function groupByQuestType()
    {
        try {

            try {

                $res = SurveyResult::with(['quest_type', 'faskes'])->where('survey_id', $this->request->survey_id)->groupBy(['quest_type_id'])->get(['quest_type_id']);

                return SurveyResultResource::collection($res);
            } catch (\Throwable $th) {
                throw new Exception($th->getMessage());
            }
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
}
