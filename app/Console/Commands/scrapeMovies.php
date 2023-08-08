<?php

namespace App\Console\Commands;

use App\Repositories\Movie\MovieInterface;
use App\Repositories\Scraper\ScraperInterface;
use Illuminate\Console\Command;

class scrapeMovies extends Command
{
    protected $scraping;
    protected $movie;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape movies from IMDB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ScraperInterface $scraping, MovieInterface $movie)
    {
        parent::__construct();

        $this->scraping = $scraping;
        $this->movie = $movie;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->scraping->fetchWeb('https://www.imdb.com/chart/top');
    
        $movies = $this->scraping->getMovies();
        
        $addMovies = $this->movie->add($movies);
        
        return 0;
    }
}
