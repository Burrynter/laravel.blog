@extends('layouts/basicpage')

@section('content')
    <div class="row">
        <div class="col-md-6" style="margin-left: auto; margin-right: auto;">
            <h3>Редактировать контент страницы "{{$page->name}}"</h3>
            {!! Form::open(['action' => ['ManagementController@updateStatic', $page->id], 'method' => 'post']) !!}
                <div class="form-group">
                    {{Form::label('name', 'Название')}}
                    {{Form::text('name', $page->name, ['class' => 'form-control', 'placeholder' => 'Название'])}}
                </div>
                <div class="form-group">
                    {{Form::label('desc', 'Описание')}}
                    {{Form::textarea('desc', $page->desc, ['class' => 'form-control', 'placeholder' => 'Описание страницы'])}}
                </div>
                <div class="form-group">
                    {{Form::label('body', 'Контент')}}
                    {{Form::textarea('body', $page->body, ['class' => 'form-control', 'id' => 'article-ckeditor', 'placeholder' => 'Контент'])}}
                </div>
                {{Form::submit('Изменить', ['class' => 'btn btn-secondary'])}}
                {{Form::hidden('_method', 'PUT')}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection