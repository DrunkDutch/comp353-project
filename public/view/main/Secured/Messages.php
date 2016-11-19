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
    <h1>My Messages</h1>
    <div class="row">
        <div class="text-center">
            <i class="fa fa-commenting fa-5x" aria-hidden="true"></i>
        </div>
    </div>
    <div class="container" style="border-style:solid; border-width:3px; height:90%; overflow-y:scroll;" id="messages">
        <?php
        function GetMessages() {
            include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/config/dbMakeConnection.php');

            $status = Connected();
            if ($status == 1) {
                try {
                    $d = new dbMakeConnection;
                } catch (PDOException $e) {
                    echo($e);
                }

                $u = $_SESSION['username'];

                $stmt = $d->conn->prepare("select SenderId, ReceiverId, Date, Content from Message join Member on Message.ReceiverId = Member.UserId where Member.UName like :u");
                $stmt->bindParam(':u', $u);
                $stmt->execute();
                $result = $stmt->fetchAll();

                foreach ($result as &$val) {

                    $r = $val["SenderId"];
                    $t = $val["ReceiverId"];
                    echo '<div class="row" style="height:150px;border-style:solid; border-width:3px;"><p style="margin-top:20px;">Destination:&nbsp</p><p>Departure time:&nbsp' . $r . '&nbspat:&nbsp' . $t . '&nbsp</p><a href="#"><button class="btn btn-success">Get Details</button></a></div>';
                }

            }
        }

        GetMessages();
        ?>

        <div class="row" style="height:150px;border-style:solid; border-width:3px;"><p>Destination:&nbsp</p>
            <p>Departure time:&nbsp2016-11-18&nbspat:&nbsp09:00:00&nbsp</p><a href="#">
                <button class="btn btn-success">Get Details</button>
            </a></div>
    </div>

</div>
<!-- END OF CONTENT -->
<div><?php echo $this_page; ?></div>
<!-- This Section is for the footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Footer.php'); ?>

</body>
</html>

