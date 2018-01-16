<html>
<head>
    <link rel="stylesheet" href="{{Storage::url('css/bar-ui.css')}}">
    <link rel="stylesheet" href="{{Storage::url('css/responsive.css')}}">
    <script src="{{Storage::url('js/soundmanager-src/script/soundmanager2.js')}}"></script>
    <script src="{{Storage::url('js/bar-ui.js')}}"></script>
    <script src="{{Storage::url('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{Storage::url('js/jscroll.js')}}"></script>
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
              <li class="select"><a href="/">home &rsaquo;</a></li>
              <li><a href="/">about &rsaquo;</a></li>
              <li><a href="/request">request a song &rsaquo;</a></li>
              <li><a href="/login">login &rsaquo;</a></li>
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
            <div class="bd sm2-playlist-drawerz sm2-element" style="background-color: #e6e6e6;">
                <div class="sm2-inline-texture">
                    <div class="sm2-box-shadow"></div>
                </div>
                <!-- playlist content is mirrored here -->
                <section class="songs-list">
                    @include('load')
                </section>
            </div>
        </div>
    </div>
    <!--<footer><div></div></footer>-->
</body>

</html>

<script>
$( document ).ready(function() {
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

    soundManager.setup({
        url: 'soundmanager-src/swf',
        flashVersion: 9, // optional: shiny features (default = 8)
        waitForWindowLoad: true,
        debugMode: false,
        // optional: ignore Flash where possible, use 100% HTML5 mode
        preferFlash: false,
        onready: function () {
            //var playlist = window.sm2BarPlayers[0].dom.playlist.children;
            window.sm2BarPlayers[0].playlistController.setCurrPage(1);
            window.sm2BarPlayers[0].playlistController.setSelectedPage(1);
            window.sm2BarPlayers[0].playlistController.setPageSwitch(false);
            console.log("sm2Player ready");
        } //onready
    });

    // for pagination :
    $(function() {
        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();

            //$('#load a').css('color', '#dfecf6');
            //$('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');

            var url = $(this).attr('href');
            var page = url.split('page=')[1];
            getSongs(url, page);

            window.history.pushState("", "", url);
        });

        function getSongs(url, page) {
            $.ajax({
                url : url  
            }).done(function (data) {
                $('.songs-list').html(data);
                // don't refresh the playlist just yet, since otherwise it will lose the current spot
                // when it starts to play the next song
                window.sm2BarPlayers[0].playlistController.setSelectedPage(parseInt(page));
                window.sm2BarPlayers[0].playlistController.setPageSwitch(true);
                
                // keep song selected if selectedPage==currPage (e.g. the user switched back to the page currently playing)
                if(window.sm2BarPlayers[0].dom.currPage == window.sm2BarPlayers[0].dom.selectedPage){
                    var selectedIndex = window.sm2BarPlayers[0].playlistController.data.selectedIndex;
                    selectedIndex++;
                    $(".sm2-playlist-li:nth-child("+selectedIndex+")").addClass("selected");
                    
                    // then refresh dom :) otherwise previously selected li elements don't get de-selected when next song starts
                    window.sm2BarPlayers[0].playlistController.init();
                    window.sm2BarPlayers[0].playlistController.refresh();
                }
            }).fail(function () {
                alert('Songs could not be loaded.');
            });
        }
    });
});
</script>