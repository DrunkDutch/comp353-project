<!DOCTYPE html>
<!--Authors: 26290515, 26795528, 27417888, 40039346-->
<html>
<head>
    <title> Report </title>
    <!-- This section is for the Head -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Head.php'); ?>
</head>
<body>
<!-- Page Content -->
<!-- This Section is for the Navigation file -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Header.php'); ?>
<!-- INCLUDE CONTENT OF PAGE HERE -->
<div id="page-content-wrapper">
    <h1>Report</h1>

    <a href="/comp353-project/public/view/main/Secured/Report-Details.php?page=1"><button class="btn btn-default">Posting</button></a></div>
    <a href="/comp353-project/public/view/main/Secured/Report-Details.php?page=2"><button class="btn btn-default">Rides Offered</button></a></div>
    <a href="/comp353-project/public/view/main/Secured/Report-Details.php?page=3"><button class="btn btn-default">Rides Used</button></a></div>
    <a href="/comp353-project/public/view/main/Secured/Report-Details.php?page=4"><button class="btn btn-default">Privilege Type</button></a></div>
    <a href="/comp353-project/public/view/main/Secured/Report-Details.php?page=5"><button class="btn btn-default">User Status</button></a></div>
    <a href="/comp353-project/public/view/main/Secured/Report-Details.php?page=6"><button class="btn btn-default">Balance Status</button></a></div>

</div>
<!-- END OF CONTENT -->
<div><?php echo $this_page; ?></div>
<!-- This Section is for the footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Footer.php'); ?>

</body>
</html>
