<?php

//Authors: 26290515, 26795528, 27417888, 40039346

if (session_status() == PHP_SESSION_NONE) { session_start(); }
session_destroy();
$url = "http://" . $_SERVER['SERVER_NAME']. '/comp353-project/';
header("Location:".$url." ");
if (session_status() == PHP_SESSION_NONE) { session_start(); }
exit;

?>


