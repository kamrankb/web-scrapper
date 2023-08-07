<?php 

namespace App\Repositories\Scraper;

interface ScraperInterface {
  public function fetchWeb($url);

  public function getMovies();
}