@extends('layouts/basicpage')

@section('content')
    <div class="row">
        <div class="col-md-6" style="margin-left: auto; margin-right: auto;">
            <h3>Редактировать пост</h3>
            {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'post']) !!}
                <div class="form-group">
                    {{Form::label('title', 'Название')}}
                    {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Название'])}}
                </div>
                <div class="form-group">
                    {{Form::label('body', 'Пост')}}
                    {{Form::textarea('body', $post->body, ['class' => 'form-control', 'id' => 'article-ckeditor', 'placeholder' => 'Текст поста'])}}
                </div>
                
                <?php
                    $tagList = '';  
                    foreach ($post->tags as $tag) {
                        $tagList .= $tag->name . ', ';
                    }
                    $tagList = trim($tagList, ', ');
                ?>

                <div class="form-group">
                    {{Form::label('tags', 'Тэги (разделяются запятой)')}}
                    {{Form::text('tags', $tagList, ['class' => 'form-control', 'placeholder' => 'Тэги'])}}
                </div>
                {{Form::submit('Изменить', ['class' => 'btn btn-primary'])}}
                {{Form::hidden('_method', 'PUT')}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection