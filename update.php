<?php
   include("db_connect.php");
   session_start();
 
?>
<script type="text/javascript">
$.getScript("jquery.js");
$.getScript("jquery-ui.js");
$.getScript("script.js");
$.getScript("prompt.js");

</script>
<?php

$user = $_SESSION['username'];
   $getUserID = "SELECT id FROM users WHERE username = '$user'";
   $getUserResult = mysql_query($getUserID);
   $userA = mysql_fetch_array($getUserResult);
   $userID = $userA['id'];

echo ' <div id="Request">';
 $sql = "SELECT id, name FROM list_id WHERE user_id = '$userID'";
         $result = mysql_query($sql);
         $count = mysql_num_rows($result);
         $counter = 0;
         $test = 0;
         while ($playlist = mysql_fetch_array($result))
         {
            $id = $playlist['id'];
            $countSongs = mysql_query("SELECT list_id FROM playlist WHERE list_id = '$id' AND user_id = '$userID'");
            $count = mysql_num_rows($countSongs);

            echo '
            <div class="requestTitle">
            <table class="playlist" style="cursor: pointer;">';
             echo '<tr><td style="margin-left: 20px; width: 200px">'.$playlist['name'].'</td><td id="playl'.$counter.'" style="margin-left: 70px;">'.$count.'</td></tr>';
            echo '</table> </div>';
//<td><div class="playButtonAll" id="playAll'.$counter.'"><input type="hidden" value="'.$playlist['id'].'" /></div></td>
               $list = $playlist['id'];
               $sql = "SELECT p.play_id, a.artist, s.song_name FROM artists a, songs s, playlist p WHERE p.list_id = '$list' AND p.artist_id = a.id AND
               p.song_id = s.id AND p.user_id = '$userID' ORDER BY p.play_id ASC";
               //$songSQL = "SELECT song_name FROM songs s WHERE s.artist_id = '$artist'";
               $songResult = mysql_query($sql);
               $numr = mysql_num_rows($songResult);
               if ($numr > 0)
               {
                 echo '<div class="requestInformation">
                  <table class="stripeMe"><thead>
                  <tr><th style="width: 90px;">Artist Name</th><th style="width: 100px">Song Name</th><th style="width: 48px;">Album</th><th style="width: 90px;">Remove</th></tr>
		  <tr><td><div class="playButtonAll" id="playAll'.$counter.'"><input type="hidden" value="'.$playlist['id'].'" /></div><td>Play All</td></td></tr>
                  </thead> <tbody>';

                  while ($song = mysql_fetch_array($songResult))
                  {
                     echo '
                              <tr class="move" id="row'.$test.'"><input type="hidden" value="'.$song['play_id'].'"/><td style="width: 20px;"><div class="current" id="currentplay'.$test.'"></div>
			      </td><td><div class="playButton" id="play'.$test.'"><input type="hidden" value="'.$song['play_id'].'" /></div></td><td style="padding-left: 20px; width: 160px;">'.$song['artist'].'</td>
			      <td style="width:155px;">'.$song['song_name'].'</td><td style="width:115px">Coming Soon!</td><td style="width: 70px;"><div class="remove" id="'.$test.'" style="cursor: pointer; color: blue;">
			      <input type="hidden" value="'.$song['play_id'].'" /><input type="hidden" class="te" value="'.$counter.'"/> Remove</div></td></tr>
                      ';
                     $test++;
                  }
                  echo '</tbody></table></div>';
               }
               else
               {
                  echo '<div class="requestInformation">
                           Add Songs!
                        </div>';
               }
               $counter++;
         }

?>

<script type="text/javascript">
var temp;

   $('.playButtonAll').click(function(){
      var id = this.id;
      var sendID = $('#'+id).find('input[type=hidden]:first').val();
       $.post('index.php', {id: sendID}, function(data) {
         loadPlaylist(sendID);
   });
   });

   $('.playButton').click(function(){
      var id = this.id;

      var sendID = $('#'+id).find('input[type=hidden]:first').val();
      if (temp != '')
      {
         $("#current"+temp).css("background-image", "none");
      }

      // use this id, to lookup youtube code

      $("#current"+id).css("background-image", "url(images/current.png)");
      temp = id;

      $.post('index.php', {id: sendID}, function(data) {
         playSong(sendID);   });
   });

   $('.remove').click(function(){
      
      var removeID = this.id;
      var id = $('#'+removeID).find('input[type=hidden]:first').val();
      var update = $('#'+removeID).find('input[class=te]').val();
      removeSong(removeID, id, update);
   });



   function removeSong(id, playlist_id, update)
   {
      $.getScript("prompt.js");
	var txt = 'Are you sure you want to remove this song?';

				$.prompt(txt,{
				 buttons:{Delete:true, Cancel:false},
               callback:function(data){
                  if (data)
                  {
                     $.get('remove.php',{playID: playlist_id}, function(){
                     var currentVal = $('#playl'+update).text();
                     $('#row'+id).effect("highlight", {}, 2000, function(){
                        $('#row'+id).hide();
                        $('#playl'+update).text(currentVal - 1);
                     });
                     });
                  }
                  else
                  {}
               }
            });
   }
   function moveDownUpdate(idReplaced, idMoved)
   {

      //alert(idMoved + idReplaced);
         //alert($('#'+idReplaced).find('input[type=hidden]:first').val());
         if (idReplaced.foo !== null)
         {
          $.get('updateMoved.php',{replaced: idReplaced, moved: idMoved}, function(){
            alert('sent');
          });
         }
   }


</script>
