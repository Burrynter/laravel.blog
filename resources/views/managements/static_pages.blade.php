@extends('layouts.basicpage')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default" style="background-color:#333;">
                <div class="card-header"><h3>Управление статичными страницами</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <hr>
                    
                    <table class="table table-striped">
                        <tr>
                            <th>Страницы:</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>
                                <a href="/about">{{$about->name}}</a><br>
                                {{$about->desc}}
                            </td>
                            <td>
                                <a href="{{ action('ManagementController@editStatic', $about->id) }}" class="btn btn-secondary">Редактировать</a>
                            </td>
                            <td>
                                @if($about->published)
                                    <a href="{{ action('ManagementController@hideStatic', $about->id) }}" class="btn btn-secondary">Спрятать</a>
                                @else
                                    <a href="{{ action('ManagementController@publishStatic', $about->id) }}" class="btn btn-secondary">Опубликовать</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="/contact">{{$contact->name}}</a><br>
                                {{$contact->desc}}
                            </td>
                            <td>
                                <a href="{{ action('ManagementController@editStatic', $contact->id) }}" class="btn btn-secondary">Редактировать</a>
                            </td>
                            <td>
                                    @if($contact->published)
                                    <a href="{{ action('ManagementController@hideStatic', $contact->id) }}" class="btn btn-secondary">Спрятать</a>
                                @else
                                    <a href="{{ action('ManagementController@publishStatic', $contact->id) }}" class="btn btn-secondary">Опубликовать</a>
                                @endif
                            </td>
                        </tr>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
