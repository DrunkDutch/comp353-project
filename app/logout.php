<?php
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/config.php');
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');
session_start();
$_SESSION['Authen']= false;

$url = "http://" . $_SERVER['SERVER_NAME']. '/comp353-project/';
header("Location:".$url." ");