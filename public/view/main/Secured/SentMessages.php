<!DOCTYPE html>
<html>
<head>
<?php if (session_status() == PHP_SESSION_NONE) {
	 session_start();
	  
     }?>
    <title> Sent Messages </title>
    <!-- This section is for the Head -->
     <?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Head.php'); ?>
</head>
<body>
<!-- Page Content -->
<!-- This Section is for the Navigation file -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Header.php'); ?>
<!-- INCLUDE CONTENT OF PAGE HERE -->
<div id="page-content-wrapper">
    <h1>My Sent Messages</h1>

    <a href="/comp353-project/public/view/main/Secured/Messages.php"><button class="btn btn-default">View Received Messages</button></a>

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

                // GET USER MESSAGES
                $stmt = $d->conn->prepare(
                    "select m.MessageId, mem2.UName, m.Date, m.Content 
					from ".$GLOBALS['db_name'].".Message m join ".$GLOBALS['db_name'].".Member mem2 on ".$GLOBALS['db_name'].".m.ReceiverId = ".$GLOBALS['db_name'].".mem2.UserId 
					join ".$GLOBALS['db_name'].".Member mem on ".$GLOBALS['db_name'].".m.SenderId = ".$GLOBALS['db_name'].".mem.UserId 
					where ".$GLOBALS['db_name'].".mem.UName like :u");
                $stmt->bindParam(':u', $u);
                $stmt->execute();
                $result = $stmt->fetchAll();

                if (empty($result)) {
                    echo "No messages";
                }
                else {
                    foreach ($result as &$val) {
                        $mId = $val["MessageId"];
                        $rId = $val["UName"];
                        $date = $val["Date"];
                        $content = $val["Content"];
                        // Build URL For each Button...
                        $url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER[''] . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')) . '/Message-Details.php?id=' . $mId;
                        // Create HTML...
                        echo '<div class="row" style="height:150px;border-style:solid; border-width:3px;"><p style="margin-top:20px;">Receiver:&nbsp' . $rId . '</p><p>Date:&nbsp' . $date . '&nbsp</p><p>Content:&nbsp' . $content . '&nbsp</p><a href="' . $url . '"><button class="btn btn-success">Get Details</button></a></div>';
                    }
                }
            }
        }

        GetMessages();
        ?>

    </div>

</div>
<!-- END OF CONTENT -->
<div><?php echo $this_page; ?></div>
<!-- This Section is for the footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Footer.php'); ?>

</body>
</html>
