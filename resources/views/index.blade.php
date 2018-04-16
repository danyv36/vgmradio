@extends('layouts.default')
@section('main_content')
<div class="container">
    <div id="content">    
        <div class="sm2-bar-ui large flat dark-text playlist-open" id="player-wrap">
            <div class="bd sm2-playlist">
                <div class="sm2-playlist-target">
                    <div class="now-playing">
                        <div class="left">
                            <img src="{{Storage::url('images/ost/xenoblade_chronicles_x.jpg')}}" id="track-img" />
                        </div>
                        <div class="right">
                            <div class="title" id="song-name">Noctilum</div>
                            <div class="game" id="game-name">Xenoblade Chronicles X</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bd sm2-main-controls" style="background-color: #e6e6e6;">
                <div class="sm2-inline-texture"></div>
                <div class="sm2-inline-gradient"></div>
                <div class="sm2-inline-element sm2-button-element">
                    <div class="sm2-button-bd" id="play-pause">
                        <a href="#play" class="sm2-inline-button sm2-icon-play-pause">Play / pause</a>
                    </div>
                </div>
                <div class="sm2-inline-element sm2-inline-status">
                    <div class="sm2-progress">
                        <div class="sm2-row-progressbar">
                            <div class="sm2-inline-time">0:00</div>
                            <div class="sm2-progress-bd">
                                <div class="sm2-progress-track">
                                    <div class="sm2-progress-bar"></div>
                                    <div class="sm2-progress-ball">
                                        <div class="icon-overlay"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="sm2-inline-duration">0:00</div>
                        </div>
                    </div>
                </div>
                <div class="sm2-inline-element sm2-button-element">
                    <div class="sm2-button-bd">
                        <a href="#prev" title="Previous" class="sm2-inline-button sm2-icon-previous">&lt; previous</a>
                    </div>
                </div>

                <div class="sm2-inline-element sm2-button-element">
                    <div class="sm2-button-bd">
                        <a href="#next" title="Next" class="sm2-inline-button sm2-icon-next">&gt; next</a>
                    </div>
                </div>

                <div class="sm2-inline-element sm2-button-element sm2-menu">
                    <div class="sm2-button-bd">
                        <a href="#menu" class="sm2-inline-button sm2-icon-menu">menu</a>
                    </div>
                </div>
            </div>
            <div class="bd sm2-playlist-drawerz sm2-element" style="background-color: #e6e6e6;">
                <div class="sm2-inline-texture">
                    <div class="sm2-box-shadow"></div>
                </div>
                <!-- playlist content is mirrored here -->
                <section class="songs-list">
                    @include('partial.load')
                </section>
            </div>
        </div>
    </div>
    @include('footer')
    @stop