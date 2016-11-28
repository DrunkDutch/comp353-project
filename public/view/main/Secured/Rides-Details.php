<!DOCTYPE html>
<html>
<head>
    <title> Rides - Details </title>
    <!-- This section is for the Head -->
    <?php include("../../include/Head.php"); ?>
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
            width: 70%
        }

        #warnings-panel {
            width: 100%;
            height: 10%;
            text-align: center;
        }
    </style>
    <!--AIzaSyCTrJWbLtv2VwyMhbgTUx0VCr_8r6I7VLo -->
</head>

<body>
<!-- Page Content -->
<!-- This Section is for the Navigation file -->
<?php include("../../include/Header.php"); ?>
<!-- INCLUDE CONTENT OF PAGE HERE -->
<div id="page-content-wrapper">

    <?php
    include("../../../../config/dbMakeConnection.php");

    // Get Location ID
    function GetDetailAddress($id)
    {
        $status = Connected();
        if ($status == 1) {
            try {
                $d = new dbMakeConnection;

            } catch (PDOException $e) {
                echo($e);
            }

            $stmt = $d->conn->prepare("SELECT * FROM " . $GLOBALS['db_name'] . ".Location WHERE LocationId = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $resultLoca = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultLoca;
        }
    }

    // Get Detail On Ride
    function GetRideDetails($Rid)
    {
        $status = Connected();
        if ($status == 1) {
            try {
                $d = new dbMakeConnection;

            } catch (PDOException $e) {
                echo($e);
            }

            $stmt = $d->conn->prepare("SELECT RideId, Date, DepartTime, RepeatDay, DepartureId, DestinationId, Distance, RiderCapacity, CURRENT_DATE - Date as DateDifference FROM " . $GLOBALS['db_name'] . ".Ride WHERE RideId = :id");
            $stmt->bindParam(':id', $Rid);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    // Get Details About Driver (Embedded to link profile)
    function GetDriverID($Rid)
    {
        $status = Connected();
        if ($status == 1) {
            try {
                $d = new dbMakeConnection;

            } catch (PDOException $e) {
                echo($e);
            }

            $stmt = $d->conn->prepare("SELECT DriverId FROM " . $GLOBALS['db_name'] . ".Driver WHERE RideId = :id");
            $stmt->bindParam(':id', $Rid);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    // Get Details Passenger and Space remaining (Embedded to link profile)
    function GetPassengerIDs($Rid)
    {
        $status = Connected();
        if ($status == 1) {
            try {
                $d = new dbMakeConnection;

            } catch (PDOException $e) {
                echo($e);
            }

            $stmt = $d->conn->prepare("SELECT RiderId FROM " . $GLOBALS['db_name'] . ".Rider WHERE RideId = :id");
            $stmt->bindParam(':id', $Rid);
            $stmt->execute();

            $result = $stmt->fetchAll();
            return $result;
        }
    }

    function GetDetailsOfMember($id)
    {
        $status = Connected();
        if ($status == 1) {
            try {
                $d = new dbMakeConnection;

            } catch (PDOException $e) {
                echo($e);
            }

            $stmt = $d->conn->prepare("SELECT UName FROM " . $GLOBALS['db_name'] . ".Member WHERE UserId = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $result = $stmt->fetchAll();
            return $result;
        }
    }

    function CollectResult()
    {
        $Ride = GetRideDetails($_GET["id"]);
        $Destination = GetDetailAddress($Ride['DestinationId']);
        $Departure = GetDetailAddress($Ride['DepartureId']);
        $DriverID = GetDriverID($Ride['RideId']);
        $PassengerID = GetPassengerIDs($Ride['RideId']);
        $DriverDetails = GetDetailsOfMember($DriverID['DriverId']);
        $GLOBALS['FullDestinaAddress'] = ' ' . $Destination['StreetNum'] . ' ' . $Destination['Street'] . ', ' . $Destination['City'];
        $GLOBALS['FullDepartAddress'] = ' ' . $Departure['StreetNum'] . ' ' . $Departure['Street'] . ', ' . $Departure['City'];

        // Getting Repeat...

        $GLOBALS['RepeatingRide'] = $Ride['RepeatDay'];
        // Getting lenght of travel

        $GLOBALS['TravelLenght'] = $Ride['Distance'];


        $GLOBALS['DestinationLat'] = $Destination['Latitude'];
        $GLOBALS['DestinationLon'] = $Destination['Longitude'];
        $GLOBALS['DepartureLat'] = $Departure['Latitude'];
        $GLOBALS['DepartureLon'] = $Departure['Longitude'];

        $GLOBALS['RideID'] = $Ride['RideId'];

        if ($Ride['DateDifference'] > 0) {
            $GLOBALS['PastRide'] = true;
        } else {
            $GLOBALS['PastRide'] = false;
        }

        $urlToDirectory = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER[''] . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')) . '/Directory.php';
        if (empty($DriverDetails)) {
            $GLOBALS['Driver'] = "No Driver";
            $urlToDriver = $urlToDirectory;
        } else {
            $GLOBALS['Driver'] = $DriverDetails[0]['UName'];
            $urlToDriver = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER[''] . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')) . '/Account.php?id=' . $DriverID['DriverId'];
        }

        $GLOBALS['ALLPassenger'];
        $GLOBALS['PCountHelper'] = $PassengerID;
        foreach ($PassengerID as &$val) {
            $tmp = GetDetailsOfMember($val['RiderId']);
            $GLOBALS['ALLPassenger'] = $GLOBALS['ALLPassenger'] . ' ' . $tmp[0]['UName'] . ', ';

        }
        // Computer place remaining on rides
        $GLOBALS['StatusRide'];
        $numbPassenger = sizeof($PassengerID);
        if ($Ride['RiderCapacity'] == $numbPassenger) {
            $GLOBALS['StatusRide'] = "This ride is Full";
        } else {

            $a = $Ride['RiderCapacity'] - $numbPassenger;
            $GLOBALS['StatusRide'] = "There is " . $a . " place(s) left";
        }

        echo '<div class="container">
		<h2> Ride Details </h2>
		<div class="row">Departure:<a href="#Maps">' . $GLOBALS['FullDepartAddress'] . '</a></div>
		<div class="row">Destination:<a href="#Maps">' . $GLOBALS['FullDestinaAddress'] . '</a></div>
		<div class="row">Distance:&nbsp' . $GLOBALS['TravelLenght'] . ' &nbspKM</div>
		<div class="row">Date:&nbsp' . $Ride['Date'] . '</div>
		<div class="row">Time:&nbsp' . $Ride['DepartTime'] . '</div>
		<div class="row">Repeating Every:&nbsp' . $GLOBALS['RepeatingRide'] . '</div>
		<div class="row">Driver:&nbsp<a href="' . $urlToDriver . '">' . $GLOBALS['Driver'] . '</a></div>
		<div class="row">Passengers:&nbsp<a href="' . $urlToDirectory . '">' . $GLOBALS['ALLPassenger'] . '</a></div>
		<div class="row">Capacity:&nbsp' . $Ride['RiderCapacity'] . '</div>
		<div class="row">Status:&nbsp' . $GLOBALS['StatusRide'] . '</div>
		</div>';
    }

    CollectResult();

    ?>
    <div class="row" style="display:none">
        <input type="text" id="DetLat" value="<?php echo $GLOBALS['DestinationLat'] ?>">
        <input type="text" id="DetLon" value="<?php echo $GLOBALS['DestinationLon']; ?>">
        <input type="text" id="DepLat" value="<?php echo $GLOBALS['DepartureLat']; ?>">
        <input type="text" id="DepLon" value="<?php echo $GLOBALS['DepartureLon']; ?>">
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
        <div class="row" style="background-color:darkgrey; margin-top:30px;margin-bottom:30px;">
            <h4>Can't find a ride?</h4>
            <a href="<?php echo('http://' . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/Secured/NewRide.php') ?>">
                <button style="margin-bottom:40px;" class="btn btn-primary">Create your own</button>
            </a>
        </div>
        <div id="ButtonPanel" class="container" style="background-color:black; margin-top:30px;margin-bottom:30px;">
            <h4>Action Panel</h4>
            <?php
            session_start();
            $isFull = (strcmp($GLOBALS['StatusRide'], "This ride is Full") == 0);
            $HaveADriver = !(strcmp($GLOBALS['Driver'], "No Driver") == 0);
            $AreYouRiderIn = (strpos($GLOBALS['ALLPassenger'], $_SESSION['username']));
            $AreYouDriverIn = (strcmp($GLOBALS['Driver'], $_SESSION['username']) == 0);
            $afterDeparture = $GLOBALS['PastRide'];
            $Repeating = ($GLOBALS['RepeatingRide'] != '');
            $AllP = explode(',', substr($GLOBALS['ALLPassenger'], 0, -2));
            $NumberPassenger = count($GLOBALS['PCountHelper']);
            $HaveRider = ($NumberPassenger > 0);


            // For each passenger pass button...
            // Rate Rider Button
            if ($HaveRider and $AreYouDriverIn and ($Repeating or $afterDeparture)) {
                foreach ($AllP as & $valueR) {
                    echo '<div class="row" style="margin-top:20px;margin-bottom:20px;"><button type="button" class="btn btn-success add-ratee" data-toggle="modal" data-target="#myModal" data-id="' . $valueR . '">Rate Rider ' . $valueR . '</button> &nbsp;</div>';
                }
            }

            // Rate Driver Button
            if ($HaveADriver and $AreYouRiderIn and ($Repeating or $afterDeparture)) {
                echo '<div class="row" style="margin-top:20px;margin-bottom:20px;"><button type="button" class="btn btn-success add-ratee" data-toggle="modal" data-target="#myModal" data-id="' . $GLOBALS['Driver'] . '">Rate Driver ' . $GLOBALS['Driver'] . '</button></div>';
            }
// Leave Driver

	if($AreYouDriverIn and $HaveADriver){
	echo('<div class="row" style="margin-top:20px;margin-bottom:20px;"><h5>You are the driver and you can not leave</h5></div>');
	}
            // Leave as Rider
            if ($AreYouRiderIn and ($Repeating or !$afterDeparture)) {
                echo('<div class="row" style="margin-top:20px;margin-bottom:20px;"><form method="POST" action="/comp353-project/app/LeaveRider.php" ><Input type="number" style="display:none;" name="RideId" value="' . $_GET['id'] . '"><Input type="submit" class="btn btn-success" value="Leave as Rider"></form></div>');
            }

            // Join as Driver
            if (!$HaveADriver and !$AreYouRiderIn and !$AreYouDriverIn and ($Repeating or !$afterDeparture)) {
                echo('<div class="row" style="margin-top:20px;margin-bottom:20px;"><form method="POST" action="/comp353-project/app/JoinAsDriver.php" ><Input type="number" style="display:none;" name="RideId" value="' . $_GET['id'] . '"><Input type="submit" class="btn btn-success" value="Join as Driver"></form></div>');
            }

            // Join as Rider
            if (!$isFull and !$AreYouRiderIn and !$AreYouDriverIn and ($Repeating or !$afterDeparture)) {
                echo('<div class="row" style="margin-top:20px;margin-bottom:20px;"><form method="POST" action="/comp353-project/app/JoinAsRider.php" ><Input type="number" style="display:none;" name="RideId" value="' . $_GET['id'] . '"><Input type="submit" class="btn btn-success" value="Join as Rider"></form></div>');
            }

            // Message if ride is finished...
            if (!$Repeating and $afterDeparture) {
                echo('<div class="row" style="margin-top:20px;margin-bottom:20px;"><h5>This ride has passed.</h5></div>');
            }

            ?>
        </div>

        <div id="map" style="Height:500px; Width:100%; margin-top:40px;"></div>

        <?php include "/comp353-project/app/rate.php" ?>
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Rate</h4>
                    </div>
                    <div class="modal-body">
                        <form action="/comp353-project/app/rate.php?" method="POST">
                            <div class="form-group">
                                <label for="user">Ratee:</label>
                                <input type="text" class="form-control" name="user" id="user"
                                       placeholder="Enter Username" required="required">
                            </div>
                            <div class="form-group">
                                <label for="score">Score:</label>
                                <select class="form-control" name="score" id="score">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <script>

            function initMap() {

                var filterFloat = function (value) {
                    if (/^(\-|\+)?([0-9]+(\.[0-9]+)?|Infinity)$/
                            .test(value))
                        return Number(value);
                    return NaN;
                }

                var depLat = filterFloat(document.getElementById("DepLat").value);
                var depLon = filterFloat(document.getElementById("DepLon").value);
                var detLat = filterFloat(document.getElementById("DetLat").value);
                var detLon = filterFloat(document.getElementById("DetLon").value);

                var directionsDisplay = new google.maps.DirectionsRenderer;
                var directionsService = new google.maps.DirectionsService;

                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 10,
                    center: {lat: depLat, lng: depLon},
                });
                directionsDisplay.setMap(map);

                calculateAndDisplayRoute(directionsService, directionsDisplay);
                document.getElementById('mode').addEventListener('change', function () {
                    calculateAndDisplayRoute(directionsService, directionsDisplay);
                });
            }

            function calculateAndDisplayRoute(directionsService, directionsDisplay) {

                var filterFloat = function (value) {
                    if (/^(\-|\+)?([0-9]+(\.[0-9]+)?|Infinity)$/
                            .test(value))
                        return Number(value);
                    return NaN;
                }


                var depLat = filterFloat(document.getElementById("DepLat").value);
                var depLon = filterFloat(document.getElementById("DepLon").value);
                var detLat = filterFloat(document.getElementById("DetLat").value);
                var detLon = filterFloat(document.getElementById("DetLon").value);

                var start = {lat: depLat, lng: depLon};
                var end = {lat: detLat, lng: detLon};
                var selectedMode = document.getElementById('mode').value;


                directionsService.route({
                    origin: start,
                    destination: end,  // Ocean Beach.
                    // Note that Javascript allows us to access the constant
                    // using square brackets and a string value as its
                    // "property."
                    travelMode: google.maps.TravelMode[selectedMode]
                }, function (response, status) {
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

        <script>
            $(document).on("click", ".add-ratee", function () {
                var ratee = $(this).data('id');
                $(".modal-body #user").val(ratee);
            });
        </script>

    </div>
    <!-- END OF CONTENT -->

    <!-- This Section is for the footer -->
    <?php include("../../include/Footer.php"); ?>

</body>
</html>


