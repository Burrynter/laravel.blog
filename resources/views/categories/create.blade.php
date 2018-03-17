@extends('layouts/basicpage')

@section('content')
    <div class="row">
        <div class="col-md-6" style="margin-left: auto; margin-right: auto;">
            <h3>Создать категорию</h3>
            {!! Form::open(['action' => 'CategoriesController@store', 'method' => 'post']) !!}
                <div class="form-group">
                    {{Form::label('name', 'Название')}}
                    {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Название'])}}
                </div>
                <div class="form-group">
                    {{Form::label('desc', 'Описание')}}
                    {{Form::textarea('desc', '', ['class' => 'form-control', 'placeholder' => 'Описание категории'])}}
                </div>
                {{Form::submit('Создать', ['class' => 'btn btn-secondary'])}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection