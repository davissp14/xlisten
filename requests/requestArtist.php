
<?
session_start();
$user = $_SESSION['username'];
include("../db_connect.php");
   $getUserID = "SELECT id FROM users WHERE username = '$user'";
   $getUserResult = mysql_query($getUserID);
   $userA = mysql_fetch_array($getUserResult);
   $userID = $userA['id'];

echo ' <div id="Request">';
 $sql = "SELECT id, name FROM list_id WHERE user_id = '$userID' ";
         $result = mysql_query($sql);
         $count = mysql_num_rows($result);
         $counter = 0;
         while ($playlist = mysql_fetch_array($result))
         {
            echo '<div class="requestTitle">
            <table class="stripeMe">';
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
                  echo '<div class="requestInformation">';
                  while ($song = mysql_fetch_array($songResult))
                  {
                     echo $song['artist'] .'  -  '.  $song['song_name']. '  <br />';
                  }
                  echo '</div>';
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
