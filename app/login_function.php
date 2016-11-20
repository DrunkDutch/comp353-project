<?php
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/config.php');
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');
session_start();
$_SESSION['Authen']= false;
$username = $_POST['user'];
$email = $_POST['email'];
$password = $_POST['password'];



if( !((empty($email)) and (empty($username)))){
   
   if(!(empty($email))){AuthentificationEmail($email, $password);}
 
   else{
   if(!(empty($username))){AuthentificationUser($username, $password); }
   }
}




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

		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$passwordFromDB = $result['Password'];
		
		if( strcmp($result['Password'], $p) == 0){
		 $email = $result['Email'];
		 LaunchSession($u, $email, $p);	
		}
		else{
		$_SESSION['Authen']= false;
		header("Location: http://192.168.2.85/comp353-project/public/view/main/LOG_IN.php");
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

		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		
		if( strcmp($result['Password'], $p) == 0){
			$user = $result['UName'];
			LaunchSession($user, $em, $p);	
		}
		else{
		$_SESSION['Authen'] = false;
		header("Location: http://192.168.2.85/comp353-project/public/view/main/LOG_IN.php");
		
		}
		
	}

}

function LaunchSession($u, $e, $p){

$_SESSION['username'] = $u;
$_SESSION['email'] = $e;
$_SESSION['p'] = $p;
$_SESSION['Authen'] = true;
header("Location: http://192.168.2.85/comp353-project/");
}
?>
