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
    <form class="container-fluid col-md-4 col-md-offset-4" action="/comp353-project/app/resetAccount.php"
          method="POST">

        <div class=form-group>
            <label for="username">Username</label>
            <input type="text" name="user" class="form-control" aria-describedby="UsernameHelp" id="exampleInputEmail1"
                   placeholder="Enter New Username">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                   placeholder="Enter New Password">
        </div>
        <button
        <button type="reset" class="btn btn-danger">Reset</button>
        <input type="submit" value="Log in" class="btn btn-primary">
    </form>
    <?php
    if (isset($_SESSION['Authen'])) {
        if (!$_SESSION['Authen']) {
            echo("<div class='row' style='margin-top:30px;height:70px; background-color:red; color:white;'><p style='padding-top:20px; font-size:20px;'>Wrong password/Username/Email</p></div>");
        }
        if ($_SESSION['Authen']) {
            echo("<div class='row' style='margin-top:30px;height:70px; background-color:green; color:white;'><p style='padding-top:20px; font-size:20px;'>You are logged in</p></div>");
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

