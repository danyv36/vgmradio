  <!-- Modal -->
  <div class="modal fade" id="edit-playlist-modal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
      {!! Form::open(['route' => ['playlists.update',$songs[0]->idPlaylist], 'method' => 'PUT', 'id'=>'edit-playlist']) !!}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Playlist</h4>
        </div>
        <div class="modal-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    {!! Form::text('name', $songs[0]->playlistName, ['class' => 'form-control', 'id' => 'edit-name']) !!}
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    {!! Form::textarea('description', $songs[0]->description, ['rows' => '2', 'class' => 'form-control', 'id' => 'edit-desc']) !!}
                </div>
                <div class="checkbox">
                    @if ($songs[0]->isPublic)
                      <label><input id="edit-public" type="checkbox" name="edit-public" checked> Make playlist public</label>
                    @else
                      <label><input id="edit-public" type="checkbox" name="edit-public"> Make playlist public</label>
                    @endif
                </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-info update-playlist">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            {!! Form::close() !!}
        </div>
      </div>

    </div>
  </div>
