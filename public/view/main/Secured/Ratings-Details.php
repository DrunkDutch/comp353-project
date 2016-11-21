<!DOCTYPE html>
<html>
<head>
    <title> Account </title>
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

</head>
<body>
<!-- Page Content -->
<!-- This Section is for the Navigation file -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Header.php'); ?>
<!-- INCLUDE CONTENT OF PAGE HERE -->
<div id="page-content-wrapper">

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/config/dbMakeConnection.php');

    // Get Detail On Ratings
    function GetRatingsDetails($id)
    {
        $status = Connected();
        if ($status == 1) {
            try {
                $d = new dbMakeConnection;
            } catch (PDOException $e) {
                echo($e);
            }

            $stmt = $d->conn->prepare("SELECT UName, UserId, max(Score) as High, min(Score) as Low, avg(Score) as Avg FROM comp353.Rating JOIN comp353.Member ON (UserId=RateeId) WHERE RateeId = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    function CollectResult()
    {
        $details = GetRatingsDetails($_GET["id"]);

        echo '<div class="container">';
        if (empty($details)) {
            echo 'User not found';
        }
        else if ($details['Avg'] == null) {
            echo '<h2> ' . $details['FName'] . ' Rating </h2>';
            echo '<div class="row">Username:&nbsp' . $details['UName'] . '</div>
            <div class="row">UserID:&nbsp' . $details['UserId'] . '</div>';
            echo 'User has not yet been rated';
        } else {
		    echo '<h2> ' . $details['FName'] . ' Rating </h2>';
            echo '<div class="row">Username:&nbsp' . $details['UName'] . '</div>
            <div class="row">UserID:&nbsp' . $details['UserId'] . '</div>
                <div class="row">Highest Rating:&nbsp' . $details['High'] . '</div>
		        <div class="row">Average Rating:&nbsp' . $details['Avg'] . '</div>
		        <div class="row">Lowest Rating:&nbsp' . $details['Low'] . '</div>';
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

