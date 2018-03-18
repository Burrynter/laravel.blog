@extends('layouts/basicpage')



@section('content')
    <div class="container archive">
        <h1>Категории </h1> 
        <hr>
        @if(count($categories) > 0)
        <?php $categoriesInRow = 1; ?>
            @foreach($categories as $category)
                @if($categoriesInRow == 1)
                    <div class="row">
                @endif
                <aside class="one-third column olderpost">
                    <h3><a href="{{ action('CategoriesController@show', $category) }}">{{$category->name}}</a></h3>
                    <p>
                        {!! str_limit($category->desc, 150) !!}
                    </p>
                </aside>
                <?php $categoriesInRow++ ?>
                @if($categoriesInRow > 3)
                    </div>
                    <?php $categoriesInRow = 1; ?>
                @endif
            @endforeach
        @else
            <p>Категории не найдены</p>
        @endif
    </div>
@endsection