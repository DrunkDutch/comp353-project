<!DOCTYPE html>
<html>
<head>
	<title> Sign Up </title>
	<!-- This section is for the Head -->
 <?php include("../include/Head.php"); ?>
</head>
<body>
	<!-- Page Content -->
<?php include("../include/Header.php"); ?>
    <!-- INCLUDE CONTENT OF PAGE HERE -->
    <div id="page-content-wrapper">
    <div class="row"><div class="text-center"><i class="fa fa-user-circle-o  fa-5x" aria-hidden="true"></i>
</div></div>	
    <form class="container-fluid col-md-4 col-md-offset-4" style="margin-bottom:300px;" action="/comp353-project/app/signup_function.php" method="post">
	<div class="form-group">
    <label for="Username">Username</label>
    <input type="text" name="username" class="form-control" aria-describedby="UsernameHelp" id="exampleInputUsername1" placeholder="Username">
    </div>
    <div class="form-group">
    <label for="FirstName">First Name</label>
    <input type="text" name="FirstName" class="form-control" aria-describedby="FirstnameHelp" id="exampleInputFirstName1" placeholder="First Name">
    </div>
    <div class="form-group">
    <label for="LastName">Last Name</label>
    <input type="text" name="LastName" class="form-control" aria-describedby="LastnameHelp" id="exampleInputLastName1" placeholder="Last Name">
    </div>
	<div class="form-group">
    <label for="Email">Email</label>
    <input type="email" name="email1" class="form-control" aria-describedby="emailHelp" id="exampleInputEmail1" placeholder="Email">
    </div>
 	<div class="form-group">
    <label for="Confirm Email">Confirm Email</label>
    <input type="email" name="email2" class="form-control" aria-describedby="emailHelp" id="exampleInputEmail1" placeholder="Confirm Email">
    </div>   
    <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password1" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Confirm Password</label>
    <input type="password" name="password2" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
    </div>
    <div class="form-group">
    <label for="exampleInputPhone1">Phone</label>
    <input type="text" name="phone" class="form-control" aria-describedby="PhoneHelp" id="exampleInputPhone1" placeholder="514-xxx-xxxx">
    </div>
    <div class="form-group">
    <label for="DOB">Date of Birth</label>
    <input type="text" name="dob" class="form-control" aria-describedby="DOBHelp" id="exampleInputDOB" placeholder="2016-12-31">
    </div>
    <div class="form-group">
    <label for="exampleInputRUsername">Referrer's First Name</label>
    <input type="text" name="rfname" class="form-control" aria-describedby="RFnameHelp" id="exampleInputRFname" placeholder="Bob">
    </div>
    <div class="form-group">
    <label for="exampleInputRUsername">Referrer's Email</label>
    <input type="text" name="remail" class="form-control" aria-describedby="REmailHelp" id="exampleInputREmail" placeholder="Referrer@email.com">
    </div>
    <div class="form-group">
    <label for="exampleInputRUsername">Referrer's Date of Birth</label>
    <input type="text" name="rdob" class="form-control" aria-describedby="RDOBHelp" id="exampleInputRDOB" placeholder="2016-12-31">
    </div>
    <div class="form-group">
    <label for="exampleInputPermit">Driver's Permit Number (Optional)</label>
    <input type="text" name="permit" class="form-control" aria-describedby="PermitHelp" id="exampleInputPermit" placeholder="xxxx-xxxx">
    </div>
    <div class="form-group">
    <label for="exampleInputInsurance">Insurance Policy Number (Optional)</label>
    <input type="text" name="insurance" class="form-control" aria-describedby="InsuranceHelp" id="exampleInputInsurance" placeholder="xxxx-xxxx">
    </div>
    <button type="reset" class="btn btn-danger">Clear</button>
    <button type="submit" class="btn btn-success">Create Account</button>
    </form>

    <p>
        <a href="/comp353-project/public/view/main/LOG_IN.php">Already have an account? Log in</a>
    </p>

        <?php
        if(isset($_SESSION['Authen'])){
            if(!$_SESSION['Authen']){
                echo("<div class='row' style='margin-top:30px;height:70px; background-color:red; color:white;'><p style='padding-top:20px; font-size:20px;'>Not all fields filled or user already exists</p></div>");
            }
            if($_SESSION['Authen']){
                echo("<div class='row' style='margin-top:30px;height:70px; background-color:green; color:white;'><p style='padding-top:20px; font-size:20px;'>Account successfully created</p></div>");
            }
        }
        ?>

    </div>
    <!-- END OF CONTENT --> 
	<div><?php echo $this_page; ?></div>
	<!-- This Section is for the footer -->
<?php include("../include/Footer.php"); ?>
	
</body>
</html>

