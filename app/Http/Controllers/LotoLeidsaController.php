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
    public function create($id)
    {
        // Buscar la lotería
        $loteria = Loteria::findOrFail($id);

        return view("lottery_results.create", compact("loteria"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'draw_date' => 'required|date',
            'numbers' => 'required|string',
        ]);

        // Limpiar y validar los números
        $numbers = collect(explode(',', $request->input('numbers')))
            ->map(fn($num) => trim($num))
            ->filter(fn($num) => is_numeric($num))
            ->map(fn($num) => (int) $num)
            ->toArray();

        //Conseguir los datos de la loteria con ese id
        $loterias = Loteria::findOrFail($id);

        // Validar cantidad de números
        if (count($numbers) !== $loterias->total) {
            return redirect()->back()->withInput()->withErrors([
                'numbers' => 'Debes ingresar exactamente '. $loterias->total .' números separados por comas.'
            ]);
        }

        // Validar que estén dentro del rango permitido (ejemplo: 1 a 38)
        foreach ($numbers as $num) {
            if ($num < $loterias->minValue || $num > $loterias->maxValue) {
                return redirect()->back()->withInput()->withErrors([
                    'numbers' => 'Todos los números deben estar entre '. $loterias->minValue .' y '. $loterias->maxValue .'.'
                ]);
            }
        }

        // Validar que no exista ya esa jugada en la base de datos
        $exists = LotoLeidsa::where('lottery_id', $id)
            ->where('draw_date', $request->input('draw_date'))
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
            'lottery_id' => $id,
        ]);

        return redirect()->route('loto.agregar', $id)->with('success', '¡Resultado guardado!');
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
    public function edit($id)
    {
        // Buscar la jugada
        $lotoleidsa = LotoLeidsa::findOrFail($id);
        //Id de la loteria a la que pertenece la jugada
        $lottery_id = $lotoleidsa->lottery_id;

        return view('lottery_results.edit', compact('lotoleidsa', 'lottery_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LotoLeidsa $LotoLeidsa, $id)
    {
        //Validar datos del formulario
        $request->validate([
            'draw_date' => 'required|date',
            'numbers' => 'required|string',
        ]);

        // Procesar los números: convertir el string en array de números enteros
        $numbers = array_map('intval', array_map('trim', explode(',', $request->input('numbers'))));

        $loteria = LotoLeidsa::findOrFail($id);

        // Actualizar los campos del modelo
        $loteria->draw_date = $request->input('draw_date');
        $loteria->numbers = $numbers;

        // Guardar los cambios
        $loteria->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('loto.editar', $id)->with('success', 'La jugada ha sido actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $LotoLeidsa = LotoLeidsa::findOrFail($id);
        //Id de la loteria para retornar a ella
        $loteriaId =  $LotoLeidsa->lottery_id;
        //Eliminar jugadas
        $LotoLeidsa -> delete();

        return redirect()->route('loterias.show',  $loteriaId)->with('success', 'Resultado eliminado correctamente.');
    }
}
