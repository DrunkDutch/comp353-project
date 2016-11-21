<!DOCTYPE html>
<html>
<head>
    <title> Message - Details </title>
    <!-- This section is for the Head -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Head.php'); ?>
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
<?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Header.php'); ?>
<!-- INCLUDE CONTENT OF PAGE HERE -->
<div id="page-content-wrapper">

    <div class="row">
        <div class="text-center">
            <i class="fa fa-commenting fa-5x" aria-hidden="true"></i>
        </div>
    </div>

    <?php include "/comp353-project/app/sendMessage.php"?>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Message</h4>
                </div>
                <div class="modal-body">
                    <form action="/comp353-project/app/sendMessage.php" method="POST">
                        <div class="form-group">
                            <label for="user">To:</label>
                            <input type="text" class="form-control" name="user" id="user" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea class="form-control" rows="5" name="message" id="message" placeholder="Enter message"></textarea>
                        </div>
                        <button class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/config/dbMakeConnection.php');

    // Get Detail On Message
    function GetMessageDetails($id)
    {
        $status = Connected();
        if ($status == 1) {
            try {
                $d = new dbMakeConnection;
            } catch (PDOException $e) {
                echo($e);
            }

            $stmt = $d->conn->prepare("SELECT UName, UserId, Date, Content FROM comp353.Message JOIN comp353.Member ON (SenderId=UserId) WHERE MessageId = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    function CollectResult()
    {
        $messageDetails = GetMessageDetails($_GET["id"]);

        echo '<div class="container">
		<h2> Message Details </h2>';

        if (empty($messageDetails)) {
            echo 'Message not found';
        } else {
            echo '<div class="row">Date:&nbsp' . $messageDetails['Date'] . '</div>
		        <div class="row">Sender:&nbsp' . $messageDetails['UName'] . '</div>
		        <div class="row">Message:&nbsp' . $messageDetails['Content'] . '</div>
		        <br/>
		        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" data-id="' . $messageDetails['UName'] . '">New Message</button>';
        }
        echo '</div>';
    }
    
    CollectResult();
    ?>
    <!-- END OF CONTENT -->

    <!-- This Section is for the footer -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Footer.php'); ?>

</body>
</html>

