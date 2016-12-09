<!DOCTYPE html>
<!--Authors: 26290515, 26795528, 27417888, 40039346-->
<html>
<head>
<?php if (session_status() == PHP_SESSION_NONE) { session_start();} ?>
    <title> New Ride </title>
    <!-- This section is for the Head -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Head.php'); ?>
</head>
<body>
<!-- Page Content -->
<!-- This Section is for the Navigation file -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Header.php'); ?>
<!-- INCLUDE CONTENT OF PAGE HERE -->
<div id="page-content-wrapper">
<form class="form-group" method="POST" action="/comp353-project/app/createRide.php">
<h2 style="margin-bottom:25px;margin-top:25px;"> Create your ride </h2>
<div class="container" style="border-style:solid;">
  <ul class="nav nav-tabs" style="border-style:none; display:none;">
    <li class="active"><a href="#home">Destination</a></li>
    <li><a href="#menu1">Departure</a></li>
    <li><a href="#menu2">Date</a></li>
    <li><a href="#menu3">Driver/Rider</a></li>
    <li><a href="#menu4">Post</a></li>
  </ul>

  <div class="tab-content" style="margin-bottom:30px;">
    <div id="home" class="tab-pane fade in active">
      <h3 style="margin-bottom:30px;">Departure</h3>
<div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="Depart_streetNumber">Street Number: </label>
<Input id="Depart_streetNumber" style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="Depart_streetNumber" type="text" value="">
</div>
<div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="Depart_street">Street Name: </label>
<Input id="Depart_street" style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="Depart_street" type="text" value="">
</div>

<div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="Depart_City">City: </label>
<Input id="Depart_City" style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="Depart_City" type="text" value="">
</div>
<div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="Depart_Prov">Province: </label>
<Input id="Depart_Prov" style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="Depart_Prov" type="text" value="">
</div>
<div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="Depart_Country">Country: </label>
<Input id="Depart_Country" style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="Depart_Country" type="text" value="">
</div>
<div class="row form-group" style="margin-bottom:25px;">
<div class="" style="margin:Auto; float:none; width:90%; background-color: darkorange; padding:20px; margin-bottom:30px;"><h5 style="font-weight: bold;">Please note that the Postal code is required but would not be used by our server. Please enter the right address</h5></div>
<label class="form-check-label" for="Depart_ZIP">Postal Code: </label>
<Input id="Depart_ZIP" style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="Depart_ZIP" type="text" value="">
</div>
	<a href="#menu1" data-toggle="tab"><button onclick="BuildAddressDep()" class="btn btn-primary">Next Step</button></a>
	
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Destination</h3>
      <div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="Des_streetNumber">Street Number: </label>
<Input id="Des_streetNumber" style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="Des_streetNumber" type="text" value="">
</div>
<div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="Des_street">Street Name: </label>
<Input id="Des_street" style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="Des_street" type="text" value="">
</div>

<div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="Des_City">City: </label>
<Input id="Des_City" style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="Des_City" type="text" value="">
</div>
<div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="Des_Prov">Province: </label>
<Input id="Des_Prov" style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="Des_Prov" type="text" value="">
</div>
<div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="Des_Country">Country: </label>
<Input id="Des_Country" style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="Des_Country" type="text" value="">
</div>
<div class="row form-group" style="margin-bottom:25px;">
<div class="" style="margin:Auto; float:none; width:90%; background-color: darkorange; padding:20px; margin-bottom:30px;"><h5 style="font-weight: bold;">Please note that the Postal code is required but would not be used by our server. Please enter the right address</h5></div>
<label class="form-check-label" for="Des_ZIP">Postal Code: </label>
<Input id="Des_ZIP" style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="Des_ZIP" type="text" value="">
</div>
	<a href="#home" data-toggle="tab"><button class="btn btn-danger">Previous Step</button></a>
	<a href="#menu2" data-toggle="tab"><button onclick="BuildAddressDes()" class="btn btn-primary">Next Step</button></a>
    </div>
    <div id="menu2" class="tab-pane fade">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <h3>Choose the right time</h3>
