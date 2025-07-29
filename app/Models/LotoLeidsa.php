<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LotoLeidsa extends Model
{
    //
    protected $fillable = ['draw_date', 'numbers'];

    protected $casts = [
        'numbers'=> 'array',
        'draw_date'=> 'date',
    ];
}
