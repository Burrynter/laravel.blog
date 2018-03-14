@extends('layouts/basicpage')

@section('content')
    <h3>Редактировать пост</h3>

    {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'post']) !!}
        <div class="form-group">
            {{Form::label('category', 'Категория')}}
            {{Form::select('category', $categories, null, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('title', 'Название')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Название'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Пост')}}
            {{Form::textarea('body', '', ['class' => 'form-control', 'id' => 'article-ckeditor', 'placeholder' => 'Текст поста'])}}
        </div>
        <div class="form-group">
            {{Form::label('tags', 'Тэги (разделяются запятой)')}}
            {{Form::text('tags', '', ['class' => 'form-control', 'placeholder' => 'Тэги'])}}
        </div>
        {{Form::submit('Изменить', ['class' => 'btn btn-primary'])}}
        {{Form::hidden('_method', 'PUT')}}
    {!! Form::close() !!}
@endsection