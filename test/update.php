<script type="text/javascript">
$.getScript("script.js");
</script>

<?php

include("../db_connect.php");
echo ' <div id="Request">';
 $sql = "SELECT id, name FROM list_id WHERE 1";
         $result = mysql_query($sql);
         $count = mysql_num_rows($result);
         $counter = 0;
         while ($playlist = mysql_fetch_array($result))
         {
            echo '<div class="requestTitle">
            <table>';
             echo '<tr><td> '.$playlist['name'].'</td></tr>';
            echo '</table> </div>';

               $list = $playlist['id'];
               $sql = "SELECT a.artist, s.song_name FROM artists a, songs s, playlist p WHERE p.list_id = '$list' AND p.artist_id = a.id AND
               p.song_id = s.id";
               //$songSQL = "SELECT song_name FROM songs s WHERE s.artist_id = '$artist'";
               $songResult = mysql_query($sql);
               $numr = mysql_num_rows($songResult);
               if ($numr > 0)
               {
                  echo '<div class="requestInformation">
                  <table class="stripeMe">';

                  while ($song = mysql_fetch_array($songResult))
                  {
                     echo '<tr><td>'.$song['artist'].'</td><td>'.$song['song_name'].'</td></tr>';
                  }
                  echo '</table></div>';
               }
               else
               {
                  echo '<div class="requestInformation">
                           Add Songs!
                        </div>';
               }
               $counter++;
         }

   echo '</div>';

?>
