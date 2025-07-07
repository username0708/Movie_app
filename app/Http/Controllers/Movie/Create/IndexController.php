<?php

namespace App\Http\Controllers\Movie\Create;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function show()
    {
        $genres = Genre::all();
        return view('movie.create') ->with('genres', $genres);
    }
}
