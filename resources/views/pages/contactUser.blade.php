@extends('layouts/basicpage')

@section('content')
    <div class="row jumbotron" style="background-color: #222;">
        <div class="col-sm-3" style="margin-left: auto; margin-right: auto;">
            @if ($contact->published)
                {!!$contact->body!!}
            @else <h1>Maintenance, please check in later</h1>
            @endif
            <a href="{{ route('contactAdmin') }}" class="btn btn-secondary">Администратору</a>
            <a href="{{ route('contactUser') }}" class="btn btn-secondary">Пользователю</a>
            <h1>Обратная связь<h1>
            <hr>
            <form action="{{ url('/contact/user') }}" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                    <label name="name">Ф.И.О.:</label>
                    <input id="name" name="name" class="form-control" placeholder="Фамилия Имя Отчество">
                </div>
                <div class="form-group">
                    <label name="phone">Телефон:</label>
                    <input id="phone" name="phone" class="form-control" placeholder="+38(xxx)-xxx-xx-xx">
                </div>
                <div class="form-group">
                    <label name="email">E-Mail:</label>
                    <input id="email" name="email" class="form-control" placeholder="your-email@example.com">
                </div>
                <div class="form-group">
                    <label name="destination">Адресат:</label>
                    <select name="destination" size="2">
                        @foreach ($users as $user)
                            @if (auth()->user()->email !== $user->email)
                            <option value="{{$user->email}}" style="color: #333; font-size: 20px;">{{$user->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label name="body">Сообщение:</label>
                    <textarea id="body" name="body" class="form-control" placeholder="Введите ваше сообщение здесь"></textarea>
                </div>

                <div class="g-recaptcha" data-sitekey="6LcTQk0UAAAAAGzeZUtqnzqTZcQV60h025Qe8sZS" lang="ru"></div>

                <input type="submit" value="Отправить" class="btn btn-success">
            </form>
        </div>
    </div>
@endsection 