<?php

namespace SetupNow\BuscadorDeDados;

use GuzzleHttp\ClietInterface;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{

  /**
   * @var ClientInterface
   */
  private $httpClient;

  /**
   * @var Crawler
   */
  private $crawler;

  public function __construct($httpClient, $crawler)
  {

    $this->httpClient = $httpClient;
    $this->crawler = $crawler;
  }

  public function buscar(string $url): array
  {

    $resposta = $this->httpClient->request('GET', $url);
    $html = $resposta->getBody();
    $this->crawler->addHtmlContent($html);
    $elementos = $this->crawler->filter('span.card-curso__nome');

    $dados = [];
    foreach ($elementos as $elemento) {
      $dados[] = $elemento->textContent;
    }
    return $dados;
  }
}
