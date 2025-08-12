<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoteriaAnalyzer;

class AnalisisController extends Controller
{
    public function analizar(Request $request)
    {
        $request->validate([
            'numeros' => 'required|array|min:1',
            'numeros.*' => 'integer|min:0'
        ]);

        $analyzer = new LoteriaAnalyzer($request->numeros);
        $resultado = $analyzer->analizar();

        return view('resultado', compact('resultado'));
    }

}
