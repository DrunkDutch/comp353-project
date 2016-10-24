<!DOCTYPE html>
<html>
<head>
	<title> Home </title>
	<!-- This section is for the Head -->
	<?php include($_SERVER['DOCUMENT_ROOT']. 'public/view/include/Head.php');?>
</head>
<body>

	<!-- This Section is for the Navigation file -->
	<?php include($_SERVER['DOCUMENT_ROOT']. 'public/view/include/Header.php');?>
    <!-- INCLUDE CONTENT OF PAGE HERE -->
    <p> Hello FROM Home page COMP353</p>
    
    <!-- END OF CONTENT --> 
	<div><?php echo $this_page; ?></div>
	<!-- This Section is for the footer -->
	<?php include($_SERVER['DOCUMENT_ROOT']. 'public/view/include/Footer.php');?>
</body>
</html>

