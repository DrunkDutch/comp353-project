<!-- THIS FILE IS ONLY A TEMPLATE OF WHAT YOU CAN DO  -->
<!DOCTYPE html>
<html>
<head>
	<title>SAMPLE LAYOUT </title>
	<!-- This section is for the Head -->
	<?php include($_SERVER['DOCUMENT_ROOT']. 'public/view/include/Head.php');?>
</head>
<body>

	<!-- This Section is for the Navigation file -->
	<?php include($_SERVER['DOCUMENT_ROOT']. 'public/view/include/Header.php');?>
    <!-- START CONTENT -->
    <p> this is a layout page</p>
    <!-- END CONTENT --> 
	<div><?php echo $this_page; ?></div>
	<!-- This Section is for the footer -->
	<?php include($_SERVER['DOCUMENT_ROOT']. 'public/view/include/Footer.php');?>
</body>
</html>
