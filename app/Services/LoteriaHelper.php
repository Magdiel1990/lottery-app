<?php

namespace App\Services;

use Carbon\Carbon;


class LoteriaHelper
{
    //Calcula la cantidad máxima de caracteres dependiendo de la cantidad de bolos
    public static function cantidadCaracteres($bolos):int
    {
       $caracteres = $bolos*2 + $bolos - 1;
       return $caracteres;
    }
}
