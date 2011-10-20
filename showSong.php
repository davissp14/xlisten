<?php include("db_connect.php");
   if(isset($_GET['q']))
   {
      $artist = $_GET['art'];
      $queryString = $_GET['q'];
      if(strlen($queryString) >0)
      {
         $query = "SELECT s.song_name FROM songs s, artists a WHERE s.artist_id = a.id AND a.artist = '$artist' AND s.song_name LIKE '$queryString%' LIMIT 10";
         $result = mysql_query($query) or die("There is an error in database please contact Maylorb@gmail.com");
         $numrows = mysql_num_rows($result);
         if ($numrows > 0)
         {
            while($row = mysql_fetch_array($result))
            {
               $song = $row['song_name'];
               echo "$song\n";
            }
         }
         else
         {
            echo 'No Suggestions';
         }
      }
   }
?>
