<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Computer store</title>

    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/css/basic.css') }}">
    @section('stylesSection')
    @show
</head>
<body class="d-flex flex-column">
    <div id="app" class="d-flex flex-column flex-grow-1">
        <header class="navbar navbar-expand-md navbar-light w-100 d-flex align-items-center">
            <div class="container">
                <a class="navbar-brand" id="sitename" href="{{ url('/') }}">
                    Computer store
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
        </header>
            <nav class="navbar navbar-light">
                <a class="navbar-brand" href="#">
                    @yield('pageName')
                </a>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsComputerStore" aria-controls="navbarsComputerStore" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                    </span>
                </button>
                <div class="navbar-collapse collapse" id="navbarsComputerStore" style="">
                    <ul class="navbar-nav mr-auto">
                        @if (Request::url() == url('/home') || Request::url() == url('/'))
                            <li class="nav-item active">
                        @else
                            <li class="nav-item">
                        @endif
                            <a class="nav-link" href={{ url('/home') }}>
                                Главная
                            </a>
                        </li>
                        @if (Request::url() == url('/news'))
                            <li class="nav-item active">
                        @else
                            <li class="nav-item">
                        @endif
                            <a class="nav-link" href={{ url('/news') }}>
                                Новости
                            </a>
                        </li>
                        @if (Request::url() == url('/stocks'))
                            <li class="nav-item active">
                        @else
                            <li class="nav-item">
                        @endif
                            <a class="nav-link" href={{ url('/stocks') }}>
                                Акции
                            </a>
                        </li>
                        @if (Auth::check())
                            @if (Request::url() == url('/users/' . Auth::id()))
                                <li class="nav-item active">
                            @else
                                <li class="nav-item">
                            @endif
                                <a class="nav-link" href={{ url('/users/' . Auth::id()) }}>
                                    Профиль
                                </a>
                            </li>
                            @if (Request::url() == url('/basket'))
                                <li class="nav-item active">
                            @else
                                <li class="nav-item">
                            @endif
                                <a class="nav-link" href={{ url('/basket') }}>
                                    Корзина
                                </a>
                            </li>
                        @endif
                        @if (preg_match('/\/types/', Request::url()) != 1)
                            @isset($types)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href={{ url('/products') }} id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Товары
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdown05">
                                        @foreach ($types as $type)
                                            <a class="dropdown-item" href={{ url('/products/type/' . $type->id) }}>
                                                {{ $type->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </li>
                            @endisset
                        @endif
                        @if (Auth::check())
                            @if (Auth::user()->role == 0)
                                @if (Request::url() == url('/users'))
                                    <li class="nav-item active">
                                @else
                                    <li class="nav-item">
                                @endif
                                    <a class="nav-link" href={{ url('/users') }}>
                                        Пользователи
                                    </a>
                                </li>
                                @if (Request::url() == url('/types'))
                                    <li class="nav-item active">
                                @else
                                    <li class="nav-item">
                                @endif
                                    <a class="nav-link" href={{ url('/types') }}>
                                        Категории товаров
                                    </a>
                                </li>
                                @if (Request::url() == url('/paytypes'))
                                    <li class="nav-item active">
                                @else
                                    <li class="nav-item">
                                @endif
                                    <a class="nav-link" href={{ url('/paytypes') }}>
                                        Способы оплаты
                                    </a>
                                </li>
                                @if (Request::url() == url('/deliverytypes'))
                                    <li class="nav-item active">
                                @else
                                    <li class="nav-item">
                                @endif
                                    <a class="nav-link" href={{ url('/deliverytypes') }}>
                                        Способы доставки
                                    </a>
                                </li>
                                @if (Request::url() == url('/userorders'))
                                    <li class="nav-item active">
                                @else
                                    <li class="nav-item">
                                @endif
                                    <a class="nav-link" href={{ url('/userorders') }}>
                                        Оформленные заказы
                                    </a>
                                </li>
                                @if (Request::url() == url('/statuses'))
                                    <li class="nav-item active">
                                @else
                                    <li class="nav-item">
                                @endif
                                    <a class="nav-link" href={{ url('/statuses') }}>
                                        Виды cостояний заказов
                                    </a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </div>
            </nav>
        <div class="container d-flex flex-grow-1">
            <div class="row w-100 justify-content-center">
                <main class="col container">
                    @section('contentSection')
                    @show
                </main>
            </div>
        </div>
        <a href="#" class="btn btn-primary">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <img src={{ asset('public/simgs/arrow-circle-top-4x.png') }}>
                    </div>
                    <div class="col">
                        <img src={{ asset('public/simgs/arrow-circle-top-4x.png') }}>
                    </div>
                    <div class="col">
                        <img src={{ asset('public/simgs/arrow-circle-top-4x.png') }}>
                    </div>
                </div>
            </div>
        </a>
        <footer class="text-center w-100">
            <div class="vspacer10px"></div>
            Шилов Анатолий<br>
            ИС-41о<br>
            СевГУ, 2019<br>
            Курсовой проект по дисциплине "Web-технологии"<br>
        </footer>
    </div>
</body>
</html>
