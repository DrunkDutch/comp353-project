<!DOCTYPE html>
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

    <a href="/comp353-project/public/view/main/Secured/Report-Page1.php"><button class="btn btn-secondary">Posting</button></a></div>$nbsp;
    <a href="/comp353-project/public/view/main/Secured/Report-Page2.php"><button class="btn btn-secondary">Rides Offered</button></a></div>$nbsp;
    <a href="/comp353-project/public/view/main/Secured/Report-Page3.php"><button class="btn btn-secondary">Rides Used</button></a></div>$nbsp;
    <a href="/comp353-project/public/view/main/Secured/Report-Page4.php"><button class="btn btn-secondary">Other Services</button></a></div>
    <a href="/comp353-project/public/view/main/Secured/Report-Page5.php"><button class="btn btn-secondary">Privilege Type</button></a></div>

</div>
<!-- END OF CONTENT -->
<div><?php echo $this_page; ?></div>
<!-- This Section is for the footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Footer.php'); ?>

</body>
</html>
