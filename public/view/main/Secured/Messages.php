<!DOCTYPE html>
<html>
<head>
    <title> Review </title>
    <!-- This section is for the Head -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Head.php'); ?>
    <script>
        function showMessages() {
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("messages").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "/comp353-project/app/getMessages.php", true);
            xmlhttp.send();
        }
        showMessages();
    </script>
</head>
<body>
<!-- Page Content -->
<!-- This Section is for the Navigation file -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Header.php'); ?>
<!-- INCLUDE CONTENT OF PAGE HERE -->
<div id="page-content-wrapper">
    <h1>My Rating</h1>
    <div class="row">
        <div class="text-center">
            <i class="fa fa-commenting fa-5x" aria-hidden="true"></i>
        </div>
    </div>
    <div id="messages"><p>My messages</p></div>
</div>
<!-- END OF CONTENT -->
<div><?php echo $this_page; ?></div>
<!-- This Section is for the footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Footer.php'); ?>

</body>
</html>

