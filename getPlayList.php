<?php
include("db_connect.php");

$playlistName = $_GET['q'];

$sql = "SELECT l.name AS Playlist, a.artist AS Artist, s.song_name AS Song_Name FROM list_id l, artists a, songs s, playlist p WHERE l.id = p.play_id AND a.id = p.artist_id
AND s.id = p.song_id";
$result = mysql_query($sql);

while($row = mysql_fetch_array($result))
{
   echo $row['song_name'];
}

?>
