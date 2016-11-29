<?php
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/config.php');
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');

if (session_status() == PHP_SESSION_NONE) { session_start(); }

// Field information
$username = $_POST['user'];
$password = $_POST['password'];

if (!empty($username) & !empty($password)) {
    UpdateFields($username, $password);
}
else {
    echo "Must enter new username and password";
    Redirect();
}

function UpdateFields($username, $password) {
    $status = Connected();
    if($status == 1) {
        try {
            $d = new dbMakeConnection;
        } catch (PDOException $e) {
            echo($e);
        }

        $stmt = $d->conn->prepare("UPDATE `comp353`.`Member` SET `UName` = :u, `Password` = :p WHERE `UName` = 'admin'");
        $stmt->bindParam(':u', $username);
        $stmt->bindParam(':p', $password);
        $stmt->execute();

        $_SESSION['Authen'] = null;

        OnSuccessfulReset();
    }
}

function Redirect() {
    $url = "http://" . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/ResetUser.php';
    header("Location:".$url." ");
}

function OnSuccessfulReset() {
    $url = "http://" . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/LOG_IN.php';
    header("Location:".$url." ");
}