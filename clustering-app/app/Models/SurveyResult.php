<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyResult extends Model
{
    use HasFactory;

    protected $table = 't_survey_result';
    protected $primaryKey = 'id_survey_result';

    protected $guarded = [];
}
