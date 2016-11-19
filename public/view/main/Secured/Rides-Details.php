<!DOCTYPE html>
<html>
<head>
	<title> Rides - Details </title>
	<!-- This section is for the Head -->
	<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Head.php');?>
	   <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
	width:70%
      }
      #warnings-panel {
        width: 100%;
        height:10%;
        text-align: center;
      }
    </style>
	<!--AIzaSyCTrJWbLtv2VwyMhbgTUx0VCr_8r6I7VLo -->
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
		$GLOBALS['FullDepartAddress'] = ' '. $Destination['StreetNum'] . ' '. $Destination['Street'] . ', ' . $Destination['City'];
		$GLOBALS['FullDestinaAddress'] = ' '. $Departure['StreetNum'] . ' '. $Departure['Street'] . ', ' . $Departure['City'];

		$GLOBALS['DestinationLat'] = $Destination['Latitude'];
		$GLOBALS['DestinationLon'] = $Destination['Longitude'];
		$GLOBALS['DepartureLat'] = $Departure['Latitude'];
		$GLOBALS['DepartureLon'] = $Departure['Longitude'];

		$urlToDirectory = "http://" . $_SERVER['SERVER_NAME'] .   $_SERVER[''].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')) . '/Directory.php' ;
		if(empty($DriverDetails)){
			$GLOBALS['Driver'] = "No Driver";
			$urlToDriver = $urlToDirectory;
		}
		else{
		$GLOBALS['Driver'] = $DriverDetails[0]['UName'];
		$urlToDriver = "http://" . $_SERVER['SERVER_NAME'] .   $_SERVER[''].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')) . '/Account.php?id=' .$DriverID['DriverId'] ;
		}		

		$GLOBALS['ALLPassenger'];		
		foreach($PassengerID as&$val){
			$tmp = GetDetailsOfMember($val['RiderId']);
			$GLOBALS['ALLPassenger'] = $GLOBALS['ALLPassenger'] . ' ' . $tmp[0]['UName'] . ', ';
			
		}
		// Computer place remaining on rides
		$StatusRide;
		$numbPassenger = sizeof($PassengerID);
		if($Ride['RiderCapacity'] == $numbPassenger){
			$StatusRide = "This ride is Full";		
		}
		else {
			echo($numbPassenger);
			$a = $Ride['RiderCapacity'] - $numbPassenger;
			$StatusRide = "There is " . $a . " place(s) left";
		}

		echo '<div class="container">
		<h2> Ride Details </h2>
		<div class="row">Departure:<a href="#Maps">'.$GLOBALS['FullDepartAddress'].'</a></div>
		<div class="row">Destination:<a href="#Maps">'.$GLOBALS['FullDestinaAddress'].'</a></div>
		<div class="row">Date:&nbsp'.$Ride['Date'].'</div>
		<div class="row">Time:&nbsp'.$Ride['DepartTime'].'</div>
		<div class="row">Driver:&nbsp<a href="'.$urlToDriver.'">' .$GLOBALS['Driver'].'</a></div>
		<div class="row">Passengers:&nbsp<a href="'.$urlToDirectory.'">'.$GLOBALS['ALLPassenger'].'</a></div>
		<div class="row">Capacity:&nbsp'.$Ride['RiderCapacity'].'</div>
		<div class="row">Status:&nbsp'.$StatusRide.'</div>
		</div>';
	}
	CollectResult();

     ?>
<div class="row" style="display:none">
<input type="number" id="DetLat" value="<?php echo $GLOBALS['DestinationLat']?>">
<p id="DetLon"><?php echo $GLOBALS['DestinationLon']; ?></p>
<p id="DepLat"><?php echo $GLOBALS['DepartureLat']; ?></p>
<p id="DepLon"><?php echo $GLOBALS['DepartureLon']; ?></p>
</div>
<div class="container" id="ButtonPanel"></div>
<div class="container" id="Maps">
    <div id="floating-panel" style="display:none">
    <b>Mode of Travel: </b>
    <select id="mode">
      <option value="DRIVING">Driving</option>
      <option value="WALKING">Walking</option>
      <option value="BICYCLING">Bicycling</option>
      <option value="TRANSIT">Transit</option>
    </select>
    </div>
    <div id="map" style="Height:500px; Width:90%;"></div>
    <script>
	var destLon = document.getElementById("DetLon").value;
	var destLat = document.getElementById("DetLat").value;
	var depLon = document.getElementById("DepLon").value;
	var deptLat = document.getElementById("DepLat").value;
	
      function initMap() {
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: {lat: destLat, lng: x}
        });
        directionsDisplay.setMap(map);

        calculateAndDisplayRoute(directionsService, directionsDisplay);
        document.getElementById('mode').addEventListener('change', function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        });
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var selectedMode = document.getElementById('mode').value;
        directionsService.route({
          origin: {lat: 37.77, lng: -122.447},  // Haight.
          destination: {lat: 37.768, lng: -122.511},  // Ocean Beach.
          // Note that Javascript allows us to access the constant
          // using square brackets and a string value as its
          // "property."
          travelMode: google.maps.TravelMode[selectedMode]
        }, function(response, status) {
          if (status == 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
    </script>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTrJWbLtv2VwyMhbgTUx0VCr_8r6I7VLo&callback=initMap">
    </script>

</div>

	
    <!-- END OF CONTENT --> 
		
	<!-- This Section is for the footer -->
	<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Footer.php');?>
	
</body>
</html>

