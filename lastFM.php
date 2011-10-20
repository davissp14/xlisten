<?php
require('lastFM/lastfmapi/lastfmapi.php');
$authVars['apiKey'] = 'd6df4e2f159ed394ecd133cf955758e3';
$auth = new lastfmApiAuth('setsession', $authVars);
$apiClass = new lastfmApi();
$artistClass = $apiClass->getPackage($auth, 'track');

$artist = $_GET['artist'];
$song = $_GET['song'];

$methodVars = array(
'artist' => $artist,
'track' => $song
);

if ( $artist = $artistClass->getSimilar($methodVars) ) {
// Success

$rand = rand(0, 100);

   echo $artist[$rand]['artist']['name'].'  '.$artist[$rand]['name'];
   
   


}
else {
// Error
die('Error '.$artistClass->error['code'].' - '.$artistClass->error['desc']);
}


?>
