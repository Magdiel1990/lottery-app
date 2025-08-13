<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\LotoLeidsa;
use Carbon\Carbon;

class ScrapeLotteryResults extends Command
{
    protected $signature = 'lottery:scrape';
    protected $description = 'Scrapea resultados de lotería y los guarda en BD';

    public function handle()
    {
        $client = new Client();

        // Cambia por la URL real
        $url = 'https://www.conectate.com.do/loterias/leidsa/loto-pool';

        $response = $client->request('GET', $url);

        $html = (string) $response->getBody();

        $crawler = new Crawler($html);

        // Ejemplo: extraer números con selector CSS
        $numbers = $crawler->filter('.game-scores .score')->each(function (Crawler $node) {
            return trim($node->text());
        });

        // Extraer la fecha del sorteo (ajustar selector)
        $dateText = $crawler->filter('.session-date')->text();
        $year = (int) date('Y'); // año actual

        try {
            $date = Carbon::createFromFormat('d-m', trim($dateText))->setYear($year);
        } catch (\Exception $e) {
            $this->error("Error al parsear fecha: " . $e->getMessage());
            return 1;
        }

        // Guardar o actualizar resultado
        LotoLeidsa::updateOrCreate(
            ['lottery_id' => 4],
            [
                'draw_date' => $date,
                'numbers' => json_encode($numbers)
            ]
        );

        $this->info('Resultados guardados para la fecha ' . $date->toDateString());
    }
}
