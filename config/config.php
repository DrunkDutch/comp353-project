<?php

include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbconf.php');
// Include Value and Setting For the user and Connection...
function goat(){
	if(ConnectionCheck()){
		return "Yes";	
	}
	else{
		return "NO";	
	}
}


 ?>
