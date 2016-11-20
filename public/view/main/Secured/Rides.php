
<!DOCTYPE html>
<html>
<head>
	<title> Rides </title>
	<!-- This section is for the Head -->
	<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Head.php');?>

</head>
<body>
	<!-- Page Content -->
	<!-- This Section is for the Navigation file -->
	<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Header.php');?>
    <!-- INCLUDE CONTENT OF PAGE HERE -->
    <div id="page-content-wrapper">
	<div class="row">
		<h4>Where are you now?</h4>
		<div id="map" style="text-align:center;width:75%; Height:350px;float:none;margin:auto;"></div>
	<div class="row">
            <label for="useAnotherLoc">Use another location</label>
            <input style="" id="Reverse" type="checkbox" name="useAnotherLoc">
	<input id="SpanItem" style="width:50%; display:none; text-align:center; margin:Auto;" type="text" name="location" placeholder="23 Domenic Street, Millville, MA, USA" class="form-control">
		<div class="row" style="margin-top:20px;">
		<button id="TakeLocation" class="btn btn-success" onclick="WriteLocation()">Use location</button>
		</div>
	</div>
  
	</div>	
	<div class="row" style="border-style:solid; height:200px;margin-top:20px;">
		<h4>Search</h4>
		<label for="LatLocation">Your location:&nbsp</label>
		<input style="width:100px; color:blue;" type="text" name="LatLocation" id="LatLocation" readonly>
		<input style="width:100px; color:blue;"  type="text" name="LonLocation" id="LonLocation" readonly>
	
	</div>
    <h1>Current Rides</h1>
            <div class="container" style="border-style:solid; border-width:3px; height:90%; overflow-y:scroll;" id="rides">  
<?php 
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

		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$AllAddress = ' '. $result['StreetNum'] . ' '. $result['Street'] .' '. $result['City'];
		return $AllAddress;
		
		
	}


}
function GetDataForRide(){
	include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');
	
	$status = Connected();
		if($status == 1){
		try{
			$d = new dbMakeConnection;
		}
		
		catch(PDOException $e){ echo($e);}

		$stmt = $d->conn->prepare("SELECT * FROM comp353.Ride");
        	$stmt->execute();
		$result = $stmt->fetchAll();
		

		
		
		foreach($result as&$val){
		$Rid = $val["RideId"];
		$Did = $val["DestinationId"];
		$AllAdd = GetDetailAddress($Did);
		$r = $val["Date"];
		$t = $val["DepartTime"];
		// Build URL For each Button...

		$url = "http://" . $_SERVER['SERVER_NAME'] .   $_SERVER[''].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')) . '/Rides-Details.php?id=' .$Rid ;

		// Create HTML...
		echo '<div class="row" style="height:150px;border-style:solid; border-width:3px;"><p style="margin-top:20px;">Destination:' .$AllAdd. '&nbsp</p><p>Departure time:&nbsp'.$r.'&nbspat:&nbsp'.$t. '&nbsp</p><a href="'.$url.'"><button class="btn btn-success">Get Details</button></a></div>';
		}

		
	}

}
GetDataForRide();

?>
  <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var SuperLat;
      var SuperLon;
      function initMap() {
		var filterFloat = function (value) {
    		if(/^(\-|\+)?([0-9]+(\.[0-9]+)?|Infinity)$/
      		.test(value))
      		return Number(value);
  		return NaN;
	}
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 14
        });
        var infoWindow = new google.maps.InfoWindow({map: map});

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
	      
            };
	    	
	    SuperLat = filterFloat(pos.lat);
	    SuperLon = filterFloat(pos.lng);
	    
            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
      }

      function WriteLocation(){
	var x = document.getElementById('Reverse').checked;
	if(x){
		InputVal = document.getElementById('SpanItem').value;
		
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({
		    "address": InputVal
		}, function(results) {
		    FillCase(results[0].geometry.location.lat(),results[0].geometry.location.lng());
		  
		});
		
	}
	else{
	 FillCase(SuperLat, SuperLon);
	}
      }

	function FillCase(Lat, Lon){
	document.getElementById('LatLocation').value = String(Lat);
	document.getElementById('LonLocation').value = String(Lon);
	
	}
      
    </script>
	<script>
	 $(document).ready(function(){

	   	$("#Reverse").click(function(){
		if($(this).is(':checked')){
			$("#map").hide("slow");
			$("#SpanItem").slideToggle("slow");
				
		} 
		else{
			$("#map").slideToggle("slow");
			$("#SpanItem").hide("slow");
		}   	
		});

		
	}); 

	</script>
 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAR2TULEBxvkVavNgSpCk6xXhwKnJT1Uio&callback=initMap">
    </script>

    </div>
    <!-- END OF CONTENT -->
	<div><?php echo $this_page; ?></div>
	<!-- This Section is for the footer -->
	<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Footer.php');?>
</body>
</html>

