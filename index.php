<?php
include("db_connect.php");
session_start();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <noscript><span style="color: red; font-weight: bold; font-size: 14px">You currently do not have Javascript Enabled... Please enable then revisit site.</noscript>
         <script type="text/javascript" src="jquery.js"></script>
         <script type="text/javascript" src="jquery.autocomplete.pack.js"></script>
         <script type="text/javascript" src="prompt.js"></script>
         <script type="text/javascript" src="jquery-ui.js"></script>
         <script type="text/javascript" src="popup.js"></script>
         <script type="text/javascript" src="script.js"></script>
         <script type="text/javascript" src="player.js"></script>
         <script type="text/javascript" src="http://www.google.com/jsapi"></script>
         <script type="text/javascript"> google.load("swfobject", "2.1")</script>
         <script type="text/javascript" src="http://ui.jquery.com/latest/ui/effects.core.js"></script>
         <!-- CSS IMPORTING -->
        <script type="text/javascript">
        //Determines Whether Radio function is active.
        var radio = false;
        var scramble = false;
        // Store the current Radio Information
        var tempRadioArtist;
        var tempRadioSong;
        var scrambleArtist;

        // Stores Video keys
        var keys = new Array();
        
        // Counter variable, used for locating position in playlist.
        var count = 1;
        // Determines when playlist is done playing. End position for count.
        var max;
            // Initial loaded video.  Optional
            var id = 's_RGaSV0KIg';

         // Autocomplete JQuery information
         $(document).ready(function(){
            $('input[name=opt]:eq(0)').attr('checked', 'checked');
           
            // Need to fix this eventually.
            $("#adSong").hide();
            $("#artist").autocomplete("showArtist.php", {
               width: 220,
               matchContains: true,
               selectFirst: false
            });
            $("#song").autocomplete("showSong.php", {
               width: 220,
               extraParams: {art: function() { return $("#artist").val(); }},
               matchContains: true,
               selectFirst: false
            });
         });

         // Form control over Add Song/Add Playlist
         function showContent(content)
         {
            
            if (content == 'playlist')
            {
               $("#adPlay").show();
               $("#adSong").hide();
            }
            else if (content == 'song')
            {
               $("#adSong").show();
               $("#adPlay").hide();
            }
         }
         
        function updateList()
        {
                // alert("Your Playlist Has Been Updated!");
                $.get("update.php",
                  function(data) {
                     $("#subcontainer").html(data);
                  }, "html");
         }
         
         // Sends request to add song.
         function addSong()
         {
            var artist = document.getElementById("artist").value;
            var song = document.getElementById("song").value;
            var playlist = document.getElementById("playlist").value;

            if (artist == '' || song == '' || playlist  == '')
            {
               alert("Some Fields Appear To Be Empty!");
            }
            else
            {
               $.get("requests/requestAddSong.php", {artistt: artist, song: song, playlist: playlist}, function(data){
                 alert('Song Added!');
                 keys.push(data);
                 updateList();
                 $(':input', '#adSong').not(':button, :submit, :reset, :hidden').val('');

               });

            }
         }

         // Get Data From Last.FM API
         function getRandomVideo(radioArtist, radioSong)
         {
            var radArray = new Array();
            $.get("lastFM.php", {artist: radioArtist, song: radioSong}, function(data){
                radio = true;
                radArray.push(data.split("  "));
                $("#playing").html(radArray[0][0] + '   ' + radArray[0][1]);
                getRadioKey(radArray[0][0], radArray[0][1]);


            });
         }

        function getArtistVideo(radioArtist)
         {
            var radArray = new Array();
            $.get("lastFMScramble.php", {artist: radioArtist}, function(data){
                scramble = true;
                radArray.push(data.split("  "));
                $("#playing").html(radArray[0][0] + '   ' + radArray[0][1]);
                getRadioKey(radArray[0][0], radArray[0][1]);


            });
         }

         function initiateRadio(type)
         {
            var a = $("#radioArtist").val();
            var b = $("#radioSong").val();
            var c = $("#scramArtist").val();
            $("#nextSong").hide();
            $("#previousSong").hide();

            if (type == 'Radio')
            {
                scramble = false;
                tempRadioArtist = a;
                tempRadioSong = b;
                getRandomVideo(a,b);
            }
            if (type == 'Scramble')
            {
                radio = false;
                scrambleArtist = c;
                getArtistVideo(c);
            }
         }

         function getRadioKey(artist, song)
         {

              $.get("requests/requestRadio.php", {artist: artist, song: song}, function(data){
                 loadNewVideo(data);
               });

         }


         // Sends Request to add Playlist
         function addPlaylist()
         {
            var playlist = document.getElementById("addPlay").value;
            if (playlist == '')
            {
               alert("Playlist Field is empty!");
            }
            else
            {
               $.get("requests/requestAddPlaylist.php", {playlist: playlist});
               alert('Playlist Added!');
               updateList();
            }
         }

            function showArtist(num)
            {
               $.get("sql.php", {q: num},
               function(data) {
                  $("#title"+num).html(data);
                  showSong(num, data);
                  }, "html");
            }
            function showSong(id, artist)
            {
               $.get("songSQL.php", {div: id, art: artist},
               function(data) {
                  $("#song"+id).html(data);
                  }, "html");
            }

           function playSong(id)
           {
               var height = screen.height;
               var width = screen.width;

               if (document.getElementById("testing").value != '')
               {
                  $.get("get_key.php", {id: id, width: width}, function(data){
                    radio = false;
                    scramble = false;
                     count = -1;
                     $("#nextSong").hide();
                     $("#previousSong").hide();
                     loadNewVideo(data, '');
                     $("#testing").html(data);
                  }, "html");
               }
           }

           function nextSong()
           {
               if (count < keys.length)
               {
                   loadNewVideo(keys[count+1]);
                   count++;
               }
           }

           function previousSong()
           {
               if (count > 0)
               {
                   loadNewVideo(keys[count-1]);
                    count--;
               }
           }

           function loadPlaylist(id)
           {

                   $.get("loadPlaylist.php", {id: id}, function(data){
                    $("#nextSong").show();
                    $("#previousSong").show();
                    radio = false;
                    scramble = false;
                    count = 0;
                    max = keys.length;
                    keys = data.split('  ');
                    loadNewVideo(keys[0], '');
                  //$("#playlistData").html(data);
               }, "html");
           }

           function updatePlaylist()
           {
              $.get("requests/requestOption.php",function(data){
                  $("#playOption").html(data);
               }, "html");
           }

            function onYouTubePlayerReady(playerId) {
              ytplayer = document.getElementById("myytplayer");
              ytplayer.addEventListener("onStateChange", "onytplayerStateChange");
            }

            function onytplayerStateChange(newState) {
               if (newState == '0')
               {
                if (radio)
                {
                   getRandomVideo(tempRadioArtist, tempRadioSong);
                }
                else if (scramble)
                {
                    getArtistVideo(scrambleArtist);
                }
                {
                  if (count != -1)
                  {
                     loadNewVideo(keys[count+1], '');
                     count++;
                  }
                }
               }
            }

            // If Javascript is not enabled, or Player Error
            function onPlayerError(errorCode) {
              alert("An error occured: " + errorCode);
            }

            // functions for the api calls
            function loadNewVideo(id, startSeconds) {
              if (ytplayer) {
                ytplayer.loadVideoById(id, parseInt(startSeconds));
              }
            }
   
        function switc(option)
            {
                if (option == 'signup')
                {
                    $('#intro').hide();
                    $('#login').css('display', 'none');
                    
                   $('#signup').show();
                }
                if(option == 'login')
                {
                    $('#intro').hide();
                    $('#signup').hide();
                    $('#login').css('display', 'block');
                    
                }
                if (option == 'logout')
                {
                  $.get('session_unset.php',  function(){
                    window.location="index.php";
                  });
             
                }
             
            }
            
                function autoAddScrambler()
                {
                     var data = $('#playing').text();
                     var sArray = new Array();
                     sArray.push(data.split("   "));
                     
                     var artist = sArray[0][0];
                     var song = sArray[0][1];
                    centerPopup();
                    loadPopup();
                    
                    $("input[name='opt']:eq(1)").attr("checked", "checked");
                    $('#artist').val(artist);
                    $('#song').val(song);
                    
                     
                     
                    //$("#playing").html(sArray[0][0] + '   ' + rArray[0][1]);
                }
                
                function resetArea()
                {
                
                    $('input[name=opt]:eq(0)').attr('checked', 'checked');
                    
                    
                }
             </script>
         <link rel="stylesheet" href="style.css" type="text/css" />
         <link rel="stylesheet" href="main.css" type="text/css" />
         <link rel="stylesheet" href="popup.css" type="text/css" />
        <title>Xlisten</title>
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-17615656-3']);
            _gaq.push(['_trackPageview']);
          
            (function() {
              var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
              ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
              var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
    </script>
    </head>
    <body>

            <!-- Pop Up Window -->
            <div id="popupContact">
            <a id="popupContactClose" onclick="resetArea();">x</a>
            <h1>Add Song/Playlist!</h1>
            <p id="contactArea">

            Playlist <input type="radio" name="opt" value="playlist"  onclick="showContent(this.value);" />
            Song <input type="radio"  name="opt" value="song" onclick="showContent(this.value);"/>
            <form id="adSong" action="">
            <br />
            Artist: <input id="artist" size="30" />
            Song:  <input id="song" size="30"  />
            <script type="text/javascript"> updatePlaylist(); </script>
            <div style="display: inline;" id="playOption"></div>
            </form>
            <form id="adPlay" action="">
            <br />
            Playlist: <input type="text" id="addPlay" value="" />
            <input type="button" value="Add Playlist" onclick="addPlaylist(); updateList(); updatePlaylist(); this.form.reset();" />
            </form>
            </p>
            </div>
            <div id="backgroundPopup"></div>
            <?
            echo '
                <div id="main">';
            
            if ($_SESSION['username'] == "")
            {
                 ?>
                 <div id="Header"><a href="#" style="float: right; margin-top: 25px; margin-right: 40px; width: 60px; height: 30px;" onclick="switc('login');"></a><a href="#" style="float: right; margin-top: 25px;  width: 70px; height: 30px;" onclick="switc('signup');"></a></div>
                <?
                
                ?>
                <script type="text/javascript">
                switc('none');
                
                function sendData()
                {
                    var username = $('#username').val();
                    var password = $('#password1').val();
                    var password1 = $('#password2').val();
                    var firstname = $('#first').val();
                    var lastname = $('#last').val();
                    var city = $('#city').val();
                    var state = $('#state').val();
                    var age = $('#age').val();
                    
                    $.get("saveUser.php", {username: username, password: password, password1: password1, firstname: firstname, lastname: lastname,
                          city: city, state: state, age: age}, function(data){
                          
                          alert('Thank you!');
                          $('#intro').show();
                          $('#signup').css('display', 'none');
                          });
                }
                
                function login()
                {
                    var username = $('#loginUsername').val();
                    var password = $('#loginPassword').val();
                    
                    $.get('login.php', {username: username, password: password}, function(data){
                        window.location="index.php";

                    });
                    
                }
                
            
                
            
                </script>
        
                <?
                echo '
                <div id="intro" style="font-size: 16px;">
                    Welcome to Xlisten.com.<br /> <br />
                    
                    Xlisten is currently in Beta, lots of new features on the way soon.  If you would like to see what I have to offer please
                    sign up free of charge.  This will give you access to an unlimited amount of playlists to store all of your favorite songs accompanied
                    by a music videos brought to you by youtube.  Along with storage you will also have access to two radio functions.  One is an
                    artist based station, where the station only plays songs by a specific artist.  You will also have a Discovery radio function,
                    where it plays songs of a similar genre.  Have fun, and if you have any questions, concerns, or recommendations please email me at
                    davissp14@gmail.com.
                </div>
                <form name="sign">
                <div id="signup" style=" display: none; margin-left: auto; margin-right: auto; width: 500px; height: 500px; margin-top: 20px; font-size: 18px;">
                    <table>
                        <tr>
                        <td>Username: </td><td><input type="text" id="username" value="" /></td><td><input type="button" value="Check Availability" />
                        </tr>
                        <tr>
                        <td>Password: </td><td><input type="password" id="password1" value="" /></td>
                        </tr>
                        <tr>
                        <td>Re-enter Password: </td><td><input type="password" id="password2" value="" /></td>
                        </tr>
                        <tr>
                        <td>First Name: </td><td><input type="text" id="first" value="" /></td>
                        </tr>
                          <tr>
                        <td>Last Name: </td><td><input type="text" id="last" value="" /></td>
                        </tr>
                        <tr>
                        <td>City: </td><td><input type="text" id="city" value="" /></td>
                        </tr>
                        <tr>
                        <td>State: </td><td><input type="text" id="state" value="" /></td>
                        </tr>
                            <tr>
                        <td>Age: </td><td><input type="text" id="age" value="" /></td>
                        </tr>
                        <tr>
                            <td><input type="button" value="Register" onclick="sendData(); "/></td>
                        </tr>
                    </table>
                </div>
                </form>
                
                <div id="login" style="display: none; margin-left: auto; margin-right: auto; width: 250px; height: 300px; margin-top: 5%;">
                    <table>
                        <tr>
                        <td>Username: </td><td><input type="text" id="loginUsername" value="" /></td>
                        </tr>
                        <tr>
                        <td>Password: </td><td><input type="password" id="loginPassword" value="" /></td>
                        </tr>
                        <tr><td><input type="button" value="Login" onclick="login();" /></td></tr>
                    </table>
                </div>
             </div>';

            }
            else
            {
            ?>
                 <div id="Header"></a><a href="#" style="float: right; margin-top: 25px;  margin-right: 70px; width: 70px; height: 30px;" onclick="switc('logout');"></a></div>
                <script type="text/javascript">
                    $('#Header').css('background-image', 'url(images/header_logout.jpg)');
                </script>
                <?
                echo '
            
            <div id="subMenu">
             <div id="playerControl">
                           <div id="nextSong" style="display: inline;"></div>
                           <div id="previousSong" style="display: inline; float: right; width: 50px; height: 30px; margin-right: 46px; "></div>
            </div>';
            ?>
             <a href="#" style="float: right; width: 150px; height: 30px; margin-right: 30px;" onclick=" loadPopup(); showContent('playlist'); centerPopup();"></a>
            <?
            echo '
            </div>
            
            <div id="scrollbar"  >

                        <div id="rightInfo" style="margin-top: 10px;">
                        <div id="subcontainer">
                      
                            
                        </div>
                           <script type="text/javascript"> updateList(); </script>
                        </div>
                    </div>
                    <div id="leftPlayer">
                       
                        <div id="ytapiplayer">
                        If you can see this... Make sure Javascript is Enabled!
                        </div>
                        ';
                        ?>

                        <script type="text/javascript">
                        var screenWidth = screen.width;
                        // <![CDATA[

                        // allowScriptAccess must be set to allow the Javascript from one
                        // domain to access the swf on the youtube domain
                        var params = { allowScriptAccess: "always", bgcolor: "#cccccc", allowFullScreen: "true", wmode: "opaque" };
                        // this sets the id of the object or embed tag to 'myytplayer'.
                        // You then use this id to access the swf and make calls to the player's API
                        var atts = { id: "myytplayer" };

                        $("#nextSong").html('').html('<a href="#" style=" width: 80px; height: 20px; float: left; margin-left: 33px; cursor: pointer; margin-top:7px;" onclick="previousSong();"></a>');
                        $("#previousSong").html('').html('<a href="#" style="display: inline; float: right; width: 45px; height: 20px;  margin-top: 7px;  cursor: pointer;" onclick="nextSong();"></a>');
                        swfobject.embedSWF("http://www.youtube.com/v/"+ id + "?enablejsapi=1&playerapiid=ytplayer&fs=1",
                        "ytapiplayer", "500", "425", "8", null, null, params, atts);

                        ytplayer = document.getElementById("myytplayer");
                        ytplayer.addEventListener("onStateChange", "onytplayerStateChange");
                        </script>
                  
                <?
                echo '
  
                    </div>
        
<div id="bottomLeft">
        <span style="font-size: 24;">Currently Playing</span> <div id="playing"></div><input type="button" value="Add Song" onclick="autoAddScrambler();" />
        <br /><br />';?>
    <p>Currently working out the Invalid Parameters Error, if you experience it just click the button again to restart the search.</p>
         <div id="testing"></div>
        <span style="font-size: 18;">Radio</span><br />
        <label>Artist</label><input type="text" id="radioArtist" value="" />
        <label>Song</label><input type="text" id="radioSong" value="" />
        <input type="button" value="Play Radio" onclick="initiateRadio('Radio');" />
        <br /><br />
        <span style="font-size: 18;">Scramble Artist</span><br />
        <label>Artist</label><input type="text" id="scramArtist" value="" />
        <input type="button" value="Scramble Artist" onclick="initiateRadio('Scramble');" />
</div>
<?
echo'

   </div>';
            }
            ?>

</div>
    <div style="width: 100px; height: 10px; position: fixed;"></div>
    </body>
</html>
