<?php
//Authors: 26290515, 26795528, 27417888, 40039346

if (session_status() == PHP_SESSION_NONE) { session_start(); }

include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/config.php');
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');

DeleteUser();

// Check Login with DB assuming variable passed in are cleaned and not all empty
function DeleteUser(){
    $status = Connected();
    if($status == 1){
        try{
            $d = new dbMakeConnection;
        }

        catch(PDOException $e){ echo($e);}

        $current = $_SESSION['UserId'];

        if ($_GET['id'] == $current) {
            $stmt = $d->conn->prepare("UPDATE ".$GLOBALS['db_name'].".`Member` SET `Active` = 0, `Suspended` = 1 WHERE `UserId` = :u");
            $stmt->bindParam(':u', $u);
            $stmt->execute();

            Logout();
        }
        else {
            $url = "http://" . $_SERVER['SERVER_NAME']. '/comp353-project/public/view/main/Secured/Account.php?id=' . $current;
            header("Location:".$url." ");
        }
    }
}

function Logout() {
    $_SESSION['Authen']= null;
    $url = "http://" . $_SERVER['SERVER_NAME']. '/comp353-project/public/view/main/LOG_IN.php';
    header("Location:".$url." ");
}