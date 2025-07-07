<?php

namespace App\Http\Controllers\Movie\Create;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\CreateRequest;
use App\Models\BelongingGenre;
use Illuminate\Http\Request;
use App\Models\Movie;

class CreateController extends Controller
{
    public function create(CreateRequest $request)
    {
        // $imagePath = $request->file('image')->store('public/images');
        // $imageName = basename($imagePath);

        $movie = new Movie;
        $movie->mName = $request->mName();
        $movie->date = $request->mdate();
        $movie->time = $request->mtime();

        if($request->file('image'))
        {
            $imagePath = $request->file('image')->store('public/images');
            $imageName = basename($imagePath);
            $movie->image = $imageName;
        }

        $movie->save();
        if (is_array($request->gID))
        {
            foreach($request->gID as $genre)
            {
                $bGenre = new BelongingGenre;
                $bGenre->mID = $movie->mID;
                $bGenre->gID = $genre;
                $bGenre->save();
            }
        } else {
                $bGenre = new BelongingGenre;
                $bGenre->mID = $movie->mID;
                $bGenre->gID = $request->gID;
                $bGenre->save();
        }
        return redirect()->route('movie.index');

    }
}
