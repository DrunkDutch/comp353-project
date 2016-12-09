<?php
//Authors: 26290515, 26795528, 27417888, 40039346
if (session_status() == PHP_SESSION_NONE) {session_start();}
include_once($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/config.php');
include_once($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');

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

        $u = $_SESSION['UserId'];
        $editId = $_SESSION['editId'];

        // if admin or root
        if ($editId) {
            $u = $editId;
        }

        // check if current funds
        $stmt = $d->conn->prepare("SELECT * FROM " . $GLOBALS['db_name'] . ".Member WHERE UserId = :u");
        $stmt->bindParam(':u', $u);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $balance = $result['Balance'];

        $newBalance = $balance + $funds;

        $stmt = $d->conn->prepare("UPDATE " . $GLOBALS['db_name'] . ".`Member` SET `Balance` = :v WHERE `UserId` = :i");
        $stmt->bindParam(':v', $newBalance);
        $stmt->bindParam(':i', $u);
        $stmt->execute();

    }
}
