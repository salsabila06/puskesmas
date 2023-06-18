<?php

namespace App\Http\Controllers;

use App\Http\Repository\QuestRepository;
use App\Http\Repository\QuestTypeRepository;
use App\Http\Repository\SurveyRepository;
use App\Models\Quest;
use App\Models\SurveyResult;
use Illuminate\Http\Request;

class SurveyResultController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $array = [];
        $survey = (new SurveyRepository($request))->get();

        $quest = [];
        foreach ($survey->detail as $key => $item) {
            $newQuest = (new QuestRepository($request))->byFaskesType($item->quest_id);
            if ($newQuest) {
                $array[$newQuest->quest_type->quest_type_name][] = $request[$newQuest->quest_type->quest_type_name . $item->quest_id] ?? 0;
                $quest[$newQuest->quest_type->quest_type_name][] = $newQuest;
            }
        }

        $data = [];
        foreach ($quest as $key => $value) {
            array_push($data, [
                'value_real' => array_sum($array[$key]),
                'value_percentage' => (array_sum($array[$key]) / count($quest[$key]) * 100),
                'quest_type_id' => $value[0]->quest_type_id,
                'quest_count' => count($quest[$key]),
                'survey_id' => $request->id_survey,
                'created_at' => date('Y-m-d H:i:s'),
                'faskes_id' => $request->user()->faskes_id,
                'created_by' => $request->user()->id_user
            ]);
        }

        SurveyResult::insert($data);

        return $data;
    }
}
