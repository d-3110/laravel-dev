@extends('layouts.default')
@section('title', 'Starter Template｜Flat UI')
@section('content')
<h1>Bootstrap表示テスト</h1><br>
        <button type="button" class="btn btn-default">Default</button><br><br>

        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                ドロップダウン
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li role="presentation"><a href="#">リンクのリスト１</a></li>
                <li role="presentation"><a href="#">リンクのリスト２</a></li>
                <li role="presentation"><a href="#">リンクのリスト３</a></li>
            </ul>
        </div><br>
        <div class="alert alert-primary" role="alert">primary</div>
@endsection

