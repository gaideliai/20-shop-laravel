<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="https://unpkg.com/swiper/swiper-bundle.js" defer></script> --}}
    <script src="{{ asset('js/app.js') }}" defer></script>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css"> --}}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                {{-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> --}}
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link dodo-logo" href="">
                                <img class="logo-img" src="https://cdn.dodostatic.net/site-static/dist/be20534fd8b4b6d47024.svg" alt="">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mt-1" href="">Picos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mt-1" href="">Užkandžiai</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mt-1" href="">Desertai</a>
                        </li>
                        <li class="nav-item mt-1">
                            <a class="nav-link" href="">Gėrimai</a>
                        </li>                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link cart-button px-3 d-flex" href="">Krepšelis
                                <div id="cart-count">
                                    @include('front.mini-cart')
                                </div>                                                               
                            </a>
                            <div class="mini-cart-list">
                                <ul>
                                    @foreach ($cartProducts as $item)
                                        <li>{{$item->title}} {{$item->price}}&#8364; x {{$cart[$item->id]['count']}} {{$cart[$item->id]['price']}}&#8364;</li>                                        
                                    @endforeach
                                    <div class="sum">Užsakymo suma: {{$total}}&#8364;</div>
                                </ul>                               
                            </div> 
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
