<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loteria extends Model
{
    //
    protected $fillable = ['nombre', 'minValue', 'maxValue', 'total', 'descripcion'];
}

