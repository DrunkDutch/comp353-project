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

    // Get Detail On Account
    function GetAccountDetails($id)
    {
        $status = Connected();
        if ($status == 1) {
            try {
                $d = new dbMakeConnection;
            } catch (PDOException $e) {
                echo($e);
            }

            $stmt = $d->conn->prepare("SELECT * FROM comp353.Member WHERE UserId = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;

        }
    }

    function CollectResult()
    {
        $accountDetails = GetAccountDetails($_GET["id"]);

        echo '<div class="container">
		<h2> ' . $accountDetails['FName'] . ' Account Details </h2>';

        if (empty($accountDetails)) {
            echo 'User not found';
        } else {
            $url = "http://" . $_SERVER['SERVER_NAME'] .   $_SERVER[''].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')) . '/NewMessage.php?id=' .$accountDetails['UserId'] ;


            echo '<div class="row">Username:&nbsp' . $accountDetails['UName'] . '</div>
            <div class="row">UserID:&nbsp' . $accountDetails['UserId'] . '</div>
                <div class="row">Name:&nbsp' . $accountDetails['FName'] . ' ' . $accountDetails['LName'] . '</div>
		        <div class="row">Email:&nbsp' . $accountDetails['Email'] . '</div>
		        <div class="row">DOB:&nbsp' . $accountDetails['DOB'] . '</div>
		        <div class="row">Phone:&nbsp' . $accountDetails['Phone'] . '</div>
		        <br/>
		        <a href="'.$url.'"><button class="btn btn-success">Send Message</button></a>';
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

