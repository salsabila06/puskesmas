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


    function quest_type()
    {
        return $this->belongsTo(QuestType::class, 'quest_type_id', 'id_quest_type');
    }

    function faskes()
    {
        return $this->belongsTo(Faskes::class, 'faskes_id', 'id_faskes');
    }
}
