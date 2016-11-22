<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" id="menu-toggle2" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav" style="float:none">
                <li class="btn-default btn pull-left">
                    <button class="btn btn-default btn-menu" id="menu-toggle" style="text-decoration:none">MENU</button>
                </li>
                <a class="navbar-brand pull-right"
                   href="<?php echo('http://' . $_SERVER['SERVER_NAME'] . '/comp353-project/') ?>">EZ-RIDERZ</a>
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li>
                <?php if (!$_SESSION['Authen']) {
                    $url = 'http://' . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/LOG_IN.php';
                    echo("<a href='" . $url . "'>Log In</a>");
                }
                ?>
            </li>
            <li>
                <?php if (!$_SESSION['Authen']) {
                    $url = 'http://' . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/Sign_up.php';
                    echo("<a href='" . $url . "'>Sign Up</a>");
                }
                ?>
            </li>
            <li>
                <?php if ($_SESSION['Authen']) {
                    $url = 'http://' . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/logout.php';
                    echo("<a href='" . $url . "'>Log Out</a>");
                }
                ?>
            </li>
            <li>
                <?php if ($_SESSION['Authen']) {
                    $url = 'http://' . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/Secured/Account.php?id=' . $_SESSION['UserId'] . '';
                    echo("<a href='" . $url . "'>Account</a>");
                }
                ?>
            </li>
            <li>
                <?php if ($_SESSION['Authen']) {
                    $url = 'http://' . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/Secured/Drivers.php';
                    echo("<a href='" . $url . "'>Drivers Available</a>");
                }
                ?>
            </li>
            <li>
                <?php if ($_SESSION['Authen']) {
                    $url = 'http://' . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/Secured/Rides.php';
                    echo("<a href='" . $url . "'>Rides</a>");
                }
                ?>
            </li>
            <li>
                <?php if ($_SESSION['Authen']) {
                    $url = 'http://' . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/Secured/Reviews.php';
                    echo("<a href='" . $url . "'>Reviews</a>");
                }
                ?>
            </li>
            <li>
                <?php if ($_SESSION['Authen']) {
                    $url = 'http://' . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/Secured/Directory.php';
                    echo("<a href='" . $url . "'>User Directory</a>");
                }
                ?>
            </li>
            <li>
                <?php if ($_SESSION['Authen']) {
                    $url = 'http://' . $_SERVER['SERVER_NAME'] . '/comp353-project/public/view/main/Secured/Messages.php';
                    echo("<a href='" . $url . "'>Message Center</a>");
                }
                ?>
            </li>
        </ul>
    </div>


</div>
<!-- /#wrapper -->
<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    $("#menu-toggle2").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
