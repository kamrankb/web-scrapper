<?php

namespace App\Http\Controllers;

use App\Models\Scraper;
use App\Repositories\Scraper\ScraperInterface;
use Illuminate\Http\Request;

class ScraperController extends Controller
{
    protected $scraping;

    function __construct(ScraperInterface $scraping)
    {
        $this->scraping = $scraping;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->scraping->fetchWeb('https://www.imdb.com/chart/top');

        $this->scraping->getMovies();

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
