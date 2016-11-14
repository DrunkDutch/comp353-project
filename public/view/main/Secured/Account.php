<!DOCTYPE html>
<html>
<head>
	<title> Account </title>
	<!-- This section is for the Head -->
	<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Head.php');?>
    <script>
        function showUserDetails() {
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("userInfo").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","/comp353-project/app/getUser.php",true);
            xmlhttp.send();
        }
        showUserDetails();
    </script>
</head>
<body>
	<!-- Page Content -->
	<!-- This Section is for the Navigation file -->
	<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Header.php');?>
    <!-- INCLUDE CONTENT OF PAGE HERE -->

    <div id="page-content-wrapper">


    <h1>My Account</h1>

        <div id="userInfo"><p>User Account Info</p></div>

    </div>

    <!-- END OF CONTENT -->
	<div><?php echo $this_page; ?></div>
	<!-- This Section is for the footer -->
	<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Footer.php');?>
	
</body>
</html>

