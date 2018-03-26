@extends('layouts/basicpage')

@section('content')
    <div class="row">
        <div class="col-md-6" style="margin-left: auto; margin-right: auto;">
            <h3>Редактировать категорию</h3>
            {!! Form::open(['action' => ['CategoriesController@update', $category->slug], 'method' => 'post']) !!}
                <div class="form-group">
                    {{Form::label('name', 'Название')}}
                    {{Form::text('name', $category->name, ['class' => 'form-control', 'placeholder' => 'Название'])}}
                </div>
                @if(Auth::user()->hasRole('moderator') || Auth::user()->hasRole('admin'))
                    {{Form::label('slug', 'URI')}}
                    {{Form::text('slug', $category->slug, ['class' => 'form-control', 'placeholder' => 'URI'])}}
                @endif
                <div class="form-group">
                    {{Form::label('desc', 'Описание')}}
                    {{Form::textarea('desc', $category->desc, ['class' => 'form-control', 'placeholder' => 'Описание категории'])}}
                </div>
                {{Form::submit('Изменить', ['class' => 'btn btn-secondary'])}}
                {{Form::hidden('_method', 'PUT')}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection