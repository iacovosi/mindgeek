<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>     
    <script src="{{ asset('js/toastr.min.js') }}"></script>       
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">     
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    @yield('styles')   
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
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

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
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
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                    @if(auth::check())
                        <ul class="list-group">
                                <li class="list-group-item">
                                        <a href="{{ route('home') }}">Home</a>
                                </li>                                    
                                <li class="list-group-item">
                                    <a href="{{ route('chatroom.join') }}">Join/Enter Chat Rooms</a>
                                </li>   
                                <li class="list-group-item">
                                        <a href="{{ route('messages.personal',['user_id' => Auth::user()->id]) }}">Personal Messages</a>
                                </li>
                                @if(Auth::user()->isAdmin())
                                    <li class="list-group-item">
                                            <a href="{{ route('users') }}">Make User Admin</a>
                                    </li>  
                                    <li class="list-group-item">
                                            <a href="{{ route('chatroom.create') }}">Manage Chat Room</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ route('message.create') }}">Create Message</a>
                                    </li>
                                @endif                                   
                                                                                                                                          
                        </ul>                       
                     @endif   
                    </div>
                    <div class="col-lg-10">
                            @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>


    <script>
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
            //session()->forget('success');
            //session()->flush();
        @endif
        @if(Session::has('info'))
            toastr.info("{{ Session::get('info') }}")
            //session()->forget('info');
            //session()->flush();
        @endif
    </script>

    @yield('scripts')
</body>
@yield('scripts2')
</html>
