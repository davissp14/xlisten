
<?php

include("db_connect.php");
session_start();
$playid = $_GET['id'];
$width = $_GET['width'];

$sql = "SELECT * FROM playlist WHERE `play_id` = '$playid'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

$artist_id = $row['artist_id'];
$song_id = $row['song_id'];

$getKeySQL = "SELECT `key` FROM songs WHERE `artist_id` = '$artist_id' AND `id` = '$song_id'";
$getKeyResult = mysql_query($getKeySQL);
$key = mysql_fetch_array($getKeyResult);

$return = $key['key'];

echo $return;
$_SESSION['width'] = $width;

/*
if ($width > 1700 && $width < 2400)
{
echo '
<div id="player">
         <object id="tes" width="700" height="644">
         <param name="movie" value="http://www.youtube.com/v/'.$return.'&autoplay=1?fs=1"</param>
         <param name="allowFullScreen" value="true"></param>
         <param name="allowScriptAccess" value="always"></param>
         <embed src="http://www.youtube.com/v/'.$return.'&autoplay=1?fs=1"
           type="application/x-shockwave-flash"
           allowfullscreen="true"
           allowscriptaccess="always"
           width="700" height="644">
         </embed>
         </object>
      </div>';
}

if ($width > 1200 && $width < 1700)
{    echo '
     <div id="player">
         <object id="tes" width="400" height="344">
         <param name="movie" value="http://www.youtube.com/v/'.$return.'&autoplay=1?fs=1"</param>
         <param name="allowFullScreen" value="true"></param>
         <param name="allowScriptAccess" value="always"></param>
         <embed src="http://www.youtube.com/v/'.$return.'&autoplay=1?fs=1"
           type="application/x-shockwave-flash"
           allowfullscreen="true"
           allowscriptaccess="always"
           width="400" height="344">
         </embed>
         </object>
      </div>';

}
else if($width > 800 && $width < 1200)
{
      echo '
    <div id="player">
         <object id="tes" width="300" height="244">
         <param name="movie" value="http://www.youtube.com/v/'.$return.'&autoplay=1?fs=1"</param>
         <param name="allowFullScreen" value="true"></param>
         <param name="allowScriptAccess" value="always"></param>
         <embed src="http://www.youtube.com/v/'.$return.'&autoplay=1?fs=1"
           type="application/x-shockwave-flash"
           allowfullscreen="true"
           allowscriptaccess="always"
           width="400" height="344">
         </embed>
         </object>
      </div>';
}

*/
?>
