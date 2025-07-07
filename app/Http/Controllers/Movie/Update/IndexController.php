<?php

namespace App\Http\Controllers\Movie\Update;

use App\Http\Controllers\Controller;
use App\Models\BelongingGenre;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IndexController extends Controller
{
    public function show(Request $request)
    {
        $mID = (int) $request -> route('mID');
        $movie = Movie::where('mID', $mID) -> firstOrfail();
        $genres = Genre::all();
        $currentGenres = BelongingGenre::where('mID', $mID) ->pluck('gID');
        return view('movie.update')
            -> with('movie', $movie)
            -> with('genres', $genres)
            -> with('currentGenres', $currentGenres);
    }
}
