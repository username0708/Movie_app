<head>
    <title>本当に「{{ $movie -> mName }}」を削除しますか？</title>
    <style>
        table,tr,td,th{
            border: solid 1px black;border-collapse: collapse;
        }
        fd,th{
            min-width: 32px;
        }
        th{
            background: silver;
        }
    </style>
</head>
<body>
    <h1>{{ $movie -> mName }}</h1>
    <div>
        <a href="{{ route('movie.index') }}">< 戻る</a><br/>
        <p>映画情報</p>
        <table>
            <tr>
                <th>映画名</th><th>公開日</th><th>上映時間(分)</th>
            </tr>
            <tr>
                <td>{{ $movie -> mName }}</td><td>{{ $movie -> date }}</td><td>{{ $movie -> time }}</td>
            </tr>
        </table>
        <br/>
        {{-- <button type="button" onclick="location.href='{{ route('movie.delete', ['mID' => $movie->mID]) }}'">削除を確定</button> --}}
        <form action="{{ route('movie.delete', ['mID' => $movie->mID]) }}" method="post">
            @method('DELETE')
            @csrf
            <button type="submit">削除を確定</button>
        </form>
    </div>
</body>
