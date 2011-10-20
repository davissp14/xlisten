<?php
require('lastFM/lastfmapi/lastfmapi.php');
$authVars['apiKey'] = 'd6df4e2f159ed394ecd133cf955758e3';
$auth = new lastfmApiAuth('setsession', $authVars);
$apiClass = new lastfmApi();
$artistClass = $apiClass->getPackage($auth, 'artist');

//$artistt = $_GET['artist'];
$artistt = 'Fair to Midland';

$methodVars = array(
'artist' => $artistt
);

if ( $artist = $artistClass->getTopAlbums($methodVars) ) {
// Success
//$rand = rand(0, 30);

for ($i = 0; $i < 8; $i++)
{
    $temp = 0;
    if (count($albums) > 0)
    {
        for ($y = 0; $y < count($albums); $y++)
        {
            if ($albums[$y] == $artist[$i]['name'])
            {
                $temp = 1;
            }
        }
        if ($temp == 0)
        {
            $albums[] = $artist[$i]['name'];
        }
    }
    else
    {
        $albums[] = $artist[$i]['name'];
    }
}  
   
   
for ($i = 0; $i < count($albums); $i++)
{
    echo $albums[$i].'<br />';
}

}
else {
// Error
die('Error '.$artistClass->error['code'].' - '.$artistClass->error['desc']);
}


?>
