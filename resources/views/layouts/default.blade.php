<html>
<head>
    <link rel="stylesheet" href="{{Storage::url('css/bar-ui.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
        <li class="active"><a href="#">home</a></li>
        <li><a href="#">about</a></li>
        <li><a href="#">contact</a></li>
        <li><a href="#">request a song</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        @if (Route::has('login'))
            @auth
                <p class="navbar-text">{{ Auth::user()->username }}</p>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">playlists <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @if ($playlists->count())
                            @foreach ($playlists as $playlist)
                                <li>{{Html::link("/playlists/{$playlist->id}", $playlist->name, $playlist->name, null)}}</li>
                                <!--li><a href="#">{{ $playlist->name }}</a></li-->
                            @endforeach
                        @else
                            <li><a href="#">(no playlists)</a></li>
                        @endif
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

    @yield('main_content')

    <script src="{{Storage::url('js/soundmanager-src/script/soundmanager2.js')}}"></script>
    <script src="{{Storage::url('js/bar-ui.js')}}"></script>
    <script src="{{Storage::url('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{Storage::url('js/custom.js')}}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>