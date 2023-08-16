<?php 

namespace App\Repositories\WebMD;

use Illuminate\Support\ServiceProvider;

class WebMDServiceProvider extends ServiceProvider {
  public function boot() {

  }

  public function register() {
    $this->app->bind('App\Repositories\WebMD\WebMDInterface', 'App\Repositories\WebMD\WebMDRepository');
  }
}