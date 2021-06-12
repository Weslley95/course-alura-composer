<?php

require_once 'vendor/autoload.php';

use SetupNow\BuscadorDeDados\Buscador;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client([
  'base_uri' => 'https://www.alura.com.br/',
  'verify' => false
]);
$crawler = new Crawler();

$buscador = new Buscador($client, $crawler);
$dados = $buscador->buscar('/cursos-online-programacao/php');

foreach ($dados as $dado) {
  echo $dado . PHP_EOL;
}
