<?php
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/config.php');
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');

// Field information
$username = $_POST['username'];
$first = $_POST['FirstName'];
$last = $_POST['LastName'];
$email = $_POST['email1'];
$email2 = $_POST['email2'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$phone = $_POST['phone'];
$dob = $_POST['dob'];
$rusername = $_POST['rusername'];
$permit = $_POST['permit'];
$insurance = $_POST['insurance'];

// Check if required fields are filled out
if( !(empty($username) and empty($first) and empty($last) and
    empty($email) and empty($password) and empty($phone) and
    empty($dob) and empty($rusername))){

    if ($password !== $password2 or $email !== $email2) {
        echo("Replace with some sort of error");
        return;
    }

    // If permit and insurance info filled, create driver
    if(!((empty($insurance)) and (empty($permit)))) {
        CreateDriver($username, $first, $last, $email, $password, $phone, $dob, $rusername, $insurance, $permit);
    }
    // Create rider
    else{
        CreateRider($username, $first, $last, $email, $password, $phone, $dob, $rusername);
    }
}

function CreateDriver($username, $first, $last, $email, $password, $phone, $dob, $rusername, $insurance, $permit) {
    $status = Connected();
    if($status == 1){
        try{
            $d = new dbMakeConnection;
        }

        catch(PDOException $e){ echo($e);}

        // Check if username already exists
        $stmt = $d->conn->prepare("SELECT * FROM comp353.Member WHERE UName = :u");
        $stmt->bindParam(':u', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            // do something
        }

        // Create user
        $stmt = $d->conn->prepare(/*INSERT DRIVER STATEMENT HERE*/);
        $stmt->bindParam(':u', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        LaunchSession($username, $email, $password);
    }

}

function CreateRider($username, $first, $last, $email, $password, $phone, $dob, $rusername) {
    $status = Connected();
    if($status == 1){
        try{
            $d = new dbMakeConnection;
        }

        catch(PDOException $e){ echo($e);}

        // Check if username already exists
        $stmt = $d->conn->prepare("SELECT * FROM comp353.Member WHERE UName = :u");
        $stmt->bindParam(':u', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            // do something
        }

        // Create user
        $stmt = $d->conn->prepare(/*INSERT RIDER STATEMENT HERE*/);
        $stmt->bindParam(':u', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        LaunchSession($username, $email, $password);

    }

}

function LaunchSession($u, $e, $p){
    session_start();
    $_SESSION['username'] = $u;
    $_SESSION['email'] = $e;
    $_SESSION['p'] = $p;

    header("Location: http://localhost/comp353-project/public/view/main/Secured/Rides.php");
}
?>
