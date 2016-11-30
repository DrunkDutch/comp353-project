<?php
//Authors: 26290515, 26795528, 27417888, 40039346

$enable_root = true;
if($enable_root){


	$url = "http://" . $_SERVER['SERVER_NAME']. '/comp353-project/';
	$urlAndIndex = $url . "index.php";
	
	$ref = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	$a = strcmp($urlAndIndex, $ref) == 0;
	$b = strpos($ref, 'public');
	$f = strpos($ref, 'Secured');
	if(!($a or $b)){
	header("Location:".$url."");
	exit;	
	}
	// Block user from getting on page without log in...
	if($f and !$_SESSION['Authen'])	{
	header("Location:".$url."");
	exit;
	}
}
?>
