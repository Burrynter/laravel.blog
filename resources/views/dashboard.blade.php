@extends('layouts.basicpage')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default" style="background-color:#333;">
                <div class="card-header"><h3>Добро пожаловать, {{$user->name}}!</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <a href="/post" class="btn btn-secondary">Написать пост</a>
                    <hr>
                    
                    @if(count($user->posts) > 0)
                        @if(count($user->posts->where('published', false)) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Ожидают публикации:</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($user->posts->where('published', false)->reverse() as $post)
                                <tr>
                                    <td><a href="{{ action('PostsController@show', [$post->category->slug, $post->slug]) }}">{{$post->title}}</a><br>
                                        <span class="date">
                                            Время написания: {{$post->created_at->format('d-m-Y')}} в {{$post->created_at->format('H:i')}}
                                        </span><br>
                                        <span class="filing">Категория: <a href="/{{$post->category->slug}}" class="btn btn-outline-secondary">{{$post->category->name}}</a></span><br>
                                        <span class="filing">Тэги: 
                                            @if(count($post->tags) > 0)
                                                @foreach($post->tags->sortBy('name') as $tag)
                                                    <a href="/tags/{{$tag->slug}}" class="btn btn-outline-secondary">{{$tag->name}}</a>
                                                @endforeach
                                            @else
                                                Без тэгов
                                            @endif
                                        </span><br>
                                        <span>Комментарии: {{$post->comments->count()}}</span>
                                    </td>
                                    <td>
                                        <a href="{{ action('PostsController@edit', [$post->category->slug, $post->slug]) }}" class="btn btn-secondary">Редактировать</a>
                                    </td>
                                    <td>
                                        {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST'])!!}
                                            {{Form::hidden('url', URL::previous())}}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Удалить', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        @endif
                        
                        @if(count($user->posts->where('published', true)) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Ваши посты:</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($user->posts->where('published', true)->reverse() as $post)
                                <tr>
                                    <td><a href="{{ action('PostsController@show', [$post->category->slug, $post->slug]) }}">{{$post->title}}</a><br>
                                        <span class="date">
                                            Время написания: {{$post->created_at->format('d-m-Y')}} в {{$post->created_at->format('H:i')}}
                                        </span><br>
                                        <span class="filing">Категория: <a href="/{{$post->category->slug}}" class="btn btn-outline-secondary">{{$post->category->name}}</a></span><br>
                                        <span class="filing">Тэги: 
                                            @if(count($post->tags) > 0)
                                                @foreach($post->tags->sortBy('name') as $tag)
                                                    <a href="/tags/{{$tag->slug}}" class="btn btn-outline-secondary">{{$tag->name}}</a>
                                                @endforeach
                                            @else
                                                Без тэгов
                                            @endif
                                        </span><br>
                                        <span>Комментарии: {{$post->comments->count()}}</span>
                                    </td>
                                    <td>
                                        <a href="{{ action('PostsController@edit', [$post->category->slug, $post->slug]) }}" class="btn btn-secondary">Редактировать</a>
                                    </td>
                                    <td>
                                        {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST'])!!}
                                            {{Form::hidden('url', URL::previous())}}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Удалить', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        @endif
                    @else
                        <p>Вы еще не создали ни одного поста</p>
                    @endif     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
