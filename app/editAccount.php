<?php
//Authors: 26290515, 26795528, 27417888, 40039346

if (session_status() == PHP_SESSION_NONE) { session_start(); }

include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/config.php');
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');

// Field information
$username = $_POST['username'];
$first = $_POST['FirstName'];
$last = $_POST['LastName'];
$email = $_POST['email1'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$dob = $_POST['dob'];
$permit = $_POST['permit'];
$insurance = $_POST['insurance'];
$active = $_POST['active'];
$suspended = $_POST['suspended'];
$privilege = $_POST['privilege'];

if (!empty($username)) {
    UpdateUniqueField('UName', $username);
}
if (!empty($first)) {
    UpdateField('FName', $first);
}
if (!empty($last)) {
    UpdateField('LName', $last);
}
if (!empty($email)) {
    UpdateField('Email', $email);
}
if (!empty($password)) {
    UpdateField('Password', $password);
}
if (!empty($phone)) {
    UpdateField('Phone', $phone);
}
if (!empty($dob)) {
    $dob_array = explode('-',$dob);

    if (count($dob_array) != 3 || strlen($dob_array[0]) != 4 || strlen($dob_array[1]) != 2 || strlen($dob_array[2]) != 2)
    {
        Failure('Date of birth format is incorrect' . $dob_array[0] . ' '.$dob_array[1] . ' '. $dob_array[2]);
    }
    else if (!is_numeric($dob_array[0]) || !is_numeric($dob_array[1]) || !is_numeric($dob_array[2]) || !checkdate($dob_array[1], $dob_array[2], $dob_array[0])) {
        Failure('Date of birth invalid');
    }
    else {
        UpdateField('DOB', $dob);
    }
}
if (!empty($permit)) {
    UpdateField('Permit', $permit);
}
if (!empty($insurance)) {
    UpdateField('Insurance', $insurance);
}
if (!empty($active)) {
    UpdateField('Active', $active);
}
if (!empty($suspended)) {
    UpdateField('Suspended', $suspended);
}
if (!empty($privilege)) {
    UpdateField('Privilege', $privilege);
}


Redirect();

function UpdateField($fieldName, $value) {
    $status = Connected();
    if($status == 1) {
        try {
            $d = new dbMakeConnection;
        } catch (PDOException $e) {
            echo($e);
        }

        $userId = $_SESSION['UserId'];
        $editId = $_SESSION['editId'];

        // if admin or root
        if ($editId) {
            $userId = $editId;
        }

        $stmt = $d->conn->prepare("UPDATE ".$GLOBALS['db_name'].".`Member` SET ". $fieldName. " = :v WHERE `UserId` = :i");
        $stmt->bindParam(':v', $value);
        $stmt->bindParam(':i', $userId);
        $stmt->execute();

    }
}

function UpdateUniqueField($fieldName, $value) {
    $status = Connected();
    if($status == 1) {
        try {
            $d = new dbMakeConnection;
        } catch (PDOException $e) {
            echo($e);
        }

        // Check if username already exists
        $stmt = $d->conn->prepare("SELECT * FROM ".$GLOBALS['db_name'].".Member WHERE UName = :u");
        $stmt->bindParam(':u', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            Failure($fieldName . " already exists");
        }
        else {
            $userId = $_SESSION['UserId'];
            $editId = $_SESSION['editId'];

            $stmt = $d->conn->prepare("UPDATE ".$GLOBALS['db_name'].".`Member` SET ". $fieldName. " = :v WHERE `UserId` = :i");
            $stmt->bindParam(':v', $value);
            $stmt->bindParam(':i', $userId);
            if ($editId) {
                $stmt->bindParam(':i', $editId);
            }
            $stmt->execute();

        }
    }
}

function Redirect() {
    $url = "http://" . $_SERVER['SERVER_NAME']. '/comp353-project/public/view/main/Secured/Account.php?id=' . $_SESSION['UserId'];
    header("Location:".$url." ");
}

function Failure($msg) {
    $urlAndAlert = "http://" . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/Account.php?id=' . $_SESSION['UserId'] . '&error=' . $msg;
    header("Location:" . $urlAndAlert . " ");
}