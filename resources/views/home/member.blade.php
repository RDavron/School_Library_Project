@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/button.css">
    <link rel="stylesheet" href="/css/backgroundColor.css">
    <div class="button-display">
        <div>
            <button class="btn"><a href="/search" style="color: white;">検索</a></button>
        </div>
        
        <div>
            <button class="btn"><a href="{{route('members.create') }}" style="color: white;">作成 </a></button>
        </div>
        
        <div>
            <button class="btn"><a href="/home" style="color: white;">マイページ</a></button>
        </div>
        <h1>会員管理</h1>
    </div>

@endsection
