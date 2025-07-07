<?php

namespace App\Http\Controllers\Movie\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class DeleteController extends Controller
{
    public function delete(Request $request) {
        $mID = (int) $request->route('mID');
        $id = (int) $request->route('id');

        Review::where('mID', $mID) ->where('id', $id) ->delete();

        return redirect()
            -> route('movie.title', ['mID' => $mID])
            -> with('feedback.success', "レビューを削除しました");
    }
}
