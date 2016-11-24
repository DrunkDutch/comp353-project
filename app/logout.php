<?php
session_start();
session_destroy();
$url = "http://" . $_SERVER['SERVER_NAME']. '/comp353-project/';
header("Location:".$url." ");
exit;

?>


