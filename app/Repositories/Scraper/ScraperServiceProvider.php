<?php 

namespace App\Repositories\Scraper;

use Illuminate\Support\ServiceProvider;

class ScraperServiceProvider extends ServiceProvider {
  public function boot() {

  }

  public function register() {
    $this->app->bind('App\Repositories\Scraper\ScraperInterface', 'App\Repositories\Scraper\ScraperRepository');
  }
}