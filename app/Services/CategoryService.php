<?php

namespace App\Services;

use App\Models\Categories;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;

class CategoryService {
  protected $category;

  public function __construct(Categories $category)
  {
    $this->category = $category;
  }

  public function create($data) {
    
    try {
      foreach($data as $category) {
        $this->category::updateOrCreate([
          "url"=> $category['url']
        ], $category);
      }

      return [
        "success" => true
      ];
    } catch(ModelNotFoundException $e) {
        return [
            "success" => false,
            "code" => $e->getCode(),
            "message" => $e->getMessage()
        ];
    } catch(InvalidArgumentException $e) {
        return [
          "success" => false,
          "code" => $e->getCode(),
          "message" => $e->getMessage()
        ];
    } catch(Exception $e) {
        return [
          "success" => false,
          "code" => $e->getCode(),
          "message" => $e->getMessage()
        ];
    }
    
  }

  public function getAll() {
    return $this->category::select('id','name','url')->get();
  }
}