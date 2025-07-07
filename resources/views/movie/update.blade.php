{{-- <head>
    <title>映画</title>
</head>
<body> --}}
@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Movie/index.css') }}">
<div class="container">
    <h1>映画情報を変更する</h1>
        <a href="{{ route('movie.title', ['mID' => $movie->mID]) }}">< 戻る</a><br/>

        <h2>映画情報</h2>
        <form action="{{ route('movie.update.put', ['mID' => $movie->mID]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- <label for="movie-info">映画情報</label><br/> --}}
            <input id="mID" type="hidden" name="mID" value = {{$movie -> mID }}>
            <span class="search-item">映画名</span><input id="movie_name" type="text" name="mName" value = {{$movie -> mName }} required><br/>
            @error('mName')<p style="color: red;">{{ $message }}</p>@enderror
            <span class="search-item">公開日</span><input id="movie_date" type="date" name="date" value = {{$movie -> date }} required><br/>
            @error('date')<p style="color: red;">{{ $message }}</p>@enderror
            <span class="search-item">上映時間</span><input id="movie_time" type="text" name="time" value = {{$movie -> time }} required><br/>
            @error('time')<p style="color: red;">{{ $message }}</p>@enderror

            <span class="search-item">ジャンル</span><br/>
            @forelse($genres as $genre)
            <input type="checkbox" id="gID" name="gID[]" value="{{ $genre->gID }}" {{ $currentGenres->contains($genre->gID) ? 'checked' : '' }}>{{ $genre->genreName }}<br/>
            @empty
            ジャンルが存在しません
            @endforelse
            @error('gID')<p style="color: red;">{{ $message }}</p>@enderror

            <span class="search-item">新しい画像</span><br/>
            <input type="file" name="image"><br/>
            @error('image')<p style="color: red;">{{ $message }}</p>@enderror

            <button type="submit">変更</button>
        </form><br/>
    @can('deleteMovie')
    <h1>映画を削除する</h1>
        <details>
            <summary>映画を削除</summary>
            <form action="{{ route('movie.delete', ['mID' => $movie->mID]) }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit">削除を確定</button>
            </form>
        </details>
    @endcan
</div>
@endsection
