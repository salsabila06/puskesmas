<?php

namespace App\Http\Repository;


use App\Models\SurveyDetail;
use Exception;
use Illuminate\Http\Request;

class SurveyDetailRepository
{

    protected $fillable = [];
    protected $request;
    protected $primaryKey;

    public function __construct(Request $request)
    {

        $this->request = $request;
        $this->primaryKey = $request->id_survey_detail;
    }


    public function create()
    {
        try {

            foreach ($this->request->quest_id as $key => $value) {
                array_push($this->fillable, [
                    'survey_id' => $this->request->id_survey,
                    'quest_id' => $value
                ]);
            }

            return SurveyDetail::insert($this->fillable);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    public function update()
    {
        try {

            foreach ($this->request->quest_id as $key => $value) {
                array_push($this->fillable, [
                    'survey_id' => $this->request->id_survey,
                    'quest_id' => $value
                ]);
            }


            return SurveyDetail::where('survey_id', $this->request->id_survey)->update($this->fillable);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    public function delete()
    {
        try {
            return SurveyDetail::where('survey_id', $this->request->id_survey)->delete();
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
}
