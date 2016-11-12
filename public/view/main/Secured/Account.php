<!DOCTYPE html>
<html>
<head>
	<title> Account </title>
	<!-- This section is for the Head -->
	<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Head.php');?>
</head>
<body>
	<!-- Page Content -->
	<!-- This Section is for the Navigation file -->
	<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Header.php');?>
    <!-- INCLUDE CONTENT OF PAGE HERE -->

    <div id="page-content-wrapper">


    <p> Account page COMP353</p>
        <img src="http://localhost/comp353-project/public/media/covoiturage.jpg" class="img-rounded img-centered" alt="Car and People" height="20%" width="20%" >

        <div class="text-centered">
        Name: Stella Lee
        <br />
        Email: stuff
        <br />
        DOB: stuff
        <br />
        Balance: $999999
        <br />
        Phone: stuff
        <br />
        Permit Number: stuff
        <br />
        Insurance Number: stuff
        </div>
    </div>

    <!-- END OF CONTENT -->
	<div><?php echo $this_page; ?></div>
	<!-- This Section is for the footer -->
	<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Footer.php');?>
	
</body>
</html>

