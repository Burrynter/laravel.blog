@extends('layouts/basicpage')

@section('content')
    <div class="row">
        <div class="col-md-6" style="margin-left: auto; margin-right: auto;">
            <h3>Написать пост</h3>
            {!! Form::open(['action' => 'PostsController@store', 'method' => 'post']) !!}
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
                {{Form::submit('Создать', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection