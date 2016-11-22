<?php
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
    UpdateField('FName', $dob);
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

        $stmt = $d->conn->prepare(/*Update statement*/);
        $stmt->bindParam(':u', $username);
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
        $stmt = $d->conn->prepare("SELECT * FROM comp353.Member WHERE UName = :u");
        $stmt->bindParam(':u', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo "Username already exists";
        }
        else {
            $stmt = $d->conn->prepare(/* UPDATE STATEMENT */);
            $stmt->bindParam(':u', $username);
            $stmt->execute();
        }

    }
}

function Redirect() {
    $url = "http://" . $_SERVER['SERVER_NAME']. '/comp353-project/public/view/main/Secured/Account.php?id=' . $_SESSION['UserId'];
    header("Location:".$url." ");
}