<?php
include('../config/config.php');
include('../config/dbMakeConnection.php');

$funds = $_POST['funds'];

if (!empty($funds) && is_numeric($funds)) {
    UpdateFunds($funds);
}
Redirect();

function Redirect()
{
    $url = "http://" . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/Secured/Account.php?id=' . $_SESSION['UserId'];
    header("Location:" . $url . " ");
}

// Check Login with DB assuming variable passed in are cleaned and not all empty
function UpdateFunds($funds)
{
    $status = Connected();
    if ($status == 1) {
        try {
            $d = new dbMakeConnection;
        } catch (PDOException $e) {
            echo($e);
        }

        $u = $_SESSION['username'];

        // adding funds
        if ($funds > 0) {
            $stmt = $d->conn->prepare(/* UPDATE BALANCE */);
            $stmt->bindParam(':u', $u);
            $stmt->execute();
        } else {
            // check if sufficient funds
            $stmt = $d->conn->prepare("SELECT Balance FROM ".$GLOBALS['db_name'].".Member WHERE UName = :u");
            $stmt->bindParam(':u', $u);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $balance = $result['Balance'];

            $toRemove = abs($funds);
            if ($balance = $toRemove < 0) {
                $toRemove = $balance;
            }

            $stmt = $d->conn->prepare(/* UPDATE BALANCE */);
            $stmt->bindParam(':u', $u);
            $stmt->execute();
        }
    }
}
