@extends('layouts/basicpage')

@section('content')
    <div class="row">
        <div class="col-md-6" style="margin-left: auto; margin-right: auto;">
            <h3>Редактировать пост</h3>
            {!! Form::open(['action' => ['PostsController@update', $data['post']->id], 'method' => 'post']) !!}
                <div class="form-group">
                    {{Form::label('title', 'Название')}}
                    {{Form::text('title', $data['post']->title, ['class' => 'form-control', 'placeholder' => 'Название'])}}
                </div>
                @if(Auth::user()->hasRole('moderator') || Auth::user()->hasRole('admin'))
                    {{Form::label('category', 'Категория')}}
                    {{Form::select('category', $data['categories'], $data['post']->category_id, ['class'=>'form-control'])}}
                @endif
                <div class="form-group">
                    {{Form::label('body', 'Пост')}}
                    {{Form::textarea('body', $data['post']->body, ['class' => 'form-control', 'id' => 'article-ckeditor', 'placeholder' => 'Текст поста'])}}
                </div>
                
                <?php
                    $tagList = '';  
                    foreach ($data['post']->tags as $tag) {
                        $tagList .= $tag->name . ', ';
                    }
                    $tagList = trim($tagList, ', ');
                ?>

                <div class="form-group">
                    {{Form::label('tags', 'Тэги (разделяются запятой)')}}
                    {{Form::text('tags', $tagList, ['class' => 'form-control', 'placeholder' => 'Тэги'])}}
                </div>
                {{Form::submit('Изменить', ['class' => 'btn btn-secondary'])}}
                {{Form::hidden('_method', 'PUT')}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection