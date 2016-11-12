<?php
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/config.php');
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');

$username = $_POST['user'];
$email = $_POST['email'];
$password = $_POST['password'];
echo("OK1");


if( !((empty($email)) and (empty($username)))){
   
   if(!(empty($email))){AuthentificationEmail($email, $password);}
 
   else{
   if(!(empty($username))){AuthentificationUser($username, $password); }
   }
}



echo("OK2");
// Check Login with DB assuming variable passed in are cleaned and not all empty

function AuthentificationUser($u, $p){
	$status = Connected();
	if($status == 1){
		try{
			$d = new dbMakeConnection;
		}
		
		catch(PDOException $e){ echo($e);}

		$stmt = $d->conn->prepare("SELECT * FROM comp353.Member WHERE UName = :u");
        	$stmt->bindParam(':u', $u);
        	$stmt->execute();
		echo("OKuser");
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$passwordFromDB = $result['Password'];
		
		if( strcmp($result['Password'], $p) == 0){
		 $email = $result['Email'];
		 LaunchSession($u, $email, $p);	
		}
		
	}

}
function AuthentificationEmail($em, $p){
	$status = Connected();
	if($status == 1){
		try{
			$d = new dbMakeConnection;


	
		}
		
		catch(PDOException $e){ echo($e);}

		$stmt = $d->conn->prepare("SELECT * FROM comp353.Member WHERE Email = :e");
        	$stmt->bindParam(':e', $em);
        	$stmt->execute();
		echo("OKemail");
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		
		if( strcmp($result['Password'], $p) == 0){
			$user = $result['UName'];
			LaunchSession($user, $em, $p);	
		}
		
	}

}

function LaunchSession($u, $e, $p){
session_start();
$_SESSION['username'] = $u;
$_SESSION['email'] = $e;
$_SESSION['p'] = $p;

header("Location: http://localhost/comp353-project/");
}
?>
