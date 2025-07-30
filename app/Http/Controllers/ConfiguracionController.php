<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loteria;

class ConfiguracionController extends Controller
{
    public function index()
    {
        $loterias = Loteria::all();
        return view('configuracion.index', compact('loterias'));
    }

    public function update(Request $request)
    {
        return redirect()->back()->with('success', 'Configuración actualizada.');
    }
}
