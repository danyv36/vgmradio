  <!-- Delete Playlist Modal -->
  <div class="modal fade" id="delete-playlist-modal" role="dialog">
    <div class="modal-dialog">

      <!-- Delete Playlist Modal content-->
      <div class="modal-content">
      {!! Form::open(['route' => ['playlists.destroy',$songs[0]->idPlaylist], 'id'=>'delete-playlist']) !!}
        {{ method_field('DELETE') }}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete Playlist</h4>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete playlist <span style="font-weight: bold">{{$songs[0]->playlistName}}</span>?</p>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-danger destroy-playlist">Delete</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            {!! Form::close() !!}
        </div>
      </div>

    </div>
  </div>