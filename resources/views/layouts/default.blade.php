<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{Storage::url('css/bar-ui.css')}}">
    <link rel="stylesheet" href="{{Storage::url('css/responsive.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <nav class="navbar navbar-inverse">
    <div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">video game music <span id="radio">rad.io</span></a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="#">request a song</a></li>
        @include('partial.search')
    </ul>
    <ul class="nav navbar-nav navbar-right">
        @if (Route::has('login'))
            @auth
                <p class="navbar-text">{{ Auth::user()->email }}</p>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">playlists <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @include('partial.playlists')
                    </ul>
                </li>
                <!--li><a href="/user/playlists"><span class="glyphicon glyphicon-expand"></span> playlists</a></li-->
                <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> logout</a></li>
            @else
                <li><a href="/register"><span class="glyphicon glyphicon-user"></span> register</a></li>
                <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> login</a></li>
            @endauth
        @endif
    </ul>
    </div>
    </nav>

    @include('playlists.forms.create')

    @yield('main_content')
    
    <!-- See if there is a message to show -->
    @if (is_null(session()->get('msg')))
        <div id="notif-snackbar">-1</div>
    @else
        <div id="notif-snackbar">{{session()->get('msg')}}</div>
    @endif

    <script src="{{Storage::url('js/soundmanager-src/script/soundmanager2.js')}}"></script>
    <script src="{{Storage::url('js/bar-ui.js')}}"></script>
    <script src="{{Storage::url('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{Storage::url('js/custom.js')}}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>