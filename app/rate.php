<?php
//Authors: 26290515, 26795528, 27417888, 40039346

include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/config.php');
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');
$username = $_POST['user'];
$score = $_POST['score'];
$rideId = $_POST['rideId'];

if ((!empty($username) and !empty($score) and !empty($rideId))) {

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

        $u = $_SESSION['UserId'];

        // This statement would allow us to also check that the recipient user exists as well when it returns an empty row
        $stmt = $d->conn->prepare("select UserId from `".$GLOBALS['db_name']."`.`Member` where UName like :t");
        $stmt->bindParam(':t', $ratee);
        $stmt->execute();
        $r = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($r['UserId'])) {
            Failure('User does not exist');
        }

        $stmt = $d->conn->prepare("select * from `".$GLOBALS['db_name']."`.`Rating` where RideId = :id and RaterId = :r and RateeId = :e");
        $stmt->bindParam(':id', $rideId);
        $stmt->bindParam(':r', $u);
        $stmt->bindParam(':e', $r['UserId']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {

            $stmt = $d->conn->prepare("INSERT INTO `".$GLOBALS['db_name']."`.`Rating`(`RideId`,`RaterId`,`RateeId`, `Score`)VALUES(:id,:r,:e,:s)");
            $stmt->bindParam(':id', $rideId);
            $stmt->bindParam(':r', $u);
            $stmt->bindParam(':e', $r['UserId']);
            $stmt->bindParam(':s', $score);
            $stmt->execute();
        }
        else {
            Failure("Already rated for this ride");
        }

        Redirect();
    }
}

function Failure($msg) {
    $urlAndAlert ="http://" . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/Secured/Reviews.php?alert=' . $msg;
    header("Location:" .$urlAndAlert. " ");
}

function Redirect() {
    $url ="http://" . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/Secured/Reviews.php';
    header("Location:" .$url. " ");
}