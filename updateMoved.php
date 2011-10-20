
<?php
include("db_connect.php");

$replaced = $_GET['replaced'];
$moved = $_GET['moved'];

echo '$replaced';
echo '$moved';

$repsql = "SELECT `list_id`, `artist_id`, `song_id` FROM playlist WHERE `play_id` = '$replaced'";
$movsql = "SELECT `list_id`, `artist_id`, `song_id` FROM playlist WHERE `play_id` = '$moved'";
mysql_query($repsql);
mysql_query($movsql);

$rep = mysql_fetch_array($selectReplaced);
$mov = mysql_fetch_array($selectMoved);

$repList = $rep['list_id'];
$repArtist = $rep['artist_id'];
$repSong = $rep['song_id'];
$movList = $mov['list_id'];
$movArtist = $mov['artist_id'];
$movSong = $mov['song_id'];


mysql_query("UPDATE playlist SET `list_id`='$movList', `artist_id`='$movArtist', `song_id`='$movSong' WHERE `play_id`='$replaced'");
mysql_query("UPDATE playlist SET `list_id`='$repList', `artist_id`='$repArtist', `song_id`='$repSong' WHERE `play_id`='$moved'");

?>
