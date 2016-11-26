<!DOCTYPE html>
<html>
<head>
    <title> Sign In </title>
    <!-- This section is for the Head -->
 <?php include("../include/Head.php"); ?>
</head>
<body>
<!-- Page Content -->
<!-- This Section is for the Navigation file -->
<?php include("../include/Header.php"); ?>
<!-- INCLUDE CONTENT OF PAGE HERE -->
<div id="page-content-wrapper">
    <?php include "../app/resetAccount.php" ?>
    <h1>Reset Username and Password</h1>
    <form class="container-fluid col-md-4 col-md-offset-4" action="/comp353-project/app/resetAccount.php"
          method="POST">

        <div class=form-group>
            <label for="username">New Username</label>
            <input type="text" name="user" class="form-control" aria-describedby="UsernameHelp" id="exampleInputEmail1"
                   placeholder="Enter New Username">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">New Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                   placeholder="Enter New Password">
        </div>
        <input type="submit" value="Reset" class="btn btn-primary">
    </form>

</div>
<!-- END OF CONTENT -->
<div><?php echo $this_page; ?></div>
<!-- This Section is for the footer -->
<?php include("../include/Footer.php"); ?>

</body>
</html>

