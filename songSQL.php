<?php
include("db_connect.php");


$num = $_GET['div'];
$artist = $_GET['art'];




$getsql = "SELECT id FROM artists WHERE artist = '$artist'";
$getresult = mysql_query($getsql);
$arts = mysql_fetch_array($getresult);
$id = $arts['id'];

$sql = "SELECT song_name FROM songs WHERE artist_id = '$id'";
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result))
{
        $array[] = $row['song_name'];
}

$count = mysql_num_rows($result);
$i = 0;
while($i != $count)
{
   echo $array[$i]."<br />";
   $i++;
}





?>
