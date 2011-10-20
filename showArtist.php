<?php include("db_connect.php");
  if(isset($_GET['q']))
  {
      $queryString = $_GET['q'];
         if(strlen($queryString) >0)
         {
            $query = "SELECT artist FROM artists WHERE artist LIKE '$queryString%' LIMIT 10";
            $result = mysql_query($query) or die("There is an error in database please contact support@ExploreMyBlog.Com");
            $numrows = mysql_num_rows($result);
            if ($numrows > 0)
            {
               while($row = mysql_fetch_array($result))
               {
                  $artist = $row['artist'];
                  echo "$artist\n";
               }
            }
            else
            {
               echo "No Suggestions";
            }
         }
      }
?>
