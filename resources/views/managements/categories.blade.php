@extends('layouts.basicpage')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default" style="background-color:#333;">
                <div class="card-header"><h3>Управление категориями</h3>
                Внимание! Удаление категории приведёт к удалению постов в этой категории</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <a href="/manage/categories/new" class="btn btn-secondary">Создать категорию</a>
                    <hr>
                    
                    @if(count($categories) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Категории:</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($categories->sortBy('name') as $category)
                                <tr>
                                    <td>
                                        <a href="{{ action('CategoriesController@show', $category->slug) }}">{{$category->name}}</a><br>
                                        {{$category->desc}}
                                    </td>
                                    <td>
                                        <a href="{{ action('CategoriesController@edit', $category->slug) }}" class="btn btn-secondary">Редактировать</a>
                                    </td>
                                    <td>
                                        {!!Form::open(['action' => ['CategoriesController@destroy', $category->id], 'method' => 'POST'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Удалить', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>Не найдено ни одной категории</p>
                    @endif     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
