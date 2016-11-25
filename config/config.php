<?php
session_start();
include('./dbconf.php');
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
