<?php
//Authors: 26290515, 26795528, 27417888, 40039346
echo("OK");
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/config.php');
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');
if (session_status() == PHP_SESSION_NONE) { session_start(); }
$userID = $_SESSION['UserId'];
$rideID = $_POST['RideIdJ'];
$comment = $_POST['comment'];

echo($userID);
echo($rideID);
echo($comment);

$a = strlen($userID);
$b = strlen($rideID);
$c = strlen($comment);


if( ($a != 0) and ($b != 0) and ($c != 0)){

WriteComment($userID, $rideID, $comment);


$urlAndAlert = "http://" . $_SERVER['SERVER_NAME'] . '/comp353-project/index.php?alert=Your comment was added to ride:  ' . $rideID . ' ';
header("Location:" . $urlAndAlert . " ");
exit;

}


// Write Comment
function WriteComment($u, $r, $c){
		$status = Connected();	

		if ($status == 1) {
		try {
			$d = new dbMakeConnection;
		
        	} 	
		catch (PDOException $e) {
            		echo($e);
        	}
		$stmt = $d->conn->prepare("INSERT INTO `".$GLOBALS['db_name']."`.`Comment`(`RideId`,`PosterId`,`Comment`)VALUES(:r, :u, :c)");
			$stmt->bindParam(':u', $u);
			$stmt->bindParam(':r', $r);
			$stmt->bindParam(':c', $c);
			$stmt->execute();
			
		}

}







?>
