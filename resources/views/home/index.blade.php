@extends('layouts.app')

@section('content')
        <link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" href="/css/button.css">
        <link rel="stylesheet" href="/css/backgroundColor.css">
        <div class="button-display">
            <form action="{{route('logout') }}" method="POST">
                @csrf
                    <button class="btn" type="submit">ログアウト</button>
            </form>
                <button class="btn"><a href="home\member" style="color: white;">会員管理</a></button>
                <button class="btn"><a href="home\books" style="color: white;">資料</a></button>
            <h1>マイページ</h1>
        </div>
@endsection