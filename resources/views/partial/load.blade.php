<div class="sm2-playlist-wrapper">
    <ul class="sm2-playlist-bd">
        @foreach ($songs as $song)
            <li class="sm2-playlist-li">
                <div class="sm2-row">
                    <div class="sm2-col sm2-wide">
                        <a href="{{Storage::url($songFolder->value.''.$song->song_filename)}}" data-id="{{$song->idsongs}}" data-src="{{$song->ost_img_filename}}">
                            <b>{{$song->game}}</b> - {{$song->title}}</a>
                    </div>
                    @auth
                    <div class="dropdown-hidden">
                        <div class="sm2-col">
                            <a class="dropbtn sm2-icon sm2-uplaylist sm2-exclude">d</a>
                            <div id="myDropdown" class="dropdown-content">
                                <a href="#" data-toggle="modal" data-target="#playlistModal">New playlist</a>
                                <div>Add to playlist</div>
                                @foreach ($playlists as $playlist)
                                    <a href="javascript:void(null);"  data-id="{{$playlist->id}}" class="playlist-name">{{$playlist->name}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endauth
                    <div class="sm2-col">
                        @if ($song->likes===1)
                            <a href="javascript:void(null);" title="Like" class="sm2-icon sm2-liked sm2-exclude">Like</a>
                        @else
                            <a href="javascript:void(null);" title="Like" class="sm2-icon sm2-like sm2-exclude">Like</a>
                        @endif
                    </div>
                    <div class="sm2-col">
                        @if ($song->likes===0)
                            <a href="javascript:void(null);" title="Dislike" class="sm2-icon sm2-disliked sm2-exclude">Dislike</a>
                        @else
                            <a href="javascript:void(null);" title="Dislike" class="sm2-icon sm2-dislike sm2-exclude">Dislike</a>
                        @endif
                    </div>
                    <!--div style="display: none">{{$song->idsongs}}</div-->
                </div>

            </li>
        @endforeach
    </ul>
</div>
{{ $songs->links() }}