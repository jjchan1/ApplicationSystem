<?php
require_once("support.php");

    $user = "magHmcKCVsoXw";
    $pass = "teR1BD6nOCbHE";

    $username = $_SERVER['PHP_AUTH_USER'];
    $password = $_SERVER['PHP_AUTH_PW'];

    #if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']) &&
    #    crypt($username, $username) == $user && crypt($password,$password) == $pass){
        header("Location:applications.php");
    #} else {
    #    header("WWW-Authenticate: Basic realm=\"Example System\"");
    #    header("HTTP/1.0 401 Unauthorized");
    #    exit;
    #}
?>