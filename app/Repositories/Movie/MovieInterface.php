<?php

namespace App\Repositories\Movie;

interface MovieInterface {
    // Add movies 
    public function add($data);

    // List Movies 
    public function list($count=10);
}