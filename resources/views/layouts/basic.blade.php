<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
    </div>
    </nav>

    @yield('main_content')
</body>
</html>