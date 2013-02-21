<?php
$mosConfig_locale_debug = 0;
$mosConfig_locale_use_gettext = 0;
// Edit your database settings
$db_host = "mysql.davissp.com";
$db_user = "davissp14";
$db_pass = "XxXx";
$db_name = "xlisten";
    $connection = @mysql_connect($db_host,$db_user,$db_pass);
    if (!(mysql_select_db($db_name,$connection)))
    {
        echo "MySQL Error";
    }
    return $connection;
?>
