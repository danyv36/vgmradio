<input type="text" value="{{$songs[0]->idPlaylist}}" style="display: none" id="id-playlist">
    <h2>{{$songs[0]->playlistName}}</h2>
    <div class="playlist-info">
        @if (is_null($songs[0]->description))
        <p class="description">My playlist</p>
        @else
        <p class="description">{{ $songs[0]->description}}</p>
        @endif
        <div class="playlist-action">
            <a href="#" id="edit-playlist-info" data-toggle="modal" data-target="#edit-playlist-modal">
                <span class="glyphicon glyphicon-pencil" style="margin-left:5px"></span>
                EDIT
            </a>
            <a href="#" id="delete-playlist-info" data-toggle="modal" data-target="#delete-playlist-modal">
                <span class="glyphicon glyphicon-remove" style="margin-left:5px"></span>
                DELETE
            </a>
        </div>
    </div>
