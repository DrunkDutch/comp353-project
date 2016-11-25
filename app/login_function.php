<?php
include('../config/config.php');
include('../config/dbMakeConnection.php');



session_start();

$_SESSION['Authen'] = false;
$username = $_POST['user'];
$email = $_POST['email'];
$password = $_POST['password'];


if (!((empty($email)) and (empty($username)))) {
	
    if ((strcmp($username,'admin') == 0) and (strcmp($password,'admin') ==0)) 		{
	        
	ForceReset();
	
    	}
    if (!(empty($email))) {
	
        AuthentificationEmail($email, $password);
	
    } else {
        if (!(empty($username))) {
		
            AuthentificationUser($username, $password);
		
        }
    }
} else {
    Failure();
}

function Failure()
{

    $_SESSION['Authen'] = false;
    $url = "http://" . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/LOG_IN.php';
    header("Location:" . $url . " ");
}

// Check Login with DB assuming variable passed in are cleaned and not all empty
function AuthentificationUser($u, $p)
{
	
    $status = Connected();
	
    if ($status == 1) {
        try {
            $d = new dbMakeConnection;
		
        } catch (PDOException $e) {
            echo($e);
        }
	
        $stmt = $d->conn->prepare("SELECT * FROM ".$GLOBALS['db_name'].".Member WHERE UName = :u");
        $stmt->bindParam(':u', $u);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $passwordFromDB = $result['Password'];

        if (($result['Suspended'] == 0) && (strcmp($passwordFromDB, $p) == 0)) {
            $em = $result['Email'];
            $id = $result['UserId'];
            $priv = $result['Privilege'];
            LaunchSession($u, $em, $p, $id, $priv);
        } else {
            Failure();
        }
    }
}

function AuthentificationEmail($em, $p)
{
    $status = Connected();
	
    if ($status == 1) {
        try {
            $d = new dbMakeConnection;
        } catch (PDOException $e) {
            echo($e);
        }

        $stmt = $d->conn->prepare("SELECT * FROM ".$GLOBALS['db_name'].".Member WHERE Email = :e");
        $stmt->bindParam(':e', $em);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $passwordFromDB = $result['Password'];

        if (($result['Suspended'] == 0) && (strcmp($passwordFromDB, $p) == 0)) {
            $user = $result['UName'];
            $id = $result['UserId'];
            $priv = $result['Privilege'];
            LaunchSession($user, $em, $p, $id, $priv);
        } else {
            Failure();
        }
    }
}

function ForceReset() {
// Please explain to me what is this function...	
    $url = "http://" . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/ResetUser.php';
    header("Location:" . $url . " ");
	
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
    exit;
}

?>
