<?php
$enable_root = false;
if($enable_root){
	$ref = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	$a = strcmp("http://localhost/comp353-project/index.php", $ref) == 0;
	$b = strpos($ref, 'public');
	if(!($a or $b)){
	header("Location: http://localhost/comp353-project/");
	exit;	
	}	
}
?>
