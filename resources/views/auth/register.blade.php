<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/button.css">
    <link rel="stylesheet" href="/css/backgroundColor.css">
    <title>Library</title>
</head>
<body>
        <div class="container">
            @extends('layouts.app')
            @section('content')
            <h1>職員登録</h1>
            @include('commons/flash')
            <form action="{{ route('register') }}" method="post">
                @csrf
                <p>
                    <label>メールアドレス</label><br>
                    <input type="text" name="email" value="{{ old('email') }}">
                </p>
                <p>
                    <label>パスワード</label><br>
                    <input type="password" name="password" value="">
                </p>
                <p>
                    <label>パスワード（確認）</label><br>
                    <input type="password" name="password_confirmation" value="">
                </p>
                <p>
                    <button class="log" type="submit">登録</button>
                </p>
                <p>
                    <a href="{{ route('login') }}">ログイン</a>
                </p>
            </form>
            @endsection
        </div>
    </main>
</body>
</html>