<?php
include("db_connect.php");
$id = $_GET['id'];

$sql = "SELECT `song_id` FROM playlist WHERE `list_id` = '$id' ORDER BY play_id ASC";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
    $song_id = $row['song_id'];
    $sel = "SELECT `key` FROM songs WHERE `id` = '$song_id'";
    $rel = mysql_query($sel);
    $keys = mysql_fetch_array($rel);
    $key = $keys['key'];
    $key_array[] = $key;
}

$num = count($key_array);

for($i = 0; $i < $num; $i++)
{
    if ($i == $num-1)
    {
        $string .= $key_array[$i];
    }
    else
    {
        $string .= $key_array[$i].'  ';
    }
}

$_SESSION['num'] = $num;

echo $string;


?>
