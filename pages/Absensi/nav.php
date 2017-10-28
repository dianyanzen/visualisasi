<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            
			<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php?user=<?php echo htmlentities($_GET['user']) ?>">DisdukCapil Kota Bandung</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                  
                        <li class="divider"></li>
                       <li><a href="../loginAbsensi.php"><i class="fa fa-sign-out fa-fw"></i> Kembali</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <!--<input type="text" class="form-control" placeholder="">-->
                                <span class="input-group-btn">
                                <!--<button id='lada' class="btn btn-default" type="button">-->
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="../absensi/index.php?user=<?php echo htmlentities($_GET['user']) ?>"><i class="fa fa-home fa-fw"></i> Halaman Utama</a>
                        </li>
						<li>
                            <a href="../absensi/indexop.php?user=<?php echo htmlentities($_GET['user']) ?>"><i class="fa fa-desktop fa-fw"></i> Aktivitas Pendamping Operator</a>
                        </li>
						<li>
                            <a href="../absensi/indexrekap.php?user=<?php echo htmlentities($_GET['user']) ?>"><i class="fa fa-steam-square fa-fw"></i> Rekap Absensi Operator</a>
                        </li>
						<li>
                            <a href="../absensi/indexreport.php?user=<?php echo htmlentities($_GET['user']) ?>"><i class="fa fa-table fa-fw"></i> Laporan Bulanan Operator</a>
                        </li>
						<li>
                            <a href="../absensi/indexprofil.php?user=<?php echo htmlentities($_GET['user']) ?>"><i class="fa fa-user fa-fw"></i> Profil Admin</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>