<!DOCTYPE html>
<html>
<head>
    <title> New Ride </title>
    <!-- This section is for the Head -->
    <?php include("../../include/Head.php"); ?>
</head>
<body>
<!-- Page Content -->
<!-- This Section is for the Navigation file -->
<?php include("../../include/Header.php"); ?>
<!-- INCLUDE CONTENT OF PAGE HERE -->
<div id="page-content-wrapper">
    <h1>Create Ride</h1>

    <div class="row"><div class="text-center"><i class="fa fa-car fa-5x" aria-hidden="true"></i>
        </div></div>
    <?php include "../app/createRide.php"?>
    <form class="container-fluid col-md-4 col-md-offset-4" action="/comp353-project/app/createRide.php" method="POST">

        <!-- TO DO: NEED TO UPDATE THESE FIELDS -->
        <div class="form-group">
            <label for="Date">Date</label>
            <input type="date" name="date" class="form-control" aria-describedby="dateHelp" id="exampleInputdate" placeholder="2016-12-31">
        </div>
        <div class=form-group>
            <label for="username">Departure Time</label>
            <input type="text" name="user" class="form-control" aria-describedby="UsernameHelp"  id="exampleInputEmail1" placeholder="Enter Username">
        </div>
        <div class=form-group>
            <label for="username">Repeating</label>
            <input type="text" name="user" class="form-control" aria-describedby="UsernameHelp"  id="exampleInputEmail1" placeholder="Enter Username">
        </div>
        <div class=form-group>
            <label for="username">Depature Street Number</label>
            <input type="text" name="user" class="form-control" aria-describedby="UsernameHelp"  id="exampleInputEmail1" placeholder="Enter Username">
        </div>
        <div class=form-group>
            <label for="username">Depature Street</label>
            <input type="text" name="user" class="form-control" aria-describedby="UsernameHelp"  id="exampleInputEmail1" placeholder="Enter Username">
        </div>
        <div class=form-group>
            <label for="username">Depature City</label>
            <input type="text" name="user" class="form-control" aria-describedby="UsernameHelp"  id="exampleInputEmail1" placeholder="Enter Username">
        </div>
        <div class=form-group>
            <label for="username">Depature Province</label>
            <input type="text" name="user" class="form-control" aria-describedby="UsernameHelp"  id="exampleInputEmail1" placeholder="Enter Username">
        </div>
        <div class=form-group>
            <label for="username">Depature Postal Code</label>
            <input type="text" name="user" class="form-control" aria-describedby="UsernameHelp"  id="exampleInputEmail1" placeholder="Enter Username">
        </div>
        <div class=form-group>
            <label for="username">Destination Street Number</label>
            <input type="text" name="user" class="form-control" aria-describedby="UsernameHelp"  id="exampleInputEmail1" placeholder="Enter Username">
        </div>
        <div class=form-group>
            <label for="username">Destination Street</label>
            <input type="text" name="user" class="form-control" aria-describedby="UsernameHelp"  id="exampleInputEmail1" placeholder="Enter Username">
        </div>
        <div class=form-group>
            <label for="username">Destination City</label>
            <input type="text" name="user" class="form-control" aria-describedby="UsernameHelp"  id="exampleInputEmail1" placeholder="Enter Username">
        </div>
        <div class=form-group>
            <label for="username">Destination Province</label>
            <input type="text" name="user" class="form-control" aria-describedby="UsernameHelp"  id="exampleInputEmail1" placeholder="Enter Username">
        </div>
        <div class=form-group>
            <label for="username">Destination Postal Code</label>
            <input type="text" name="user" class="form-control" aria-describedby="UsernameHelp"  id="exampleInputEmail1" placeholder="Enter Username">
        </div>
        <div class=form-group>
            <label for="username">Distance (Need better descriptor)</label>
            <input type="text" name="user" class="form-control" aria-describedby="UsernameHelp"  id="exampleInputEmail1" placeholder="5 (in km)">
        </div>
        <div class=form-group>
            <label for="username">Rider Capacity</label>
            <input type="text" name="user" class="form-control" aria-describedby="UsernameHelp"  id="exampleInputEmail1" placeholder="4">
        </div>
        <div class=form-group>
            <label for="username">Are you driving or just riding?</label>
            <input type="radio" name="riderType"
                <?php if (isset($riderType) && $riderType=="driving") echo "checked";?>
                   value="driving">Driving
            <input type="radio" name="riderType"
                <?php if (isset($riderType) && $riderType=="riding") echo "checked";?>
                   value="riding">Riding
        </div>

        <button
        <button type="reset" class="btn btn-danger">Reset</button>
        <input type="submit" value="click" class="btn btn-primary">
    </form>
</div>

</div>
<!-- END OF CONTENT -->
<div><?php echo $this_page; ?></div>
<!-- This Section is for the footer -->
<?php include("../../include/Footer.php"); ?>

</body>
</html>

