<?php
require('lastFM/lastfmapi/lastfmapi.php');
$authVars['apiKey'] = 'd6df4e2f159ed394ecd133cf955758e3';
$auth = new lastfmApiAuth('setsession', $authVars);
$apiClass = new lastfmApi();
$artistClass = $apiClass->getPackage($auth, 'artist');

$artistt = $_GET['artist'];

$methodVars = array(
'artist' => $artistt
);

if ( $artist = $artistClass->getTopTracks($methodVars) ) {
// Success
$rand = rand(0, 30);


//var_dump($artist);
   echo $artistt.'  '.$artist[$rand]['name'];
   
   


}
else {
// Error
die('Error '.$artistClass->error['code'].' - '.$artistClass->error['desc']);
}


?>
