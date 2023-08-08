<?php

namespace App\Http\Controllers;

use App\Models\Scraper;
use App\Repositories\Movie\MovieInterface;
use App\Repositories\Scraper\ScraperInterface;
use Exception;
use Illuminate\Http\Request;

class ScraperController extends Controller
{
    protected $scraping;
    protected $movie;

    function __construct(ScraperInterface $scraping, MovieInterface $movie)
    {
        $this->scraping = $scraping;
        $this->movie = $movie;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $this->scraping->fetchWeb('https://www.imdb.com/chart/top');
    
            $movies = $this->scraping->getMovies();
            
            $addMovies = $this->movie->add($movies);

            if(!empty($addMovies['success']) && $addMovies['success'] == true) {
                return response()->json($this->movie->list());
            } else {
                return response()->json([
                    "message" => "No movies in the list."
                ]);
            }
        } catch(Exception $ex) {
            return [
                "error" => $ex->getCode(),
                "message" => $ex->getMessage()
            ];
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Scraper  $scraper
     * @return \Illuminate\Http\Response
     */
    public function show(Scraper $scraper)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Scraper  $scraper
     * @return \Illuminate\Http\Response
     */
    public function edit(Scraper $scraper)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Scraper  $scraper
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Scraper $scraper)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Scraper  $scraper
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scraper $scraper)
    {
        //
    }
}