<div style="margin:Auto; float:none; width:90%; background-color: darkorange; padding:20px; margin-bottom:30px;" ><h5>Super is not responsible for any ride planned at the same time... You have to make sure you are not on another ride...</h5></div>
<div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="RDate">Date:</label>
<Input style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="RDate" id="datepicker" type="text" value="">
</div>
<div class="row form-group" style="margin-bottom:25px;">
<label  class="form-check-label" for="RTime">Time:</label>
<Input placeholder="09:32:02 or 23:59:59" id="TimeValue" style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="RTime"  type="text" value="">
</div>


<h3 for="RRepeating">Repeating each:</h3>
<div class="row">
<label class="form-check-label" for="Rmon">Monday</label>
<Input style="margin:Auto; float:none;" class="form-check-input text-muted" id="RMon" name="RMon"  type="checkbox" value="Mon">

<div class="row">
<label class="form-check-label" for="RTue">Tuesday</label>
<Input style="margin:Auto; float:none;" class="form-check-input text-muted" id="RTue" name="RTue"  type="checkbox" value="Tue">
</div>

<div class="row">
<label class="form-check-label" for="RWes">Wednesday</label>
<Input style="margin:Auto; float:none;" class="form-check-input text-muted" id="RWes" name="RWes"  type="checkbox" value="Wes">
</div>

<div class="row">
<label class="form-check-label" for="RThur">Thursday</label>
<Input style="margin:Auto; float:none;" class="form-check-input text-muted" id="RThur" name="RThur"  type="checkbox" value="Thur">
</div>

<div class="row">
<label class="form-check-label" for="RFri">Friday</label>
<Input style="margin:Auto; float:none;" class="form-check-input text-muted" id="RFri" name="RFri"  type="checkbox" value="Fri">
</div>

<div class="row">
<label class="form-check-label" for="RSat">Saterday</label>
<Input style="margin:Auto; float:none;" class="form-check-input text-muted" id="RSat" name="RSat"  type="checkbox" value="Sat">
</div>

<div class="row" style="margin-bottom:25px;">
<label class="form-check-label" for="RSun">Sunday</label>
<Input style="margin:Auto; float:none;" class="form-check-input text-muted" id="RSun" name="RSun"  type="checkbox" value="Sun">
</div>

</div>
	<a href="#menu1" data-toggle="tab"><button class="btn btn-danger">Previous Step</button></a>
	<a href="#menu3" data-toggle="tab"><button onclick="ResetValid()" class="btn btn-primary">Next Step</button></a>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Driver or Rider ?</h3>
<div class="form-check">
<div class="row" style="margin-bottom:25px;">
<label class="form-check-label" style="Padding:15px; font-size:22px;">Driver</label>
<Input id="driverFoo" style="margin:Auto; float:none;" class="form-check-input text-muted" name="optionRadio"  type="radio" value="driver">
</div>
<div class="row" style="margin-bottom:25px;">
<label class="form-check-label" style="Padding:15px; font-size:22px;">Rider</label>
<Input id="riderFoo" style="margin:Auto; float:none;" class="form-check-input text-muted" name="optionRadio"  type="radio" value="rider">
</div>
</div>
<div class="row" style="margin-bottom:25px;">
<label class="form-check-label" style="Padding:15px; font-size:22px;">Capacity of the ride</label>
<Input id="Capacity" style="margin:Auto; float:none;" class=" text-muted" name="Capacity"  type="number" value="1">
</div>
	<a href="#menu2" data-toggle="tab"><button class="btn btn-danger">Previous Step</button></a>

	<a id="GoAway" href="#Roger" data-toggle="tab"><button onclick="ValidateData()" class="btn btn-warning">Validate Data</button></a>

	<a href="#menu4" id="ValidIt" class="collapse" data-toggle="tab"><button class="btn btn-primary">Next Step</button></a>
    </div>


    <div id="menu4" class="tab-pane fade">
      <h3>Post</h3>
      <p>Ride Posting...</p>
	<a href="#menu3" data-toggle="tab"><button class="btn btn-danger">Previous Step</button></a>
	<Input id="SurprisingButton"  type="submit" class="btn btn-success" value="Post">
    </div>
  </div>
