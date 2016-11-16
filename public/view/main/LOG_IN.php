<!DOCTYPE html>
<html>
<head>
	<title> Sign In </title>
	<!-- This section is for the Head -->
	<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Head.php');?>

</head>
<body>
	<!-- Page Content -->
	<!-- This Section is for the Navigation file -->
<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Header.php');?>
    <!-- INCLUDE CONTENT OF PAGE HERE -->
    <div id="page-content-wrapper">
	<div class="row"><div class="text-center"><i class="fa fa-car fa-5x" aria-hidden="true"></i>
</div></div>
<?php include "../app/login_function.php"?>
        <h1>Log In</h1>
    <form class="container-fluid col-md-4 col-md-offset-4" action="/comp353-project/app/login_function.php" method="POST">
	
	<div class="form-group">
    <label for="Email">Email</label>
    <input type="email" name="email" class="form-control" aria-describedby="emailHelp" id="exampleInputEmail1" placeholder="Enter Email">
    </div>
    <div class=form-group">
    <label> OR </label>
    </div>
    <div class=form-group>
	<label for="username">Username</label>
    <input type="text" name="user" class="form-control" aria-describedby="UsernameHelp"  id="exampleInputEmail1" placeholder="Enter Username">
    </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <button 
    <button type="reset" class="btn btn-danger">Reset</button>
    <input type="submit" value="Log in" class="btn btn-primary">
    </form>
    </div>
    <!-- END OF CONTENT --> 
	<div><?php echo $this_page; ?></div>
	<!-- This Section is for the footer -->
	<?php include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/public/view/include/Footer.php');?>
	
</body>
</html>

