<html>

<head>
    <link rel="stylesheet" href="{{Storage::url('css/bar-ui.css')}}">
    <link rel="stylesheet" href="{{Storage::url('css/responsive.css')}}">
    <script src="{{Storage::url('js/soundmanager-src/script/soundmanager2.js')}}"></script>
    <script src="{{Storage::url('js/bar-ui.js')}}"></script>
    <script src="{{Storage::url('js/jquery-3.2.1.min.js')}}"></script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <div id="logo">
            <a href="soundmanager.html">
                <h1>video game music
                    <span id="radio">rad.io</span>
                </h1>
            </a>
        </div>
        <nav>
            <ul>
              <li class="select"><a href="/">about &rsaquo;</a></li>
              <li><a href="/about">request a song &rsaquo;</a></li>
              <li><a href="/contact">register &rsaquo;</a></li>
            </ul>
          </nav>
    </header>
    <div id="content">
        <div class="sm2-bar-ui large flat dark-text playlist-open" id="player-wrap">
            <div class="bd sm2-playlist">
                <div class="sm2-playlist-target">
                    <div class="now-playing">
                        <div class="left">
                            <img src="{{Storage::url('images/ost/xenoblade_chronicles_x.jpg')}}" style="width:100%" id="track-img" />
                        </div>
                        <div class="right">
                            <div class="title" id="song-name">Noctilum</div>
                            <div class="game" id="game-name">Xenoblade Chronicles X</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bd sm2-main-controls" style="background-color: #e6e6e6;">
                <div class="sm2-inline-texture"></div>
                <div class="sm2-inline-gradient"></div>
                <div class="sm2-inline-element sm2-button-element">
                    <div class="sm2-button-bd" id="play-pause">
                        <a href="#play" class="sm2-inline-button sm2-icon-play-pause">Play / pause</a>
                    </div>
                </div>
                <div class="sm2-inline-element sm2-inline-status">
                    <div class="sm2-progress">
                        <div class="sm2-row">
                            <div class="sm2-inline-time">0:00</div>
                            <div class="sm2-progress-bd">
                                <div class="sm2-progress-track">
                                    <div class="sm2-progress-bar"></div>
                                    <div class="sm2-progress-ball">
                                        <div class="icon-overlay"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="sm2-inline-duration">0:00</div>
                        </div>
                    </div>
                </div>
                <div class="sm2-inline-element sm2-button-element">
                    <div class="sm2-button-bd">
                        <a href="#prev" title="Previous" class="sm2-inline-button sm2-icon-previous">&lt; previous</a>
                    </div>
                </div>

                <div class="sm2-inline-element sm2-button-element">
                    <div class="sm2-button-bd">
                        <a href="#next" title="Next" class="sm2-inline-button sm2-icon-next">&gt; next</a>
                    </div>
                </div>

                <div class="sm2-inline-element sm2-button-element sm2-menu">
                    <div class="sm2-button-bd">
                        <a href="#menu" class="sm2-inline-button sm2-icon-menu">menu</a>
                    </div>
                </div>
            </div>
            <div class="bd sm2-playlist-drawer sm2-element" style="background-color: #e6e6e6;">
                <div class="sm2-inline-texture">
                    <div class="sm2-box-shadow"></div>
                </div>
                <!-- playlist content is mirrored here -->
                <div class="sm2-playlist-wrapper">
                    <ul class="sm2-playlist-bd">
                        <!-- Enter all sound clips as list items, per the example code below -->
                        @foreach ($songs as $song)
                        <li>
                            <div class="sm2-row">
                                <div class="sm2-col sm2-wide">
                                    <a href="{{Storage::url($songFolder->value.''.$song->song_filename)}}" data-src="{{$song->ost_img_filename}}">
                                        <b>{{$song->game}}</b> - {{$song->title}}</a>
                                </div>
                                <div class="sm2-col">
                                    <a href="javascript:void(null);" title="Like" class="sm2-icon sm2-like sm2-exclude">Like</a>
                                </div>
                                <div class="sm2-col">
                                    <a href="javascript:void(null);" title="Dislike" class="sm2-icon sm2-dislike sm2-exclude">Dislike</a>
                                </div>
                            </div>

                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--<footer><div></div></footer>-->
</body>

</html>

<script>

    $(".sm2-dislike").click(function () {
        var likeButton = $(this).parent().prev().children(0);
        if ($(this).hasClass("sm2-disliked")) // already disliked, remove disliked
            $(this).addClass("sm2-dislike").removeClass("sm2-disliked");
        else if (likeButton.hasClass("sm2-liked")) { //disliked is already set
            dislikeButton.addClass("sm2-like").removeClass("sm2-liked");
            $(this).addClass("sm2-disliked").removeClass("sm2-dislike");
        }
        else
            $(this).addClass("sm2-disliked").removeClass("sm2-dislike");
        // mark this song to not play next time
    });

    $(".sm2-like").click(function () {
        var dislikeButton = $(this).parent().next().children(0);
        if ($(this).hasClass("sm2-liked")) // already liked, remove liked
            $(this).addClass("sm2-like").removeClass("sm2-liked");
        else if (dislikeButton.hasClass("sm2-disliked")) { //disliked is already set
            dislikeButton.addClass("sm2-dislike").removeClass("sm2-disliked");
            $(this).addClass("sm2-liked").removeClass("sm2-like");
        }
        else
            $(this).addClass("sm2-liked").removeClass("sm2-like");
    });

</script>