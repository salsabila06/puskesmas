<?php

namespace App\Http\Repository;

use App\Models\Quest;
use App\Models\QuestType;
use Exception;
use Illuminate\Http\Request;

class QuestTypeRepository
{

    protected $fillable;
    protected $request;
    protected $primaryKey;
    protected $limit, $offset, $draw, $search, $order, $sort;
    protected $select = ['id_quest_type', 'quest_type_name'];



    public function __construct(Request $request)
    {
        $this->fillable = [
            'quest_type_name' => $request->quest_type_name
        ];
        $this->request = $request;
        $this->primaryKey = $request->id_quest_type;
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

            $data = QuestType::when($this->search, function ($q) use ($search) {
                $q->where('quest_type_name', 'LIKE', "%{$search}%");
            })->orderBy($this->order, $this->sort)->limit($this->limit)->offset($this->offset)->get(['quest_type_name', 'id_quest_type']);

            $total_record = QuestType::count();
            $filtered_record = ($this->search) ? QuestType::where('quest_type_name', 'LIKE', "%{$search}%")->count() : $total_record;

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
                return QuestType::find($this->primaryKey, $this->select);
            }
            return QuestType::with('quest')->get($this->select);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
    public function create()
    {
        try {
            return QuestType::create($this->fillable);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    public function update()
    {
        try {
            return QuestType::find($this->primaryKey)->update($this->fillable);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    public function delete()
    {
        try {
            return QuestType::destroy($this->primaryKey);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    function relation($id)
    {
        try {
            $quest = QuestType::whereRelation('quest', 'id_quest', $id)->first($this->select);

            $quest->quest_type = Quest::find($id);

            return $quest;
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
}
