
<!DOCTYPE html>
<html>
<head>
	<title> Rides </title>
	<!-- This section is for the Head -->
	<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Head.php');?>

</head>
<body>
	<!-- Page Content -->
	<!-- This Section is for the Navigation file -->
	<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Header.php');?>
    <!-- INCLUDE CONTENT OF PAGE HERE -->
    <div id="page-content-wrapper">
    <h1>Current Rides</h1>
            <div class="container" style="border-style:solid; border-width:3px; height:90%; overflow-y:scroll;" id="rides">  
<?php 

function GetDataForRide(){
	include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');
	
	$status = Connected();
		if($status == 1){
		try{
			$d = new dbMakeConnection;
		}
		
		catch(PDOException $e){ echo($e);}

		$stmt = $d->conn->prepare("SELECT * FROM comp353.Ride");
        	$stmt->execute();
		$result = $stmt->fetchAll();
		
		
		foreach($result as&$val){
		
		$r = $val["Date"];
		$t = $val["DepartTime"];
		echo '<div class="row" style="height:150px;border-style:solid; border-width:3px;"><p style="margin-top:20px;">Destination:&nbsp</p><p>Departure time:&nbsp'.$r.'&nbspat:&nbsp'.$t. '&nbsp</p><a href="#"><button class="btn btn-success">Get Details</button></a></div>';
		}

		
	}

}
GetDataForRide();

?>
           
<div class="row" style="height:150px;border-style:solid; border-width:3px;"><p>Destination:&nbsp</p><p>Departure time:&nbsp2016-11-18&nbspat:&nbsp09:00:00&nbsp</p><a href="#"><button class="btn btn-success">Get Details</button></a></div>
	</div>

    </div>
    <!-- END OF CONTENT -->
	<div><?php echo $this_page; ?></div>
	<!-- This Section is for the footer -->
	<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Footer.php');?>
</body>
</html>

