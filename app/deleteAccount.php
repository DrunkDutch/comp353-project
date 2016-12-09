<?php
//Authors: 26290515, 26795528, 27417888, 40039346
if (session_status() == PHP_SESSION_NONE) {
	 session_start();}
include_once($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/config.php');
include_once($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php')

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
            $stmt = $d->conn->prepare("UPDATE ".$GLOBALS['db_name'].".Member SET `Active` = 0, `Suspended` = 1 WHERE `UserId` = :u");
            $stmt->bindParam(':u', $current);
            $stmt->execute();

            Logout();
        }
        else {
   header("Location:https://tpc353_2.encs.concordia.ca/comp353-project/index.php");
        }
    }
}

function Logout() {
    $_SESSION['Authen']= null;
   header("Location:https://tpc353_2.encs.concordia.ca/comp353-project/index.php?alert=You are log out");
}
