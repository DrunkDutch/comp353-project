<?php
//Authors: 26290515, 26795528, 27417888, 40039346

if (session_status() == PHP_SESSION_NONE) {
	 session_start();
	  
     }
include_once($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/config.php');
include_once($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');
$_SESSION['Authen'] = false;

// Field information
$username = $_POST['username'];
$first = $_POST['FirstName'];
$last = $_POST['LastName'];
$email = $_POST['email1'];
$email2 = $_POST['email2'];
$password = $_POST['password1'];
$password2 = $_POST['password2'];
$phone = $_POST['phone'];
$dob = $_POST['dob'];
$balance = $_POST['balance'];
$rfirst = $_POST['rfname'];
$remail = $_POST['remail'];
$rdob = $_POST['rdob'];
$permit = $_POST['permit'];
$insurance = $_POST['insurance'];

// Check if required fields are filled out
if ((!empty($username) and !empty($first) and !empty($last) and
    !empty($email) and !empty($password) and !empty($phone) and
    !empty($dob) and !empty($rfirst) and !empty($remail) and !empty($rdob) and !empty($balance))
) {
    if ((strcmp($password, $password2) != 0)) {
        Failure('Passwords do not match');
    }
    else if ((strcmp($email, $email2) != 0)) {
        Failure('Emails do not match');
    }
    else {
        $dob_array = explode('-',$dob);
        $rdob_array = explode('-',$rdob);

        if (count($dob_array) != 3 || strlen($dob_array[0]) != 4 || strlen($dob_array[1]) != 2 || strlen($dob_array[2]) != 2)
        {
            Failure('Date of birth format is incorrect' . $dob_array[0] . ' '.$dob_array[1] . ' '. $dob_array[2]);
        }
        else if (!is_numeric($dob_array[0]) || !is_numeric($dob_array[1]) || !is_numeric($dob_array[2]) || !checkdate($dob_array[1], $dob_array[2], $dob_array[0])) {
            Failure('Date of birth invalid');
        }
        else if (count($rdob_array) != 3 || strlen($rdob_array[0]) != 4 || strlen($rdob_array[1]) != 2 || strlen($rdob_array[2]) != 2)
        {
            Failure('Referrer date of birth format is incorrect' . $rdob_array[0] . ' '.$rdob_array[1] . ' '. $rdob_array[2]);
        }
        else if (!is_numeric($rdob_array[0]) || !is_numeric($rdob_array[1]) || !is_numeric($rdob_array[2]) || !checkdate($rdob_array[1], $rdob_array[2], $rdob_array[0])) {
            Failure('Referrer date of birth invalid');
        }
        // If permit and insurance info filled, create driver
        else if (!((empty($insurance)) and (empty($permit)))) {
            CreateDriver($username, $first, $last, $email, $password, $phone, $dob, $rfirst, $remail, $rdob, $insurance, $permit, $balance);
        } // Create rider
        else {
            CreateRider($username, $first, $last, $email, $password, $phone, $dob, $rfirst, $remail, $rdob, $balance);
        }
    }
} else {
    Failure('Not all required fields are filled out');
}

function Failure($msg)
{
    $_SESSION['Authen'] = false;
    $urlAndAlert = "http://" . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/Sign_up.php?error=' . $msg;
    header("Location:" . $urlAndAlert . " ");
}

function CreateDriver($username, $first, $last, $email, $password, $phone, $dob, $rfirst, $remail, $rdob, $insurance, $permit, $balance)
{
    $status = Connected();
    if ($status == 1) {
        try {
            $d = new dbMakeConnection;
        } catch (PDOException $e) {
            echo($e);
        }

        // Check if username already exists
        $stmt = $d->conn->prepare("SELECT * FROM " . $GLOBALS['db_name'] . ".Member WHERE UName = :u");
        $stmt->bindParam(':u', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            Failure('User already exists');
        } else {
            $stmt = $d->conn->prepare("SELECT `UserId` FROM `".$GLOBALS['db_name'].".`Member` where Email like :e and DOB = date(:d) and FName like :f");
            $stmt->bindParam(':e', $remail);
            $stmt->bindParam(':d', $rdob);
            $stmt->bindParam(':f', $rfirst);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {

                $ruserid = $result['UserId'];

                // Create user
                $stmt = $d->conn->prepare("INSERT INTO `" . $GLOBALS['db_name'] . "`.`Member`(`UName`,`Password`,`FName`,`LName`,`Email`,`DOB`,`ReferrerID`,`Balance`,`Privilege`,`Phone`,`Permit`,`Insurance`)VALUES(:u,:p,:f,:l,:e,:d,:r,:b,3,:phone,:per,:i)");
                $stmt->bindParam(':u', $username);
                $stmt->bindParam(':p', $password);
                $stmt->bindParam(':f', $first);
                $stmt->bindParam(':l', $last);
                $stmt->bindParam(':e', $email);
                $stmt->bindParam(':d', $dob);
                $stmt->bindParam(':r', $ruserid);
                $stmt->bindParam(':b', $balance);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':per', $permit);
                $stmt->bindParam(':i', $insurance);
                $stmt->execute();

                // Log in
                $stmt = $d->conn->prepare("SELECT * FROM " . $GLOBALS['db_name'] . ".Member WHERE UName = :u");
                $stmt->bindParam(':u', $username);
                $stmt->execute();

                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                $em = $result['Email'];
                $p = $result['Password'];
                $id = $result['UserId'];
                $priv = $result['Privilege'];

                LaunchSession($username, $em, $p, $id, $priv);
            } else {
                Failure('Referrer does not exist');
            }
        }
    }

}

function CreateRider($username, $first, $last, $email, $password, $phone, $dob, $rfirst, $remail, $rdob, $balance)
{
    $status = Connected();
    if ($status == 1) {
        try {
            $d = new dbMakeConnection;
        } catch (PDOException $e) {
            echo($e);
        }

        // Check if username already exists
        $stmt = $d->conn->prepare("SELECT * FROM " . $GLOBALS['db_name'] . ".Member WHERE UName = :u");
        $stmt->bindParam(':u', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            Failure('User already exists');
        } else {
            $stmt = $d->conn->prepare("SELECT `UserId` FROM `" . $GLOBALS['db_name'] . "`.`Member` where Email like :e and DOB = date(:d) and FName like :f");
            $stmt->bindParam(':e', $remail);
            $stmt->bindParam(':d', $rdob);
            $stmt->bindParam(':f', $rfirst);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {

                $ruserid = $result['UserId'];

                // Create user
                $stmt = $d->conn->prepare("INSERT INTO `" . $GLOBALS['db_name'] . "`.`Member`(`UName`,`Password`,`FName`,`LName`,`Email`,`DOB`,`ReferrerID`,`Balance`,`Privilege`,`Phone`)VALUES(:u,:p,:f,:l,:e,:d,:r,:b,3,:phone)");
                $stmt->bindParam(':u', $username);
                $stmt->bindParam(':p', $password);
                $stmt->bindParam(':f', $first);
                $stmt->bindParam(':l', $last);
                $stmt->bindParam(':e', $email);
                $stmt->bindParam(':d', $dob);
                $stmt->bindParam(':r', $ruserid);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':b', $balance);
                $stmt->execute();

                // Log in
                $stmt = $d->conn->prepare("SELECT * FROM " . $GLOBALS['db_name'] . ".Member WHERE UName = :u");
                $stmt->bindParam(':u', $username);
                $stmt->execute();

                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                $em = $result['Email'];
                $p = $result['Password'];
                $id = $result['UserId'];
                $priv = $result['Privilege'];

                LaunchSession($username, $em, $p, $id, $priv);
            } else {
                Failure('Referrer does not exist');
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
