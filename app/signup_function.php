<?php
include('../config/config.php');
include('../config/dbMakeConnection.php');
session_start();
$_SESSION['Authen'] = false;

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
$rfirst = $_POST['rfname'];
$remail = $_POST['remail'];
$rdob = $_POST['rdob'];
$permit = $_POST['permit'];
$insurance = $_POST['insurance'];

// Check if required fields are filled out
if ((!empty($username) and !empty($first) and !empty($last) and
    !empty($email) and !empty($password) and !empty($phone) and
    !empty($dob) and !empty($rfirst) and !empty($remail) and !empty($rdob))
) {

    if ($password !== $password2 or $email !== $email2) {
        Failure();
    } // If permit and insurance info filled, create driver
    else if (!((empty($insurance)) and (empty($permit)))) {
        CreateDriver($username, $first, $last, $email, $password, $phone, $dob, $rfirst, $remail, $rdob, $insurance, $permit);
    } // Create rider
    else {
        CreateRider($username, $first, $last, $email, $password, $phone, $dob, $rfirst, $remail, $rdob);
    }
} else {
    Failure();
}

function Failure()
{
    $_SESSION['Authen'] = false;
    header("Location: http://localhost/comp353-project/public/view/main/Sign_up.php");
}

function CreateDriver($username, $first, $last, $email, $password, $phone, $dob, $rfirst, $remail, $rdob, $insurance, $permit)
{
    $status = Connected();
    if ($status == 1) {
        try {
            $d = new dbMakeConnection;
        } catch (PDOException $e) {
            echo($e);
        }

        // Check if username already exists
        $stmt = $d->conn->prepare("SELECT * FROM comp353.Member WHERE UName = :u");
        $stmt->bindParam(':u', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            Failure();
        } else {
            $stmt = $d->conn->prepare("SELECT `UserId` FROM `comp353`.`Member` where Email like :e and DOB = date(:d) and FName like :f");
            $stmt->bindParam(':e', $remail);
            $stmt->bindParam(':d', $rdob);
            $stmt->bindParam(':f', $rfirst);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {

                $ruserid = $result['UserId'];

                // Create user
                $stmt = $d->conn->prepare("INSERT INTO `comp353`.`Member`(`UName`,`Password`,`FName`,`LName`,`Email`,`DOB`,`ReferrerID`,`Balance`,`Privilege`,`Phone`,`Permit`,`Insurance`)VALUES(:u,:p,:f,:l,:e,:d,:r,0,3,:phone,:per,:i)");
                $stmt->bindParam(':u', $username);
                $stmt->bindParam(':p', $password);
                $stmt->bindParam(':f', $first);
                $stmt->bindParam(':l', $last);
                $stmt->bindParam(':e', $email);
                $stmt->bindParam(':d', $dob);
                $stmt->bindParam(':r', $ruserid);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':per', $permit);
                $stmt->bindParam(':i', $insurance);
                $stmt->execute();

                // Log in
                $stmt = $d->conn->prepare("SELECT * FROM comp353.Member WHERE UName = :u");
                $stmt->bindParam(':u', $username);
                $stmt->execute();

                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                $em = $result['Email'];
                $p = $result['Password'];
                $id = $result['UserId'];
                $priv = $result['Privilege'];

                LaunchSession($username, $em, $p, $id, $priv);
            } else {
                echo "Referrer does not exist";
                Failure();
            }
        }
    }

}

function CreateRider($username, $first, $last, $email, $password, $phone, $dob, $rfirst, $remail, $rdob)
{
    $status = Connected();
    if ($status == 1) {
        try {
            $d = new dbMakeConnection;
        } catch (PDOException $e) {
            echo($e);
        }

        // Check if username already exists
        $stmt = $d->conn->prepare("SELECT * FROM comp353.Member WHERE UName = :u");
        $stmt->bindParam(':u', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            Failure();
        } else {
            $stmt = $d->conn->prepare("SELECT `UserId` FROM `comp353`.`Member` where Email like :e and DOB = date(:d) and FName like :f");
            $stmt->bindParam(':e', $remail);
            $stmt->bindParam(':d', $rdob);
            $stmt->bindParam(':f', $rfirst);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {

                $ruserid = $result['UserId'];

                // Create user
                $stmt = $d->conn->prepare("INSERT INTO `comp353`.`Member`(`UName`,`Password`,`FName`,`LName`,`Email`,`DOB`,`ReferrerID`,`Balance`,`Privilege`,`Phone`)VALUES(:u,:p,:f,:l,:e,:d,:r,0,3,:phone)");
                $stmt->bindParam(':u', $username);
                $stmt->bindParam(':p', $password);
                $stmt->bindParam(':f', $first);
                $stmt->bindParam(':l', $last);
                $stmt->bindParam(':e', $email);
                $stmt->bindParam(':d', $dob);
                $stmt->bindParam(':r', $ruserid);
                $stmt->bindParam(':phone', $phone);
                $stmt->execute();

                // Log in
                $stmt = $d->conn->prepare("SELECT * FROM comp353.Member WHERE UName = :u");
                $stmt->bindParam(':u', $username);
                $stmt->execute();

                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                $em = $result['Email'];
                $p = $result['Password'];
                $id = $result['UserId'];
                $priv = $result['Privilege'];

                LaunchSession($username, $em, $p, $id, $priv);
            } else {
                echo "Referrer does not exist";
                Failure();
            }
        }
    }

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
