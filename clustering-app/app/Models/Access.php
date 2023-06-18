<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    use HasFactory;

    protected $table = 't_access';
    protected $primaryKey = 'id_access';

    public function menu()
    {

        return $this->belongsTo(Menu::class, 'menu_id', 'id_menu');
    }
}
