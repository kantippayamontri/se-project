<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{URL::asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/index.css') }}" rel="stylesheet">

</head>

<?php
use App\Cart;

$cart_count = count(Cart::all()->toArray());

?>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                 <h4>422 Shopping Mall</h4>
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

                        <li class="nav-item">
                        <h5><a class="nav-link" href="/product">{{ __('Product') }}</a></h5>
                        </li>


                        @guest
                        <li class="nav-item">
                           <h5> <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></h5>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                           <h5> <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></h5>
                        </li>
                        @endif
                        @else



                        <li class="nav-item">
                            <a class="nav-link" href="/promotion">{{ __('Promotion') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/vote">{{ __('Vote') }}</a>
                        </li>

                        @if (auth()->user()->isAdmin())

                        <li class="nav-item">
                            <a class="nav-link" href="/out_of_stock">{{ __('Out of stock') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/user">{{ __('User') }}</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="/cart">{{ __('Cart') }}
                                <span class="badge badge-pill badge-secondary">
                                    {{$cart_count}}
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">{{Auth::user()->money}}</a>
                        </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    {{ __('Profile') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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

        </nav>
        <main>

            @yield('content')

        </main>
    </div>
    </div>
</body>

</html>