<!DOCTYPE html>
<html>
<head>
    <title> Sign Up </title>
    <!-- This section is for the Head -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Head.php'); ?>
</head>
<body>
<!-- Page Content -->
<!-- This Section is for the Navigation file -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Header.php'); ?>
<!-- INCLUDE CONTENT OF PAGE HERE -->
<div id="page-content-wrapper">
    <div class="row">
        <div class="text-center"><i class="fa fa-user-circle-o  fa-5x" aria-hidden="true"></i>
        </div>
    </div>
    <form class="container-fluid col-md-4 col-md-offset-4" style="margin-bottom:300px;"
          action="/comp353-project/app/signup_function.php" method="post">
        <div class="form-group">
            <label for="Username">Username</label>
            <input type="text" name="username" class="form-control" aria-describedby="UsernameHelp"
                   id="exampleInputUsername1" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="FirstName">First Name</label>
            <input type="text" name="FirstName" class="form-control" aria-describedby="FirstnameHelp"
                   id="exampleInputFirstName1" placeholder="First Name">
        </div>
        <div class="form-group">
            <label for="LastName">Last Name</label>
            <input type="text" name="LastName" class="form-control" aria-describedby="LastnameHelp"
                   id="exampleInputLastName1" placeholder="Last Name">
        </div>
        <div class="form-group">
            <label for="Email">Email</label>
            <input type="email" name="email1" class="form-control" aria-describedby="emailHelp" id="exampleInputEmail1"
                   placeholder="Email">
        </div>
        <div class="form-group">
            <label for="Confirm Email">Confirm Email</label>
            <input type="email" name="email2" class="form-control" aria-describedby="emailHelp" id="exampleInputEmail1"
                   placeholder="Confirm Email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password1" class="form-control" id="exampleInputPassword1"
                   placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input type="password" name="password2" class="form-control" id="exampleInputPassword1"
                   placeholder="Confirm Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPhone1">Phone</label>
            <input type="text" name="phone" class="form-control" aria-describedby="PhoneHelp" id="exampleInputPhone1"
                   placeholder="514-xxx-xxxx">
        </div>
        <div class="form-group">
            <label for="DOB">Date of Birth</label>
            <input type="text" name="dob" class="form-control" aria-describedby="DOBHelp" id="exampleInputDOB"
                   placeholder="2016-12-31">
        </div>
        <div class="form-group">
            <label for="exampleInputRUsername">Referrer's Username</label>
            <input type="text" name="rusername" class="form-control" aria-describedby="RUsernameHelp"
                   id="exampleInputRUsername" placeholder="Referrer's Username">
        </div>
        <div class="form-group">
            <label for="exampleInputPermit">Driver's Permit Number (Optional)</label>
            <input type="text" name="permit" class="form-control" aria-describedby="PermitHelp" id="exampleInputPermit"
                   placeholder="xxxx-xxxx">
        </div>
        <div class="form-group">
            <label for="exampleInputInsurance">Insurance Policy Number (Optional)</label>
            <input type="text" name="insurance" class="form-control" aria-describedby="InsuranceHelp"
                   id="exampleInputInsurance" placeholder="xxxx-xxxx">
        </div>
        <button type="reset" class="btn btn-danger">Clear</button>
        <button type="submit" class="btn btn-success">Create Account</button>

    </form>
    <p class="lead">
        <a href="/comp353-project/public/view/main/LOG_IN.php">Already have an account? Log in</a>
    </p>
</div>
<!-- END OF CONTENT -->
<div><?php echo $this_page; ?></div>
<!-- This Section is for the footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Footer.php'); ?>

</body>
</html>

