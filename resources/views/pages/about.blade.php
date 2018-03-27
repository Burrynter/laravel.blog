@extends('layouts/basicpage')

@section('content')
<div class="row jumbotron" style="background-color: #222;">
    <div class="col-md-4 text-center" style="margin-left: auto; margin-right: auto;">
        @if ($about->published)
            {!!$about->body!!}
        @else <h1>Maintenance, please check in later</h1>
        @endif
    </div>
</div>
@endsection
