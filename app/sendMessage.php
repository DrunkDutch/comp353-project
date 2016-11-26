<?php
include('../config/config.php');
include('../config/dbMakeConnection.php');

$username = $_POST['user'];
$message = $_POST['message'];

if (!((empty($username)) and (empty($message)))) {
    SendEmail($username, $message);
}

function Redirect()
{
    $urlAndAlert ="http://" . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/Secured/Messages.php?alert= User does not exist Message Was not sent. ';
    header("Location:" .$urlAndAlert. " ");
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

        $stmt = $d->conn->prepare("select UserId from " . $GLOBALS['db_name'] . ".Member where UName like :u");
        $stmt->bindParam(':u', $u);
        $stmt->execute();
        $s = $stmt->fetch(PDO::FETCH_ASSOC);

        // This statement would allow us to also check that the recipient user exists as well when it returns an empty row
        $stmt = $d->conn->prepare("select UserId from " . $GLOBALS['db_name'] . ".Member where UName like :t");
        $stmt->bindParam(':t', $t);
        $stmt->execute();
        $r = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($r)) {
            $_SESSION['MSG_ERROR'] = 'User does not exist. Message not sent.';
            Redirect();
        } else {
            $stmt = $d->conn->prepare("INSERT INTO `" . $GLOBALS['db_name'] . "`.`Message` (`Date`, `SenderId`, `ReceiverId`, `Content`) VALUES (now(), :s, :r, :c)");
            $stmt->bindParam(':s', $s['UserId']);
            $stmt->bindParam(':r', $r['UserId']);
            $stmt->bindParam(':c', $m);
            $stmt->execute();

            $_SESSION['MSG_ERROR'] = '';

            $url = "http://" . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/Secured/SentMessages.php';
            header("Location:" . $url . " ");
        }
    }
}
