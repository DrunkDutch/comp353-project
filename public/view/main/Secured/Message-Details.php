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
            $url = "http://" . $_SERVER['SERVER_NAME'] .   $_SERVER[''].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')) . '/NewMessage.php?id=' .$messageDetails['UserId'] ;


            echo '<div class="row">Date:&nbsp' . $messageDetails['Date'] . '</div>
		        <div class="row">Sender:&nbsp' . $messageDetails['UName'] . '</div>
		        <div class="row">Message:&nbsp' . $messageDetails['Content'] . '</div>
		        <br/>
		        <a href="'.$url.'"><button class="btn btn-success">Reply</button></a>';
        }
        echo '</div>';
    }

    CollectResult();


    ?>

    <!--    </div>-->


    <!-- END OF CONTENT -->

    <!-- This Section is for the footer -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Footer.php'); ?>

</body>
</html>

