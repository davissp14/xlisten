<?php
session_start();
include("db_connect.php");

$username = $_GET['username'];
$password = $_GET['password'];

//Validate
$checkName = "SELECT username FROM users WHERE username = '$username'";
$checkNameResult = mysql_query($checkName);
$check = mysql_fetch_array($checkNameResult);

if (mysql_num_rows($checkNameResult) > 0)
{
    $checkpassword = "SELECT password FROM users WHERE username = '$username'";
    $checkResult = mysql_query($checkpassword);
    $pass = mysql_fetch_array($checkResult);
    if ($pass['password'] == $password)
    {
        $_SESSION['username'] = $username;
        
    }
    
}
else
{
    echo 'Username does not exist!';
}



?>