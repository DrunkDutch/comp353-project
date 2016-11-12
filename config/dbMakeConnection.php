<?php 

class dbMakeConnection {
    public $conn;
    public function __construct()
    {
        
        $this->host = "localhost"; // Host name
        $this->username = "root";
        $this->password = "root"; // Mysql password
        $this->db_name = "comp353"; // Database name
        //$this->tbl_prefix = $tbl_prefix; // Prefix for all database tables
       // $this->tbl_members = $tbl_members;
        //$this->tbl_attempts = $tbl_attempts;
        // Connect to server and select database.
	//echo($this.password);
        $this->conn = new PDO('mysql:host='.$host.';dbname='. $db_name, $this->username, $this->password); 
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    }
}
	



?>
