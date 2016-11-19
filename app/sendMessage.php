<?php
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/config.php');
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');

$email = $_POST['email'];
$message = $_POST['message'];

if( !((empty($email)) and (empty($message)))){

    // TODO: check if email exists

    SendEmail($email, $message);
}

function SendEmail($email, $message){
    $status = Connected();
    if($status != 1) return;
        try{
            $d = new dbMakeConnection;
        }

        catch(PDOException $e){ echo($e);}

        $stmt = $d->conn->prepare(/*INSERT EMAIL STATEMENT*/);
        $stmt->bindParam(':e', $email);
        $stmt->bindParam(':m', $message);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
}