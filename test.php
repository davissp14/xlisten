<html>
  <head>
    <script src="http://www.google.com/jsapi"></script>
    <script>google.load("swfobject", "2.1"); var id = 'JZpxaiNV_sM';</script>
    <script type="text/javascript">
        
        



function onYouTubePlayerReady(playerId) {
  ytplayer = document.getElementById("myytplayer");
  ytplayer.addEventListener("onStateChange", "onytplayerStateChange");
}

function onytplayerStateChange(newState) {
   if (newState == '0')
   {
        id = 's_RGaSV0KIg';
       loadNewVideo(id, '');
   }
}
        function onPlayerError(errorCode) {
          alert("An error occured: " + errorCode);
        }

        // functions for the api calls
        function loadNewVideo(id, startSeconds) {
          if (ytplayer) {
            ytplayer.loadVideoById(id, parseInt(startSeconds));
          }
        }

        function cueNewVideo(id, startSeconds) {
          if (ytplayer) {
            ytplayer.cueVideoById(id, startSeconds);
          }
        }

        function play() {
          if (ytplayer) {
            ytplayer.playVideo();
          }
        }

        function pause() {
          if (ytplayer) {
            ytplayer.pauseVideo();
          }
        }

        function stop() {
          if (ytplayer) {
            ytplayer.stopVideo();
          }
        }

        function getPlayerState() {
          if (ytplayer) {
            return ytplayer.getPlayerState();
          }
        }

        function clearVideo() {
          if (ytplayer) {
            ytplayer.clearVideo();
          }
        }
        

    </script>
  </head>
  <body>
    <div>
    <div id="ytapiplayer">
      You need Flash player 8+ and JavaScript enabled to view this video.
    </div>
    <script type="text/javascript">
     
      // <![CDATA[

      // allowScriptAccess must be set to allow the Javascript from one 
      // domain to access the swf on the youtube domain
      var params = { allowScriptAccess: "always", bgcolor: "#cccccc" };
      // this sets the id of the object or embed tag to 'myytplayer'.
      // You then use this id to access the swf and make calls to the player's API
      var atts = { id: "myytplayer" };
     var test = swfobject.embedSWF("http://www.youtube.com/v/"+ id + "?enablejsapi=1&playerapiid=ytplayer", 
                       "ytapiplayer", "425", "356", "8", null, null, params, atts);

      //]]>
           
         ytplayer = document.getElementById("myytplayer");
          ytplayer.addEventListener("onStateChange", "onytplayerStateChange");
    </script>
  </body>
</html>
