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
<form class="form-group" method="POST" action="/comp353-project/app/createRide.php">
<h2 style="margin-bottom:25px;margin-top:25px;"> Create your ride </h2>
<div class="container" style="border-style:solid;">
  <ul class="nav nav-tabs" style="border-style:none; display:none;">
    <li class="active"><a href="#home">Destination</a></li>
    <li><a href="#menu1">Departure</a></li>
    <li><a href="#menu2">Date</a></li>
    <li><a href="#menu3">Driver/Rider</a></li>
    <li><a href="#menu4">Post</a></li>
  </ul>

  <div class="tab-content" style="margin-bottom:30px;">
    <div id="home" class="tab-pane fade in active">
      <h3 style="margin-bottom:30px;">Departure</h3>
<div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="Depart_streetNumber">Street Number: </label>
<Input style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="Depart_streetNumber" type="text" value="">
</div>
<div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="Depart_street">Street Name: </label>
<Input style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="Depart_street" type="text" value="">
</div>

<div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="Depart_City">City: </label>
<Input style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="Depart_City" type="text" value="">
</div>
<div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="Depart_Prov">Province: </label>
<Input style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="Depart_Prov" type="text" value="">
</div>
<div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="Depart_ZIP">Postal Code: </label>
<Input style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="Depart_ZIP" type="text" value="">
</div>
	<a href="#menu1" data-toggle="tab"><button class="btn btn-primary">Next Step</button></a>
	
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Destination</h3>
      <div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="Des_streetNumber">Street Number: </label>
<Input style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="Des_streetNumber" type="text" value="">
</div>
<div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="Des_street">Street Name: </label>
<Input style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="Des_street" type="text" value="">
</div>

<div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="Des_City">City: </label>
<Input style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="Des_City" type="text" value="">
</div>
<div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="Des_Prov">Province: </label>
<Input style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="Des_Prov" type="text" value="">
</div>
<div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="Des_ZIP">Postal Code: </label>
<Input style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="Des_ZIP" type="text" value="">
</div>
	<a href="#home" data-toggle="tab"><button class="btn btn-danger">Previous Step</button></a>
	<a href="#menu2" data-toggle="tab"><button class="btn btn-primary">Next Step</button></a>
    </div>
    <div id="menu2" class="tab-pane fade">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <h3>Choose the right time</h3>

<div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="RDate">Date:</label>
<Input style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="RDate" id="datepicker" type="text" value="">
</div>
<div class="row form-group" style="margin-bottom:25px;">
<label class="form-check-label" for="RTime">Time:</label>
<Input style="margin:Auto; float:none; width:90%;" class="form-control text-muted" name="RTime"  type="text" value="">
</div>
<div class="row form-group" style="margin-bottom:25px;">

<h3 for="RRepeating">Repeating each:</h3>
<div class="row">
<label class="form-check-label" for="Rmon">Monday</label>
<Input style="margin:Auto; float:none;" class="form-check-input text-muted" name="RMon"  type="checkbox" value="Mon">

<div class="row">
<label class="form-check-label" for="RTue">Tuesday</label>
<Input style="margin:Auto; float:none;" class="form-check-input text-muted" name="RTue"  type="checkbox" value="Tue">
</div>

<div class="row">
<label class="form-check-label" for="RWes">Wednesday</label>
<Input style="margin:Auto; float:none;" class="form-check-input text-muted" name="RWes"  type="checkbox" value="Wes">
</div>

<div class="row">
<label class="form-check-label" for="RThur">Thursday</label>
<Input style="margin:Auto; float:none;" class="form-check-input text-muted" name="RThur"  type="checkbox" value="Thur">
</div>

<div class="row">
<label class="form-check-label" for="RFri">Friday</label>
<Input style="margin:Auto; float:none;" class="form-check-input text-muted" name="RFri"  type="checkbox" value="Fri">
</div>

<div class="row">
<label class="form-check-label" for="RSat">Saterday</label>
<Input style="margin:Auto; float:none;" class="form-check-input text-muted" name="RSat"  type="checkbox" value="Sat">
</div>

<div class="row" style="margin-bottom:25px;>
<label class="form-check-label" for="RSun">Sunday</label>
<Input style="margin:Auto; float:none;" class="form-check-input text-muted" name="RSun"  type="checkbox" value="Sun">
</div>

</div>
  <script>
 $(function(){
        $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
            var minValue = $(this).val();
            minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
            minValue.setDate(minValue.getDate()+1);
            $("#to").datepicker( "option", "minDate", minValue );
        })
    });
  </script>
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

