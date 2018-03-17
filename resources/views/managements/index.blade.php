@extends('layouts/basicpage')

@section('content')
    <div class="jumbotron  text-center" style="background-color: #333;">
        <h1>Управление блогом</h1>
            <p>
                <a class="btn btn-secondary btn-lg" href="/manage/categories" role="button">Категории &raquo;</a> 
                <a class="btn btn-secondary btn-lg" href="/manage/posts" role="button">Посты &raquo;</a>
                <a class="btn btn-secondary btn-lg" href="/manage/comments" role="button">Комментарии &raquo;</a>
                <a class="btn btn-secondary btn-lg" href="/manage/tags" role="button">Тэги &raquo;</a>
                <a class="btn btn-secondary btn-lg" href="/manage/users" role="button">Пользователи &raquo;</a>
            </p>
    </div>
@endsection