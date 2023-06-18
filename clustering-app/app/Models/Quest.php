<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    use HasFactory;

    protected $table = 't_quest';
    protected $primaryKey = 'id_quest';
    protected $guarded = [];

    function quest_type()
    {
        return $this->belongsTo(QuestType::class, 'quest_type_id');
    }

    function detail()
    {
        return $this->belongsTo(SurveyDetail::class, 'id_quest', 'quest_id');
    }
}
