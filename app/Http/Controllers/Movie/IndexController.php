<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\BelongingGenre;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function show(Request $request)
    {
        $selectedGenre = $request->input('genre');
        $genres = Genre::all();
        $moviesQuery = Movie::leftJoin('reviews', 'movies.mID', '=', 'reviews.mID')
            ->select(
                'movies.mID',
                'movies.mName',
                'movies.date',
                'movies.time',
                'movies.image',
                DB::raw('AVG(reviews.star) as avg_rating'),
                DB::raw('COUNT(reviews.id) as total_reviews')
            )
            ->groupBy('movies.mID', 'movies.mName', 'movies.date', 'movies.time')
            ;// ->get();

            if ($selectedGenre) {
            $moviesQuery->join('belonging_genres', 'movies.mID', '=', 'belonging_genres.mID')
                ->where('belonging_genres.gID', $selectedGenre);
        }

        $moviesQuery -> orderBy('movies.date', 'desc');
        $movies = $moviesQuery->get();
        $num = $movies->count();

        foreach ($movies as $movie) {
            $belongingGenres = BelongingGenre::where('mID', $movie->mID)->with('genres')->get();
            $movie->belongingGenres = $belongingGenres;
        }

        $perPage = 20;
        // dd($moviesQuery ->toSql());
        $movies = $moviesQuery->paginate($perPage);
        $sortOption = 'movies.date';
        $sortDirection = 'desc';

        $latestReviews =Review::latest()->take(10)->with('movie')->with('user')->get();

        Session::forget('search');

        return view('movie.index')
            -> with('movies', $movies)
            -> with('genres', $genres)
            -> with('selectedGenre', $selectedGenre)
            -> with('num', $num)
            -> with('sortOption', $sortOption)
            -> with('sortDirection', $sortDirection)
            -> with('latestReviews', $latestReviews);
    }
}
