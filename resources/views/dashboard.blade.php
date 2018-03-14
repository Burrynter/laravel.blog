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
                        <table class="table table-striped">
                            <tr>
                                <th>Ваши посты:</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($user->posts->reverse() as $post)
                                <tr>
                                    <td><a href="/posts/{{$post->id}}">{{$post->title}}</a><br>
                                        <small>Дата создания: {{$post->created_at->format('d-m-Y')}}</small>
                                    </td>
                                    <td>
                                        <a href="{{ action('PostsController@edit', [$post->category->slug, $post->slug]) }}" class="btn btn-primary">Редактировать</a>
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
                    @else
                        <p>Вы еще не создали ни одного поста</p>
                    @endif     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
