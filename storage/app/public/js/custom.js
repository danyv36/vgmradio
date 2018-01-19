$(document).ready(function () {
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
            console.log("on click::::");

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