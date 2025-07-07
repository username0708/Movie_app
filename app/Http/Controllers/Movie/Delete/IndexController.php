<?php

namespace App\Http\Controllers\Movie\Delete;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function show(Request $request)
    {
        $mID = (int) $request -> route('mID');
        $movie = Movie::where('mID', $mID) -> firstOrfail();
        return view('movie.delete', ['movie' => $movie]);
    }
}
