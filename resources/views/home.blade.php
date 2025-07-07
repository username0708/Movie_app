@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Movie/index.css') }}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('movie.index') }}">映画一覧へ戻る</a>

                    <div class="review">
                        <h4>マイレビュー一覧</h4>
                        @if ($reviews->isEmpty())
                            <p>まだレビューがありません。</p>
                        @else
                            <ul>
                                {{-- @dd($reviews); --}}
                                @foreach ($reviews as $review)
                                    <div class="posted-review">
                                        <strong><a href="{{route('movie.title', ['mID' => $review->movie->mID]) }}">{{ $review->movie->mName }}</a></strong>
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
                    <div>
                        @can('addMovie')
                            <button type="button" onclick="location.href='{{ route('movie.create.index') }}'">映画を追加</button><br/>
                        @endcan
                        @can('addGenre')
                            <form action="{{ route('movie.genre.create') }}" method="post">
                                @csrf
                                <span>ジャンル名</span><input id="ganreName" type="text" name="genreName">
                                <button type="submit">ジャンルを追加</button>
                                @error('genreName')<p style="color: red;">{{ $message }}</p>@enderror
                            </form><br/>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
