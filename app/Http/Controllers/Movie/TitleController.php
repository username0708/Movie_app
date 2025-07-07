<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Review;
use App\Models\BelongingGenre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TitleController extends Controller
{
    public function show(Request $request)
    {
        $mID = (int) $request -> route('mID');
        $movie = Movie::leftJoin('reviews', 'movies.mID', '=', 'reviews.mID')
            ->select(
                'movies.mID',
                'movies.mName',
                'movies.date',
                'movies.time',
                'movies.image',
                DB::raw('AVG(reviews.star) as avg_rating'),
                DB::raw('COUNT(reviews.id) as total_reviews')
            )
            ->where('movies.mID', $mID)
            ->groupBy('movies.mID', 'movies.mName', 'movies.date', 'movies.time')
            ->firstOrfail();
        $belongingGenres = BelongingGenre::where('mID', $movie->mID)->with('genres')->get();
        $movie->belongingGenres = $belongingGenres;
        $reviews = Review::where('mID', $mID)
            -> with('user')
            -> get();

        if (Auth::check()) {
            $userReview = Review::where('mID', $mID)
                ->where('id', Auth::user()->id)
                ->first();
        } else {
            $userReview = null;
        }

        return view('movie.title')
            -> with('movie', $movie)
            -> with('reviews', $reviews)
            -> with('userReview', $userReview);
    }
}
