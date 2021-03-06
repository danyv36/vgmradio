  <!-- Modal -->
  <div class="modal fade" id="playlistModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
      {!! Form::open(['route' => 'playlists.store', 'id'=>'new-playlist']) !!}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Playlist</h4>
        </div>
        <div class="modal-body">
            
                <div class="form-group">
                    <label for="name">Name</label>
                    {!! Form::text('name', '', ['class' => 'form-control', 'id' => 'name']) !!}
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    {!! Form::textarea('description', '', ['rows' => '2', 'class' => 'form-control', 'id' => 'description']) !!}
                </div>
                <div class="checkbox">
                    <label><input id="public" type="checkbox"> Make playlist public</label>
                </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-info create-playlist">Create</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            {!! Form::close() !!}
        </div>
      </div>
      
    </div>
  </div>