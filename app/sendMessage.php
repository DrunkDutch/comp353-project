<?php
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/config.php');
include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/config/dbMakeConnection.php');

$username = $_POST['user'];
$message = $_POST['message'];

if (!((empty($username)) and (empty($message)))) {
    SendEmail($username, $message);
}

function SendEmail($t, $m)
{
    $status = Connected();

    if ($status == 1) {
        try {
            $d = new dbMakeConnection;
        } catch (PDOException $e) {
            echo($e);
        }

        $u = $_SESSION['username'];

        $stmt = $d->conn->prepare("select UserId from comp353.Member where UName like :u");
        $stmt->bindParam(':u', $u);
        $stmt->execute();
        $s = $stmt->fetch(PDO::FETCH_ASSOC);

        // This statement would allow us to also check that the recipient user exists as well when it returns an empty row
        $stmt = $d->conn->prepare("select UserId from comp353.Member where UName like :t");
        $stmt->bindParam(':t', $t);
        $stmt->execute();
        $r = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($r)) {
            echo "User does not exist";
            return;
        }

        $stmt = $d->conn->prepare("INSERT INTO `comp353`.`Message` (`Date`, `SenderId`, `ReceiverId`, `Content`) VALUES (CURRENT_DATE(), :s, :r, :c)");
        $stmt->bindParam(':s', $s['UserId']);
        $stmt->bindParam(':r', $r['UserId']);
        $stmt->bindParam(':c', $m);
        $stmt->execute();

        header("Location: http://localhost/comp353-project/public/view/main/Secured/SentMessages.php");
    }
}