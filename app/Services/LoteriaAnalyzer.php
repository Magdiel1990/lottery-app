<?php

namespace App\Services;

class LoteriaAnalyzer
{
    protected array $numeros;
    protected $fecha;

    public function __construct(array $numeros, $fecha)
    {
        $this->numeros = $numeros;
        $this->fecha = $fecha->format('d-M-Y');
    }

    public function analizar(): array
    {
        return [
            'pares (%)' => $this->contarPares(),
            'impares (%)' => $this->contarImpares(),
            'suma_total' => $this->sumar(),
            'producto_total' => $this->product(),
            'promedio' => $this->promedio(),
            'desviacion' => $this->desviacion_estandar(),
            'maximo' => $this->maximo(),
            'minimo' => $this->minimo(),
            'rango' => $this->rango(),
            'fecha' => $this->fecha,
        ];
    }

    private function contarPares(): float
    {
        $porcentaje = round(100 * count(array_filter($this->numeros, fn($n) => $n % 2 === 0)) / count($this->numeros), 1);

        return $porcentaje;
    }

    private function contarImpares(): float
    {
        $porcentaje = round(100 * count(array_filter($this->numeros, fn($n) => $n % 2 !== 0)) / count($this->numeros), 1);

        return $porcentaje;
    }

    private function sumar(): int
    {
        return array_sum($this->numeros);
    }

    private function product(): int
    {
        return array_product($this->numeros);
    }

    private function promedio(): float
    {
        return array_sum($this->numeros) / count($this->numeros);
    }

    private function desviacion_estandar(): float
    {
        $n = count($this->numeros);
        if ($n === 0) {
            return 0;
        }

        $media = $this->promedio();

        $suma_cuadrados = 0;
        foreach ($this->numeros as $valor) {
            $suma_cuadrados += pow($valor - $media, 2);
        }

        $varianza = $suma_cuadrados / $n;

        return sqrt($varianza);
    }

    private function maximo(): int
    {
        return max($this->numeros);
    }

    private function minimo(): int
    {
        return min($this->numeros);
    }

    private function rango(): int
    {
        return $this->maximo() - $this->minimo();
    }
}
