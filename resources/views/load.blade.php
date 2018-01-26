<div class="sm2-playlist-wrapper">
    <ul class="sm2-playlist-bd">
        @foreach ($songs as $song)
            <li class="sm2-playlist-li">
                <div class="sm2-row">
                    <div class="sm2-col sm2-wide">
                        <a href="{{Storage::url($songFolder->value.''.$song->song_filename)}}" data-src="{{$song->ost_img_filename}}">
                            <b>{{$song->game}}</b> - {{$song->title}}</a>
                    </div>
                    <!--div class="sm2-col">
                        <div class="dropdown" >
                            <a class="dropdown-toggle" role="button" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-option-vertical"></span>
                            </a>
                            <ul class="dropdown-menu" style="z-index:10">
                            <li><a href="#1">HTML</a></li>
                            <li><a href="#2">CSS</a></li>
                            <li><a href="#3">JavaScript can you see this omg</a></li>
                            </ul>
                        </div>
                    </div-->
                    <div class="sm2-col">
                        @if ($song->likes===1)
                            <a href="javascript:void(null);" title="Like" class="sm2-icon sm2-liked sm2-exclude">Like</a>
                        @else
                            <a href="javascript:void(null);" title="Like" class="sm2-icon sm2-like sm2-exclude">Like</a>
                        @endif
                    </div>
                    <div class="sm2-col">
                        @if ($song->likes===0)
                            <a href="javascript:void(null);" title="Dislike" class="sm2-icon sm2-disliked sm2-exclude">Dislike</a>
                        @else
                            <a href="javascript:void(null);" title="Dislike" class="sm2-icon sm2-dislike sm2-exclude">Dislike</a>
                        @endif
                    </div>
                    <div style="display: none">{{$song->idsongs}}</div>
                </div>

            </li>
        @endforeach
    </ul>
</div>
{{ $songs->links() }}