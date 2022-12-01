
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php">Student</a>
            </div>

        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div text-center">
                            <img src="img/admin-p.png" class="img" />
                            <h5 style="color:white;"><?php echo $_SESSION['name'];?></h5>
                        </div>
                    </li>

                    <li>
                        <a class="<?php if($page=='home'){ echo 'active-menu';}?>" href="home.php"><i class="fa fa-dashboard "></i>Register Courses</a>
                    </li>
					
					 <li>
                        <a class="<?php if($page=='registrations'){ echo 'active-menu';}?>" href="registrations.php"><i class="fa fa-users "></i>Registrations</a>
                    </li>
					
					 <li>
                        <a href="studentlogout.php"><i class="fa fa-power-off "></i>Logout</a>
                    </li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->