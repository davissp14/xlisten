<?php
include("db_connect.php");


$num = $_GET['q'];

$sql = "SELECT artist FROM artists WHERE 1";
$result = mysql_query($sql);
$total = mysql_num_rows($result);

while ($row = mysql_fetch_array($result))
{
        $array[] = $row['artist'];
}

echo $array[$num];




?>
