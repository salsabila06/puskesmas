<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    use HasFactory;

    protected $table = 't_cluster';
    protected $primaryKey = 'id_cluster';
    protected $guarded = [];

    function cluster_type()
    {
        return $this->belongsTo(ClusterType::class, 'cluster_type_id', 'id_cluster_type');
    }

    function faskes()
    {
        return $this->belongsTo(Faskes::class, 'faskes_id', 'id_faskes');
    }
    function survey()
    {
        return $this->belongsTo(Survey::class, 'survey_id', 'id_survey');
    }
}
