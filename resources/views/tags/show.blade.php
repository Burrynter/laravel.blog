@extends('layouts/basicpage')

@section('content')
    <div class="container archive">
    <h1>{{$tag->name}}</h1>
    <a href="/tags" class="btn btn-secondary">Тэги</a> <a href="/post" class="btn btn-secondary">Написать пост</a>
    <hr>
    @if(count($tag->posts) > 0)
        <h3>Посты с тэгом {{$tag->name}}:</h3>
        @foreach($tag->posts->reverse() as $post)
            <aside class="one-third column olderpost">
                <h3><a href="{{ action('PostsController@show', [$post->category->slug, $post->slug]) }}">{{$post->title}}</a></h3>
                <section class="meta">
                    <span class="date">Автор: {{$post->user->name}}<br>Дата создания: {{$post->created_at->format('d-m-Y')}}</span>
                    <span class="filing">Категория: <a href="/{{$post->category->slug}}" class="btn btn-outline-secondary">{{$post->category->name}}</a></span>
                </section>
                <p>
                    {{ str_limit(strip_tags($post->body), 100) }}
                    @if (strlen(strip_tags($post->body)) > 100)
                        <a href="{{ action('PostsController@show', [$post->category->slug, $post->slug]) }}">Читать далее</a>
                    @endif
                </p>
            </aside>
        @endforeach
    @else
        <p>Нет постов с тэгом {{$tag->name}}</p>
    @endif
    </div>
@endsection