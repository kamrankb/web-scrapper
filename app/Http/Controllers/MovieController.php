<?php

namespace App\Http\Controllers;

use App\Repositories\Movie\MovieInterface;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    protected $movies;

    function __construct(MovieInterface $movies)
    {
        $this->movies = $movies;
    }

    public function index() {
        return response()->json($this->movies->list());
    }
}
