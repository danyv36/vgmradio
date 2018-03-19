<input type="text" value="{{$songs[0]->idPlaylist}}" style="display: none" id="id-playlist">
    <h2>{{$songs[0]->playlistName}}</h2>
    <a href="#" id="edit-playlist-info" data-toggle="modal" data-target="#edit-playlist-modal">
        <span class="glyphicon glyphicon-pencil" style="margin-left:5px"></span>
    </a>
    <div class="playlist-info">
        @if (is_null($songs[0]->description))
        <p class="description">My playlist</p>
        @else
        <p class="description">{{ $songs[0]->description}}</p>
        @endif
    </div>