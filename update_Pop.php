<script type="text/javascript">
$.getScript("script.js");
</script>
<?php
include("db_connect.php");
 $getListSQL = "SELECT id, name FROM list_id WHERE 1";
         $getresult = mysql_query($getListSQL);
         $count = mysql_num_rows($getresult);
         $counter = 0;
         $test = 0;
         while ($play = mysql_fetch_array($getresult))
         {
            $id = $play['id'];
            $countSongs = mysql_query("SELECT list_id FROM playlist WHERE list_id = '$id'");
            $count = mysql_num_rows($countSongs);
            echo '<div class="requestTitle">
            <table class="playlist">';
             echo '<tr><td> '.$play['name'].'</td><td style="padding-left: 250px;">'.$count.'</td></tr>';
            echo '</table> </div>';
         }
   var_dump($getresult);
   mysql_error();

?>
