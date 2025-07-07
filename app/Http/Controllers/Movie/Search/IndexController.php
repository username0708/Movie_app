<?php

namespace App\Http\Controllers\Movie\Search;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\BelongingGenre;
use App\Models\Genre;
use App\Models\Review;
use App\Http\Requests\Movie\SearchRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function search(Request $request)
    {
        $genres = Genre::all();
        $query = Movie::query();
        if (isset($request->year1)) $query -> whereYear('date', '>=', $request->year1);
        if (isset($request->year2)) $query -> whereYear('date', '<=', $request->year2);

        $selectedGenre = $request->input('genre');
        if ($selectedGenre) {
            $query->whereHas('belongingGenres', function ($query) use ($selectedGenre) {
                $query->where('gID', $selectedGenre);
            });
        }

        if (isset($request->time1)) $query -> where('time', '>=', $request->time1);
        if (isset($request->time2)) $query -> where('time', '<=', $request->time2);
        if (isset($request->mName)) $query -> where( 'mName', 'like', "%{$request->mName}%");

        $query ->leftjoin('reviews', 'movies.mID', '=', 'reviews.mID')
            ->select(
                'movies.mID',
                'movies.mName',
                'movies.date',
                'movies.time',
                'movies.image',
                DB::raw('AVG(reviews.star) AS avg_rating'),
                DB::raw('COUNT(reviews.id) AS total_reviews')
            )
            ->groupBy('movies.mID', 'movies.mName', 'movies.date', 'movies.time');

        if ($request->min_reviews == 1) {
            $query -> having('total_reviews', '>=', 1);
        } elseif ($request->min_reviews == 5) {
            $query -> having('total_reviews', '>=', 5);
        } elseif ($request->min_reviews == 10) {
            $query -> having('total_reviews', '>=', 10);
        };

        if ($request->star == 4) {
            $query -> having('avg_rating', '>=', 4);
        } elseif ($request->star == 3) {
            $query -> having('avg_rating', '>=', 3);
        } elseif ($request->star == 2) {
            $query -> having('avg_rating', '>=', 2);
        } elseif ($request->star == 1) {
            $query -> having('avg_rating', '>=', 1);
        };

        $sortDirection = in_array($request->sortDirection, ['asc', 'desc']) ? $request->sortDirection : 'desc';
        $query -> orderBy($request->sort, $sortDirection);

        $movies = $query->get();

        // $selectedGenre = $request->input('genre');
        // if ($selectedGenre) {
        //     $movies = $movies->filter(function ($movie) use ($selectedGenre) {
        //         $belongingGenres = BelongingGenre::where('mID', $movie->mID)->pluck('gID')->toArray();
        //         return in_array($selectedGenre, $belongingGenres);
        //     });
        // };

        $num = $movies->count();
        $perPage = 20;
        $movies = $query->paginate($perPage);

        $latestReviews =Review::latest()->take(10)->with('movie')->with('user')->get();

        Session::put('search', $request->all());

        return view('movie.index')
            -> with('movies', $movies)
            -> with('genres', $genres)
            -> with('selectedGenre', $selectedGenre)
            -> with('num', $num)
            -> with('sortOption', $request->sort)
            -> with('sortDirection', $sortDirection)
            -> with('latestReviews', $latestReviews);
    }

}
