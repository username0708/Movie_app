<?php

namespace App\Http\Controllers\Movie\Genre;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\GenreCreateRequest;
use Illuminate\Http\Request;
use App\Models\Genre;

class CreateController extends Controller
{
    public function create(GenreCreateRequest $request)
    {
        $genre = new Genre;
        $genre->genreName = $request->genreName;
        $genre->save();
        return redirect()->route('movie.index')
            ->with('feedback.success', "ジャンルを追加しました");
    }
}
