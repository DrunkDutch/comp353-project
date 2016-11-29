<!DOCTYPE html>
<html>
<head>
    <title> Review </title>
    <!-- This section is for the Head -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Head.php'); ?>



</head>
<body>
<!-- Page Content -->
<!-- This Section is for the Navigation file -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Header.php'); ?>
<!-- INCLUDE CONTENT OF PAGE HERE -->
<div id="page-content-wrapper">
    <h1>My Past Rides</h1>

    <?php

    if(!empty($_GET['alert'])){
        echo '<div class="row" style="background-color:orange; height:100px;margin-top:50px;"><h4>'.$_GET['alert'].'</h4></div>';
    }

    ?>

    <div class="container" style="border-style:solid; border-width:3px; height:90%; overflow-y:scroll;" id="rides">

        <?php

        function GetDetailAddress($id){
            $status = Connected();
            if($status == 1){
                try{
                    $d = new dbMakeConnection;
                }

                catch(PDOException $e){ echo($e);}

                $stmt = $d->conn->prepare("SELECT * FROM ".$GLOBALS['db_name'].".Location WHERE LocationId = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $AllAddress = ' '. $result['StreetNum'] . ' '. $result['Street'] .' '. $result['City'];
                return $AllAddress;
            }
        }

        function GetPastRides() {
include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/config/dbMakeConnection.php');

            $status = Connected();
            if ($status == 1) {
                try {
                    $d = new dbMakeConnection;
                } catch (PDOException $e) {
                    echo($e);
                }

                $u = $_SESSION['UserId'];

                // GET Rider rides
                $stmt = $d->conn->prepare("SELECT * from ".$GLOBALS['db_name'].".Ride join ".$GLOBALS['db_name'].".Rider on Ride.RideId = RiderId where Rider.RiderId =:u GROUP BY Ride.RideId");
                $stmt->bindParam(':u', $u);
                $stmt->execute();
                $result = $stmt->fetchAll();

                if (empty($result)) {
                    echo "No past rides as rider";
                }
                else {

                    echo '<h3>Rider Rides</h3>';
                    foreach ($result as &$val) {
                        $Rid = $val["RideId"];
                        $Did = $val["DestinationId"];
                        $AllAdd = GetDetailAddress($Did);
                        $r = $val["Date"];
                        $t = $val["DepartTime"];
                        // Build URL For each Button...
                        $url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER[''] . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')) . '/Rides-Details.php?id=' . $Rid;
                        // Create HTML...
                        echo '<div class="row" style="height:150px;border-style:solid; border-width:3px;"><p style="margin-top:20px;">Destination:' .$AllAdd. '&nbsp</p><p>Departure time:&nbsp'.$r.'&nbspat:&nbsp'.$t. '&nbsp</p><a href="' . $url . '"><button class="btn btn-success">Rate Ride</button></a></div>';
                    }
                }

                // GET Driver rides
                $stmt = $d->conn->prepare("SELECT * from ".$GLOBALS['db_name'].".Ride join ".$GLOBALS['db_name'].".Driver on Ride.RideId=DriverId where DriverId =:u GROUP BY Ride.RideId");
                $stmt->bindParam(':u', $u);
                $stmt->execute();
                $result = $stmt->fetchAll();

                if (empty($result)) {
                    echo "No past rides as driver";
                }
                else {
                    echo '<h3>Driver Rides</h3>';

                    foreach ($result as &$val) {
                        $Rid = $val["RideId"];
                        $Did = $val["DestinationId"];
                        $AllAdd = GetDetailAddress($Did);
                        $r = $val["Date"];
                        $t = $val["DepartTime"];
                        // Build URL For each Button...
                        $url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER[''] . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')) . '/Rides-Details.php?id=' . $Rid;
                        // Create HTML...
                        echo '<div class="row" style="height:150px;border-style:solid; border-width:3px;"><p style="margin-top:20px;">Destination:' .$AllAdd. '&nbsp</p><p>Departure time:&nbsp'.$r.'&nbspat:&nbsp'.$t. '&nbsp</p><a href="' . $url . '"><button class="btn btn-success">Rate Ride</button></a></div>';
                    }
                }
            }
        }

        GetPastRides();
        ?>

    </div>

</div>
<!-- END OF CONTENT -->
<div><?php echo $this_page; ?></div>
<!-- This Section is for the footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Footer.php'); ?>

<script>
    $(document).on("click", ".add-ratee", function () {
        var ratee = $(this).data('id');
        $(".modal-body #user").val( ratee );
    });
</script>
</body>
</html>
