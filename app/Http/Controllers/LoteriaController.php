<?php
// app/Http/Controllers/LoteriaController.php

namespace App\Http\Controllers;

use App\Models\Loteria;
use Illuminate\Http\Request;

class LoteriaController extends Controller
{
    public function create()
    {
        return view('loterias.create');
    }

    public function store(Request $request)
    {
        // Validar datos
        $request->validate([
            'nombre' => 'required|string|unique:loterias,nombre',
            'minValue' => 'required|integer|min:1',
            'maxValue' => 'required|integer|gt:minValue',
            'total' => 'required|integer|min:1|max:100',
            'descripcion' => 'nullable|string|max:1000',
        ]);

        // Crear la lotería
        Loteria::create([
            'nombre' => $request->input('nombre'),
            'minValue' => $request->input('minValue'),
            'maxValue' => $request->input('maxValue'),
            'total' => $request->input('total'),
            'descripcion' => $request->input('descripcion'), // opcional
        ]);

        return redirect()->route('configuracion.index')->with('success', 'Lotería agregada correctamente.');
    }

    public function edit($id)
    {
        $loteria = Loteria::findOrFail($id);
        return view('loterias.edit', compact('loteria'));
    }

    public function update(Request $request, $id)
    {
        // Validación
        $request->validate([
            'nombre' => 'required|string|unique:loterias,nombre,' . $id,
            'minValue' => 'required|integer|min:1',
            'maxValue' => 'required|integer|gt:minValue',
            'total' => 'required|integer|min:1|max:100',
            'descripcion' => 'nullable|string|max:1000',
        ]);

        $loteria = Loteria::findOrFail($id);
        // Actualización
        $loteria->update([
            'nombre' => $request->input('nombre'),
            'minValue' => $request->input('minValue'),
            'maxValue' => $request->input('maxValue'),
            'total' => $request->input('total'),
            'descripcion' => $request->input('descripcion'), // opcional
        ]);

        return redirect()->route('configuracion.index')->with('success', 'Lotería actualizada correctamente.');
    }

    public function destroy(Loteria $loteria)
    {
        $loteria->delete();

        return redirect()->route('configuracion.index')->with('success', 'Lotería eliminada correctamente.');
    }
}
