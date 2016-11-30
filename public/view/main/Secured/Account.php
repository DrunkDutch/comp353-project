<!DOCTYPE html>
<!--Authors: 26290515, 26795528, 27417888, 40039346-->
<html>
<head>
    <title> Account </title>
    <!-- This section is for the Head -->
    
    <?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Head.php'); ?>

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
<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Header.php'); ?>
<!-- INCLUDE CONTENT OF PAGE HERE -->
<div id="page-content-wrapper">

    <?php
    if (session_status() == PHP_SESSION_NONE) { session_start(); }

    //include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/config/dbMakeConnection.php');
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');
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

            $stmt = $d->conn->prepare("SELECT * FROM ".$GLOBALS['db_name'].".Member WHERE UserId = :id");
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
            $url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER[''] . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')) . '/Ratings-Details.php?id=' . $accountDetails['UserId'];

            echo '<div class="row">Username:&nbsp' . $accountDetails['UName'] . '</div>
            <div class="row">UserID:&nbsp' . $accountDetails['UserId'] . '</div>
                <div class="row">Name:&nbsp' . $accountDetails['FName'] . ' ' . $accountDetails['LName'] . '</div>
		        <div class="row">Email:&nbsp' . $accountDetails['Email'] . '</div>
		        <div class="row">DOB:&nbsp' . $accountDetails['DOB'] . '</div>
		        <div class="row">Phone:&nbsp' . $accountDetails['Phone'] . '</div>
		        <br/>
		        <a href="' . $url . '"><button class="btn btn-success">See Rating</button></a>';

            $privilege = $_SESSION['privi'];
            // if own account or if you are root or admin
            if ($_SESSION['UserId'] == $accountDetails['UserId'] || $privilege <= 2) {

                if ($privilege <= 2) {
                    $_SESSION['editId'] = $_GET['id'];
                }
                else {
                    $_SESSION['editId'] = null;
                }

                // add buttons
                echo '&nbsp;<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1">Account Balance</button>';
                $url = "http://" . $_SERVER['SERVER_NAME'] . '/comp353-project/app/deleteAccount.php?id=' . $accountDetails['UserId'];
                echo '&nbsp;<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal2">Edit Account</button>&nbsp;<a href="' . $url . '"><button class="btn btn-danger">Delete Account</button></a>';

                // able to view balance
                include "/comp353-project/app/updateFunds.php";
                $balance = $accountDetails['Balance'];
                echo '<div id="myModal1" class="modal fade" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Account Balance</h4></div>';
                echo '<div class="modal-body"><form action="/comp353-project/app/updateFunds.php" method="POST">';
                echo '<div class="form-group"><label for="Username">Current Balance: ' . $balance . '</label></div>';
                echo '<div class="form-group"><label for="funds">Add Funds</label><input type="number" name="funds" class="form-control" aria-describedby="funds" id="funds" placeholder="100" min="0" required="required"></div>';
                echo '<button class="btn btn-default" data-dismiss="modal">Close</button>&nbsp;<button type="submit" class="btn btn-success">Submit</button></form></div></div></div></div>';

                // able to edit and delete account
                include "/comp353-project/app/editAccount.php";
                echo '<div id="myModal2" class="modal fade" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Edit Account</h4></div>';
                echo '<div class="modal-body"><form action="/comp353-project/app/editAccount.php" method="POST"><div class="form-group"><label for="username">Username</label><input type="text" name="username" class="form-control" aria-describedby="UsernameHelp" id="exampleInputUsername1" placeholder="Username"></div>';
                echo '<div class="form-group"><label for="FirstName">First Name</label><input type="text" name="FirstName" class="form-control" aria-describedby="FirstnameHelp" id="exampleInputFirstName1" placeholder="First Name"></div>';
                echo '<div class="form-group"><label for="LastName">Last Name</label><input type="text" name="LastName" class="form-control" aria-describedby="LastnameHelp" id="exampleInputLastName1" placeholder="Last Name"></div>';
                echo '<div class="form-group"><label for="Email">Email</label><input type="email" name="email1" class="form-control" aria-describedby="emailHelp" id="exampleInputEmail1" placeholder="Email"></div>';
                echo '<div class="form-group"><label for="exampleInputPassword1">New Password</label><input type="password" name="password1" class="form-control" id="exampleInputPassword1" placeholder="Password"></div>';
                echo '<div class="form-group"><label for="exampleInputPhone1">Phone</label><input type="numeric" name="phone" class="form-control" aria-describedby="PhoneHelp" id="exampleInputPhone1" placeholder="5141234567" min="1000000000" max="9999999999" ></div>';
                echo '<div class="form-group"><label for="DOB">Date of Birth</label><input type="date" name="dob" class="form-control" aria-describedby="DOBHelp" id="exampleInputDOB" placeholder="YYYY-MM-DD"></div>';
                echo '<div class="form-group"><label for="exampleInputPermit">Driver\'s Permit Number</label><input type="text" name="permit" class="form-control" aria-describedby="PermitHelp" id="exampleInputPermit" placeholder="Permit Number"></div>';
                echo '<div class="form-group"><label for="exampleInputInsurance">Insurance Policy Number</label><input type="text" name="insurance" class="form-control" aria-describedby="InsuranceHelp" id="exampleInputInsurance" placeholder="Policy Number"></div>';

                if ($privilege <= 2) {
                    echo '<div class="form-group"><label for="exampleInputActive">Active</label><input type="text" name="active" class="form-control" aria-describedby="ActiveHelp" id="exampleInputActive" placeholder="1 = Active, 0 = Inactive"></div>';
                    echo '<div class="form-group"><label for="exampleInputSuspended">Suspended</label><input type="text" name="suspended" class="form-control" aria-describedby="SuspendedHelp" id="exampleSuspendedActive" placeholder="0 = Not suspended, 1 = Suspended"></div>';
                    echo '<div class="form-group"><label for="exampleInputPrivilege">Privilege</label><input type="text" name="privilege" class="form-control" aria-describedby="PrivilegeHelp" id="exampleInputPrivilege" placeholder="1"></div>';
                }
                echo '<button class="btn btn-default" data-dismiss="modal">Close</button><button type="submit" class="btn btn-success">Submit</button></form></div></div></div>';


            }

        }
        echo '</div>';
    }

    CollectResult();
    ?>
    <!-- END OF CONTENT -->

    <!-- This Section is for the footer -->
    <?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Footer.php'); ?>

</body>
</html>

