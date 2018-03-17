@extends('layouts.basicpage')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default" style="background-color:#333;">
                <div class="card-header"><h3>Управление тэгами</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <hr>
                    
                    @if(count($tags) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Тэги:</th>
                                <th>Посты с тэгом:</th>
                                <th></th>
                            </tr>
                            @foreach($tags as $tag)
                                <tr>
                                    <td>
                                        <a href="/tags/{{$tag->slug}}">{{$tag->name}}</a><br>
                                    </td>
                                    <td>
                                        @foreach($tag->posts as $post)
                                            <a href="/{{$post->category->slug}}/{{$post->slug}}" class="btn btn-secondary">{{$post->title}}</a>
                                        @endforeach
                                    </td>
                                    <td>
                                        {!!Form::open(['action' => ['TagsController@destroy', $tag->id], 'method' => 'POST'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Удалить', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>Не найдено ни одного тэга</p>
                    @endif     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
