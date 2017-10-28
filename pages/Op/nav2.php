<div class="navbar-nav navbar-inverse navbar-fixed-top">
        <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php?user=<?php echo htmlentities($_GET['user']) ?>"><img src="assets/img/logo30.png" alt=""> Disduk Capil Kota Bandung</a>
        </div> 
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="index.php?user=<?php echo htmlentities($_GET['user']) ?>"><i class="fa fa-home fa-fw"></i> Home</a></li>
			  <li class="active"><a href="indexreport.php?user=<?php echo htmlentities($_GET['user']) ?>"><i class="fa fa-reddit-square fa-fw"></i> Keluhan</a></li>
			  <li><a href="indexmanager.php?user=<?php echo htmlentities($_GET['user']) ?>"><i class="fa fa-folder-open  fa-fw"></i> File Manager</a></li>
			  <li><a href="../loginabsensi.php"><i class="fa fa-arrow-circle-left fa-fw"></i> Sign Out</a></li>
              <!--<li><a href="manager.html"><i class="icon-folder-open icon-white"></i> File Manager</a></li>
              <li><a href="calendar.html"><i class="fa fa-calendar fa-fw"></i> Calendar</a></li>
              <li><a href="tables.html"><i class="fa fa-table fa-fw"></i> Tables</a></li>
              <li><a href="login.html"><i class="fa fa-lock fa-fw"></i> Login</a></li>
              <li><a href="user.html"><i class="fa fa-user fa-fw"></i> User</a></li>
				-->
            </ul>
          </div><!--/.nav-collapse -->
        </div>
    </div>