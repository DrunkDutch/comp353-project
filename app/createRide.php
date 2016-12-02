<?php
//Authors: 26290515, 26795528, 27417888, 40039346

include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/config/config.php');
include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/config/dbMakeConnection.php');


$GLOBALS['Departure_Lon'] = bcdiv($_POST['DepartLon'], 1, 6);
$GLOBALS['Departure_Lat'] = bcdiv($_POST['DepartLat'], 1, 6);
$GLOBALS['Destination_Lat'] = bcdiv($_POST['DestinationLat'], 1, 6);
$GLOBALS['Destination_Lon'] = bcdiv($_POST['DestinationLon'], 1, 6);

function PostALocation($Lat, $Lon, $StrNum, $Str, $Zip, $City, $Prov)
{

    $status = Connected();
    if ($status == 1) {
        try {
            $d = new dbMakeConnection;

        } catch (PDOException $e) {
            echo($e);
        }

        $stmt = $d->conn->prepare("INSERT INTO `" . $GLOBALS['db_name'] . "`.`Location` (`Latitude`,`Longitude`,`StreetNum`,`Street`,`PostalCode`,`City`,`Province` )VALUES(:La, :Lo, :Sn, :S, :Zip, :Cit, :Prov)");

        $stmt->bindParam(':La', $Lat);
        $stmt->bindParam(':Lo', $Lon);
        $stmt->bindParam(':Sn', $StrNum);
        $stmt->bindParam(':S', $Str);
        $stmt->bindParam(':Zip', $Zip);
        $stmt->bindParam(':Cit', $City);
        $stmt->bindParam(':Prov', $Prov);
        $stmt->execute();
    }

}

