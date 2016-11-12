<?php
session_start();
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
