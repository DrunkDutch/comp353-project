<?php
     if (session_status() == PHP_SESSION_NONE) {
	 session_start();
	  
     }
include_once($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/config.php');
include_once($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');

$funds = $_POST['funds'];

if (!empty($funds) && is_numeric($funds)) {
    UpdateFunds($funds);
}
Redirect();

function Redirect()
{
    $url = 'https://tpc353_2.encs.concordia.ca/comp353-project/public/view/main/Secured/Account.php?id=' . $_SESSION['UserId'];
    header("Location:https://tpc353_2.encs.concordia.ca/comp353-project/public/view/main/Secured/Account.php?id=" . $_SESSION['UserId']."");
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

        $u = $_SESSION['UserId'];
        $editId = $_SESSION['editId'];

        // if admin or root
        if ($editId) {
            $u = $editId;
        }

        // check if current funds
        $stmt = $d->conn->prepare("SELECT Balance FROM " . $GLOBALS['db_name'] . ".Member WHERE UName = :u");
        $stmt->bindParam(':u', $u);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $balance = $result['Balance'];

        $newBalance = $balance + $funds;

        $stmt = $d->conn->prepare("UPDATE `". $GLOBALS['db_name'] . "`.`Member` SET `Balance` = :v WHERE `UserId` = :i");
        $stmt->bindParam(':v', $newBalance);
        $stmt->bindParam(':i', $u);
        $stmt->execute();

    }
}
