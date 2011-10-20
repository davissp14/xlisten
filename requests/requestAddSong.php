
<?php
include("../db_connect.php");
session_start();
$user = $_SESSION['username'];

   $getUserID = "SELECT id FROM users WHERE username = '$user'";
   $getUserResult = mysql_query($getUserID);
   $userA = mysql_fetch_array($getUserResult);
   $userID = $userA['id'];
   
$artist = $_GET['artistt'];
$song = $_GET['song'];
$playlist = $_GET['playlist'];

    // set feed URL
   $feedURL = 'http://gdata.youtube.com/feeds/api/videos?q='.format_Search($artist, $song).'&format=5&max-results=1';

    // read feed into SimpleXML object
    $sxml = simplexml_load_file($feedURL);
    // iterate over entries in feed
    foreach ($sxml->entry as $entry) {
      // get nodes in media: namespace for media information
      $media = $entry->children('http://search.yahoo.com/mrss/');

      // get video player URL
      $attrs = $media->group->player->attributes();
      $watch = $attrs['url'];
    }

  $key = getID($watch);

  if ($key == null || $key == "")
  {
   $key = "empty";
  }



if ($key != "empty")
{

$searchArtistSQL = "SELECT id, artist FROM artists WHERE artist = '$artist'";
$searchArtistResult = mysql_query($searchArtistSQL);
$checkArtist = mysql_num_rows($searchArtistResult);
$databaseArtist = mysql_fetch_array($searchArtistResult);

if ($checkArtist == 0)
{
   mysql_query("INSERT INTO artists (id, artist) VALUES ('', '$artist')");
   $sq = "SELECT id FROM artists WHERE artist = '$artist'";
   $rq = mysql_query($sq);
   $row = mysql_fetch_array($rq);
   $artID = $row['id'];
}
else
{
   $artID = $databaseArtist['id'];
   $artist = $databaseArtist['artist'];
}


$searchSongSQL = "SELECT id, song_name FROM songs WHERE song_name = '$song'";
$searchSongResult = mysql_query($searchSongSQL);
$checkSong = mysql_num_rows($searchSongResult);
if ($checkSong == 0)
{

      mysql_query("INSERT INTO `songs` (`id`, `artist_id`, `song_name`, `key`) VALUES ('', '$artID', '$song', '$key')");
      $s1 = "SELECT id FROM songs WHERE song_name = '$song'";
      $r1 = mysql_query($s1);
      $songrow = mysql_fetch_array($r1);
      $songID = $songrow['id'];

}
else
{
   $databaseSong = mysql_fetch_array($searchSongResult);
   $songID = $databaseSong['id'];
   $song = $databaseSong['song_name'];
}


  $s2 = "SELECT id FROM list_id WHERE name = '$playlist' AND user_id = '$userID'";
  $r2 = mysql_query($s2);
  $playrow = mysql_fetch_array($r2);
  $playID = $playrow['id'];

   $findPlaylistSQL = "SELECT l.id AS list_data, a.id AS artist_data, s.id AS song_data FROM list_id l, artists a, songs s, playlist p WHERE p.user_id = '$userID' AND
   p.list_id = l.id AND p.artist_id = a.id AND p.song_id = s.id AND l.name = '$playlist' AND s.song_name = '$song' AND
   a.artist = '$artist'";
   $findPlaylistResult = mysql_query($findPlaylistSQL);
   $findPlaylistNum = mysql_num_rows($findPlaylistResult);

if ($findPlaylistNum == 0)
{
   mysql_query("INSERT INTO playlist (play_id, list_id, artist_id, song_id, user_id) VALUES ('', '$playID','$artID','$songID', '$userID')");
}
else
{
   echo 'Song is already in List!';
}
}
else
{
  
}

echo $key;

function format_Search($artist, $song)
{
   //$a = ereg_replace('[[:space:]]+', '/', trim($artist));
   // $s = ereg_replace('[[:space:]]+', '/', trim($song));
     $a = str_replace(' ', '/', $artist);
     $s = str_replace(' ', '/', $song);
     return $a.'/'.$s;
}

 function getID($id)
   {
      list($crap, $key) = explode("v=", $id);
      list($keyy, $morecrap) = explode("&", $key);
      return $keyy;
   }
