<!DOCTYPE html>
<html>
<head>
	<title> Rides - Details </title>
	<!-- This section is for the Head -->
	<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Head.php');?>
</head>
<body>
	<!-- Page Content -->
	<!-- This Section is for the Navigation file -->
	<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Header.php');?>
    <!-- INCLUDE CONTENT OF PAGE HERE -->
    <div id="page-content-wrapper">
    <?php 
	include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');
	
	// Get Location ID
	function GetDetailAddress($id){
		$status = Connected();
		if($status == 1){
		try{
		$d = new dbMakeConnection;

		}
		
		catch(PDOException $e){ echo($e);}

		$stmt = $d->conn->prepare("SELECT * FROM comp353.Location WHERE LocationId = :id");
        	$stmt->bindParam(':id', $id);
        	$stmt->execute();

		$resultLoca = $stmt->fetch(PDO::FETCH_ASSOC);
		return $resultLoca;
		
		
	}


	}
	// Get Detail On Ride
	function GetRideDetails($Rid){
		$status = Connected();
		if($status == 1){
		try{
		$d = new dbMakeConnection;

		}
		
		catch(PDOException $e){ echo($e);}

		$stmt = $d->conn->prepare("SELECT * FROM comp353.Ride WHERE RideId = :id");
        	$stmt->bindParam(':id', $Rid);
        	$stmt->execute();
		
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
				
		}
	}
	// Get Details About Driver (Embedded to link profile)
	function GetDriverID($Rid){
		$status = Connected();
		if($status == 1){
		try{
		$d = new dbMakeConnection;

		}
		
		catch(PDOException $e){ echo($e);}

		$stmt = $d->conn->prepare("SELECT DriverId FROM comp353.Driver WHERE RideId = :id");
        	$stmt->bindParam(':id', $Rid);
        	$stmt->execute();
		
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
				
		}
	}
	// Get Details Passenger and Space remaining (Embedded to link profile)
	function GetPassengerIDs($Rid){
		$status = Connected();
		if($status == 1){
		try{
		$d = new dbMakeConnection;

		}
		
		catch(PDOException $e){ echo($e);}

		$stmt = $d->conn->prepare("SELECT RiderId FROM comp353.Rider WHERE RideId = :id");
        	$stmt->bindParam(':id', $Rid);
        	$stmt->execute();
		
		$result = $stmt->fetchAll();
		return $result;
				
		}
	}
	
	function GetDetailsOfMember($id){
		$status = Connected();
		if($status == 1){
		try{
		$d = new dbMakeConnection;

		}
		
		catch(PDOException $e){ echo($e);}

		$stmt = $d->conn->prepare("SELECT UName FROM comp353.Member WHERE UserId = :id");
        	$stmt->bindParam(':id', $id);
        	$stmt->execute();
		
		$result = $stmt->fetchAll();
		return $result;
				
		}
	}

	function CollectResult(){
		
		
		$Ride = GetRideDetails($_GET["id"]);
		$Destination = GetDetailAddress($Ride['DestinationId']);
		$Departure = GetDetailAddress($Ride['DepartureId']);
		$DriverID = GetDriverID($Ride['RideId']);
		$PassengerID = GetPassengerIDs($Ride['RideId']);
		$DriverDetails = GetDetailsOfMember($DriverID['DriverId']);

		print_r($Ride);
		echo("<p>DESTINATION</p>");
		print_r($Destination);
		echo("<p>DEPARTURE</p>");	
		print_r($Departure);
		echo("<p>DRIVERID</p>");
		print_r($DriverID);
		echo($DriverID['DriverId']);	
		echo("<p>Passenger</p>");
		print_r($PassengerID);		
		echo("<p>Driver Details</p>");
		print_r($DriverDetails);
		echo("<p> Details Passenger</p>");
		foreach($PassengerID as&$val){
		$tmp = GetDetailsOfMember($val['RiderId']);
		print_r($tmp);		
		}
		
	}
	CollectResult();
     ?>
	


    </div>
    <!-- END OF CONTENT --> 
		
	<!-- This Section is for the footer -->
	<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Footer.php');?>
	
</body>
</html>

