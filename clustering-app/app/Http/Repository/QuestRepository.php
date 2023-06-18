<?php

namespace App\Http\Repository;

use App\Models\Quest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestRepository
{

    protected $fillable;
    protected $request;
    protected $primaryKey;
    protected $select = [
        'id_quest', 'quest', 'quest_type_id', 'target'
    ];
    protected $limit, $offset, $draw, $search, $order, $sort;

    public function __construct(Request $request)
    {
        $this->fillable = [
            'quest' => $request->quest,
            'quest_type_id' => $request->quest_type_id,
            'target' => $request->target
        ];
        $this->request = $request;
        $this->primaryKey = $request->id_quest;
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

            $data = Quest::with('quest_type:id_quest_type,quest_type_name')->when($this->search, function ($q) use ($search) {
                $q->where('quest', 'LIKE', "%{$search}%")->orWhereRelation('quest_type', 'quest_type_name', 'LIKE', "%{$search}%");
            })->orderBy($this->order, $this->sort)->limit($this->limit)->offset($this->offset)->get($this->select);

            $total_record = Quest::count();
            $filtered_record = ($this->search) ? Quest::with('quest_type')->where('quest', 'LIKE', "%{$search}%")->orWhereRelation('quest_type', 'quest_type_name', 'LIKE', "%{$search}%")->count() : $total_record;

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
                return Quest::find($this->primaryKey, $this->select);
            }
            return Quest::all($this->select);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
    public function create()
    {
        try {
            return Quest::create($this->fillable);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    public function update()
    {
        try {
            return Quest::find($this->primaryKey)->update($this->fillable);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    public function delete()
    {
        try {
            return Quest::destroy($this->primaryKey);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    function byFaskesType($id)
    {
        try {
            $quest = Quest::with('quest_type')->where('id_quest', $id)->where(function ($q) {
                $q->where('target', Auth::user()->faskes->faskes_type)->orWhere('target', SEMUA);
            })->first($this->select);

            return $quest;
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
}
