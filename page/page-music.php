<?php 
/* 
Custom:page-music
Description:音乐歌单
*/  
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<?php
if(_g(random_music) == 1){
	$str = _g('music_id');
	$arr = explode(',',$str);
	$id = $arr[array_rand($arr)];
}else{
	$str = _g('music_id');
	$arr = explode(',',$str);
	$id = current($arr);
}

$arr = file_get_contents('https://music.163.com/api/playlist/detail?id='.$id);
$arr = json_decode($arr,true);
$arr['result']['tracks'] = array_slice($arr['result']['tracks'],0,30);
?>
<style>
.grid-3 {
	width:25%;
}
.grid-9 {
	width:75%
}
.grid-9{
	width:100%;
}
.btn.active,.btn:active {
	box-shadow:none;
	-webkit-box-shadow:none
}
.jAudio--player * {
	padding:0;
	margin:0;
	font-weight:300;
	box-sizing:border-box;
	font-family:"Open Sans";
	font-weight:300;
	color:#888;
	outline:0
}
.jAudio--player li {
	float:left;
	list-style:none
}
.jAudio--playlist p {
	margin:0;
	padding:0;
	line-height:18px
}
.jAudio--player {
	display:table;
	overflow:hidden;
	background:#fff;
	margin:0 auto;
	width:100%;
}
.jAudio--player:after {
	content:" ";
	display:block;
	width:100%;
	clear:both;
}
.jAudio--player .jAudio--ui {
	position:relative;
	width:160px;
	height:185px
}
.jAudio--player .jAudio--status-bar {
	width:100%;
	z-index:1;
	position:relative;
	padding:40px 0 0 10px;
	display:table
}
.jAudio--player .jAudio--status-bar:after {
	content:" ";
	display:block;
	width:100%;
	clear:both
}
.jAudio--player .jAudio--controls {
	width:100%;
	display:table;
	padding-top:10px;
	margin-left:-10px
}
.jAudio--player .jAudio--controls:after {
	content:" ";
	display:block;
	width:100%;
	clear:both
}
.jAudio--player .jAudio--controls ul {
	display:table;
	overflow:hidden;
	width:100%
}
.jAudio--player .jAudio--controls ul:after {
	content:" ";
	display:block;
	width:100%;
	clear:both
}
.jAudio--player .jAudio--controls li {
	position:relative;
	width:33.3333%;
	height:50px;
	line-height:50px
}
.jAudio--player .jAudio--thumb {
	width:185px;
	height:185px;
	background-size:cover;
	background-position:center center
}
.jAudio--player .jAudio--time {
	display:table;
	width:100%;
	float:left
}
.jAudio--player .jAudio--time:after {
	content:" ";
	display:block;
	width:100%;
	clear:both
}
.jAudio--player .jAudio--time * {
	display:block;
	float:left;
	color:#555;
	font-size:10px
}
.jAudio--player .jAudio--time .jAudio--time-elapsed {
	text-align:left;
	margin-right:5px
}
.jAudio--player .jAudio--time .jAudio--time-elapsed:after {
	content:" /"
}
.jAudio--player .jAudio--time .jAudio--time-total {
	text-align:left
}
.jAudio--player .jAudio--details * {
	color:#666;
	font-size:12px
}
.jAudio--player .jAudio--details:first-of-type {
	font-weight:700
}
.jAudio--player .jAudio--details p {
	width:100%
}
.jAudio--player .jAudio--details p span {
	display:block
}
.jAudio--player .jAudio--progress-bar {
	margin:14px 0
}
.jAudio--player .jAudio--progress-bar .jAudio--progress-bar-wrapper {
	width:100%;
	position:relative;
	background:#e1e1e1;
	cursor:pointer;
	border-radius:10px;
	overflow:hidden
}
.jAudio--player .jAudio--progress-bar .jAudio--progress-bar-played {
	height:10px;
	background:#f66;
	position:relative;
	border-radius:10px
}
.jAudio--player .jAudio--progress-bar .jAudio--progress-bar-pointer {
	height:10px;
	width:10px;
	border-radius:50%;
	position:absolute;
	right:0;
	background:#fff
}
.info_z {
	float:left
}
.info_z p {
	margin-top:5px
}
.info_y {
	text-align:right;
	float:right
}
.jAudio--player .jAudio--volume-bar {
	float:right;
	width:50%
}
.jAudio--player .jAudio--volume-bar .jAudio--volume-bar-wrapper {
	display:none;
	width:13%;
	position:absolute;
	right:20px;
	background:rgba(255,255,255,.3);
	cursor:pointer;
	border-radius:10px;
	overflow:hidden
}
.jAudio--player .jAudio--volume-bar .jAudio--volume-bar-played {
	height:7px;
	background:#f66;
	position:relative;
	border-radius:7px
}
.jAudio--player .jAudio--volume-bar .jAudio--volume-bar-pointer {
	height:7px;
	width:7px;
	border-radius:50%;
	position:absolute;
	right:0;
	background:#fff
}
.jAudio--player .jAudio--playlist {
	background:#fff;
	float: right;
	width: 73%;
}
.jAudio--player .jAudio--playlist .jAudio--playlist-item {
	display:block;
	width:100%;
	padding:14px 20px;
	display:table
}
.jAudio--player .jAudio--playlist .jAudio--playlist-item:after {
	content:" ";
	display:block;
	width:100%;
	clear:both
}
.jAudio--player .jAudio--playlist .jAudio--playlist-item.active {
	background:#f55c5c;
	border-bottom-color:#f55c5c
}
.jAudio--player .jAudio--playlist .jAudio--playlist-item.active * {
	color:#fff
}
.jAudio--player .jAudio--playlist .jAudio--playlist-item:not(.active):hover {
	background:#fafafa
}
.jAudio--player .jAudio--playlist .jAudio--playlist-item:last-of-type {
	border:0;
	margin-bottom:0
}
.jAudio--player .jAudio--playlist .jAudio--playlist-thumb {
	float:left;
	margin-right:6px;
	display:table
}
.jAudio--player .jAudio--playlist .jAudio--playlist-thumb:after {
	content:" ";
	display:block;
	width:100%;
	clear:both
}
.jAudio--player .jAudio--playlist .jAudio--playlist-thumb img {
	height:24px;
	width:24px;
	border-radius:50%;
	float:left;
	margin-right:5px
}
.jAudio--player .jAudio--playlist .jAudio--playlist-meta-text h4 {
	font-size:14px;
	color:#000
}
.jAudio--player .jAudio--playlist .jAudio--playlist-meta-text p {
	font-size:12px
}
.btn {
	position:relative;
	overflow:hidden;
	position:absolute;
	top:0;
	left:0;
	width:100%;
	height:100%;
	background:0 0;
	border:0
}
.btn span {
	position:absolute;
	display:table;
	height:15px;
	top:50%;
	left:50%;
	-webkit-transform:translate(-50%,-50%);
	-ms-transform:translate(-50%,-50%);
	transform:translate(-50%,-50%);
	overflow:hidden
}
.btn span:after,.btn span:before {
	display:block;
	content:" ";
	height:0;
	float:left;
	border-color:transparent;
	border-style:solid
}
#btn-next span:after,#btn-next span:before,#btn-play span:after,#btn-play span:before,#btn-prev span:after,#btn-prev span:before {
	border-top:7.5px solid transparent;
	border-bottom:7.5px solid transparent
}
#btn-prev span:after,#btn-prev span:before {
	border-right:15px solid #ddd;
	border-left:0
}
#btn-prev:active span:after,#btn-prev:active span:before {
	border-right-color:#f66!important
}
#btn-next span:after,#btn-next span:before {
	border-left:15px solid #ddd;
	border-right:0
}
#btn-next:active span:after,#btn-next:active span:before {
	border-left-color:#f66!important
}
#btn-play span:before {
	border-left:15px solid #ddd;
	border-right:0
}
#btn-play span:after {
	display:none
}
#btn-play.active span:before,#btn-play:active span:before {
	border-left-color:#f66!important
}
#btn-pause span:after,#btn-pause span:before {
	width:5px;
	height:15px;
	background:#f66;
	border:0
}
#btn-pause span:before {
	margin-right:5px
}
#btn-pause span.active:after,#btn-pause span.active:before,#btn-pause span:active:after,#btn-pause span:active:before {
	background:#fff;
	margin-right:5px
}
.jAudio--player .jAudio--controls li button span:after,.jAudio--player .jAudio--controls li button span:before {
	-webkit-transition:border-color .3s ease 0s;
	transition:border-color .3s ease 0s
}
.jAudio--player .jAudio--thumb {
	-webkit-transition:all .5s ease 0s;
	transition:all .5s ease 0s
}
.jAudio--player .jAudio--progress-bar .jAudio--progress-bar-played {
	-webkit-transition:all .2s ease 0s;
	transition:all .2s ease 0s
}
.jAudio--player .jAudio--playlist .jAudio--playlist-item {
	-webkit-transition:all .5s ease 0s;
	transition:all .5s ease 0s
}
.jAudio--player .jAudio--playlist .jAudio--playlist-item * {
	-webkit-transition:all .3s ease 0s;
	transition:all .3s ease 0s
}
.jAudio--info {
	display:none
}
@media (min-width:990px) {
	.music-left {
	float: left;
}
}@media (max-width:990px) {
	.jAudio--ui {
	width:100%!important
}
@media (max-width:990px) {
	.jAudio--player .jAudio--playlist {
	width:100%!important
}

.sinkey-thumb {
	float:left;
	width:40%
}
.sinkey-thumb .jAudio--thumb {
	width:100%
}
.sinkey-status {
	float:left;
	width:60%
}
.grid-3,.grid-9 {
	width:100%
}
}
</style>
<section class="container main-load">
    <div id="rollstart"></div>  
            <div class="jAudio--player">
            <div class="grid-3">
                <div class="music-left">
                    <audio></audio>
                    <div class="jAudio--ui">
                        <div class="sinkey-thumb">
                            <div class="jAudio--thumb"></div>
                        </div>
                        <div class="sinkey-status">
                            <div class="jAudio--status-bar">
                                <div class="jAudio--details"></div>
                                <div class="jAudio--progress-bar">
                                    <div class="jAudio--progress-bar-wrapper">
                                        <div class="jAudio--progress-bar-played">
                                            <span class="jAudio--progress-bar-pointer"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="jAudio--time">
                                    <span class="jAudio--time-elapsed">00:00</span>
                                    <span class="jAudio--time-total">00:00</span>
                                </div>

                                <div class="jAudio--controls">
                                    <ul>
                                        <li><button class="btn" data-action="prev" id="btn-prev"><span></span></button></li>
                                        <li><button class="btn" data-action="play" id="btn-play"><span></span></button></li>
                                        <li><button class="btn" data-action="next" id="btn-next"><span></span></button></li>
                                    </ul>
                                </div>

                                <div class="jAudio--volume-bar">
                                    <div class="jAudio--volume-bar-wrapper">
                                        <div class="jAudio--volume-bar-played">
                                            <span class="jAudio--volume-bar-pointer"></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid-9">
                <div id="jAudio_right">
                    <div class="jAudio--playlist"></div>

                </div>
            </div>
        </div>

</section>
<?php
$list   = array();
foreach($arr['result']['tracks'] as $v){
    $list[] = array(
        "file"          => "https://xxser.cn/api/music.php?vid=".$v['id'],
        "thumb"         => str_replace('http://', 'https://', $v['album']['picUrl']),
        "trackName"     => $v['name'],
        "trackArtist"   => '',
        "trackAlbum"    => $v['artists'][0]['name'],
        "trackTime"         => str_replace('.',':',sprintf("%.2f", $v['duration']/1000/60))
    );
}
$list   = json_encode($list);
?>
<script type="text/javascript">
    jQuery('.grid-3').theiaStickySidebar({
      // Settings
      additionalMarginTop: 60
    });
  <?php if (is_mobile() ): ?>
  <?php else: ?>
  $('.grid-3').css("position","absolute");
  <?php endif ;?>
</script>
<script>
    // # ----- Script info:
    // - Author: Michael Mammoliti
    // - Name: jAudio.js
    // - Version: 0.2
    // - js dipendencies: jQuery
    // - Release date: 25 November 2015
    // - GitHub: https://github.com/MichaelMammoliti/jAudio.js

    // # ----- Contact info
    // - GitHub: https://github.com/MichaelMammoliti
    // - Mail: mammoliti.michael@gmail.com
    // - Twitter: @MichMammoliti

    // # ----- License Info
    // - Released under the GPL v3 license.

    (function($){

        var pluginName = "jAudio",
            defaults = {
                playlist: [],

                defaultAlbum: undefined,
                defaultArtist: undefined,
                defaultTrack: 0,

                autoPlay: true,

                debug: false
            };

        function Plugin( $context, options )
        {
            this.settings         = $.extend( true, defaults, options );

            this.$context         = $context;

            this.domAudio         = this.$context.find("audio")[0];
            this.$domPlaylist     = this.$context.find(".jAudio--playlist");
            this.$domControls     = this.$context.find(".jAudio--controls");
            this.$domVolumeBar    = this.$context.find(".jAudio--volume-bar-wrapper");
            this.$domDetails      = this.$context.find(".jAudio--details");
            this.$domStatusBar    = this.$context.find(".jAudio--status-bar");
            this.$domProgressBar  = this.$context.find(".jAudio--progress-bar-wrapper");
            this.$domTime         = this.$context.find(".jAudio--time");
            this.$domElapsedTime  = this.$context.find(".jAudio--time-elapsed");
            this.$domTotalTime    = this.$context.find(".jAudio--time-total");
            this.$domThumb        = this.$context.find(".jAudio--thumb");

            this.currentState       = "pause";
            this.currentTrack       = this.settings.defaultTrack;
            this.currentElapsedTime = undefined;

            this.timer              = undefined;

            this.init();
        }

        Plugin.prototype = {

            init: function()
            {
                var self = this;

                self.renderPlaylist();
                self.preLoadTrack();
                self.highlightTrack();
                self.updateTotalTime();
                self.events();
                self.debug();
                self.domAudio.volume = 1
            },

            play: function()
            {
                var self        = this,
                    playButton  = self.$domControls.find("#btn-play");

                self.domAudio.play();

                if(self.currentState === "play") return;

                clearInterval(self.timer);
                self.timer = setInterval( self.run.bind(self), 50 );

                self.currentState = "play";

                // change id
                playButton.data("action", "pause");
                playButton.attr("id", "btn-pause");

                // activate
                playButton.toggleClass('active');
            },

            pause: function()
            {
                var self        = this,
                    playButton  = self.$domControls.find("#btn-pause");

                self.domAudio.pause();
                clearInterval(self.timer);

                self.currentState = "pause";

                // change id
                playButton.data("action", "play");
                playButton.attr("id", "btn-play");

                // activate
                playButton.toggleClass('active');

            },

            stop: function()
            {
                var self = this;

                self.domAudio.pause();
                self.domAudio.currentTime = 0;

                self.animateProgressBarPosition();
                clearInterval(self.timer);
                self.updateElapsedTime();

                self.currentState = "stop";
            },

            prev: function()
            {
                var self  = this,
                    track;

                (self.currentTrack === 0)
                    ? track = self.settings.playlist.length - 1
                    : track = self.currentTrack - 1;

                self.changeTrack(track);
            },
            next: function()
            {
                var self = this,
                    track;

                (self.currentTrack === self.settings.playlist.length - 1)
                    ? track = 0
                    : track = self.currentTrack + 1;

                self.changeTrack(track);
            },


            preLoadTrack: function()
            {
                var self      = this,
                    defTrack  = self.settings.defaultTrack;

                self.changeTrack( defTrack );

                self.stop();
            },

            changeTrack: function(index)
            {
                var self = this;

                self.currentTrack  = index;
                self.domAudio.src  = self.settings.playlist[index].file;
                var lastRunTime=Date.now();
                if(self.currentState === "play" || self.settings.autoPlay){


                    self.play();
                }

                self.highlightTrack();

                self.updateThumb();

                self.renderDetails();

            },

            events: function()
            {
                var self = this;

                // - controls events
                self.$domControls.on("click", "button", function()
                {
                    var action = $(this).data("action");

                    switch( action )
                    {
                        case "prev": self.prev.call(self); break;
                        case "next": self.next.call(self); break;
                        case "pause": self.pause.call(self); break;
                        case "stop": self.stop.call(self); break;
                        case "play": self.play.call(self); break;
                    };

                });

               // - playlist events  
      self.$domPlaylist.on("click", ".jAudio--playlist-item", function(e)  
      {  
        var item = $(this),  
            track = item.data("track"),  
            index = item.index();  
        // before  
        // if(self.currentTrack === index) return;  
        // after fix  
        if(self.currentTrack === index && self.currentState === "play") return;  
        self.changeTrack(index);  
        // add  
        if(self.currentState === "pause") self.play();  
      });  

                // - volume's bar events
                // to do

                // - progress bar events
                self.$domProgressBar.on("click", function(e)
                {
                    self.updateProgressBar(e);
                    self.updateElapsedTime();
                });

                self.$domVolumeBar.on("click", function(e)
                {
                    per = e.offsetX / $(".jAudio--volume-bar-played").width();
                    self.domAudio.volume = per;
                    per = per * 100;
                    console.log(per);
                    $(".jAudio--volume-bar-played").width(per+"%");

                });


                $(self.domAudio).on("loadedmetadata", function()
                {
                    self.animateProgressBarPosition.call(self);
                    self.updateElapsedTime.call(self);
                    self.updateTotalTime.call(self);
                });
            },


            getAudioSeconds: function(string)
            {
                var self    = this,
                    string  = string % 60;
                string  = self.addZero( Math.floor(string), 2 );

                (string < 60) ? string = string : string = "00";

                return string;
            },

            getAudioMinutes: function(string)
            {
                var self    = this,
                    string  = string / 60;
                string  = self.addZero( Math.floor(string), 2 );

                (string < 60) ? string = string : string = "00";

                return string;
            },

            addZero: function(word, howManyZero)
            {
                var word = String(word);

                while(word.length < howManyZero) word = "0" + word;

                return word;
            },

            removeZero: function(word, howManyZero)
            {
                var word  = String(word),
                    i     = 0;

                while(i < howManyZero)
                {
                    if(word[0] === "0") { word = word.substr(1, word.length); } else { break; }

                    i++;
                }

                return word;
            },


            highlightTrack: function()
            {
                var self      = this,
                    tracks    = self.$domPlaylist.children(),
                    className = "active";

                tracks.removeClass(className);
                tracks.eq(self.currentTrack).addClass(className);
            },

            renderDetails: function()
            {
                var self          = this,
                    track         = self.settings.playlist[self.currentTrack],
                    file          = track.file,
                    thumb         = track.thumb,
                    trackName     = track.trackName,
                    trackArtist   = track.trackArtist,
                    trackAlbum    = track.trackAlbum,
                    template      =  "";

                template += "<p>";
                template += "<span>" + trackName + "</span>";
                // template += " - ";
                template += "<span>" + trackArtist + "</span>";
                // template += "<span>" + trackAlbum + "</span>";
                template += "</p>";


                $(".jAudio--details").html(template);

            },

            renderPlaylist: function()
            {
                var self = this,
                    template = "";


                $.each(self.settings.playlist, function(i, a)
                {
                    var file          = a["file"],
                        thumb         = a["thumb"],
                        trackName     = a["trackName"],
                        trackArtist   = a["trackArtist"],
                        trackAlbum    = a["trackAlbum"];
                    trackTime     = a["trackTime"];
                    trackDuration = "00:00";

                    template += "<div class='jAudio--playlist-item' data-track='" + file + "'>";

                    // template += "<div class='jAudio--playlist-thumb'><img src='"+ thumb +"'></div>";

                    template += "<div class='jAudio--playlist-meta-text'>";
                    template += "<div class='info_z'><h4>" + trackName + "</h4>";
                    template += "<p>" + trackArtist + "</p></div>";
                    template += "<div class='info_y'><p class='album'>" + trackAlbum + "</p>";
                    template += "<p class='date'>" + trackTime + "</p></div>";
                    template += '<div class="cb"></div>';
                    template += "</div>";
                    // template += "<div class='jAudio--playlist-track-duration'>" + trackDuration + "</div>";
                    template += "</div>";

                    // });

                });

                self.$domPlaylist.html(template);

            },

            run: function()
            {
                var self = this;

                self.animateProgressBarPosition();
                self.updateElapsedTime();

                if(self.domAudio.ended) self.next();
            },

            animateProgressBarPosition: function()
            {
                var self        = this,
                    percentage  = (self.domAudio.currentTime * 100 / self.domAudio.duration) + "%",
                    styles      = { "width": percentage };

                self.$domProgressBar.children().eq(0).css(styles);
            },

            updateProgressBar: function(e)
            {
                var self = this,
                    mouseX,
                    percentage,
                    newTime;

                if(e.offsetX) mouseX = e.offsetX;
                if(mouseX === undefined && e.layerX) mouseX = e.layerX;

                percentage  = mouseX / self.$domProgressBar.width();
                newTime     = self.domAudio.duration * percentage;

                self.domAudio.currentTime = newTime;
                self.animateProgressBarPosition();
            },

            updateElapsedTime: function()
            {
                var self      = this,
                    time      = self.domAudio.currentTime,
                    minutes   = self.getAudioMinutes(time),
                    seconds   = self.getAudioSeconds(time),

                    audioTime = minutes + ":" + seconds;

                self.$domElapsedTime.text( audioTime );
            },

            updateTotalTime: function()
            {
                var self      = this,
                    time      = self.domAudio.duration,
                    minutes   = self.getAudioMinutes(time),
                    seconds   = self.getAudioSeconds(time),
                    audioTime = minutes + ":" + seconds;

                self.$domTotalTime.text( audioTime );
            },


            updateThumb: function()
            {
                var self = this,
                    thumb = self.settings.playlist[self.currentTrack].thumb,
                    styles = {
                        "background-image": "url(" + thumb + ")"
                    };

                self.$domThumb.css(styles);
                //$("#bg").css(styles);
            },

            debug: function()
            {
                var self = this;

                if(self.settings.debug) console.log(self.settings);
            }

        }

        $.fn[pluginName] = function( options )
        {
            var instantiate = function()
            {
                return new Plugin( $(this), options );
            }

            $(this).each(instantiate);
        }


    })(jQuery)
</script>
<script>
  
    var t = {
        playlist:<?=$list?>,
        autoPlay:false
    }

    $(".jAudio--player").jAudio(t);
    $("#btn-play").trigger("click");

</script>

<?php
 include View::getView('footer');
?>