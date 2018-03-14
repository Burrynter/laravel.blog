@extends('layouts/basicpage')

@section('content')
    <div class="container archive">
    <h1>{{$tag->name}}</h1>
    <a href="/tags" class="btn btn-secondary">Тэги</a> <a href="/post" class="btn btn-secondary">Написать пост</a>
    <hr>
    @if(count($tags->posts) > 0)
        <h3>Посты с тэгом {{$tag->name}}:</h3>
        <?php $postsInRow = 1; ?>
        @foreach($tag->posts->reverse() as $post)
            @if($postsInRow == 1)
                <div class="row">
            @endif
            <aside class="one-third column olderpost">
                <h3><a href="{{ action('PostsController@show', [$post->category->slug, $post->slug]) }}">{{$post->title}}</a></h3>
                <section class="meta">
                    <span class="date">Автор: {{$post->user->name}}<br>Дата создания: {{$post->created_at->format('d-m-Y')}}</span>
                </section>
                <p>
                    {{ str_limit(strip_tags($post->body), 100) }}
                    @if (strlen(strip_tags($post->body)) > 100)
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