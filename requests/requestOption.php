<?php
include("../db_connect.php");
session_start();
$user = $_SESSION['username'];

   $getUserID = "SELECT id FROM users WHERE username = '$user'";
   $getUserResult = mysql_query($getUserID);
   $userA = mysql_fetch_array($getUserResult);
   $userID = $userA['id'];
            echo '
            Playlist:
            <select id="playlist">
            <option value="">Select Playlist</option>';
            $allLists = "SELECT name FROM list_id WHERE user_id = '$userID'";
            $allListsResult = mysql_query($allLists);
            while ($list = mysql_fetch_array($allListsResult))
            {
              echo '<option value="'.$list['name'].'">'.$list['name'].'</option>';
            }
            echo '</select>
            <input type="button" value="Add Song" onclick="addSong(); this.form.reset();" />
           <p> <br />NOTE: If your song is not added to your playlist, its because no video was found for the given Artist/Song.  Check Spelling!</p>';

            ?>
