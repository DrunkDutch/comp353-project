<?php
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/config.php');
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');
session_start();
$userID = $_SESSION['UserId'];
$rideID = $_POST['RideId'];
//$CostOperation = 0;
$Rate = 0.78;
$DetailRide = GetRideDetails($rideID);
$CostPaul = $DetailRide['Distance'] * $Rate ;
$RideBalance = GetBalance($userID)['Balance'];
$costV = ($RideBalance - $CostPaul);
echo("START");
if($costV < 0){

	// Redirect to home page...
	$urlAndAlert ="http://" . $_SERVER['SERVER_NAME'] . '/comp353-project/index.php?alert=You do not have enough money to join this ride';
    header("Location:" . $urlAndAlert. " ");
    exit;
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
function GetDriver($rid){
        $status = Connected();
        if ($status == 1) {
            try {
                $d = new dbMakeConnection;

            } catch (PDOException $e) {
                echo($e);
            }

        $stmt = $d->conn->prepare("SELECT DriverId FROM ".$GLOBALS['db_name'].".Driver WHERE RideId = :e");
        $stmt->bindParam(':e', $rid);
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


if(true){
	$status = Connected();
	echo($status);
	if ($status == 1) {
		try {
			$d = new dbMakeConnection;
		
        	} 	
		catch (PDOException $e) {
            		echo($e);
        	}
		$stmt = $d->conn->prepare("INSERT INTO `".$GLOBALS['db_name']."`.`Rider`(`RideId`,`RiderId`)VALUES(:r,:u)");
			$stmt->bindParam(':r', $rideID);
			$stmt->bindParam(':u', $userID);
			$stmt->execute();


		ChargeM($userID, $costV);
		WriteTransaction($userID, $userID, 20.00);


// If there is a Driver...
			
		$DriverID = GetDriver($rideID)['DriverId'];
		if($DriverID > 0){
		// Give Monney to Driver and add a Transaction...
			$DriverBalance = GetBalance($DriverID)['Balance'];
			$NewBalanceDriver = ($DriverBalance + $CostPaul);
			ChargeM($DriverID, $NewBalanceDriver);
			WriteTransaction($userID, $DriverID, $CostPaul);
			
		}
		else{
			$MinusCost = $CostPaul * -1;
			WriteTransaction($userID, $userID, $MinusCost);
		}

		echo("DONE");
	    
//$url = "http://" . $_SERVER['SERVER_NAME'] . '/comp353-project/index.php';
    //header("Location:" .$url . " ");
	//exit;
			
		
	}
}

?>
