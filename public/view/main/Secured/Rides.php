
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
		<button id="TakeLocation" style="Float:none;" class="btn btn-success col-xs-3 centered" onclick="WriteLocation()">Use location</button>
		</div>
	</div>
  
	</div>	
	<div class="container" style="border-style:solid;margin-top:20px;">
		<h4>Search</h4>
<div class="row" style="margin-top:20px; margin-bottom:20px;">
		<h4 class="col-xs-6" for="LatLocation">Your location:&nbsp</h4>
		<div class=col-xs-4"><input style="width:100px; color:blue;" type="text" name="LatLocation" id="LatLocation" readonly>
		<input style="width:100px; color:blue;"  type="text" name="LonLocation" id="LonLocation" readonly></div>
</div>

<div class="row" style="margin-top:20px; margin-bottom:20px;">
<h4 class="col-xs-6">Use a radius to find your ride?</h4>
<select style="width:20% !important; margin-right:10px" class="form-control col-xs-3" id="selectRadius">
<option value="1">1 KM</option>
<option value="5">5 KM</option>
<option value="10">10 KM</option>
</select>
<button type="button" class="btn btn-info col-xs-3" data-toggle="collapse" data-target="#rides" onclick="LaunchRadius()">Search with Radius</button>

</div>
<div class="row" style="margin-top:20px; margin-bottom:20px;">
<h4 class="col-xs-6">Use City to find your ride?</h4>

</div>
<div class="row" style="margin-top:20px; margin-left:10%; margin-bottom:20px;">
<select style="width:36.666666% !important; margin-right:10px" class="form-control col-xs-5" id="selectDepart">
<?php

function GetAllCity(){

include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');

	$status = Connected();

	if($status == 1){
		try{
			$d = new dbMakeConnection;
	
		}
		
		catch(PDOException $e){ echo($e);}

		$stmt = $d->conn->prepare("SELECT DISTINCT City FROM comp353.Location");
        	$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
		
		
	}


}

$re = GetAllCity(); 
foreach($re as&$val){
echo '<option>'.$val['City'].'</option>';
}
?>

</select>
<p class=col-xs-2>to</p>
<select style="width:36.666666% !important; margin-right:10px" class="form-control col-xs-5" id="selectDestination">
<?php

function GetAllCity2(){

//include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');

	$status = Connected();

	if($status == 1){
		try{
			$d = new dbMakeConnection;
	
		}
		
		catch(PDOException $e){ echo($e);}

		$stmt = $d->conn->prepare("SELECT DISTINCT City FROM comp353.Location");
        	$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
		
		
	}


}

$ree = GetAllCity2(); 
foreach($ree as&$val){
echo '<option>'.$val['City'].'</option>';
}
?>
</select>
</div>
<div class="row" style="margin-top:20px; margin-bottom:40px;"><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#rides">Search with City</button></div>

	<div class="row" style="margin-top:20px; margin-bottom:20px;"><h4 class="col-xs-6">Do not want to search? </h4><button" type="button" class="btn btn-info col-xs-3" data-toggle="collapse" data-target="#rides">Show All Rides</button>
	</div>
    	</div>

<div class="container collapse" id="RadiusMap" style="text-align:center; margin-top:50px; margin-bottom:50px;">
<div id="mapRadius" style="height:400px; width:90%; float:none; margin:auto;"></div>
</div>

            <div class="container collapse"  style="border-style:solid; border-width:3px; height:90%; overflow-y:scroll; margin-top:100px;" id="rides"> 
<h1>All Rides</h1> 

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
function GetDetailCoor($id){
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
		return $result;
		
		
	}


}

function GetDataForRide(){
	//include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');
	
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
		$DetailCoor = GetDetailCoor($Did);
		$r = $val["Date"];
		$t = $val["DepartTime"];
		// Build URL For each Button...

		$url = "http://" . $_SERVER['SERVER_NAME'] .   $_SERVER[''].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')) . '/Rides-Details.php?id=' .$Rid ;

		// Create HTML...
		echo '<div class="row" style="height:150px;border-style:solid; border-width:3px;"><p style="margin-top:20px;">Destination:' .$AllAdd. '&nbsp</p><p>Departure time:&nbsp'.$r.'&nbspat:&nbsp'.$t. '&nbsp</p><a href="'.$url.'"><button class="btn btn-success">Get Details</button></a><Input type="text" class="Latis" style="display:none;" value="'.$DetailCoor['Latitude'].'"><Input type="text" class="Longis" style="display:none;" value="'.$DetailCoor['Longitude'].'"><Input type="text" style="display:none;"  class="elementC" value="'.$Rid.'"></div>';
		}

		
	}

}
GetDataForRide();


?>


</div>

  <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var SuperLat;
      var SuperLon;
      function LaunchRadius(){
	if(!(document.getElementById('LonLocation').value =="") && !(document.getElementById('LatLocation').value == "")){
		
		
		$(document).ready(function(){
		$("#RadiusMap").collapse('show');		
		});

		initMap();	
	}
	else{
		alert("Please give your location...");
	}
      }
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
	var map2 = new google.maps.Map(document.getElementById('mapRadius'), {
          center: {lat: filterFloat(document.getElementById('LatLocation').value), lng: filterFloat(document.getElementById('LonLocation').value)},
          zoom: 13
        });
	// Let's try to get all Coord. of all Ride into array

	var elements = document.getElementsByClassName("elementC");
	var lats = document.getElementsByClassName("Latis");
	var lons = document.getElementsByClassName("Longis");
	var ids = {};
	for(var i=0; i< elements.length; i++){
		ids[i] ={
			'id': filterFloat(elements[i].value),
			'lat': filterFloat(lats[i].value),
			'lon': filterFloat(lons[i].value),
			'url': 	document.URL.substr(0,document.URL.lastIndexOf('/'))+"/Rides-Details.php?id=" + (i+1)
		};	
		
	}
	
	console.log(ids[0].url);
	for(var i=0; i< elements.length; i++){
		var myLatlng = new google.maps.LatLng(ids[i].lat,ids[i].lon)
		var marker = new google.maps.Marker({
    		position: myLatlng,
    		title:"Ride Starting",
		url:ids[i].url,
		});
		marker.setMap(map2);
		
	}
	google.maps.event.addListener(marker, 'click', function() {
    		window.location.href = this.url;
	});
	
		var myCenter = new google.maps.LatLng(filterFloat(document.getElementById('LatLocation').value),filterFloat(document.getElementById('LonLocation').value))
		var marker = new google.maps.Marker({
    		position: myCenter,
    		title:"You are Here!",
		animation: google.maps.Animation.BOUNCE,
		});
		marker.setMap(map2); 
		
		var CircleRadius = new google.maps.Circle({
		strokeColor: '#FF0000',
            	strokeOpacity: 0.8,
            	strokeWeight: 2,
            	fillColor: '#FF0000',
            	fillOpacity: 0.35,
		map: map2,
		center: myCenter,
		radius: 1000*filterFloat(document.getElementById('selectRadius').value),
		});
		//CircleRadius.bindTo('center', myCenter, 'position');
	

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

