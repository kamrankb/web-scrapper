<?php

namespace App\Repositories\Scraper;

use App\Repositories\Scraper\ScraperInterface;
use Exception;
use Illuminate\Http\Request;
use Goutte\Client;
use InvalidArgumentException;

class ScraperRepository implements ScraperInterface {
  protected $list;
  protected $jsonData;

  public function fetchWeb($url) {
    try {
      $client = new Client();
      
      $website = $client->request('GET', 'https://www.imdb.com/chart/top');
      
      return [
        "data" => $this->jsonData = $website->filter('#__NEXT_DATA__')->text()
      ];
    } catch(\InvalidArgumentException $invalid) {
      return [
        "error" => $invalid->getCode(),
        "message" => $invalid->getMessage()
      ];
    } catch(\Exception $ex) {
      return [
        "error" => $ex->getCode(),
        "message" => $ex->getMessage()
      ];
    }
  }

  public function getMovies($movieMount=10) {
    try {
      $json = json_decode($this->jsonData);
      $movies = $json->props->pageProps->pageData->chartTitles->edges;
      $movieLists = array();

      foreach($movies as $index => $movie) {
        $node = $movie->node;
        $movieNode['title'] = $node->titleText->text;
        $movieNode['year'] = $node->releaseYear->year;
        $movieNode['rating'] = $node->ratingsSummary->aggregateRating;
        $movieNode['movie_id'] = $node->id;

        $movieNode['url'] = 'https://www.imdb.com/title/'.$movieNode['movie_id'];
        
        $movieLists[] = $movieNode;

        if($movieMount == ($index+1)) {
          break;
        }

      }

      return $movieLists;
    } catch(InvalidArgumentException $invalid) {
      return [
        "error" => $invalid->getCode(),
        "message" => $invalid->getMessage()
      ];
    } catch(Exception $ex) {
      return [
        "error" => $ex->getCode(),
        "message" => $ex->getMessage()
      ];
    }
  }
}