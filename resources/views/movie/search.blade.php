<head>
    <title>映画</title>
    <link rel="stylesheet" href="{{ asset('css/Movie/index.css') }}">
</head>
<body>
    <h1><a href="{{ route('movie.index') }}">映画</a></h1>
    <div>
        @if (session('feedback.success'))
            <p style="color: green">{{ session('feedback.success') }}</p>
        @endif
        <details>
            <summary>検索</summary>
            <div>
                <form action="{{route('movie.search')}}" method="post">
                    @csrf
                    <span>映画名</span>
                        <input id="mName" type="search" name="mName" value="{{ old('mName', session('search.mName')) }}"><br/>
                    <span>公開年</span>
                        <input id="year1" type="text" name="year1" style="width:60px;" value="{{ old('year1', session('search.year1')) }}">
                        ～ <input id="year2" type="text" name="year2" style="width:60px;" value="{{ old('year2', session('search.year2')) }}"><br/>
                    <span>上映時間  </span>
                        <input id="time1" type="text" name="time1" style="width:60px;" value="{{ old('time1', session('search.time1')) }}">
                        ～ <input id="time2" type="text" name="time2" style="width:60px;" value="{{ old('time2', session('search.time2')) }}">分<br/>
                    <span>レビュー数 </span><br/>
                        <input id="min_reviews_1" type="radio" name="min_reviews" value=1 {{ old('min_reviews', session('search.min_reviews')) == '1' ? 'checked' : '' }}>1以上
                        <input id="min_reviews_5" type="radio" name="min_reviews" value=5 {{ old('min_reviews', session('search.min_reviews')) == '5' ? 'checked' : '' }}>5以上
                        <input id="min_reviews_10" type="radio" name="min_reviews" value=10 {{ old('min_reviews', session('search.min_reviews')) == '10' ? 'checked' : '' }}>10以上<br/>
                    @error('min_reviews')<p style="color: red;">{{ $message }}</p>@enderror
                    <span>評価</span><br/>
                        <input id="star_4" type="radio" name="star" value=4 {{ old('star', session('search.star')) == '4' ? 'checked' : '' }}>★★★★以上<br/>
                        <input id="star_3" type="radio" name="star" value=3 {{ old('star', session('search.star')) == '3' ? 'checked' : '' }}>★★★☆以上<br/>
                        <input id="star_2" type="radio" name="star" value=2 {{ old('star', session('search.star')) == '2' ? 'checked' : '' }}>★★☆☆以上<br/>
                        <input id="star_1" type="radio" name="star" value=1 {{ old('star', session('search.star')) == '1' ? 'checked' : '' }}>★☆☆☆以上<br/>
                    <span>ジャンル</span>
                        <select name="genre">
                            <option value="" {{ $selectedGenre == '' ? 'selected' : '' }}>すべて</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->gID }}" {{ $selectedGenre == $genre->gID ? 'selected' : '' }}>{{ $genre->genreName }}</option>
                            @endforeach
                        </select>
                    <button type="submit">検索</button>
                </form>
            </div>
        </details>
    </div>
    <br/>
    <div>
        <table>
            <tr>
                <th>映画名</th><th>公開日</th><th>上映時間(分)</th><th>評価(レビュー数)</th><th>ジャンル</th>
            </tr>
            @forelse($movies as $movie)
            <tr>
                <td><a href="{{ route('movie.title', ['mID' => $movie->mID]) }}">{{ $movie -> mName }}</a>
                </td><td>{{ $movie -> date }}</td>
                <td>{{ $movie -> time }}</td>
                <td>@If($movie -> total_reviews == 0) レビューなし @else {{ number_format($movie->avg_rating, 2) }}({{ $movie -> total_reviews }})@endif</td>
                <td>
                    @foreach($movie->belongingGenres as $belongingGenre)
                        {{ $belongingGenre->genres->genreName }}
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </td>
            </tr>
            @empty
            <tr>
                <td>No Data</td><td>No Data</td><td>No Data</td><td>No Data</td>
            </tr>
            @endforelse
        </table>
        {{ $movies->links() }}
    </div>
    <br/>
    <div>
        <button type="button" onclick="location.href='{{ route('movie.create.index') }}'">映画を追加</button><br/>
        <form action="{{ route('movie.genre.create') }}" method="post">
            @csrf
            <span>ジャンル名</span><input id="ganreName" type="text" name="genreName">
            <button type="submit">ジャンルを追加</button>
            @error('genreName')<p style="color: red;">{{ $message }}</p>@enderror
        </form><br/>
        <button type="button" onclick="location.href='{{ route('home') }}'">ホーム</button>
        {{-- <button type="button" onclick="location.href='{{ route('movie.update.index', ['mID' => $movie->mID]) }}'">映画を追加</button> --}}
    </div>
</body>
</html>
