{!! Form::open(['route' => 'search', 'id'=>'search-form', 'class'=>'navbar-form navbar-left']) !!}
    <div class="input-group">
      <input type="text" id="search-string" name="searchstring" class="form-control" placeholder="Search" name="search" size="40">
      <div class="input-group-btn">
         <button class="btn btn-default" type="submit">
          <i class="glyphicon glyphicon-search"></i>
      </button>
      <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <span class="caret"></span>
         <span class="sr-only">Toggle Dropdown</span>
      </button>
      <ul class="dropdown-menu">
        <li class="active" id="game-search"><a href="javascript:void(null);">game</a></li>
        <li id="song-search"><a href="javascript:void(null);">song</a></li>
      </ul>
      <input type="hidden" name="searchby" value="game">
      </div>
    </div>
{!! Form::close() !!}