function LoadAllLocationExist()
{
    $status = Connected();
    if ($status == 1) {
        try {
            $d = new dbMakeConnection;

        } catch (PDOException $e) {
            echo($e);
        }
        $stmt = $d->conn->prepare("Select LocationId, Latitude, Longitude FROM " . $GLOBALS['db_name'] . ".Location");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}

function AddRideInRide($user, $rid)
{

    $status = Connected();
    if ($status == 1) {
        try {
            $d = new dbMakeConnection;

        } catch (PDOException $e) {
            echo($e);
        }

        $stmt = $d->conn->prepare("INSERT INTO `" . $GLOBALS['db_name'] . "`.`Rider` (`RideId`,`RiderId`)VALUES(:r, :u)");

        $stmt->bindParam(':u', $user);
        $stmt->bindParam(':r', $rid);
        $stmt->execute();
    }

}

function AddRideInDriver($user, $rid)
{

    $status = Connected();
    if ($status == 1) {
        try {
            $d = new dbMakeConnection;

        } catch (PDOException $e) {
            echo($e);
        }

        $stmt = $d->conn->prepare("INSERT INTO `" . $GLOBALS['db_name'] . "`.`Driver` (`RideId`,`DriverId`)VALUES(:r, :u)");


        $stmt->bindParam(':r', $rid);
        $stmt->bindParam(':u', $user);
        $stmt->execute();
    }

}

function CheckIfRide($dep, $des, $date, $t)
{

    $status = Connected();
    if ($status == 1) {
        try {
            $d = new dbMakeConnection;

        } catch (PDOException $e) {
            echo($e);
        }
        $stmt = $d->conn->prepare("Select RideId FROM " . $GLOBALS['db_name'] . ".Ride WHERE DepartureId = :dep and DestinationId = :des and Date = :date and DepartTime = :t");
        $stmt->bindParam(':dep', $dep);
        $stmt->bindParam(':des', $des);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':t', $t);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}

function AddRide($Date, $Time, $Rep, $Dep, $Des, $Dis, $RiderCap, $PostID)
{

    $compare = (strcmp($Rep, "no") == 0);
	//if($compare){echo("hello");}
    $status = Connected();
    if ($status == 1) {
        try {
            $d = new dbMakeConnection;

        } catch (PDOException $e) {
            echo($e);
        }

        $stmt = $d->conn->prepare("INSERT INTO `" . $GLOBALS['db_name'] . "`.`Ride` (`Date`,`DepartTime`,`RepeatDay`,`DepartureId`,`DestinationId`,`Distance`, `RiderCapacity` ,`PosterId` )VALUES(:Da, :T, :RD, :Dep, :Des, :Dis, :Capa, :PoId)");

        $stmt->bindParam(':Da', $Date);
        $stmt->bindParam(':T', $Time);
        if($compare){$stmt->bindValue(':RD', null, PDO::PARAM_NULL);}
	else{$stmt->bindParam(':RD', $Rep);}
        $stmt->bindParam(':Dep', $Dep);
        $stmt->bindParam(':Des', $Des);
        $stmt->bindParam(':Dis', $Dis);
        $stmt->bindParam(':Capa', $RiderCap);
        $stmt->bindParam(':PoId', $PostID);
        $stmt->execute();
    }
}

if(strlen($_POST['AllDay']) == 0){
	$RepeatingDay = "no";
}
else{
$RepeatingDay = $_POST['AllDay'];
}






$AllMFLocation = LoadAllLocationExist();
$AlreadyExistDep = false;

$AlreadyExistDes = false;


foreach ($AllMFLocation as & $val) {


    $CompareDesLat = (abs(($GLOBALS['Destination_Lat'] - $val['Latitude']) / $val['Latitude']) < 0.00001);
    $CompareDesLon = (abs(($GLOBALS['Destination_Lon'] - $val['Longitude']) / $val['Longitude']) < 0.00001);

    $CompareDepLat = (abs(($GLOBALS['Departure_Lat'] - $val['Latitude']) / $val['Latitude']) < 0.00001);
    $CompareDepLon = (abs(($GLOBALS['Departure_Lon'] - $val['Longitude']) / $val['Longitude']) < 0.00001);

    if (($CompareDesLat) and ($CompareDesLon)) {
        $AlreadyExistDes = true;
        $GrabNumberDes = $val['LocationId'];

    }

    if (($CompareDepLat) and ($CompareDepLon)) {

        $AlreadyExistDep = true;
        $GrabNumberDep = $val['LocationId'];

    }
}


if (!$AlreadyExistDes) {
    PostALocation($GLOBALS['Destination_Lat'], $GLOBALS['Destination_Lon'], $_POST['Des_streetNumber'], $_POST['Des_street'], $_POST['Des_ZIP'], $_POST['Des_City'], $_POST['Des_Prov']);


};
if (!$AlreadyExistDep) {
    PostALocation($GLOBALS['Departure_Lat'], $GLOBALS['Departure_Lon'], $_POST['Depart_streetNumber'], $_POST['Depart_street'], $_POST['Depart_ZIP'], $_POST['Depart_City'], $_POST['Depart_Prov']);

};

// If location has been posted...

if (!$AlreadyExistDep or !$AlreadyExistDep) {

    $AllMFLocation2 = LoadAllLocationExist();
    foreach ($AllMFLocation2 as & $val) {


        $CompareDesLat = (abs(($GLOBALS['Destination_Lat'] - $val['Latitude']) / $val['Latitude']) < 0.00001);
        $CompareDesLon = (abs(($GLOBALS['Destination_Lon'] - $val['Longitude']) / $val['Longitude']) < 0.00001);

        $CompareDepLat = (abs(($GLOBALS['Departure_Lat'] - $val['Latitude']) / $val['Latitude']) < 0.00001);
        $CompareDepLon = (abs(($GLOBALS['Departure_Lon'] - $val['Longitude']) / $val['Longitude']) < 0.00001);

        if (($CompareDesLat) and ($CompareDesLon)) {
            $GrabNumberDes = $val['LocationId'];

        }

        if (($CompareDepLat) and ($CompareDepLon)) {
            $GrabNumberDep = $val['LocationId'];

        }
    }

}



// Now we are sure to have to IDs for Location...
$RideID;
$e = CheckIfRide($GrabNumberDep, $GrabNumberDes, $_POST['RDate'], $_POST['RTime']);
$r = ($e['RideId'] > 1);

if ($r == 1) {
    // A redirect to home page with message
    $RideID = $e['RideId'];

} else {
    AddRide($_POST['RDate'], $_POST['RTime'], $RepeatingDay, $GrabNumberDep, $GrabNumberDes, $_POST['DistanceAB'], $_POST['Capacity'], $_SESSION['UserId']);
    $s = CheckIfRide($GrabNumberDep, $GrabNumberDes, $_POST['RDate'], $_POST['RTime']);
    $RideID = $s['RideId'];
}


$IsDriver = (strcmp($_POST['DorR'], "Driver") == 0);
$IsRider = (strcmp($_POST['DorR'], "Rider") == 0);

if ($IsRider) {

    AddRideInRide($_SESSION['UserId'], $RideID);
} else {
    if ($IsDriver) {

        AddRideInDriver($_SESSION['UserId'], $RideID);
    }
}

$urlAndAlert = "http://" . $_SERVER['SERVER_NAME'] . '/comp353-project/index.php?alert=You have created a ride, the number of the ride is:  ' . $RideID . ' ';
header("Location:" . $urlAndAlert . " ");
exit;



?>
