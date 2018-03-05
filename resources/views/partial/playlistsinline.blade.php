<!-- These are the user playlists loaded in the main inline playlist -->
@foreach ($playlists as $playlist)
<a href="javascript:void(null);" data-id="{{$playlist->id}}" class="playlist-name">{{$playlist->name}}</a>
@endforeach