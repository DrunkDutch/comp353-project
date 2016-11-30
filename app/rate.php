<?php
  if (session_status() == PHP_SESSION_NONE) {
	 session_start();
	  
     }
include_once($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/config.php');
include_once($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');
$username = $_POST['user'];
$score = $_POST['score'];
$rideId = $_POST['RideIdY'];

echo($rideId);
echo($score);
echo($username);

function GrabIDUser($foo){


$status = Connected();

    if ($status == 1) {
        try {
            $d = new dbMakeConnection;
        } catch (PDOException $e) {
            echo($e);
        }
	
	$stmt = $d->conn->prepare("select UserId from ".$GLOBALS['db_name'].".Member where UName like :u");
        $stmt->bindParam(':u', $foo);
        $stmt->execute();
        $s = $stmt->fetch(PDO::FETCH_ASSOC);
	return $s;
	
     }



}
if (!((empty($username)) and (empty($score)))) 
{
 echo($username);
 $NameOf = GrabIDUser($username);
	echo($NameOf['UserId']);
  Rate($NameOf['UserId'], $score, $rideId);
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

        $stmt = $d->conn->prepare("select UserId from ".$GLOBALS['db_name'].".Member where UName like :u");
        $stmt->bindParam(':u', $u);
        $stmt->execute();
        $s = $stmt->fetch(PDO::FETCH_ASSOC);

        //This statement would allow us to also check that the recipient user exists as well when it returns an empty row
        $stmt = $d->conn->prepare("select UserId from ".$GLOBALS['db_name'].".Member where UName like :t");
        $stmt->bindParam(':t', $t);
        $stmt->execute();
        $r = $stmt->fetch(PDO::FETCH_ASSOC);
        if (empty($r)) {
exit(header("Location:https://tpc353_2.encs.concordia.ca/comp353-project/index.php"));
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
header("Location:https://tpc353_2.encs.concordia.ca/comp353-project/index.php");
		exit;
        }

header("Location:https://tpc353_2.encs.concordia.ca/comp353-project/index.php");
	exit;
    }
}
