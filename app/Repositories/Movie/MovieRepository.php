<?php 

namespace App\Repositories\Movie;
use App\Models\Movie;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;

class MovieRepository implements MovieInterface {

    protected $movie;

    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    // Add Movies 
    public function add($data) {
        try {
            foreach($data as $movie) {
                $this->movie::updateOrCreate([
                    "movie_id"=>$movie['movie_id']
                ], $movie);
            }

            return [
                "success" => true
            ];
        } catch(ModelNotFoundException $e) {
            return [
                "code" => $e->getCode(),
                "message" => $e->getMessage()
            ];
        } catch(InvalidArgumentException $e) {
            return [
                "code" => $e->getCode(),
                "message" => $e->getMessage()
            ];
        } catch(Exception $e) {
            return [
                "code" => $e->getCode(),
                "message" => $e->getMessage()
            ];
        }
    }

    // List Top 10 movies
    public function list($count=10) {
        try {
            $movies = $this->movie::select('id','title','year','rating','url')
                        ->limit($count)
                        ->get();

            if($movies) {
                return [
                    "success" => true,
                    "data" => $movies
                ];
            } else {
                return [
                    "success" => false,
                    "message" => 'Currently no movies in the list'
                ];
            }
        } catch(ModelNotFoundException $e) {
            return [
                "code" => $e->getCode(),
                "message" => $e->getMessage()
            ];
        } catch(InvalidArgumentException $e) {
            return [
                "code" => $e->getCode(),
                "message" => $e->getMessage()
            ];
        } catch(Exception $e) {
            return [
                "code" => $e->getCode(),
                "message" => $e->getMessage()
            ];
        }
    }
}