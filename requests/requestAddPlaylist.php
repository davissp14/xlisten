<script type="text/javascript">
$.getScript("../script.js");
</script>
<?php
session_start();
include("../db_connect.php");

$user = $_SESSION['username'];

   $getUserID = "SELECT id FROM users WHERE username = '$user'";
   $getUserResult = mysql_query($getUserID);
   $userA = mysql_fetch_array($getUserResult);
   $userID = $userA['id'];
   
$playlist = $_GET['playlist'];

mysql_query("INSERT INTO list_id (id, name, user_id) VALUES ('', '$playlist', '$userID')");
 ?><script type="text/javascript"> updateList(); </script> <?

?>
