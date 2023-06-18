<?php

namespace App\Http\Controllers;

use App\Http\Repository\QuestRepository;
use App\Http\Repository\QuestTypeRepository;
use App\Http\Repository\SurveyRepository;
use App\Models\Quest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    function index()
    {
        return view('pages.home.index');
    }
    function quest_type()
    {
        return view('pages.quest_type.index');
    }
    function quest()
    {
        return view('pages.quest.index');
    }
    function survey()
    {
        return view('pages.survey.index');
    }
    function isi_survey()
    {
        return view('pages.input_survey.index');
    }
    function lets_survey($id)
    {
        $request = request()->merge(['id_survey' => $id]);

        $survey = (new SurveyRepository($request))->get();


        $faskes = Auth::user()->faskes;

        $district = $faskes->district;

        $quest = [];
        foreach ($survey->detail as $key => $value) {
            $newQuest = (new QuestRepository($request))->byFaskesType($value->quest_id);
            if ($newQuest) {
                array_push($quest, $newQuest);
            }
        }


        $survey->quest = $quest;
        $quest_type = [];

     
        foreach ($quest as $key => $value) {
            array_push($quest_type, [
                'quest_type_name' => $value->quest_type->quest_type_name,
                'id_quest_type' => $value->quest_type_id
            ]);
        };

        $survey->quest_type = array_unique($quest_type, SORT_REGULAR);


        return view('pages.lets_survey.index', compact('survey', 'faskes', 'district'));
    }
}
