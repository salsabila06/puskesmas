<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestType extends Model
{
    use HasFactory;

    protected $table = 't_quest_type';
    protected $primaryKey = 'id_quest_type';

    protected $guarded = [];

    function quest()
    {
        return $this->hasMany(Quest::class, 'quest_type_id', 'id_quest_type');
    }
}
