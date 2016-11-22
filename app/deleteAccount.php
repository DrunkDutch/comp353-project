<?php
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/config.php');
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');

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
            $stmt = $d->conn->prepare("DELETE FROM comp353.Member WHERE UName = :u");
            $stmt->bindParam(':u', $u);
            $stmt->execute();

            $_SESSION['Authen']= false;
            $url = "http://" . $_SERVER['SERVER_NAME']. '/comp353-project/public/view/main/LOG_IN.php';
            header("Location:".$url." ");
        }
        else {
            $url = "http://" . $_SERVER['SERVER_NAME']. '/comp353-project/public/view/main/Secured/Account.php?id=' . $current;
            header("Location:".$url." ");
        }
    }
}