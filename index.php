<!DOCTYPE html>
<html>
<head>
	<title> Home </title>
	<!-- This section is for the Head -->
	<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Head.php');?>
</head>
<body>
	<!-- Page Content -->
	<!-- This Section is for the Navigation file -->
	<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Header.php');?>
    <!-- INCLUDE CONTENT OF PAGE HERE -->

    <div class="site-wrapper" id="page-content-wrapper">

        <div class="site-wrapper-inner">

            <div class="cover-container">

                <div class="inner cover">
                    <h1 class="cover-heading">Welcome, Stella!</h1>
                    <p class="lead">EZ-RIDERZ is your best option for ride-sharing.</p>
                    <p class="lead">
                        <a href="#" class="btn btn-lg btn-default">Get started</a>
                    </p>
                </div>

            </div>

        </div>

    </div>

    <!-- END OF CONTENT --> 
	<div><?php echo $this_page; ?></div>
	<!-- This Section is for the footer -->
	<!-- ?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Footer.php');? -->
	


</body>
</html>

