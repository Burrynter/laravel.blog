<nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      {{ config('app.name', 'Laravel') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="/posts">Блог</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/categories">Категории</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/tags">Тэги</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/about">О проекте</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/contact">Контакты</a>
        </li>
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
          <li><a class="nav-link" href="{{ route('login') }}">Вход</a></li>
          <li><a class="nav-link" href="{{ route('register') }}">Регистрация</a></li>
        @else
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @if(Auth::user()->hasRole('admin'))
                <a class="dropdown-item" href="/manage">Управление</a>
              @endif
              @if(Auth::user()->hasRole('moderator'))
                <a class="dropdown-item" href="/manage/posts">Все посты</a>
              @endif

              <a class="dropdown-item" href="/dashboard">Ваши посты</a>
              
              <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                  Выйти
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>