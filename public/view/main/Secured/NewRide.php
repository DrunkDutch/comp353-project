<!DOCTYPE html>
<html>
<head>
    <title> New Ride </title>
    <!-- This section is for the Head -->
    <?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Head.php');?>
</head>
<body>
<!-- Page Content -->
<!-- This Section is for the Navigation file -->
<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Header.php');?>
<!-- INCLUDE CONTENT OF PAGE HERE -->
<div id="page-content-wrapper">
    <h1>Create Ride</h1>
    <div class="container">
        <!--Testing the Google API -->
        <div id="map" style="Height:400px; width:500px"></div>

    </div>
</div>
<!-- END OF CONTENT -->
<div><?php echo $this_page; ?></div>
<!-- This Section is for the footer -->
<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Footer.php');?>

<script>
    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 6
        });
        var infoWindow = new google.maps.InfoWindow({map: map});

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent('Location found.');
                map.setCenter(pos);
                console.log(pos.lat);
                console.log(pos.lng);
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
</script>


<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAR2TULEBxvkVavNgSpCk6xXhwKnJT1Uio&callback=initMap">
</script>

<!--  	AIzaSyCTrJWbLtv2VwyMhbgTUx0VCr_8r6I7VLo = this key is used for google MAP ROAD -->
<!-- 	AIzaSyAR2TULEBxvkVavNgSpCk6xXhwKnJT1Uio  = this key is used for google MAP JS -->


</body>
</html>

