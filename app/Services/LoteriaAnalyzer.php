<?php

namespace App\Services;

class LoteriaAnalyzer
{
    protected array $numeros;

    public function __construct(array $numeros)
    {
        //Convierto los numeros del arreglo a enteros        
        $this->numeros = array_map('intval',$numeros);
    }

    public function analizar(): array
    {
        return [
            'pares' => $this->contarPares(),
            'impares' => $this->contarImpares(),
            'suma_total' => $this->sumar(),
            'promedio' => $this->promedio(),
            'maximo' => $this->maximo(),
            'minimo' => $this->minimo(),
        ];
    }

    private function contarPares(): int
    {
        return count(array_filter($this->numeros, fn($n) => $n % 2 === 0));
    }

    private function contarImpares(): int
    {
        return count(array_filter($this->numeros, fn($n) => $n % 2 !== 0));
    }

    private function sumar(): int
    {
        return array_sum($this->numeros);
    }

    private function promedio(): float
    {
        return array_sum($this->numeros) / count($this->numeros);
    }

    private function maximo(): int
    {
        return max($this->numeros);
    }

    private function minimo(): int
    {
        return min($this->numeros);
    }



}
