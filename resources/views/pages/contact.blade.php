@extends('layouts/basicpage')

@section('content')
    <p>
        Name	Required	Validate Rule
            ФИО	Yes	Chars and \s,’
            Телефон	Yes	+38(xxx)-xxx-xx-xx
            Email	Yes	Standart email rule
            Сообщение	Yes	Chars > 10 symbols
            Капча	Yes	https://www.google.com/recaptcha/intro/index.html
    </p>       
@endsection 