<?php

namespace App\Http\Controllers;

use App\Models\LotteryResult;
use Illuminate\Http\Request;

class LotteryResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10); //Valor por defecto: 10
        $results = LotteryResult::orderBy("draw_date","desc")->paginate(10);

        return view("lottery_results.index", compact("results", "perPage"));

    }

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
        $exists = LotteryResult::where('draw_date', $request->input('draw_date'))
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
        LotteryResult::create([
            'draw_date' => $request->input('draw_date'),
            'numbers' => $numbers,
        ]);

        return redirect()->route('loto.agregar')->with('success', '¡Resultado guardado!');
    }


    /**
     * Display the specified resource.
     */
    public function show(LotteryResult $lotteryResult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LotteryResult $lotteryResult)
    {
        return view('lottery_results.edit', compact('lotteryResult'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LotteryResult $lotteryResult)
    {
        //Validar datos del formulario
        $request->validate([
            'draw_date' => 'required|date',
            'numbers' => 'required|string',
        ]);

        // Procesar los números: convertir el string en array de números enteros
        $numbers = array_map('intval', array_map('trim', explode(',', $request->input('numbers'))));

        // Actualizar los campos del modelo
        $lotteryResult->draw_date = $request->input('draw_date');
        $lotteryResult->numbers = $numbers;

        // Guardar los cambios
        $lotteryResult->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('loto.index')->with('success', 'La jugada ha sido actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LotteryResult $lotteryResult)
    {
        //Eliminar jugadas
        $lotteryResult -> delete();

        return redirect()->route('loto.index')->with('success', 'Resultado eliminado correctamente.');

    }
}
