<?php

namespace App\Repositories\Scraper;

use App\Repositories\Scraper\ScraperInterface;
use Illuminate\Http\Request;
use Goutte\Client;

class ScraperRepository implements ScraperInterface {
  protected $list;
  protected $jsonData;

  public function fetchWeb($url) {
    $client = new Client();
    
    $website = $client->request('GET', 'https://www.imdb.com/chart/top');
    
    //$this->list = $website->filter('ul.ipc-metadata-list > li');
    $this->jsonData = $website->filter('#__NEXT_DATA__')->text();
  }

  public function getMovies($movies=10) {
    $json = json_decode($this->jsonData);
    dd($json->props->pageProps->pageData->chartTitles->edges);
    // h3 class="ipc-title__text
    $count = 1;
    $companies = $this->list->each(function ($node) use (&$count, $movies) {
      dump($node->filter('h3.ipc-title__text')->text());
      
      if($count==$movies) {
        return false;
      }
      
      $count++;
    });
    //dd($this->list);
  }
}