<Input id="DestinaLon" style="display:none;" type="text" name="DestinationLon" value="">
<Input id="DestinaLat" style="display:none;" type="text" name="DestinationLat" value="">
<Input id="DepartLon" style="display:none;" type="text" name="DepartLon" value="">
<Input id="DepartLat" style="display:none;" type="text" name="DepartLat" value="">
<Input id="AllDay" style="display:none;" type="text" name="AllDay" value="">
<Input id="DorR" style="display:none;" type="text" name="DorR" value="">
<Input id="DistanceAB" style="display:none;" type="text" name="DistanceAB" value="">
</div>
</form>
  <script>
 $(function(){
        $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
            var minValue = $(this).val();
            minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
            minValue.setDate(minValue.getDate()+1);
            $("#to").datepicker( "option", "minDate", minValue );
        })
    });

  </script>
<script>
var addrDes;
var addrDep;
var CaddrDep;
var CaddrDes;
var GpsDes;
var GpsDep;
var DayRepeating;
var AllDataOK;


 var filterFloat = function (value) {
       if (/^(\-|\+)?([0-9]+(\.[0-9]+)?|Infinity)$/
       .test(value))
          return Number(value);
       return NaN;
 }


      function geocodeAddress(addre) {
	var geocoder = new google.maps.Geocoder();        
	var address = addre;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {	
            //resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              //map: resultsMap,
              position: results[0].geometry.location
            });
		 var latx = marker.position.lat();
		 var lonx = marker.position.lng();		
		
          }
        });
      }



$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
});

function BuildAddressDes(){
	addrDes ="";
	$(document).ready(function () {
	addrDes = {
	'streetNum' : $("#Des_streetNumber").val(),
	'street' : $("#Des_street").val(),
	'city' : $("#Des_City").val(),
	'prov' : $("#Des_Prov").val(),
	'zip': ($("#Des_ZIP").val()).replace(/\s+/g, ''), 
	'country': $("#Des_Country").val(), }; 
	});


CaddrDes = addrDes.streetNum + ", " + addrDes.street + ",  " + addrDes.city + ", " + addrDes.prov + ", " + addrDes.country;


// Now find GSP data for it...
      function geocodeAddress3(addre) {
	var geocoder = new google.maps.Geocoder();        
	var address = addre;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {	
            //resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              //map: resultsMap,
              position: results[0].geometry.location
            });
		 var laty = marker.position.lat();
		 var lony = marker.position.lng();

		GpsDes = {
		'lat': laty,
		'lon': lony,
		};
          }
	else{
	alert("We were not able to find the location of your Destination, Please step back one step and change data ");	
	}
        });
      }
geocodeAddress3(CaddrDes);
}

function BuildAddressDep(){
	addrDep = "";
	$(document).ready(function () {
	addrDep = {
	'streetNum' : $("#Depart_streetNumber").val(),
	'street' : $("#Depart_street").val(),
	'city' : $("#Depart_City").val(),
	'prov' : $("#Depart_Prov").val(),
	'zip': ($("#Depart_ZIP").val()).replace(/\s+/g, ''), 
	'country': $("#Depart_Country").val(), }; 
	});


CaddrDep = addrDep.streetNum + ", " + addrDep.street + ",  " + addrDep.city + ", " + addrDep.prov + ", "+ addrDep.country;


// Now find GSP data for it...
      function geocodeAddress2(addre) {
	var geocoder = new google.maps.Geocoder();        
	var address = addre;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {	
            //resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              //map: resultsMap,
              position: results[0].geometry.location
            });
		 var latx = marker.position.lat();
		 var lonx = marker.position.lng();

		GpsDep = {
		'lat': latx,
		'lon': lonx,
		};
          }
	else{
	alert("We were not able to find the location of your Departure, Please step back one step and change data");	
	}
        });
      }
geocodeAddress2(CaddrDep);




}

