@extends('layouts/basicpage')

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="post ten offset-by-one columns">
                <h1>{{$post->title}}</h1>
                
                <section class="meta">
                    <span class="date">
                        Автор: {{$post->user->name}}<br>
                        Время написания: {{$post->created_at->format('d-m-Y')}} в {{$post->created_at->format('H:i')}}
                    </span><br>
                    <span class="filing">Категория: <a href="/{{$post->category->slug}}" class="btn btn-outline-secondary">{{$post->category->name}}</a></span>
                </section>
                
                <p>{!!$post->body!!}</p>
    <hr>
    <p>
        Тэги: 
        @if(count($post->tags) > 0)
            @foreach($post->tags as $tag)
                <a href="/tags/{{$tag->slug}}">{{$tag->name}}</a>
            @endforeach
        @else
            Без тэгов
        @endif
    </p>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
        <span class="filing">
            <a href="{{ action('PostsController@edit', [$post->category->slug, $post->slug]) }}" class="btn btn-primary">Редактировать</a>
        </span>
        <span class="filing">
            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST'])!!}
                {{Form::hidden('url', URL::previous())}}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Удалить', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        </span>
        @endif
    <hr>
    @endif
    
    <h3>Комментарии</h3>
    @forelse ($post->comments as $comment)
        <p>{{ $comment->user->name }}</p>
        <section class="meta">
        <span class="date">{{$comment->created_at->format('d-m-Y')}} в {{$comment->created_at->format('H:i')}}</span>
    </section>
    <p>{{ $comment->body }}</p>

    @if(Auth::user()->id == $comment->user_id)
        <span class="filing">            
            {!!Form::open(['action' => ['CommentsController@destroy', $comment->id], 'method' => 'POST'])!!}
                {{Form::hidden('url', URL::previous())}}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Удалить', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        </span>
    @endif

    <hr>
    @empty
    <p>Этот пост ещё не комментировали</p>
    @endforelse

    @if (Auth::check())
    {{ Form::open(['route' => ['comments.store'], 'method' => 'POST']) }}
    <div class="form-group">
        <p>{{ Form::textarea('body', null, ['size' => '50x2', 'style' => 'background-color: #333;', 'placeholder' => 'Написать комментарий']) }}</p>
    </div>
    {{ Form::hidden('post_id', $post->id) }}
    
    <p>{{Form::submit('Отправить', ['class' => 'btn btn-primary'])}}</p>
    {{ Form::close() }}
    @endif

    

            </div>
        </div>
    </div>
@endsection