<?php 

// Variables Connection to the database 
$host = "tpc353_2.encs.concordia.ca";
$username = "tpc353_2";
$password = "h3Y4JY";
$db_name = "tpc353_2";
$GLOBALS['db_name'] = "tpc353_2";
mysqli_report(MYSQLI_REPORT_STRICT); 
$connection = new mysqli($host, $username, $password, $db_name);
function ConnectionCheck(){
	try{
		if($connection -> connect_error){
			die("C. failed: " . $connection -> connect_error);
			return false;		
		}
		else{
			$GLOBALS['host2'] = $host;
			return true;	
		}
	}
	catch(Exception $e){
		// Do something	with the Exception...
	}


}

class Makeconnection {
	public $conn;
	public function __construct(){
		require 'dbconfig.php';
		$this-> host = $host;
		$this-> username = $username;
		$this-> password = $password;
		$this-> db_name = $db_name;
		
		$this -> conn = new PDO('mysql:host=' .$host. ';dbname=' .$db_name.';charset=utf8', $username, $password);

		$this -> conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERMODE_EXCEPTION);	
		
	}
}
	



?>
