<?php
//Authors: 26290515, 26795528, 27417888, 40039346

include_once($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/config.php');
include_once($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');
if (session_status() == PHP_SESSION_NONE) { session_start(); }
$userID = $_SESSION['UserId'];
$rideID = $_POST['RideId'];

// Remove form Rides
function QuitRide($user, $ride){
	$status = Connected();
		if ($status == 1) {
		    try {
		        $d = new dbMakeConnection;

		    } catch (PDOException $e) {
		        echo($e);
		    }

		    $stmt = $d->conn->prepare("DELETE FROM `".$GLOBALS['db_name']."`.`Rider` WHERE RideId= :r AND RiderId = :u");
		    $stmt->bindParam(':r', $ride);
		    $stmt->bindParam(':u',$user);
		    $stmt->execute();
		}
	
}
QuitRide($userID, $rideID);

	$urlAndAlert ="http://" . $_SERVER['SERVER_NAME'] . '/comp353-project/index.php?alert=You will not be refund for ride number '.$rideID.' and if you are joining again we will charge you again ';
   header("Location: https://tpc353_2.encs.concordia.ca/comp353-project/index.php?alert=You will not be refund for ride number ".$rideID." and if you are joining again we will charge you again");


?>
