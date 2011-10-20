<?php
session_start();
include("db_connect.php");

$username = $_GET['username'];
$password1 = $_GET['password'];
$password2 = $_GET['password1'];
$first = $_GET['firstname'];
$last = $_GET['lastname'];
$city = $_GET['city'];
$state = $_GET['state'];
$age = $_GET['age'];

$checkUser = "SELECT username FROM users WHERE username = '$username'";
$checkUserResult = mysql_query($checkUser);
$check = mysql_fetch_array($checkUserResult);
$numcheck = mysql_num_rows($checkUserResult);

if ($numcheck > 0)
{
    echo 'Username is taken';
}
else
{

        $insertData = "INSERT INTO users (id, username, password, first_name, last_name,
        city, state, age) VALUES('', '$username', '$password1', '$first', '$last', '$city', '$state', '$age')";
        mysql_query($insertData);
}







?>