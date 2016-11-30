<?php
//Authors: 26290515, 26795528, 27417888, 40039346

if (session_status() == PHP_SESSION_NONE) { session_start(); }
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbconf.php');
// Include Value and Setting For the user and Connection...
function Connected(){
	if(ConnectionCheck()){
		return true;	
	}
	else{
		return false;	
	}
}

 ?>
