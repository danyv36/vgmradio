$(document).ready(function () {
    if (data != null) {
        console.log("window.username::", data.username);
        console.log("window.idUser::", data.idUser);
    }

    $(".sm2-dislike, .sm2-disliked").click(function () {
        console.log("disliked clicked!");
        var likeButton = $(this).parent().prev().children();
        //var idSong = $(this).parent().siblings()[2].textContent;
        var idSong = $(this).parent().siblings(":first").children(":first")[0].dataset.id;
        var likes = 0;
        if ($(this).hasClass("sm2-disliked")) { // already disliked, remove disliked
            $(this).addClass("sm2-dislike").removeClass("sm2-disliked");
            likes = -1;
        }
        else {
            if (likeButton.hasClass("sm2-liked")) { //disliked is already set
                dislikeButton.addClass("sm2-like").removeClass("sm2-liked");
                $(this).addClass("sm2-disliked").removeClass("sm2-dislike");
            }
            else
                $(this).addClass("sm2-disliked").removeClass("sm2-dislike");
            likes = 0;
            // mark this song to not play next time
        } // else: disliked
        var formData = {
            idUser: data.idUser,
            idSong: idSong,
            likes: likes
        }
        saveLikes(formData);
    });

    $(".sm2-like, .sm2-liked").click(function () {
        console.log("like button clicked::");
        var dislikeButton = $(this).parent().next().children();
        //var idSong = $(this).parent().siblings()[2].textContent;
        var idSong = $(this).parent().siblings(":first").children(":first")[0].dataset.id;
        var likes = 1;
        if ($(this).hasClass("sm2-liked")) { // already liked, remove liked
            $(this).addClass("sm2-like").removeClass("sm2-liked");
            likes = -1;
        }
        else {
            if (dislikeButton.hasClass("sm2-disliked")) {
                // disliked is already set, remove dislike and add it to likes
                dislikeButton.addClass("sm2-dislike").removeClass("sm2-disliked");
                $(this).addClass("sm2-liked").removeClass("sm2-like");
            }
            else
                $(this).addClass("sm2-liked").removeClass("sm2-like"); // like it :)
            likes = 1;
        } // else: liked
        var formData = {
            idUser: data.idUser,
            idSong: idSong,
            likes: likes
        }
        saveLikes(formData);
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
    $(function () {
        $('body').on('click', '.pagination a', function (e) {
            e.preventDefault();
            console.log("on click::::");

            //$('#load a').css('color', '#dfecf6');
            //$('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');

            var url = $(this).attr('href');
            var page = url.split('page=')[1];
            console.log("url::", url, "page::", page)
            getSongs(url, page);
            window.history.pushState("", "", url);
        });

        function getSongs(url, page) {
            $.ajax({
                url: url
            }).done(function (data) {
                $('.songs-list').html(data);
                // don't refresh the playlist just yet, since otherwise it will lose the current spot
                // when it starts to play the next song
                window.sm2BarPlayers[0].playlistController.setSelectedPage(parseInt(page));
                window.sm2BarPlayers[0].playlistController.setPageSwitch(true);

                // keep song selected if selectedPage==currPage (e.g. the user switched back to the page currently playing)
                if (window.sm2BarPlayers[0].dom.currPage == window.sm2BarPlayers[0].dom.selectedPage) {
                    var selectedIndex = window.sm2BarPlayers[0].playlistController.data.selectedIndex;
                    selectedIndex++;
                    $(".sm2-playlist-li:nth-child(" + selectedIndex + ")").addClass("selected");

                    // then refresh dom :) otherwise previously selected li elements don't get de-selected when next song starts
                    window.sm2BarPlayers[0].playlistController.init();
                    window.sm2BarPlayers[0].playlistController.refresh();
                }
            }).fail(function () {
                alert('Songs could not be loaded.');
            });
        }
    });

    // save likes and dislikes
    function saveLikes(formData) {

        console.log("formData::", formData);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/likes',
            data: formData,
            type: "POST"
        }).done(function (data) {
            console.log("ajax response::", data);
        }).fail(function () {
            alert('Like could not be saved.');
        });
    }

    /***********************
        USER PLAYLIST
    ************************/

    // Show and hide user playlist menu:

    $(".songs-list").on('mouseenter', '.sm2-row', function( event ) {
        $(this).children(":nth-child(2)").removeClass("dropdown-hidden");
    }).on('mouseleave', '.sm2-row', function( event ) {
        if ($(this).children(":nth-child(2)").children(":first").children(":nth-child(2)").hasClass("showPlaylist")){
            // do nothing if playlist menu is open
        } 
        else{
            $(this).children(":nth-child(2)").addClass("dropdown-hidden");
        }
    });

    // Add items to playlist 
    $(".playlist-name").click(function(){
        console.log("You clicked the drop down menu!! :)");
        var idPlaylist = $(this)[0].dataset.id; // get id of playlist
        var idSong = $(this).parent().parent().parent().siblings(":first").children(":first")[0].dataset.id; // get id of song

        var formData = {
            idSong: idSong,
            idPlaylist: idPlaylist
        }
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/playlistdetails',
            data: formData,
            type: "POST"
        }).done(function (data) {
            console.log("ajax response::", data);
        }).fail(function () {
            alert('Playlist detail could not be saved.');
        });
    });

    $(".dropbtn").click(function(){
        $(this).next().addClass("showPlaylist");
	});
	
	window.onclick = function(event) {
	  if (!event.target.matches('.dropbtn')) {

		var dropdowns = document.getElementsByClassName("dropdown-content");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			
		  var openDropdown = dropdowns[i];
		  if (openDropdown.classList.contains('showPlaylist')) {
			openDropdown.classList.remove('showPlaylist');
		  }
		}
	  }
	}
});