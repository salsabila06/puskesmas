<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyDetail extends Model
{
    use HasFactory;

    protected $table = 't_survey_detail';
    protected $primaryKey = 'id_survey_detail';

    protected $guarded = [];

    function quest()
    {
        return $this->belongsTo(Quest::class, 'quest_id', 'id_quest');
    }

    function survey()
    {
        return $this->belongsTo(Survey::class, 'survey_id', 'id_survey');
    }
}
