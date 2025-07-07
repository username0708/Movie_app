<?php

namespace App\Http\Controllers\Movie\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Movie\PostRequest;
use App\Models\Review;

class PutController extends Controller
{
    public function put(PostRequest $request)
    {
        $mID = (int) $request->route('mID');
        $id = (int) $request->route('id');
        Review::updateOrInsert(
            [
                'mID' => $mID,
                'id' => $id
            ],
            [
                'star' => (int)$request->star,
                'title' => $request->title,
                'content' => $request->content
            ]);
        // $review->mID = $request->route('mID');
        // $review->id = $request->route('id');
        // $review->star = (int) $request->star;
        // $review->title = $request->title;
        // $review->content = $request->content;
        // dd($review);


        return redirect()
            ->route('movie.title', ['mID' => $request->route('mID')])
            ->with('feedback.success', "レビューを編集しました");
    }


}
