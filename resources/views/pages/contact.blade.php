@extends('layouts/basicpage')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Обратная связь<h1>
            <hr>
            <form>
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
                    <label name="message">Сообщение:</label>
                    <textarea id="email" name="email" class="form-control" placeholder="Введите ваше сообщение здесь">
                </div>

                <input type="submit" value="Отправить" class="btn btn-success">
            </form>
        </div>
    </div>
@endsection 