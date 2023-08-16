<?php 

namespace App\Repositories\WebMD;

interface WebMDInterface {
  // Get Categories type wise
  public function categories($type);

  // Get List Items
  public function blogList($category);

  // Get Blog item
  public function blog($slug);
}