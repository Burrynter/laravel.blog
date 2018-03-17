@extends('layouts/basicpage')

@section('content')
    <div class="container archive">
    <h1>{{$tag->name}}</h1>
    <a href="/tags" class="btn btn-secondary">Тэги</a> <a href="/post" class="btn btn-secondary">Написать пост</a>
    <hr>
    @if(count($tag->posts) > 0)
        <h3>Посты с тэгом {{$tag->name}}:</h3>
        <?php $postsInRow = 1; ?>
        @foreach($tag->posts->reverse() as $post)
            @if($postsInRow == 1)
                <div class="row">
            @endif
            <aside class="one-third column olderpost">
                <h3><a href="{{ action('PostsController@show', [$post->category->slug, $post->slug]) }}">{{$post->title}}</a></h3>
                <section class="meta">
                    <span class="date">
                        Автор: {{$post->user->name}}<br>
                        Время написания: {{$post->created_at->format('d-m-Y')}} в {{$post->created_at->format('H:i')}}
                    </span>
                    <span class="filing">Категория: <a href="/{{$post->category->slug}}" class="btn btn-outline-secondary">{{$post->category->name}}</a></span>
                    <span>Комментарии: {{$post->comments->count()}}</span>
                </section>
                <p>
                    {!! str_limit($post->body, 100) !!}
                    @if (strlen($post->body) > 100)
                        <a href="{{ action('PostsController@show', [$post->category->slug, $post->slug]) }}">Читать далее</a>
                    @endif
                </p>
            </aside>
            <?php $postsInRow++ ?>
            @if($postsInRow > 3)
                </div>
                <?php $postsInRow = 1; ?>
            @endif
        @endforeach
    @else
        <p>Нет постов с тэгом {{$tag->name}}</p>
    @endif
    </div>
@endsection