<?php

namespace App\Http\Controllers;

use App\Models\LotoLeidsa;
use Illuminate\Http\Request;
use App\Services\LoteriaAnalyzer;
use App\Models\Loteria;

class AnalisisController extends Controller
{
    public function index($id) {
        return(view ('analize.index', compact('id')));
    }

    public function probar_numero($id) {
        $loteria = Loteria::findOrFail($id);
        return (view ('analize.probar_numero', compact('loteria')));
    }

    public function analizar(Request $request)
    {
        $request->validate([
            'numeros' => 'required|array|min:1',
        ]);

        $analyzer = new LoteriaAnalyzer($request->numeros);
        $resultado = $analyzer->analizar();

        return view('loterias.analize', compact('resultado'));
    }
}