function ValidateData(){
	AllDataOK = false;
        $(document).ready(function () {
		// if all data are valid
		AllDataOK = true;
		if((!isNaN(GpsDep.lon)) && (!isNaN(GpsDep.lat))){
			$("#DepartLon").val(GpsDep.lon);
			$("#DepartLat").val(GpsDep.lat);
			

		}
		else{
			alert("The location of your Destination is still not defined... :(");
			AllDataOK = false;
		}
		if((!isNaN(GpsDes.lon)) && (!isNaN(GpsDes.lat))){
			$("#DestinaLon").val(GpsDes.lon);
			$("#DestinaLat").val(GpsDes.lat);
		}
		else{
			alert("The location of your Destination is still not defined... :(");
			AllDataOK = false;
		}
		// Setting Repeating Date...
		$("#AllDay").val(DayRepeating);

		
		var desZip = addrDes.zip;
		var depZip = addrDep.zip;
		
		if( (desZip.length < 5) || (desZip.length > 6)){
			AllDataOK = false;
			alert("The Destination Postal code is not OK...");
		}

		if((depZip.length < 5) || (depZip.length > 6)){
			AllDataOK = false;
			alert("The Departure Postal code is not OK...");
		}
		// Driver or Rider...?
		var DorR = "";
		if($("#driverFoo").is(":checked")){
			DorR = "Driver";		
		}
		else {
			if($("#riderFoo").is(":checked")){DorR = "Rider";}
			else{AllDataOK = false;
			alert("Please choose Driver or Rider");		
			}
				
		}
		
		$("#DorR").val(DorR);
		// Validation on date...
		var date = $("#datepicker").val();
		if(date.length != 10){
			AllDataOK = false;
			alert("The date choosen is not in the right format");		
		}
		
		// Validation on Time

		
		var time = $("#TimeValue").val();
		var timeL = (time.length == 8);
		var FCtime = ( parseInt(time.charAt(0)) <= 2 );
		var Fotime = ( parseInt(time.charAt(3)) <= 6 );
		var SCtime = ( parseInt(time.charAt(6)) <= 6 );
    		var SecondCase = true;
    		if(parseInt(time.charAt(0)) == 2){
     
     		if(parseInt(time.charAt(1)) < 4 ){
         		SecondCase = true;
        	}
        	else{ SecondCase = false;}
		}

     		else{ SecondCase = true;}
		if(!(timeL && FCtime && Fotime && SCtime && SecondCase)){
		AllDataOK = false;
		alert("The time format is not ok");
		}
		
		// Computer distance between two points...
	
		      	function calculateAndDisplayRoute() {
			var directionsService = new google.maps.DirectionsService;
        		var directionsDisplay = new google.maps.DirectionsRenderer;
        		directionsService.route({
          			origin: {lat: GpsDep.lat , lng: GpsDep.lon  },
         			destination: {lat: GpsDes.lat, lng: GpsDes.lon},
          			travelMode: 'DRIVING'
        			}, function(response, status) {
          			if (status === 'OK') {
					var distance= 0;
					for(i = 0; i < response.routes[0].legs.length; i++){
			distance += parseFloat(response.routes[0].legs[i].distance.value);
					       
					}   
			document.getElementById('DistanceAB').value = parseInt(distance/1000);
	    
          			} else {
           		 		window.alert('Directions request failed due to ' + status);
          			}
        		});
      		}

		calculateAndDisplayRoute();
		
		
		if(AllDataOK){
		$("#ValidIt").collapse("show");
		}
		
        });

}



function ResetValid(){
        $(document).ready(function () {
		$("#ValidIt").collapse("hide");		

        });
	function BuildDayString(){
		DayRepeating = "";

		$(document).ready(function () {
			if($('#RMon').is(':checked')){ DayRepeating = "Mon"; }
			if($('#RTue').is(':checked')){ DayRepeating = DayRepeating + "Tue"; }
			if($('#RWes').is(':checked')){ DayRepeating = DayRepeating + "Wes"; }
			if($('#RThur').is(':checked')){ DayRepeating= DayRepeating + "Thur"; }
			if($('#RFri').is(':checked')){ DayRepeating = DayRepeating + "Fri"; }
			if($('#RSat').is(':checked')){ DayRepeating = DayRepeating + "Sat"; }
			if($('#RSun').is(':checked')){ DayRepeating = DayRepeating + "Sun"; }


			

		
		});

	}
	BuildDayString();
}



</script>
<script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAR2TULEBxvkVavNgSpCk6xXhwKnJT1Uio&callback=geocodeAddress">
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTrJWbLtv2VwyMhbgTUx0VCr_8r6I7VLo">
</script>


</div>
<!-- END OF CONTENT -->
<div><?php echo $this_page; ?></div>
<!-- This Section is for the footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Footer.php'); ?>

</body>
</html>

