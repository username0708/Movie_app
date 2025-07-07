<?php

namespace App\Http\Controllers\Movie\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Movie\PostRequest;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function post(PostRequest $request)
    {
        $review = new Review;
        $review->mID = $request->mID;
        $review->id = Auth::id();
        $review->star = $request->star;
        $review->title = $request->title;
        $review->content = $request->content;
        $review->save();
        return redirect()
            ->route('movie.title', ['mID'=> $request->route('mID')])
            ->with('feedback.success', "レビューを投稿しました");;
    }
}
