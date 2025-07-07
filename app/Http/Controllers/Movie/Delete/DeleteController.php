<?php

namespace App\Http\Controllers\Movie\Delete;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\BelongingGenre;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        $mID = (int) $request->route('mID');
        $movie = Movie::find($mID);

        BelongingGenre::where('mID', $mID)->delete();
        Review::where('mID', $mID)->delete();

        if ($movie && $movie->image) {
            Storage::delete("public/images/{$movie->image}");
        }

        Movie::destroy($mID);
        return redirect()
            -> route('movie.index')
            -> with('feedback.success', "映画を削除しました");
    }
}
