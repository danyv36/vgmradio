<!-- These are the user playlists loaded in the nav bar at the top -->
@if ($playlists->count())
    @foreach ($playlists as $playlist)
        <li>{{Html::link("/playlists/{$playlist->id}", $playlist->name, $playlist->name, null)}}</li>
    <!--li><a href="#">{{ $playlist->name }}</a></li-->
    @endforeach
@endif
<li class="divider"></li>
<li><a href="#" data-toggle="modal" data-target="#playlistModal">New playlist</a></li>