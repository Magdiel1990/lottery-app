<?php

namespace App\Http\Controllers;

use App\Models\LotoLeidsa;
use Illuminate\Http\Request;
use App\Services\LoteriaAnalyzer;
use App\Models\Loteria;

class AnalisisController extends Controller
{
    public function index($id)
    {
        return (view('analize.index', compact('id')));
    }

    public function probar_numero($id)
    {
        $loteria = Loteria::findOrFail($id);
        return (view('analize.probar_numero', compact('loteria')));
    }


    protected function results_algorithm($lottery_id)
    {
        $lotteryResults = LotoLeidsa::where('lottery_id', $lottery_id)
            ->orderBy('draw_date', 'desc')
            ->get();

        $resultsSet = [];

        foreach ($lotteryResults as $result) {
            $analyzer = new LoteriaAnalyzer($result->numbers, $result->draw_date);
            $resultsSet[] = $analyzer->analizar();
        }

        return $resultsSet;
    }

    private function results_algorithm_collection($lottery_id)
    {
        $resultSet = $this->results_algorithm($lottery_id);

        $resultCollection = []; // Ej: ["suma" => [20,50,...], "producto" => [40,60,...],...]

        foreach ($resultSet as $result) {
            foreach ($result as $categoria => $valor) {
                // Si la categoría no existe, inicializar como array vacío
                if (!isset($resultCollection[$categoria])) {
                    $resultCollection[$categoria] = [];
                }
                // Agregar el valor a la lista de la categoría
                $resultCollection[$categoria][] = $valor;
            }
        }

        return $resultCollection;
    }

    public function estadisticas(Request $request, $id)
    {
        // Configurar paginación (por defecto 10 resultados por página)
        $perPage = $request->get('per_page', 6);

        //Instancia de la clase hija
        $results = new AnalisisControllerChild();
        $results = $results->results_algorithm($id, $perPage);

        $resultsSet = $results['resultsSet'];
        $lotteryResults = $results['lotteryResults'];

        return view('analize.estadisticas', [
            'lotteryResults' => $lotteryResults, // para links()
            'resultsSet' => $resultsSet,         // para mostrar datos
            'perPage' => $perPage,
        ]);
    }
    /*
    public function analizar(Request $request)
    {
        $request->validate([
            'numeros' => 'required|array|min:1',
        ]);

        $analyzer = new LoteriaAnalyzer($request->numeros);
        $resultado = $analyzer->analizar();

        return view('loterias.analize', compact('resultado'));
    }
        */
}

class AnalisisControllerChild extends AnalisisController
{
    protected function results_algorithm($lottery_id, $perPage = null)
    {
        $lotteryResults = LotoLeidsa::where('lottery_id', $lottery_id)
            ->orderBy('draw_date', 'desc')
            ->paginate($perPage);

        // Analizar solo los de la página actual
        $resultsSet = $lotteryResults->map(function ($result) {
            $analyzer = new LoteriaAnalyzer($result->numbers, $result->draw_date);
            return $analyzer->analizar();
        });

        return ['resultsSet' => $resultsSet, 'lotteryResults' => $lotteryResults];
    }
}
