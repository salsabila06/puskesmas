<?php

namespace App\Http\Repository;

use App\Models\Cluster;
use App\Models\Survey;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SurveyRepository
{

    protected $fillable;
    protected $request;
    protected $primaryKey;
    protected $limit, $offset, $draw, $search, $order, $sort;
    protected $select = [
        'id_survey', 'title', 'date_publish'
    ];

    public function __construct(Request $request)
    {
        $this->fillable = [
            'title' => $request->title,
            'date_publish' => $request->date_publish,
        ];
        $this->request = $request;
        $this->primaryKey = $request->id_survey;
        $this->draw = $request->draw;
        $this->limit = $request->length;
        $this->offset = $request->start;
        $this->search = $request["search.value"];
    }

    public function forDatatable()
    {
        try {
            $search = $this->search;
            $this->order =  $this->request['columns'][$this->request['order.0.column']]['name'];
            $this->sort = $this->request['order.0.dir'];

            $data = Survey::when($this->search, function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%");
            })->orderBy($this->order, $this->sort)->limit($this->limit)->offset($this->offset)->get($this->select);

            $total_record = Survey::count();
            $filtered_record = ($this->search) ? Survey::where('title', 'LIKE', "%{$search}%")->count() : $total_record;

            return [
                'data' => $data,
                'recordsTotal' => $total_record,
                'recordsFiltered' => $filtered_record,
            ];
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    public function get()
    {
        try {

            if ($this->primaryKey) {
                return Survey::with('detail')->find($this->primaryKey, $this->select);
            }
            return Survey::all($this->select);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
    public function create()
    {
        try {
            return Survey::create($this->fillable);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    public function update()
    {
        try {
            return Survey::find($this->primaryKey)->update($this->fillable);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    public function delete()
    {
        try {
            return Survey::destroy($this->primaryKey);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    function surveyForFaskes()
    {
        try {
            $faskes = Auth::user()->faskes_id;
            array_push($this->select, DB::raw("CASE WHEN EXISTS(SELECT survey_id, faskes_id FROM t_survey_result WHERE survey_id = t_survey.id_survey AND faskes_id = '{$faskes}') THEN 1 ELSE 0 END AS status"));
            $search = $this->search;
            $this->order =  $this->request['columns'][$this->request['order.0.column']]['name'];
            $this->sort = $this->request['order.0.dir'];

            $data = Survey::when($this->search, function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%");
            })->orderBy($this->order, $this->sort)->limit($this->limit)->offset($this->offset)->get($this->select);

            $total_record = Survey::count();
            $filtered_record = ($this->search) ? Survey::where('title', 'LIKE', "%{$search}%")->count() : $total_record;

            return [
                'data' => $data,
                'recordsTotal' => $total_record,
                'recordsFiltered' => $filtered_record,
            ];
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    function surveyWithCluster()
    {
        try {

            $cluster = (new Cluster())->getTable();
            $survey = (new Survey())->getTable();

            return  Survey::join("{$cluster}", "{$cluster}.survey_id", "{$survey}.id_survey")->get([DB::raw("DISTINCT id_survey"), 'title']);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
}
