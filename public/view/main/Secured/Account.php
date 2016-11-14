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
                else {
                    console.log("stella1");
                }
            };
            xmlhttp.open("GET","/comp353-project/app/getUser.php",true);
            console.log("stella2");
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
<!--        <img src="http://localhost/comp353-project/public/media/covoiturage.jpg" class="img-rounded img-centered" alt="Car and People" height="20%" width="20%" >-->

        <div id="userInfo"><p>Stuff</p></div>
        <div>Stuff2</div>

<!--        <div class="text-centered">-->
<!--        Name: Stella Lee-->
<!--        <br />-->
<!--        Email: stuff-->
<!--        <br />-->
<!--        DOB: stuff-->
<!--        <br />-->
<!--        Balance: $999999-->
<!--        <br />-->
<!--        Phone: stuff-->
<!--        <br />-->
<!--        Permit Number: stuff-->
<!--        <br />-->
<!--        Insurance Number: stuff-->
<!--        </div>-->


    </div>

    <!-- END OF CONTENT -->
	<div><?php echo $this_page; ?></div>
	<!-- This Section is for the footer -->
	<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Footer.php');?>
	
</body>
</html>

