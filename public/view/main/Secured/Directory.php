<!DOCTYPE html>
<html>
<head>
    <title> Directory </title>
    <!-- This section is for the Head -->
    <?php include("../../include/Head.php"); ?>
</head>
<body>
<!-- Page Content -->
<!-- This Section is for the Navigation file -->
<?php include("../../include/Header.php"); ?>
<!-- INCLUDE CONTENT OF PAGE HERE -->
<div id="page-content-wrapper">
    <h1>Directory</h1>

    <div class="container" style="border-style:solid; border-width:3px; height:90%; overflow-y:scroll;" id="directory">

        <?php

        function GetDirectory() {
            include("../../../../config/dbMakeConnection.php");

            $status = Connected();
            if ($status == 1) {
                try {
                    $d = new dbMakeConnection;
                } catch (PDOException $e) {
                    echo($e);
                }

                $u = $_SESSION['username'];

                $stmt = $d->conn->prepare(
                    "select * FROM ".$GLOBALS['db_name'].".Member where UName not like :u and UserId not in (1, 2, 3)");
                $stmt->bindParam(':u', $u);
                $stmt->execute();
                $result = $stmt->fetchAll();

                foreach($result as&$val){
                    $uId = $val["UserId"];
                    $username = $val["UName"];
                    $email = $val["Email"];
                    // Build URL For each Button...
                    $url = "http://" . $_SERVER['SERVER_NAME'] .   $_SERVER[''].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')) . '/Account.php?id=' .$uId ;
                    // Create HTML...
                    echo '<div class="row" style="height:150px;border-style:solid; border-width:3px;"><p style="margin-top:20px;">UserID:&nbsp'.$uId.'</p><p>Username:&nbsp'.$username. '&nbsp</p><p>Email:&nbsp'.$email. '&nbsp</p><a href="'.$url.'"><button class="btn btn-success">Get Details</button></a></div>';
                }
            }
        }

        GetDirectory();
        ?>

    </div>

</div>
<!-- END OF CONTENT -->
<div><?php echo $this_page; ?></div>
<!-- This Section is for the footer -->
<?php include("../../include/Footer.php"); ?>

</body>
</html>
