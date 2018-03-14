@extends('layouts/basicpage')

@section('content')
    <div class="jumbotron  text-center" style="background-color: #333;">
        <h1>{{$title}}</h1>
        <p>Экзаменационный проект для курса PHP-программирования</p>
        @guest
            <p><a class="btn btn-primary btn-lg" href="/login" role="button">Вход &raquo;</a> <a class="btn btn-success btn-lg" href="/register" role="button">Регистрация &raquo;</a></p>
        @else
            <p><a class="btn btn-secondary btn-lg" href="/posts" role="button">Перейти к блогу</a>
        @endguest
    </div>
@endsection