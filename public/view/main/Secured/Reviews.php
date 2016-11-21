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

    <div class="container" style="border-style:solid; border-width:3px; height:90%; overflow-y:scroll;" id="rides">

        <?php include "/comp353-project/app/rate.php"?>
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
                        <form action="/comp353-project/app/rate.php" method="POST">
                            <div class="form-group">
                                <label for="user">Ratee:</label>
                                <input type="text" class="form-control" name="user" id="user" placeholder="Enter Username">
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

        function GetPastRides() {
            include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/config/dbMakeConnection.php');

            $status = Connected();
            if ($status == 1) {
                try {
                    $d = new dbMakeConnection;
                } catch (PDOException $e) {
                    echo($e);
                }

                // GET USER MESSAGES
                $stmt = $d->conn->prepare("SELECT * FROM comp353.Ride WHERE Date < CURDATE()");
                $stmt->execute();
                $result = $stmt->fetchAll();

                if (empty($result)) {
                    echo "No past rides";
                }
                else {
                    foreach ($result as &$val) {
                        $Rid = $val["RideId"];
                        $Did = $val["DestinationId"];
                        $AllAdd = GetDetailAddress($Did);
                        $r = $val["Date"];
                        $t = $val["DepartTime"];
                        $data = "STELLA"; // TODO: LOGIC TO GET RATEE'S NAME
                        // Build URL For each Button...
                        $url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER[''] . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')) . '/Rate.php?id=' . $Rid;
                        // Create HTML...
                        echo '<div class="row" style="height:150px;border-style:solid; border-width:3px;"><p style="margin-top:20px;">Destination:' .$AllAdd. '&nbsp</p><p>Departure time:&nbsp'.$r.'&nbspat:&nbsp'.$t. '&nbsp</p>';
                        echo '<button type="button" class="btn btn-success add-ratee" data-toggle="modal" data-target="#myModal" data-id="' . $data . '"">Rate</button></div>';
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
