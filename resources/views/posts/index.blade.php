@extends('layouts/basicpage')



@section('content')
    <div class="container archive">
        <a href="/post" class="btn btn-secondary">Написать пост</a> 
    <hr>
    {{$posts->links()}}
    @if(count($posts) > 0)
    <?php $postsInRow = 1; ?>
        @foreach($posts as $post)
            @if($postsInRow == 1)
                <div class="row">
            @endif
            <aside class="one-third column olderpost">
                <h3><a href="/{{$post->category->slug}}/{{$post->slug}}">{{$post->title}}</a></h3>
                <section class="meta">
                    <span class="date">Автор: {{$post->user->name}}<br>Дата создания: {{$post->created_at->format('d-m-Y')}}</span>
                    <span class="filing">Категория: <a href="/{{$post->category->slug}}" class="btn btn-outline-secondary">{{$post->category->name}}</a></span>
                    <span class="filing">Тэги: 
                        @if(count($post->tags) > 0)
                            @foreach($post->tags as $tag)
                                <a href="/tags/{{$tag->slug}}">{{$tag->name}}</a>
                            @endforeach
                        @else
                            Без тэгов
                        @endif
                    </span>
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
        <p>Посты не найдены</p>
    @endif
    </div>
@endsection