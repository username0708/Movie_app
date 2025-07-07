{{-- <head>
    <title>映画</title>
    <link rel="stylesheet" href="{{ asset('css/Movie/index.css') }}">
</head>
<body> --}}
@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Movie/index.css') }}">
    {{-- <h1><a href="{{ route('movie.index') }}">映画</a></h1> --}}
<div class="container">
<div class="toppage">
    <div class="sidebar">
            <h1>検索</h1>
            <div>
                <form action="{{route('movie.search')}}" method="get">
                    @csrf
                    <button type="submit" class="form-btn">検索</button><br/>
                    <p><span class="search-item">ソート</span><br/>
                        <select id="sort" name="sort">
                            <option value="movies.date" {{ $sortOption == 'movies.date' ? 'selected' : '' }}>公開日</option>
                            <option value="movies.time" {{ $sortOption == 'movies.time' ? 'selected' : '' }}>上映時間</option>
                            <option value="avg_rating" {{ $sortOption == 'avg_rating' ? 'selected' : '' }}>評価</option>
                            <option value="total_reviews" {{ $sortOption == 'total_reviews' ? 'selected' : '' }}>レビュー数</option>
                            <option value="movies.mName" {{ $sortOption == 'movies.mName' ? 'selected' : '' }}>映画名</option>
                        </select>
                        <select name="sortDirection">
                            <option value="desc" {{ $sortDirection == 'desc' ? 'selected' : '' }}>降順</option>
                            <option value="asc" {{ $sortDirection == 'asc' ? 'selected' : '' }}>昇順</option>
                        </select>
                    </p>
                    <p><span class="search-item">映画名</span><br/>
                        <input id="mName" type="text" name="mName" value="{{ old('mName', session('search.mName')) }}"><br/>
                    </p>
                    <p><span class="search-item">公開年</span><br/>
                        <input id="year1" type="text" name="year1" style="width:60px;" value="{{ old('year1', session('search.year1')) }}">
                        ～ <input id="year2" type="text" name="year2" style="width:60px;" value="{{ old('year2', session('search.year2')) }}">年<br/>
                    </p>
                    <p><span class="search-item">上映時間</span><br/>
                        <input id="time1" type="text" name="time1" style="width:60px;" value="{{ old('time1', session('search.time1')) }}">
                        ～ <input id="time2" type="text" name="time2" style="width:60px;" value="{{ old('time2', session('search.time2')) }}">分<br/>
                    </p>
                    <p><span class="search-item">レビュー数</span><br/>
                        <input id="min_reviews_1" type="radio" name="min_reviews" value=1 {{ old('min_reviews', session('search.min_reviews')) == '1' ? 'checked' : '' }}>1以上<br/>
                        <input id="min_reviews_5" type="radio" name="min_reviews" value=5 {{ old('min_reviews', session('search.min_reviews')) == '5' ? 'checked' : '' }}>5以上<br/>
                        <input id="min_reviews_10" type="radio" name="min_reviews" value=10 {{ old('min_reviews', session('search.min_reviews')) == '10' ? 'checked' : '' }}>10以上<br/>
                    @error('min_reviews')<p style="color: red;">{{ $message }}</p>@enderror
                    </p>
                    <p><span class="search-item">評価</span><br/>
                        <input id="star_4" type="radio" name="star" value=4 {{ old('star', session('search.star')) == '4' ? 'checked' : '' }}><span class="search-star">★★★★☆</span>以上<br/>
                        <input id="star_3" type="radio" name="star" value=3 {{ old('star', session('search.star')) == '3' ? 'checked' : '' }}><span class="search-star">★★★☆☆</span>以上<br/>
                        <input id="star_2" type="radio" name="star" value=2 {{ old('star', session('search.star')) == '2' ? 'checked' : '' }}><span class="search-star">★★☆☆☆</span>以上<br/>
                        <input id="star_1" type="radio" name="star" value=1 {{ old('star', session('search.star')) == '1' ? 'checked' : '' }}><span class="search-star">★☆☆☆☆</span>以上<br/>
                    </p>
                    <p><span class="search-item">ジャンル</span><br/>
                        <label>
                            <input type="radio" name="genre" value="" {{ $selectedGenre == '' ? 'checked' : '' }}> すべて
                        </label><br/>
                        @foreach($genres as $genre)
                            <label>
                                <input type="radio" name="genre" value="{{ $genre->gID }}" {{ $selectedGenre == $genre->gID ? 'checked' : '' }}>
                                {{ $genre->genreName }}
                            </label><br/>
                        @endforeach
                    </p>
                    <p>
                    <button type="submit" class="form-btn">検索</button><br/>
                    <input type="reset" name="reset" value="入力をクリア" class="form-reset-btn">
                    </p>
                </form>
            </div>
    </div>
    <div class="content">
        @if (session('feedback.success'))
            <p style="color: green">{{ session('feedback.success') }}</p>
        @endif
        <h1>映画一覧</h1>
        {{ $num }}件の検索結果
        <div class="movies">
            @forelse($movies as $movie)
            <div class="title">
                <div class="title-image">
                @if($movie->image)
                    <a href="{{ route('movie.title', ['mID' => $movie->mID]) }}">
                        <img src="{{ asset('storage/images/'. $movie->image) }}" alt="{{ $movie->image }}" width=120 height=160>
                    </a>
                @else
                    <a href="{{ route('movie.title', ['mID' => $movie->mID]) }}">
                        <img src="{{ asset('storage/images/NoImage.png') }}" alt="{{ $movie->image }}" width=120 height=160>
                    </a>
                @endif
                </div>
                <div class="title-information">
                    <a href="{{ route('movie.title', ['mID' => $movie->mID]) }}">{{ $movie -> mName }}</a><br/>
                    {{ $movie -> date }}<br/>
                    {{ $movie -> time }}分<br/>
                    @If($movie -> total_reviews == 0) レビューなし
                    @else
                        <span class="stars" style="--percent: calc({{ number_format($movie ->avg_rating, 2) }} / 5 * 100%)"></span>
                        {{ number_format($movie->avg_rating, 2) }}({{ $movie -> total_reviews }})
                    @endif
                    <br/>
                    @foreach($movie->belongingGenres as $belongingGenre)
                        {{ $belongingGenre->genres->genreName }}
                        @if (!$loop->last) , @endif
                    @endforeach
                </div>
            </div>
            @empty
            映画はまだありません
            @endforelse
        </div>
        <br/>
        {{ $movies->appends(request()->query())->links() }}
        <br/>
        {{-- @can('addMovie')
        <button type="button" onclick="location.href='{{ route('movie.create.index') }}'">映画を追加</button><br/>
        @endcan
        @can('addGenre')
        <form action="{{ route('movie.genre.create') }}" method="post">
            @csrf
            <span>ジャンル名</span><input id="ganreName" type="text" name="genreName">
            <button type="submit">ジャンルを追加</button>
            @error('genreName')<p style="color: red;">{{ $message }}</p>@enderror
        </form><br/>
        @endcan --}}
        {{-- <button type="button" onclick="location.href='{{ route('home') }}'">ホーム</button> --}}
        {{-- <button type="button" onclick="location.href='{{ route('movie.update.index', ['mID' => $movie->mID]) }}'">映画を追加</button> --}}
    </div>
    <div class="recent-reviews">
        <h1>最近のレビュー</h1>
        <div class="review2">
            @if ($latestReviews->isEmpty())
                <p>まだレビューがありません。</p>
            @else
                <ul>
                    @foreach ($latestReviews as $review)
                        <div class="posted-review2">
                            <strong><a href="{{route('movie.title', ['mID' => $review->movie->mID]) }}">{{ $review->movie->mName }}</a></strong><br/>
                            {{$review ->user->name}}
                            <font color="gray"> ({{ $review->updated_at }})</font><br/>
                            <span class="search-star">
                                @if ($review->star == 1) ★☆☆☆☆ @elseif ($review->star == 2) ★★☆☆☆ @elseif($review->star == 3) ★★★☆☆ @elseif($review->star == 4) ★★★★☆ @else ★★★★★@endif
                                </span>
                                <span class="bold-font">{{$review -> title }}</span><br/>
                                <pre>{{$review -> content }}</pre><br/>
                            </div>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
</div>
{{-- </body>
</html> --}}
@endsection
