@extends('layouts.basicpage')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default" style="background-color:#333;">
                <div class="card-header"><h3>Управление пользователями</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    Внимание! Удаление пользователя приводит к удалению всех его постов и комментариев.
                    <hr>
                    
                    
                    @if(count($users) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Пользователи:</th>
                                <th>Роль:</th>
                                <th></th>
                            </tr>
                            @foreach($users as $user)
                                <tr>
                                    <td><p>{{$user->name}}</p></td>
                                    <td>
                                        {!!Form::open(['action' => ['ManagementController@user_roleChange', $user->id], 'method' => 'POST'])!!}
                                            {!!Form::select('new_role', ['1' => 'User', '2' => 'Moderator', '3' => 'Admin'], $user->roles()->where('user_id', $user->id)->first()->id, ['style' => 'background-color: #222;border: #222'])!!}
                                            {{Form::submit('Сменить', ['class' => 'btn btn-secondary'])}}
                                        {!!Form::close()!!}
                                    </td>
                                    <td>
                                        {!!Form::open(['action' => ['ManagementController@user_kill', $user->id], 'method' => 'POST'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Удалить', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>Непредвиденная ошибка.</p>
                    @endif     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
