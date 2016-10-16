
<!DOCTYPE html>
<html>
<head>
	<title> <?php echo($title); ?> </title>
	<!-- This section is for the Head -->
	<?php include($_SERVER['DOCUMENT_ROOT']. 'public/view/include/Head.php');?>
</head>
<body>

	<!-- This Section is for the Navigation file -->
	<?php include($_SERVER['DOCUMENT_ROOT']. 'public/view/include/Header.php');?>
    <!-- Include Content -->
	<div><?php echo $this_page; ?></div>
	<!-- This Section is for the footer -->
	<?php include($_SERVER['DOCUMENT_ROOT']. 'public/view/include/Footer.php');?>
</body>
</html>
