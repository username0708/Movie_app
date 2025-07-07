@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Movie/index.css') }}">
<div class="container">
    <h1>映画を追加</h1>
    <a href="{{ route('movie.index') }}">戻る</a><br/>
    <div>
        <h2>映画情報</h2>
        <form action="{{ route('movie.create') }}" method="post" enctype="multipart/form-data">
            @csrf
            <span class="bold-font">映画名</span><input id="movie_name" type="text" name="mName" value="{{ old('mName') }}" required><br/>
            @error('mName')<p style="color: red;">{{ $message }}</p>@enderror
            <span class="bold-font">公開日</span><input id="movie_date" type="date" name="date" value="{{ old('date') }}" required><br/>
            @error('date')<p style="color: red;">{{ $message }}</p>@enderror
            <span class="bold-font">上映時間</span><input id="movie_time" type="text" name="time" value="{{ old('time') }}" required><br/>
            @error('time')<p style="color: red;">{{ $message }}</p>@enderror

            <span class="bold-font">ジャンル</span><br/>
            @forelse($genres as $genre)
            <input id="gID" type="checkbox" name="gID[]" value="{{ $genre->gID}}">{{ $genre->genreName }}<br/>
            @empty
            ジャンルが存在しません
            @endforelse
            @error('gID')<p style="color: red;">{{ $message }}</p>@enderror

            <span class="bold-font">映画画像</span><br/>
            <input type="file" name="image" accept="image/*"><br>
            @error('image')<p style="color: red;">{{ $message }}</p>@enderror

            <button type="submit">追加</button>
        </form>
    </div>
</div>
@endsection
