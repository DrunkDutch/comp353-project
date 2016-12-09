<?php
//Authors: 26290515, 26795528, 27417888, 40039346

class dbMakeConnection {
    public $conn;
    public function __construct()
    {
        
        $this->host = "tpc353_2.encs.concordia.ca"; // Host name
        $this->username = "tpc353_2";
        $this->password = "h3Y4JY"; // Mysql password
        $this->db_name = "tpc353_2"; // Database name
        //$this->tbl_prefix = $tbl_prefix; // Prefix for all database tables
       // $this->tbl_members = $tbl_members;
        //$this->tbl_attempts = $tbl_attempts;
        // Connect to server and select database.
	//echo($this.password);
        $this->conn = new PDO(
	'mysql:host=tpc353_2.encs.concordia.ca;dbname=tpc353_2', 
	$this->username, 
	$this->password); 
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    }
}
		



?>
