<!DOCTYPE html>
<html>
<head>
	<?php session_start(); ?>
	<title> Home </title>
	<!-- This section is for the Head -->
	<?php include('./public/view/include/Head.php');?>
</head>
<body>
	<!-- Page Content -->
	<!-- This Section is for the Navigation file -->
	<?php include('./public/view/include/Header.php');?>
    <!-- INCLUDE CONTENT OF PAGE HERE -->

    <div class="site-wrapper" id="page-content-wrapper">

        <div class="site-wrapper-inner">

            <div class="cover-container">

                <div class="inner cover">
                    <h1 class="cover-heading">Welcome to SUPER!</h1>
                    <p class="lead">Your best option for ride-sharing.</p>
                    <p class="lead">
                        <a href="#" class="btn btn-lg btn-default">Get started</a>
                    </p>
                </div>

            </div>
	<?php
		if(!empty($_GET['alert'])){
		echo '<div class="row" style="background-color:orange; height:100px;margin-top:50px;"><h4>Alert:&nbsp'.$_GET['alert'].'</h4></div>';
		}

	?>

        </div>


    </div>

    <!-- END OF CONTENT --> 
	
	<!-- This Section is for the footer -->
	<!-- ?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Footer.php');? -->
	


</body>
</html>

