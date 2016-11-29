<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }
session_destroy();
$url = "http://" . $_SERVER['SERVER_NAME']. '/comp353-project/';
header("Location:".$url." ");
if (session_status() == PHP_SESSION_NONE) { session_start(); }
exit;

?>


