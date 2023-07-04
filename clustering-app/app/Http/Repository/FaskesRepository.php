<?php

namespace App\Http\Repository;

use App\Models\Faskes;
use Exception;
use Illuminate\Http\Request;

class FaskesRepository
{
    protected $fillable;
    protected $request;
    protected $primaryKey;
    protected $select = ['*'];
    protected $limit, $offset, $draw, $search, $order, $sort;

    public function __construct(Request $request)
    {
        $this->fillable = [
            'faskes_name' => $request->faskes_name,
            'faskes_type_id' => $request->faskes_type,
            'district_id' => $request->district,
            'faskes_establish' => $request->faskes_establish,
            'faskes_code' => Faskes::GenerateCode(),
        ];
        $this->request = $request;
        $this->primaryKey = $request->id_quest;
        $this->draw = $request->draw;
        $this->limit = $request->length;
        $this->offset = $request->start;
        $this->search = $request["search.value"];
    }


    public function get()
    {
        try {
            $faskes_id = $this->request->faskes_id;
            if ($faskes_id) {
                return Faskes::with(['type', 'district', 'user'])->find($faskes_id);
            }
            return Faskes::with(['type', 'district'])->get();
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
    public function create()
    {
        try {
            return Faskes::create($this->fillable);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
    public function update()
    {
        try {
            return Faskes::find($this->request->faskes_id)->update($this->fillable);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
    public function delete()
    {
        try {
            return Faskes::find($this->request->faskes_id)->delete();
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    public function forDatatable()
    {
        try {
            $search = $this->search;
            $this->order =  $this->request['columns'][$this->request['order.0.column']]['name'];
            $this->sort = $this->request['order.0.dir'];

            $data = Faskes::with(['district', 'type', 'user'])->when($this->search, function ($q) use ($search) {
                $q->where('faskes_name', 'LIKE', "%{$search}%")->orWhereRelation('district', 'district_name', 'LIKE', "%{$search}%")->orWhereRelation('type', 'faskes_type_name', 'LIKE', "%{$search}%")->orWhereRelation('user', 'fullname', 'LIKE', "%{$search}%");
            })->orderBy($this->order, $this->sort)->limit($this->limit)->offset($this->offset)->get($this->select);

            $total_record = Faskes::count();
            $filtered_record = ($this->search) ? Faskes::with('quest_type')->where('faskes_name', 'LIKE', "%{$search}%")->orWhereRelation('district', 'district_name', 'LIKE', "%{$search}%")->orWhereRelation('type', 'faskes_type_name', 'LIKE', "%{$search}%")->orWhereRelation('user', 'fullname', 'LIKE', "%{$search}%")->count() : $total_record;

            return [
                'data' => $data,
                'recordsTotal' => $total_record,
                'recordsFiltered' => $filtered_record,
            ];
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
}
