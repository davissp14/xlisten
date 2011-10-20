<?php
include("db_connect.php");

session_start();
$user = $_SESSION['username'];

   $getUserID = "SELECT id FROM users WHERE username = '$user'";
   $getUserResult = mysql_query($getUserID);
   $userA = mysql_fetch_array($getUserResult);
   $userID = $userA['id'];
   
$play_id = $_GET['playID'];
$update = $_GET['update'];

$removePlayID = mysql_query("DELETE FROM playlist WHERE play_id = '$play_id' AND user_id = '$userID'");
if ($removePlayID)
{
$sql = "SELECT list_id FROM playlist WHERE list_id = '$update'";
$result = mysql_query($sql);

$num = mysql_num_rows($result);
echo $num;
}
else
{
   echo 'Error';
}


?>
