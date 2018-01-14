<div class="sm2-playlist-wrapper">
    <ul class="sm2-playlist-bd">
    <!-- Enter all sound clips as list items, per the example code below -->
        @foreach ($songs as $song)
            <li class="sm2-playlist-li">
                <div class="sm2-row">
                    <div class="sm2-col sm2-wide">
                        <a href="{{Storage::url($songFolder->value.''.$song->song_filename)}}" data-src="{{$song->ost_img_filename}}">
                            <b>{{$song->game}}</b> - {{$song->title}}</a>
                    </div>
                    <div class="sm2-col">
                        <a href="javascript:void(null);" title="Like" class="sm2-icon sm2-like sm2-exclude">Like</a>
                    </div>
                    <div class="sm2-col">
                        <a href="javascript:void(null);" title="Dislike" class="sm2-icon sm2-dislike sm2-exclude">Dislike</a>
                    </div>
                </div>

            </li>
        @endforeach
    </ul>
</div>
{{ $songs->links() }}