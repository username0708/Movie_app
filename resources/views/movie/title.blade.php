@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Movie/index.css') }}">
<div class="container">
<div class="titlepage">
    <div class="titleinfo">
        {{-- <a href="{{ route('movie.index') }}">< 戻る</a><br/> --}}
        <p>映画情報</p>
        @if (session('feedback.success'))
            <p style="color: green">{{ session('feedback.success') }}</p>
        @endif
        <div class="title">
            <div class="title-image">
                @if ($movie->image)
                    <img src="{{ asset('storage/images/'. $movie->image) }}" alt="{{ $movie->image }}" width=240 height=320>
                @else
                    <img src="{{ asset('storage/images/NoImage.png') }}" alt="{{ $movie->image }}" width=240 height=320>
                @endif
            </div>
            <div class="title-information">
                <h1>{{ $movie -> mName }}</h1>
                <span class="bold-font">公開日</span><br/>
                {{ $movie -> date }}<br/>
                <span class="bold-font">上映時間</span><br/>
                {{ $movie -> time }}分<br/>
                <span class="bold-font">評価(レビュー数)</span><br/>
                @if ($movie -> total_reviews == 0)
                    レビューなし
                @else
                    <span class="stars" style="--percent: calc({{ number_format($movie ->avg_rating, 2) }} / 5 * 100%)"></span>
                    {{ number_format($movie->avg_rating, 2) }}({{ $movie -> total_reviews }})
                @endif
                <br/>
                <span class="bold-font">ジャンル</span><br/>
                @foreach($movie->belongingGenres as $belongingGenre)
                    {{ $belongingGenre->genres->genreName }}
                    @if (!$loop->last) , @endif
                @endforeach
            </div>
        <br/>
        </div>
        @can('editMovie')
        <button type="button" onclick="location.href='{{ route('movie.update.index', ['mID' => $movie->mID]) }}'">情報を変更</button><br/>
        @endcan
    </div>
    <div class="review">
        <h2>レビュー一覧</h2>
        @if ($userReview)
        <div class="posted-review">
            <h4>あなたのレビュー</h4>
            <form action="{{ route('movie.review.put', ['mID'=> $movie->mID, 'id'=> $userReview->id]) }}" method="post">
                @csrf
                @method('PUT')
                <label for="post-review"></label>
                <span class="bold-font">5段階評価</span>
                <div class="rate-form">
                    <input id="star5" type="radio" name="star" value=5 {{$userReview->star == '5' ? 'checked' : ''}}>
                    <label for="star5">★</label>
                    <input id="star4" type="radio" name="star" value=4 {{$userReview->star == '4' ? 'checked' : ''}}>
                    <label for="star4">★</label>
                    <input id="star3" type="radio" name="star" value=3 {{$userReview->star == '3' ? 'checked' : ''}}>
                    <label for="star3">★</label>
                    <input id="star2" type="radio" name="star" value=2 {{$userReview->star == '2' ? 'checked' : ''}}>
                    <label for="star2">★</label>
                    <input id="star1" type="radio" name="star" value=1 {{$userReview->star == '1' ? 'checked' : ''}}>
                    <label for="star1">★</label>
                @error('star')<p style="color: red;">{{ $message }}</p>@enderror
                </div>
                <span class="bold-font">タイトル<br/></span><input id="title" type="text" name="title" size="50" value="{{$userReview->title}}"><br/>
                @error('title')<p style="color: red;">{{ $message }}</p>@enderror
                <span class="bold-font">本文<br/></span><textarea id="content" type="text" name="content" rows="8" cols="100" placeholder="レビューを書く" value="{{$userReview->content}}"></textarea><br/>
                @error('content')<p style="color: red;">{{ $message }}</p>@enderror
                <button type="submit">編集して投稿</button>
            </form>
            <form action="{{ route('movie.review.delete', ['mID' => $movie->mID, 'id' => $userReview->id]) }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit">レビューを削除</button>
            </form>
            {{-- {{ Auth::user()->name }}<br/>
            <span class="search-star">
                @if ($userReview->star == 1) ★☆☆☆☆ @elseif ($userReview->star == 2) ★★☆☆☆ @elseif($userReview->star == 3) ★★★☆☆ @elseif($userReview->star == 4) ★★★★☆ @else ★★★★★@endif
            </span>
            <span class="search-item">{{ $userReview->title }}</span><br/>
            {{ $userReview->content }}<br/> --}}
        </div>
        @else
        <details><summary>レビューを投稿する</summary>
            <form action="{{ route('movie.review.post', ['mID'=> $movie->mID]) }}" method="post">
                @csrf
                <label for="post-review"></label>
                <span class="bold-font">5段階評価</span>
                <div class="rate-form">
                    <input id="star5" type="radio" name="star" value=5>
                    <label for="star5">★</label>
                    <input id="star4" type="radio" name="star" value=4>
                    <label for="star4">★</label>
                    <input id="star3" type="radio" name="star" value=3>
                    <label for="star3">★</label>
                    <input id="star2" type="radio" name="star" value=2>
                    <label for="star2">★</label>
                    <input id="star1" type="radio" name="star" value=1>
                    <label for="star1">★</label>
                @error('star')<p style="color: red;">{{ $message }}</p>@enderror
                </div>
                <span class="bold-font">タイトル</span><br/><input id="title" type="text" name="title" size="50"><br/>
                @error('title')<p style="color: red;">{{ $message }}</p>@enderror
                <span class="bold-font">本文</span><br/><textarea id="content" type="text" name="content" rows="8" cols="100" placeholder="レビューを書く"></textarea><br/>
                @error('content')<p style="color: red;">{{ $message }}</p>@enderror
                <button type="submit">投稿</button>
            </form>
        </details><br/>
    @endif
    @forelse($reviews as $review)
        <div class="posted-review">
            {{$review ->user->name}}
            <font color="gray"> ({{ $review->updated_at }})</font><br/>
            <span class="search-star">
                @if ($review->star == 1) ★☆☆☆☆ @elseif ($review->star == 2) ★★☆☆☆ @elseif($review->star == 3) ★★★☆☆ @elseif($review->star == 4) ★★★★☆ @else ★★★★★@endif
            </span>
            <span class="bold-font">{{$review -> title }}</span><br/>
            <pre>{{$review -> content }}</pre><br/>
            @can('deleteReview')
                <form action="{{ route('movie.review.delete', ['mID' => $review->mID, 'id' => $review->id]) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit">レビューを削除</button>
                </form>
            @endcan
        </div>
        @empty
            レビューはまだありません
        @endforelse
    </div>
</div>
</div>

@endsection
