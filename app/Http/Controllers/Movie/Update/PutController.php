<?php

namespace App\Http\Controllers\Movie\Update;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\BelongingGenre;
use Illuminate\Support\Facades\Storage;

class PutController extends Controller
{
    public function put(UpdateRequest $request)
    {
        $movie = Movie::where('mID', $request->mID)->firstOrFail();

        $movie->mName = $request->mName();
        $movie->date = $request->mdate();
        $movie->time = $request->mtime();

        if ($request->hasFile('image')) {
            // Delete the old image
            if ($movie->image) {
                Storage::delete("public/images/{$movie->image}");
            }

            // Upload and save the new image
            $imagePath = $request->file('image')->store('public/images');
            $movie->image = basename($imagePath);
        }

        $movie->save();

        $selectedGenres = $request->input('gID', []);
        BelongingGenre::where('mID', $movie->mID)->delete(); // Delete existing genres for the movie

        foreach ($selectedGenres as $genreID) {
            BelongingGenre::create([
                'mID' => $movie->mID,
                'gID' => $genreID,
            ]);
        }

        return redirect()
            ->route('movie.title', ['mID' => $movie->mID])
            ->with('feedback.success', "映画情報を変更しました");
    }
}
