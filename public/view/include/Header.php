
 <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" id="menu-toggle2"   aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="http://localhost/comp353-project">Hubert</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav" style="float:none">
        <li class="btn-primary btn pull-right"><button class="btn btn-primary"  id="menu-toggle" style="color:white; text-decoration:none">MENU</button></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="http://localhost">
                        Home
                    </a>
                </li>
                <li>
                    <a href="http://localhost/comp353-project/public/view/main/LOG_IN.php">Sign In</a>
                </li>
                <li>
                    <a href="http://localhost/comp353-project/public/view/main/Sign_up.php">Sign Up</a>
                </li>
                <li>
                    <a href="http://localhost/comp353-project/public/view/main/Secured/Account.php">Account</a>
                </li>
                <li>
                    <a href="http://localhost/comp353-project/public/view/main/Secured/Drivers.php">Drivers Available</a>
                </li>
                <li>
                    <a href="http://localhost/comp353-project/public/view/main/Secured/Rides.php">Rides Request/Create</a>
                </li>
                <li>
                    <a href="http://localhost/comp353-project/public/view/main/Secured/Reviews.php">Reviews</a>
                </li>
				<li>
                    <a href="http://localhost/comp353-project/public/view/main/Secured/Directory.php">Directory</a>
                </li>
                <li>
                    <a href="http://localhost/comp353-project/public/view/main/Secured/Rides-Details.php">Ride Details</a>
                </li>
            </ul>
        </div>


    </div>
    <!-- /#wrapper -->
    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
        $("#menu-toggle2").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

