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
                @if(Auth::user()->hasRole('moderator') || Auth::user()->hasRole('admin'))
                    {{Form::label('category', 'Категория')}}
                    {{Form::select('category', $categories, $post->category_id, ['class'=>'form-control'])}}
                    {{Form::label('slug', 'URI')}}
                    {{Form::text('slug', $post->slug, ['class' => 'form-control', 'placeholder' => 'URI'])}}
                @endif
                <div class="form-group">
                    {{Form::label('body', 'Пост')}}
                    {{Form::textarea('body', $post->body, ['class' => 'form-control', 'id' => 'article-ckeditor', 'placeholder' => 'Текст поста'])}}
                </div>

                <div class="form-group">
                    {{Form::label('tagsList', 'Существующие тэги (ctrl+клик для множественного выбора):')}}
                    {{Form::select('tagsList[]', $allTags, $keys, 
                        ['id' => 'tagsList', 'multiple' => 'multiple', 'size' => '4', 'style' => 'color: #333;'])}}
                </div>
                <div class="form-group">
                    {{Form::label('tags', 'Новые тэги (разделяются запятой с пробелом (", "))')}}
                    {{Form::text('tags', '', ['class' => 'form-control', 'placeholder' => 'Тэги'])}}
                </div>
                {{Form::submit('Изменить', ['class' => 'btn btn-secondary'])}}
                {{Form::hidden('_method', 'PUT')}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection