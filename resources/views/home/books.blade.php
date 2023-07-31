@extends('layouts.app')

@section('content')
        <link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" href="/css/button.css">
        <link rel="stylesheet" href="/css/backgroundColor.css">
    <body>
            
        <div class="button-display">
            <div>
                <button class="btn"><a href="{{route('lends.index') }}" style="color: white;">返却</a></button>
            </div>
            
            <div>
                <button class="btn"><a href="{{route('lends.store') }}" style="color: white;">貸出</a></button>
            </div>
            <div>
                <button class="btn"><a href="{{route('documents.index') }}" style="color: white;">資料管理</a></button>
            </div>
            <div>
                <button class="btn"><a href="{{route('stocks.index') }}" style="color: white;">在庫管理</a></button>
            </div>
            <div>
                <button class="btn"><a href="/home" style="color: white;">マイページ</a></button>
            </div>
            <h1>資料管理</h1>
        </div>
    </body>
@endsection