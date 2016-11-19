<?php
$enable_root = true;
if($enable_root){
	$ref = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	$a = strcmp("http://localhost/comp353-project/index.php", $ref) == 0;
	$b = strpos($ref, 'public');
	$f = strpos($ref, 'Secured');
	if(!($a or $b)){
	header("Location: http://localhost/comp353-project/");
	exit;	
	}
	// Block user from getting on page without log in...
	if($f and !$_SESSION['Authen'])	{
	header("Location: http://localhost/comp353-project/");
	exit;
	}
}
?>
