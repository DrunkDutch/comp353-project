<?php
include('../config/config.php');
include('../config/dbMakeConnection.php');
$username = $_POST['user'];
$score = $_POST['score'];
$rideId = $_GET['id'];

if (!((empty($username)) and (empty($score)))) {
    Rate($username, $score, $rideId);
}

function Rate($ratee, $score, $rideId)
{
    $status = Connected();

    if ($status == 1) {
        try {
            $d = new dbMakeConnection;
        } catch (PDOException $e) {
            echo($e);
        }

        $u = $_SESSION['username'];

        $stmt = $d->conn->prepare("select UserId from ".$GLOBALS['db_name'].".Member where UName like :u");
        $stmt->bindParam(':u', $u);
        $stmt->execute();
        $s = $stmt->fetch(PDO::FETCH_ASSOC);

        // This statement would allow us to also check that the recipient user exists as well when it returns an empty row
        $stmt = $d->conn->prepare("select UserId from ".$GLOBALS['db_name'].".Member where UName like :t");
        $stmt->bindParam(':t', $t);
        $stmt->execute();
        $r = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($r)) {
            echo "User does not exist";
            return;
        }

        $stmt = $d->conn->prepare("select * from `".$GLOBALS['db_name']."`.`Rating` where RideId = :id and RaterId = :r and RateeId = :e");
        $stmt->bindParam(':id', $rideId);
        $stmt->bindParam(':r', $u);
        $stmt->bindParam(':e', $ratee);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {

            $stmt = $d->conn->prepare("INSERT INTO `".$GLOBALS['db_name']."`.`Rating`(`RideId`,`RaterId`,`RateeId`, `Score`)VALUES(:id,:r,:e,:s)");
            $stmt->bindParam(':id', $rideId);
            $stmt->bindParam(':r', $u);
            $stmt->bindParam(':e', $ratee);
            $stmt->bindParam(':s', $score);
            $stmt->execute();
        }
        else {
            echo "Already rated for this ride.";
        }

        header("Location: http://localhost/comp353-project/public/view/main/Secured/SentMessages.php");
    }
}
