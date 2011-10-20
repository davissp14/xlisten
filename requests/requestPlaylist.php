<?

include("../db_connect.php");

$artist = $_GET['artist'];
$num = $_GET['q'];

$songSQL = "SELECT song_name FROM songs s WHERE s.artist_id = '$artist'";
$result = mysql_query($songSQL);
while($row = mysql_fetch_array($result))
{
   $array[] = $row['song_name'];

}
echo $array[$num];



?>
