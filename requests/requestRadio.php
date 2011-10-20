
<?php
include("../db_connect.php");

$artist = $_GET['artist'];
$song = $_GET['song'];

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
