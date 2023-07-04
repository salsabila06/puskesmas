<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClusterType extends Model
{
    use HasFactory;

    protected $table = 't_cluster_type';
    protected $primaryKey = 'id_cluster_type';
    protected $guarded = [];
}
