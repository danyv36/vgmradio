<div class="sm2-playlist-wrapper">
    <ul class="sm2-playlist-bd">
        @foreach ($songs as $song)
            <li class="sm2-playlist-li">
                <div class="sm2-row">
                    <div class="sm2-col sm2-wide">
                        <a href="{{Storage::url($songFolder->value.''.$song->song_filename)}}" data-src="{{$song->ost_img_filename}}">
                            <b>{{$song->game}}</b> - {{$song->title}}</a>
                    </div>
                    <div class="sm2-col">
                        @auth
                            @if ($song->likes===1)
                                <a href="javascript:void(null);" title="Like" class="sm2-icon sm2-liked sm2-exclude">Like</a>
                            @else
                                <a href="javascript:void(null);" title="Like" class="sm2-icon sm2-like sm2-exclude">Like</a>
                            @endif
                        @else
                            <a href="javascript:void(null);" title="Like" class="sm2-icon sm2-like sm2-exclude">Like</a>
                        @endauth
                    </div>
                    <div class="sm2-col">
                        @auth
                            @if ($song->likes===0)
                                <a href="javascript:void(null);" title="Dislike" class="sm2-icon sm2-disliked sm2-exclude">Dislike</a>
                            @else
                                <a href="javascript:void(null);" title="Dislike" class="sm2-icon sm2-dislike sm2-exclude">Dislike</a>
                            @endif
                        @else
                            <a href="javascript:void(null);" title="Dislike" class="sm2-icon sm2-dislike sm2-exclude">Dislike</a>
                        @endauth
                    </div>
                    <div style="display: none">{{$song->idsongs}}</div>
                </div>

            </li>
        @endforeach
    </ul>
</div>
{{ $songs->links() }}