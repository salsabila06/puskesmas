<?php

namespace App\Http\Controllers;

use App\Http\Repository\QuestRepository;
use App\Http\Repository\QuestTypeRepository;
use App\Http\Repository\SurveyRepository;
use App\Http\Repository\SurveyResultRepository;
use App\Models\Cluster;
use App\Models\ClusterType;
use App\Models\Faskes;
use App\Models\Quest;
use App\Models\QuestType;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    function index()
    {
        $faskes_id = Auth::user()->faskes_id;
        $faskes = Faskes::count();
        $survey = Survey::count();
        $quest_type = QuestType::count();
        $quest = Quest::count();
        $not_yet_survey = 0;
        $survey_passed = 0;

        $survey_list = Cluster::join('t_survey AS  a', 'a.id_survey', 't_cluster.survey_id')->get([DB::raw("DISTINCT(survey_id)"), 'title']);

        if (Auth::user()->role_id == ROLE_FASKES) {
            $not_yet_survey = DB::selectOne("SELECT COUNT(*) AS count FROM t_survey a WHERE NOT EXISTS (SELECT survey_id FROM t_survey_result AS b WHERE a.id_survey = b.survey_id AND faskes_id = ? )", [$faskes_id])->count;
            $survey_passed = DB::selectOne("SELECT COUNT(*) AS count FROM t_survey a WHERE EXISTS (SELECT survey_id FROM t_survey_result AS b WHERE a.id_survey = b.survey_id AND faskes_id = ? )", [$faskes_id])->count;
        }

        return view('pages.home.index', compact('faskes', 'survey', 'quest_type', 'quest', 'not_yet_survey', 'survey_passed', 'survey_list'));
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
        $faskes = Auth::user()->faskes;
        return view('pages.input_survey.index', compact('faskes'));
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

    function hasil_survey(Request $request)
    {
        $survey = (new SurveyRepository($request))->get();
        return view('pages.hasil_survey.index', compact('survey'));
    }
    function hasil_survey_detail(Request $request, $id)
    {
        $request->merge(['survey_id' => $id]);
        $obj = new SurveyResultRepository($request);
        $survey = $obj->groupByQuestType();
        $result = $obj->getByFaskes();
        $faskes_count = Faskes::count();
        $faskes_pass_count = count($result);
        $is_clustered = Cluster::where('survey_id', $id)->exists();
        return view('pages.hasil_survey_detail.index', compact('survey', 'result', 'faskes_count', 'faskes_pass_count', 'is_clustered'));
    }

    function faskes()
    {
        return view('pages.faskes.index');
    }

    function hasil_cluster(Request $request)
    {
        $survey = (new SurveyRepository($request))->surveyWithCluster();
        return view('pages.hasil_cluster.index', compact('survey'));
    }
    function hasil_cluster_detail(Request $request, $id)
    {
        $result = Cluster::with(['cluster_type', 'faskes'])->where('survey_id', $id)->get();
        return view('pages.hasil_cluster_detail.index', compact('result'));
    }
}
