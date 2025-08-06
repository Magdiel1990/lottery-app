<?php

namespace App\Http\Controllers;

use App\Models\LotoLeidsa;
use Illuminate\Http\Request;
use App\Models\Loteria;

class LotoLeidsaController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("lottery_results/create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'draw_date' => 'required|date',
            'numbers' => 'required|string'
        ]);

        // Limpiar y validar los números
        $numbers = collect(explode(',', $request->input('numbers')))
            ->map(fn($num) => trim($num))
            ->filter(fn($num) => is_numeric($num))
            ->map(fn($num) => (int) $num)
            ->toArray();

        // Validar cantidad de números
        if (count($numbers) !== 6) {
            return redirect()->back()->withInput()->withErrors([
                'numbers' => 'Debes ingresar exactamente 6 números separados por comas.'
            ]);
        }

        // Validar que estén dentro del rango permitido (ejemplo: 1 a 38)
        foreach ($numbers as $num) {
            if ($num < 1 || $num > 40) {
                return redirect()->back()->withInput()->withErrors([
                    'numbers' => 'Todos los números deben estar entre 1 y 38.'
                ]);
            }
        }

        // Validar que no exista ya esa jugada en la base de datos
        $exists = LotoLeidsa::where('draw_date', $request->input('draw_date'))
            ->whereJsonContains('numbers', $numbers[0]) // Primer número como entrada base
            ->get()
            ->filter(function ($result) use ($numbers) {
                return collect($result->numbers)->sort()->values()->all() === collect($numbers)->sort()->values()->all();
            })
            ->isNotEmpty();

        if ($exists) {
            return redirect()->back()->withInput()->withErrors([
                'numbers' => 'Ya existe una jugada con esa combinación de números en esa fecha.'
            ]);
        }

        // Guardar el resultado
        LotoLeidsa::create([
            'draw_date' => $request->input('draw_date'),
            'numbers' => $numbers,
        ]);

        return redirect()->route('loto.agregar')->with('success', '¡Resultado guardado!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        // Buscar la lotería
        $loteria = Loteria::findOrFail($id);

        // Configurar paginación (por defecto 10 resultados por página)
        $perPage = $request->get('per_page', 10);

        // Iniciar consulta filtrando por el ID de la lotería
        $query = LotoLeidsa::where('lottery_id', $id)->orderBy("draw_date", "desc");

        // Filtrar por fecha si se proporciona
        if ($request->filled('fecha')) {
            $query->whereDate('draw_date', $request->input('fecha'));
        }

        // Ejecutar paginación
        $results = $query->paginate($perPage)->withQueryString();

        // Retornar la vista con los datos
        return view("loterias.show", compact("results", "perPage", "loteria"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LotoLeidsa $LotoLeidsa)
    {
        return view('lottery_results.edit', compact('LotoLeidsa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LotoLeidsa $LotoLeidsa)
    {
        //Validar datos del formulario
        $request->validate([
            'draw_date' => 'required|date',
            'numbers' => 'required|string',
        ]);

        // Procesar los números: convertir el string en array de números enteros
        $numbers = array_map('intval', array_map('trim', explode(',', $request->input('numbers'))));

        // Actualizar los campos del modelo
        $LotoLeidsa->draw_date = $request->input('draw_date');
        $LotoLeidsa->numbers = $numbers;

        // Guardar los cambios
        $LotoLeidsa->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('loto.index')->with('success', 'La jugada ha sido actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LotoLeidsa $LotoLeidsa)
    {
        //Eliminar jugadas
        $LotoLeidsa -> delete();

        return redirect()->route('loto.index')->with('success', 'Resultado eliminado correctamente.');

    }
}
