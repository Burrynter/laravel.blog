@extends('layouts/basicpage')

@section('content')
    <div class="container archive">
        <h1>Тэги</h1> 
        <hr>
        @if(count($tags) > 0)
            @foreach($tags as $tag)
                <aside class="one-third column olderpost">
                    <h3><a href="/tags/{{$tag->slug}}">{{$tag->name}}</a></h3>
                </aside>
            @endforeach
        @else
            <p>Тэги не найдены</p>
        @endif
    </div>
@endsection