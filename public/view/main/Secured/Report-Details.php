<!DOCTYPE html>
<!--Authors: 26290515, 26795528, 27417888, 40039346-->
<html>
<head>
    <title> Report - Details </title>
    <!-- This section is for the Head -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Head.php'); ?>


</head>
<body>
<!-- Page Content -->
<!-- This Section is for the Navigation file -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Header.php'); ?>
<!-- INCLUDE CONTENT OF PAGE HERE -->
<div id="page-content-wrapper">
    <h1>Report - Details</h1>

    <a href="/comp353-project/public/view/main/Secured/Report.php">
        <button class="btn btn-default">Return to Report Console</button>
    </a></div>

<div class="container" style="border-style:solid; border-width:3px; height:90%; overflow-y:scroll;" id="directory">

    <?php

    function GetPosting()
    {
        echo "<h3>Postings</h3>";

        include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/config/dbMakeConnection.php');

        $status = Connected();
        if ($status == 1) {
            try {
                $d = new dbMakeConnection;
            } catch (PDOException $e) {
                echo($e);
            }

            $stmt = $d->conn->prepare("Select UName as `UserName`, FName as `First Name`, count(PosterId) as `Rides Posted` from " . $GLOBALS['db_name'] . ".Member join " . $GLOBALS['db_name'] . ".Ride on UserId=PosterId group by UName order by count(PosterId) desc, Active desc");
            $stmt->execute();
            $result = $stmt->fetchAll();

            foreach ($result as &$val) {
                $username = $val["UserName"];
                $first = $val["First Name"];
                $rides = $val["Rides Posted"];
                // Create HTML...
                echo '<div class="row" style="height:150px;border-style:solid; border-width:3px;"><p style="margin-top:20px;">Username:&nbsp' . $username . '</p><p>Name:&nbsp' . $first . '&nbsp</p><p>Number of Rides:&nbsp' . $rides . '</div>';
            }
        }
    }

    function GetRidesOffered()
    {

        echo "<h3>Rides Offered</h3>";

        include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/config/dbMakeConnection.php');

        $status = Connected();
        if ($status == 1) {
            try {
                $d = new dbMakeConnection;
            } catch (PDOException $e) {
                echo($e);
            }

            $stmt = $d->conn->prepare("Select UName as `UserName`, FName as `First Name`, count(DriverId) as `Rides as Driver` from " . $GLOBALS['db_name'] . ".Member join " . $GLOBALS['db_name'] . ".Driver on UserId=DriverId group by UName order by count(DriverId) desc, Active desc");
            $stmt->execute();
            $result = $stmt->fetchAll();

            foreach ($result as &$val) {
                $username = $val["UserName"];
                $first = $val["First Name"];
                $rides = $val["Rides as Driver"];
                // Create HTML...
                echo '<div class="row" style="height:150px;border-style:solid; border-width:3px;"><p style="margin-top:20px;">Username:&nbsp' . $username . '</p><p>Name:&nbsp' . $first . '&nbsp</p><p>Number of Rides:&nbsp' . $rides . '</div>';
            }
        }
    }

    function GetRidesUsed()
    {

        echo "<h3>Rides Used</h3>";

        include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/config/dbMakeConnection.php');

        $status = Connected();
        if ($status == 1) {
            try {
                $d = new dbMakeConnection;
            } catch (PDOException $e) {
                echo($e);
            }

            $stmt = $d->conn->prepare("Select UName as `UserName`, FName as `First Name`, count(RiderId) as `Rides as Passenger` from " . $GLOBALS['db_name'] . ".Member join " . $GLOBALS['db_name'] . ".Rider on UserId=RiderId group by UName order by count(RiderId) desc, Active desc");
            $stmt->execute();
            $result = $stmt->fetchAll();

            foreach ($result as &$val) {
                $username = $val["UserName"];
                $first = $val["First Name"];
                $rides = $val["Rides as Passenger"];
                // Create HTML...
                echo '<div class="row" style="height:150px;border-style:solid; border-width:3px;"><p style="margin-top:20px;">Username:&nbsp' . $username . '</p><p>Name:&nbsp' . $first . '&nbsp</p><p>Number of Rides:&nbsp' . $rides . '</div>';
            }
        }
    }

    function GetPrivilegeType()
    {

        echo "<h3>Privilege Type</h3>";

        include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/config/dbMakeConnection.php');

        $status = Connected();
        if ($status == 1) {
            try {
                $d = new dbMakeConnection;
            } catch (PDOException $e) {
                echo($e);
            }

            $stmt = $d->conn->prepare("Select UName as `User Name`, FName as `First Name`, Privilege from " . $GLOBALS['db_name'] . ".Member order by Privilege asc");
            $stmt->execute();
            $result = $stmt->fetchAll();

            foreach ($result as &$val) {
                $username = $val["User Name"];
                $first = $val["First Name"];
                $privilege = $val["Privilege"];

                switch ($privilege) {
                    case 1:
                        // root
                        echo '<div class="row" style="height:150px;border-style:solid; border-width:3px; background-color:pink;"><p style="margin-top:20px;">Username:&nbsp' . $username . '</p><p>Name:&nbsp' . $first . '&nbsp</p><p>Privilege:&nbsp' . $privilege . '</p></div>';
                        break;
                    case 2:
                        // admin
                        echo '<div class="row" style="height:150px;border-style:solid; border-width:3px; background-color:blue;"><p style="margin-top:20px;">Username:&nbsp' . $username . '</p><p>Name:&nbsp' . $first . '&nbsp</p><p>Privilege:&nbsp' . $privilege . '</p></div>';
                        break;
                    case 3:
                        // user
                        echo '<div class="row" style="height:150px;border-style:solid; border-width:3px; background-color:green;"><p style="margin-top:20px;">Username:&nbsp' . $username . '</p><p>Name:&nbsp' . $first . '&nbsp</p><p>Privilege:&nbsp' . $privilege . '</p></div>';
                        break;
                    default:
                }
            }
        }
    }

    function GetStatus()
    {

        echo "<h3>Status</h3>";

        include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/config/dbMakeConnection.php');

        $status = Connected();
        if ($status == 1) {
            try {
                $d = new dbMakeConnection;
            } catch (PDOException $e) {
                echo($e);
            }

            $stmt = $d->conn->prepare("Select UName as `UserName`, FName as `First Name`, Suspended, Active from " . $GLOBALS['db_name'] . ".Member order by Active desc, Suspended asc");
            $stmt->execute();
            $result = $stmt->fetchAll();

            foreach ($result as &$val) {
                $username = $val["UserName"];
                $first = $val["First Name"];
                $suspended = $val["Suspended"];
                $active = $val["Active"];

                if ($active == 1 && $suspended == 0) {
                    // normal user
                    echo '<div class="row" style="height:150px;border-style:solid; border-width:3px; background-color:green;"><p style="margin-top:20px;">Username:&nbsp' . $username . '</p><p>Name:&nbsp' . $first . '&nbsp</p><p>Active Status:&nbsp Active</p><p>Suspended Status:&nbsp Not Suspended</p></div>';
                } else if ($active == 0 && $suspended == 0) {
                    // inactive user
                    echo '<div class="row" style="height:150px;border-style:solid; border-width:3px; background-color:yellow;"><p style="margin-top:20px;">Username:&nbsp' . $username . '</p><p>Name:&nbsp' . $first . '&nbsp</p><p>Active Status:&nbsp Inactive</p><p>Suspended Status:&nbsp Not Suspended</p></div>';
                } else if ($suspended == 1) {
                    // Suspended user
                    $activeString = "Active";
                    if ($active == 0) {
                        $activeString = "Inactive";
                    }
                    echo '<div class="row" style="height:150px;border-style:solid; border-width:3px; background-color:red;"><p style="margin-top:20px;">Username:&nbsp' . $username . '</p><p>Name:&nbsp' . $first . '&nbsp</p><p>Active Status:&nbsp' . $activeString . '</p><p>Suspended Status:&nbsp Suspended</p></div>';
                }
            }
        }
    }

    function GetBalanceStatus()
    {

        echo "<h3>Rides Used</h3>";

        include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/config/dbMakeConnection.php');

        $status = Connected();
        if ($status == 1) {
            try {
                $d = new dbMakeConnection;
            } catch (PDOException $e) {
                echo($e);
            }

            $stmt = $d->conn->prepare("Select UName as `UserName`, FName as `First Name`, Balance from " . $GLOBALS['db_name'] . ".Member order by Balance desc");
            $stmt->execute();
            $result = $stmt->fetchAll();

            foreach ($result as &$val) {
                $username = $val["UserName"];
                $first = $val["First Name"];
                $balance = $val["Balance"];
                // Create HTML...
                echo '<div class="row" style="height:150px;border-style:solid; border-width:3px;"><p style="margin-top:20px;">Username:&nbsp' . $username . '</p><p>Name:&nbsp' . $first . '&nbsp</p><p>Balance:&nbsp' . $balance . '</div>';
            }
        }
    }

    function GetDirectory()
    {
        $page = $_GET['page'];

        switch ($page) {
            case 1:
                GetPosting();
                break;
            case 2:
                GetRidesOffered();
                break;
            case 3:
                GetRidesUsed();
                break;
            case 4:
                GetPrivilegeType();
                break;
            case 5:
                GetStatus();
                break;
            case 6:
                GetBalanceStatus();
                break;
            default:
                echo "Page not found.";
        }
    }

    GetDirectory();
    ?>

</div>

<!-- END OF CONTENT -->
<div><?php echo $this_page; ?></div>
<!-- This Section is for the footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Footer.php'); ?>

</body>
</html>
