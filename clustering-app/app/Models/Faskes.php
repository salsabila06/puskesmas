<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Faskes extends Model
{
    use HasFactory;


    protected $table = 't_faskes';
    protected $primaryKey = 'id_faskes';

    protected $guarded = [];


    public function scopeGenerateCode($q)
    {
        $code = $q->latest()->first([DB::raw('RIGHT(faskes_code,5) as faskes_code')]);

        $batch = $code ?  $code->faskes_code + 1 : 1;

        $generate_code = Str::padLeft($batch, 5, '0');

        return 'FSC-' . $generate_code;
    }

    function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    function type()
    {

        return $this->belongsTo(FaskesType::class, 'faskes_type_id');
    }
}
