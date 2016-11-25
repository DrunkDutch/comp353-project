<?php
include('../config/config.php');
include('../config/dbMakeConnection.php');

// Field information
$username = $_POST['username'];
$password = $_POST['password'];

if (!empty($username) & !empty($password)) {
    UpdateFields($username, $password);
}
else {
    echo "Must enter new username and password";
    Redirect();
}

Redirect();

function UpdateFields($username, $password) {
    $status = Connected();
    if($status == 1) {
        try {
            $d = new dbMakeConnection;
        } catch (PDOException $e) {
            echo($e);
        }

        $stmt = $d->conn->prepare(/*Update statement*/);
        $stmt->bindParam(':u', $username);
        $stmt->bindParam(':p', $password);
        $stmt->execute();


    }
}

function Redirect() {
    $url = "http://" . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/ResetUser.php';
    header("Location:".$url." ");
}

function LaunchSession($u, $e, $p, $i, $priv)
{
    $_SESSION['username'] = $u;
    $_SESSION['email'] = $e;
    $_SESSION['p'] = $p;
    $_SESSION['privi'] = $priv;
    $_SESSION['UserId'] = $i;
    $_SESSION['Authen'] = true;
    $url = "http://" . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/Secured/Rides.php';
    header("Location:" . $url . " ");
}
