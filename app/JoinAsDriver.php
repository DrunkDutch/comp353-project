<?php
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/config.php');
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');
if (session_status() == PHP_SESSION_NONE) { session_start(); }
$userID = $_SESSION['UserId'];
$rideID = $_POST['RideId'];
$DetailRide = GetRideDetails($rideID);
$Rate = 0.78;
$PriceRide = $Rate * $DetailRide['Distance'];
// CostJac is the price for one rider 100%
$CostJac = money_format('%.2n', $PriceRide);
$DriverBalance = GetBalance($userID)['Balance'];



// Get ALL Rider on Ride...
function GetRiders($rid){
        $status = Connected();
        if ($status == 1) {
            try {
                $d = new dbMakeConnection;

            } catch (PDOException $e) {
                echo($e);
            }

        $stmt = $d->conn->prepare("SELECT RiderId FROM ".$GLOBALS['db_name'].".Rider WHERE RideId = :e");
        $stmt->bindParam(':e', $rid);
        $stmt->execute();

        $result = $stmt->fetchAll();
	return $result;
        }
}
// Get Balance for someone...
function GetBalance($user){
        $status = Connected();
        if ($status == 1) {
            try {
                $d = new dbMakeConnection;

            } catch (PDOException $e) {
                echo($e);
            }

        $stmt = $d->conn->prepare("SELECT Balance FROM ".$GLOBALS['db_name'].".Member WHERE UserId = :e");
        $stmt->bindParam(':e', $user);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result;
        }
}
// Write transaction
function WriteTransaction($from, $to, $amount){
		$status = Connected();		
		if ($status == 1) {
		try {
			$d = new dbMakeConnection;
		
        	} 	
		catch (PDOException $e) {
            		echo($e);
        	}
		$stmt = $d->conn->prepare("INSERT INTO `".$GLOBALS['db_name']."`.`Transaction`(`PayerId`,`PayeeId`,`Amount`)VALUES(:fr, :to, :am)");
			$stmt->bindParam(':fr', $from);
			$stmt->bindParam(':to', $to);
			$stmt->bindParam(':am', $amount);
			$stmt->execute();
		}

}

// Get Detail On Ride
function GetRideDetails($Rid){
        $status = Connected();
        if ($status == 1) {
            try {
                $d = new dbMakeConnection;

            } catch (PDOException $e) {
                echo($e);
            }

            $stmt = $d->conn->prepare("SELECT * FROM ".$GLOBALS['db_name'].".Ride WHERE RideId = :id");
            $stmt->bindParam(':id', $Rid);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }
// Charge Monney
function ChargeM($user, $cost){
        $status = Connected();
        if ($status == 1) {
            try {
                $d = new dbMakeConnection;

            } catch (PDOException $e) {
                echo($e);
            }

            $stmt = $d->conn->prepare("UPDATE `comp353`.`Member` SET `Balance` = :c WHERE `UserId` = :u");
            $stmt->bindParam(':c', $cost);
	    $stmt->bindParam(':u',$user);
            $stmt->execute();
        }
}
// Join as Driver
function JoinAsDriv($user, $ride){
$status = Connected();
	echo($status);
	if ($status == 1) {
		try {
			$d = new dbMakeConnection;
		
        	} 	
		catch (PDOException $e) {
            		echo($e);
        	}
		$stmt = $d->conn->prepare("INSERT INTO `".$GLOBALS['db_name']."`.`Driver`(`RideId`,`DriverId`)VALUES(:r,:u)");
			$stmt->bindParam(':r', $ride);
			$stmt->bindParam(':u', $user);
			$stmt->execute();
	}
}


$ar = GetRiders($rideID);

// Join AS Driver
JoinAsDriv($userID, $rideID);

$FinalBalance = 0;

if((count($ar)) > 0){
	// No admin fee since they have already charge on the Rider login...
	$n = count($ar);
	$NewBalanceDriver = ($DriverBalance + (0.95 *$CostJac * $n));
	ChargeM($userID, $NewBalanceDriver);


	$DirectPay = money_format('%.2n', ($CostJac * $n * 0.95));
	WriteTransaction(2, $userID, $DirectPay);

	$FinalBalance = $DirectPay;		
}
else{
// There is no rider... the driver can't be paid...


}

	$urlAndAlert ="http://" . $_SERVER['SERVER_NAME'] . '/comp353-project/index.php?alert=You are the driver of ride number '.$rideID.' this ride will pay you:  ' .$FinalBalance.'$ ';
   header("Location:" .$urlAndAlert. " ");
   exit;

?>
