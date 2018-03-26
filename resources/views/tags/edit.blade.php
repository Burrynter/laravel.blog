@extends('layouts/basicpage')

@section('content')
    <div class="row">
        <div class="col-md-6" style="margin-left: auto; margin-right: auto;">
            <h3>Редактировать тэг</h3>
            {!! Form::open(['action' => ['TagsController@update', $tag->id], 'method' => 'post']) !!}
                <div class="form-group">
                    {{Form::label('name', 'Название')}}
                    {{Form::text('name', $tag->name, ['class' => 'form-control', 'placeholder' => 'Название'])}}
                </div>
                <div class="form-group">
                    {{Form::label('slug', 'URI')}}
                    {{Form::text('slug', $tag->slug, ['class' => 'form-control', 'placeholder' => 'URI'])}}
                </div>
                {{Form::submit('Изменить', ['class' => 'btn btn-secondary'])}}
                {{Form::hidden('_method', 'PUT')}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection