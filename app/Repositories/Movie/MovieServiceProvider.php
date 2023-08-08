<?php 

namespace App\Repositories\Movie;

use Illuminate\Support\ServiceProvider;

class MovieServiceProvider extends ServiceProvider {
    public function boot() {

    }
  
    public function register() {
      $this->app->bind('App\Repositories\Movie\MovieInterface', 'App\Repositories\Movie\MovieRepository');
    }
}