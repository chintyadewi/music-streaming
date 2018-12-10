<div class="container-fluid m-0 fixed-bottom text-white pt-3 border-bottom" style="background-color:#222a42;" id="player">
        <div class="row">
            <div class="col-4 offset-4">
                <div class="row justify-content-center">
                    <div class="col-1">
                        <i class="fas fa-pause pt-2 text-right" onclick="pause()"></i></button>
                    </div>
                    <div class="col-1">
                        <i class="far fa-play-circle fa-2x" onclick="play('song')"></i>
                    </div>
                    <div class="col-1 ml-2">
                        <i class="fas fa-stop p-2" onclick="stopSong()"></i>
                    </div>
                </div>
                <div class="row pt-2">
                    <audio id="song" ontimeupdate="updateTime()">
                        <source src="Till You Drop - ItaloBrothers.mp3" type="audio/mp3"/>
                        Your browser does not support the audio tag.
                    </audio>
                    <div class="col-1" id="songTimeCurrent">0:00</div>
                    <div class="col-10">
                        <div id="songSlider" onclick="setSongPosition(this,event)"><div id="trackProgress"></div></div>
                    </div>
                    <div class="col-1" id="songTimeLength" style="margin-left:-18px;">0:00</div>
                </div>
            </div>
            <div class="col-1 mt-4 d-flex">
                <div class="icon mt-1">
                    <i class="fas fa-volume-up volume"></i>
                </div>
                <div class="mt-2 ml-2" id="volumeMeter" onclick="setNewVolume(this,event)"><div id="volumeStatus"></div></div>
            </div>
        </div>
    </div>