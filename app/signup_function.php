<?php
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/config.php');
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');
session_start();
$_SESSION['Authen']= false;

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
        Failure();
    }

    // If permit and insurance info filled, create driver
    else if(!((empty($insurance)) and (empty($permit)))) {
        CreateDriver($username, $first, $last, $email, $password, $phone, $dob, $rusername, $insurance, $permit);
    }
    // Create rider
    else{
        CreateRider($username, $first, $last, $email, $password, $phone, $dob, $rusername);
    }
}
else {
    Failure();
}

function Failure() {
    $_SESSION['Authen']= false;
    header("Location: http://localhost/comp353-project/public/view/main/Sign_up.php");
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
            Failure();
        }
        else {

            // Create user
            $stmt = $d->conn->prepare("INSERT INTO `comp353`.`Member`(`UName`,`Password`,`FName`,`LName`,`Email`,`DOB`,`ReferrerID`,`Balance`,`Privilege`,`Phone`,`Permit`,`Insurance`)VALUES(:u,:p,:f,:l,:e,:d,:r,-50,3,:phone,:per,:i)");
            $stmt->bindParam(':u', $username);
            $stmt->bindParam(':p', $password);
            $stmt->bindParam(':f', $first);
            $stmt->bindParam(':l', $last);
            $stmt->bindParam(':e', $email);
            $stmt->bindParam(':d', $dob);
            $stmt->bindParam(':r', $rusername);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':per', $permit);
            $stmt->bindParam(':i', $insurance);
            $stmt->execute();

            LaunchSession($username, $email, $password);
        }
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
            Failure();
        }
        else {

            // Create user
            $stmt = $d->conn->prepare("INSERT INTO `comp353`.`Member`(`UName`,`Password`,`FName`,`LName`,`Email`,`DOB`,`ReferrerID`,`Balance`,`Privilege`,`Phone`)VALUES(:u,:p,:f,:l,:e,:d,:r,-50,3,:phone)");
            $stmt->bindParam(':u', $username);
            $stmt->bindParam(':p', $password);
            $stmt->bindParam(':f', $first);
            $stmt->bindParam(':l', $last);
            $stmt->bindParam(':e', $email);
            $stmt->bindParam(':d', $dob);
            $stmt->bindParam(':r', $rusername);
            $stmt->bindParam(':phone', $phone);
            $stmt->execute();

            LaunchSession($username, $email, $password);
        }
    }

}

function LaunchSession($u, $e, $p){
    $_SESSION['username'] = $u;
    $_SESSION['email'] = $e;
    $_SESSION['p'] = $p;
    $_SESSION['Authen'] = true;

    header("Location: http://localhost/comp353-project/public/view/main/Secured/Rides.php");
}
?>
