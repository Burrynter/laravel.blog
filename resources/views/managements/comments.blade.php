@extends('layouts.basicpage')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default" style="background-color:#333;">
                <div class="card-header"><h3>Управление комментариями</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <hr>
                    
                    @if(count($comments) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Комментарии:</th>
                                <th>Пост:</th>
                                <th></th>
                            </tr>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>
                                        <p>{{ $comment->user->name }}</p>
                                        <span class="date">{{$comment->created_at->format('d-m-Y')}} в {{$comment->created_at->format('H:i')}}</span>
                                        <p>{{$comment->body}}</p><br>
                                    </td>
                                    <td>
                                        <a href="/{{$comment->post->category->slug}}/{{$comment->post->slug}}" class="btn btn-secondary">{{$comment->post->title}}</a>
                                    </td>
                                    <td>
                                        {!!Form::open(['action' => ['CommentsController@destroy', $comment->id], 'method' => 'POST'])!!}
                                            {{Form::hidden('url', URL::previous())}}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Удалить', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>Не найдено ни одного комментария</p>
                    @endif     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
