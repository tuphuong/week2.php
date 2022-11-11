<?php
// time
date_default_timezone_set('Asia/Ho_Chi_Minh');

// init db
require_once('helper/DbConfig.php');
$db = new Database();
$db->connect();

// authen
if (!array_key_exists("token", $_COOKIE)) {
    // check token in cookie
    header("Location: /login.php");
}
$authen_token = $_COOKIE["token"];

if (!array_key_exists("username", $_COOKIE)) {
    // check username in cookie
    header("Location: /login.php");    
}
$authen_username = $_COOKIE["username"];

// check username and token in db
$sql = "SELECT * FROM session WHERE username='$authen_username' AND token='$authen_token'";
$db->execute($sql);
if ($db->countRow() == 0){
    // token invalid => redirect to login page
    header("Location: /login.php");
}


?>