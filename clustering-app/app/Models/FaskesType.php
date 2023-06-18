<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaskesType extends Model
{
    use HasFactory;


    protected $table = 't_faskes_type';
    protected $primaryKey = 'id_faskes_type';
    protected $guarded = [];
}
