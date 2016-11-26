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
<form method="POST" action="/comp353-project/app/createRide.php">
<div class="container">
  <h2>Create A ride</h2>
  <ul class="nav nav-tabs" style="border-style:none; display:none;">
    <li class="active"><a href="#home">Destination</a></li>
    <li><a href="#menu1">Departure</a></li>
    <li><a href="#menu2">Date</a></li>
    <li><a href="#menu3">Driver/Rider</a></li>
    <li><a href="#menu4">Post</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>Departure</h3>
      <p>Departure field</p>
	<a href="#menu1" data-toggle="tab"><button class="btn btn-primary">Next Step</button></a>
	
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Destination</h3>
      <p>Destination Field</p>
	<a href="#home" data-toggle="tab"><button class="btn btn-danger">Previous Step</button></a>
	<a href="#menu2" data-toggle="tab"><button class="btn btn-primary">Next Step</button></a>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Date</h3>
      <p>Date field</p>
	<a href="#menu1" data-toggle="tab"><button class="btn btn-danger">Previous Step</button></a>
	<a href="#menu3" data-toggle="tab"><button class="btn btn-primary">Next Step</button></a>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Driver or Rider ?</h3>
      <p>Drier Rider field</p>
	<a href="#menu2" data-toggle="tab"><button class="btn btn-danger">Previous Step</button></a>
	<a href="#menu4" data-toggle="tab"><button class="btn btn-primary">Next Step</button></a>
    </div>
    <div id="menu4" class="tab-pane fade">
      <h3>Post</h3>
      <p>Ride Posting...</p>
	<a href="#menu3" data-toggle="tab"><button class="btn btn-danger">Previous Step</button></a>
	<Input type="submit" class="btn btn-success" value="Post">
    </div>
  </div>
</div>
</form>
<script>
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
});
</script>
</div>
<!-- END OF CONTENT -->
<div><?php echo $this_page; ?></div>
<!-- This Section is for the footer -->
<?php include("../../include/Footer.php"); ?>

</body>
</html>

