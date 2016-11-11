<?php 

// Variables Connection to the database 
$host = "localhost";
$user = "root";
$password = "root";
$db_name = "comp353";
mysqli_report(MYSQLI_REPORT_STRICT); 
$connection = new mysqli($host, $user, $password, $db_name);
function ConnectionCheck(){
	try{
		if($connection -> connect_error){
			die("C. failed: " . $connection -> connect_error);
			return false;		
		}
		else{
			return true;	
		}
	}
	catch(Exception $e){
		// Do something	with the Exception...
	}


}

?>
