<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="@DianYanzen">

    <title>DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL KOTA BANDUNG</title>
	
	<!-- Yanzen core Sc -->
    <link rel="shortcut icon" href="../logo.png" />	
	
    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- Start Php -->
	
		

<body onload='loadCategories()'>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            
			<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">DisdukCapil Kota Bandung</a>
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
                       <li><a href="../../index.php"><i class="fa fa-sign-out fa-fw"></i> Kembali</a>
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
                            <a href="../../index.php"><i class="fa fa-home fa-fw"></i> Halaman Utama</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Statistik<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="stdisduk.php">Dafduk</a>
                                </li>
                                <li>
                                    <a href="stcapil.php">Capil</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Tabel<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="tbdisduk.php">Dafduk</a>
                                </li>
                                <li>
                                    <a href="tbcapil.php">Capil</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="gis/index.php"><i class="fa fa-map-marker fa-fw"></i> Informasi Geografis</a>
                        </li>
						
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                   <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills">
								<!--</li>
                                <li><a href="#" data-toggle="tab"><i class="fa fa-cog fa-spin fa-5x fa-fw"></i>
								<span class="sr-only">Loading...</span></a></a>
                                </li>-->
								<li><a href="#" data-toggle="tab"><i class="fa fa-user fa-4x fa-fw"></i></a>
                                </li>
								<li><h1> System Disduk Create New User</h1></li>
                            </ul>
					
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="kartukeluarga-pills">
								<br>
                                    <div class="col-lg-12">
										<div class="panel panel-primary">
											<div class="panel-heading">
												Sistem Information Administrator - Create New User
											</div>
										<div class="panel-body" >
										
										<form method="post" name="formstatistik" id="formstatistik" action="usercreate.php" role="form">
	
																												<!--start row-->
										<div class="row">
											<div class="col-lg-12">
                                            <div class="form-group col-lg-6">
											<label>Username ID</label>
                                            <input name="username" id="username" class="form-control" type="text" placeholder="Username ID" required x-moz-errormessage="Please Insert Username ID">
											</div>
										<!-- Div -->
										<div class="form-group col-lg-6">
											<label>Password</label>
                                            <input name="password" id="password" class="form-control" type="password" placeholder="Password User" required x-moz-errormessage="Please Insert Password User">
											</div>
											</div>
											</div>
										<div class="row">
										<div class="col-lg-12">
											<div class="form-group col-lg-6">
											<label>Full Name User</label>
                                            <input name="name" id="name" class="form-control" type="text" placeholder="Full Name User" maxlength="50" required x-moz-errormessage="Insert Full Name User">
											</div>
											
											
											<div class="form-group col-lg-6">
											<label>Grup User</label>
                                            <select name="grup_id" id="grup_id" class="form-control" required>
                                               	<option value="1">Administrator</option>
												<option value="2">Kepala Seksi/Kepala Bidang</option>
												<option value="3">Kepala Dinas</option>
												<option value="4">Bagian Pendaftaran Penduduk</option>												
												<option value="5">Bagian Pencatatan Sipil</option>
												<option value="6">Capil Lahir Umum</option>
												<option value="7">Capil Mati Umum</option>
												<option value="8">Operator Pengambilan</option>
												<option value="9">Capil Mati Terlambat</option>
												<option value="10">Capil Lahir Terlambat</option>
												<option value="11">Pihak Ketiga</option>
                                            </select>
											</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12">
                                            <div class="form-group col-lg-4">
											<label>Admin Username</label>
                                            <input name="admin" id="admin" class="form-control" type="text" placeholder="Insert Your Username" required x-moz-errormessage="Insert Your Name">
											</div>
										<!-- Div -->
										<div class="form-group col-lg-4">
											<label>Admin Password</label>
                                            <input name="pwsadm" id="pass" class="form-control" type="password" placeholder="Insert Your Password" required x-moz-errormessage="Insert Your Passcode ">
											</div>
											<div class="form-group col-lg-4">
											<label>Scurity Key</label>
                                            <input name="kode" id="kode" class="form-control" type="password" placeholder="Scurity Key" required x-moz-errormessage="Require">
											</div>
											</div>
										</div>
										</div>
										<!-- end panel -->
									<div class="panel-footer">
										<button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Create New User</button>
									</div>
									</form>
									</div>
									<?php

//if submit is not blanked i.e. it is clicked.
if (isset($_REQUEST['submit'])) //here give the name of your button on which you would like    //to perform action.
{
	Include('../config/connectlogin.php');
	 $username = $_POST['username'];
	 $password = $_POST['password'];
	 $fullname = $_POST['name'];
	 $grup_id = $_POST['grup_id'];
	 $nameadm = $_POST['admin'];
	 $passadm = $_POST['pwsadm'];
	 $kode = $_POST['kode'];
	 $pwduser = md5($password);
	 $pwdadm =md5($passadm);
	 $sql= "select USERNAME, PASSWORD, GRUP_ID from USER_ID WHERE USERNAME = '$nameadm' AND PASSWORD = '$pwdadm'";
	 $stmt = oci_parse($conn, $sql);
	 oci_execute($stmt);
	 $num_rows=oci_fetch($stmt);
	  if($num_rows>0){
		$sql= "select GRUP_ID from USER_ID WHERE USERNAME = '$nameadm' AND PASSWORD = '$pwdadm'";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		$row = oci_fetch_array($stmt);
	if($row['GRUP_ID'] == '1')
	{
		$sql= "select USERNAME from USER_ID WHERE USERNAME = '$username'";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		$num_rows=oci_fetch($stmt);
		if($num_rows>0)
		{
			ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-danger'>
                        <div class='panel-heading'>
                            <i class='fa fa-user fa-fw'></i> CREATE NEW USER ERROR
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>";
						echo "<div class='alert alert-danger alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                Mohon Maaf Anda Tidak Dapat Membuat User Baru Karena Username Sudah Terpakai <a href='#' class='alert-link'>Perhatian !</a>.
                            </div>";
						echo"</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
		}
		else{
			if($kode == '40min.'){
				$sql= "INSERT INTO USER_ID (USERNAME,PASSWORD,GRUP_ID,NAMA) VALUES (:USERNAME,:PASSWORD,:GRUP_ID,:FULLNAME)";
				$compiled = oci_parse($conn, $sql);
				oci_bind_by_name($compiled, ':USERNAME', $username);
				oci_bind_by_name($compiled, ':PASSWORD', $pwduser);
				oci_bind_by_name($compiled, ':GRUP_ID', $grup_id);
				oci_bind_by_name($compiled, ':FULLNAME', $fullname);
				oci_execute($compiled);
				// $sql= "select * from USER_ID WHERE USERNAME = '$username'";
				// $stmt = oci_parse($conn, $sql);
				// oci_execute($stmt);
				// $row = oci_fetch_array($stmt);
				// ECHO "<div class='row'>
                // <div class='col-lg-12'>
                    // <div class='panel panel-default'>
                        // <div class='panel-heading'>
                            // <i class='fa fa-table fa-fw'></i> TABEL PEMBUATAN USER BARU
                        // </div>
                        // <!-- /.panel-heading -->
                        // <div class='panel-body'>
                            // <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                // <thead>
                                    // <tr>
                                        // <Th>ID</Th>
                                        // <Th>GRUP ID</Th>
										// <Th>USERNAME</Th>
										// <Th>PASSWORD</th>
										// <Th>NAMA</th>
                                    // </Tr>
                                // </thead>
                                // <tbody>";
                                    // while (($row = oci_fetch_array($stmt,OCI_ASSOC)) != false) {
                                    // echo "<tr class='gradeA'>";
                                    // echo "<td class='center'>".htmlentities($row['ID'])."</td>";
                                    // echo "<td class='center'>".htmlentities($row['GRUP_ID'])."</td>";
                                    // echo "<td class='center'>".htmlentities($row['USERNAME'])."</td>";
									// echo "<td class='center'>".htmlentities($row['PASSWORD'])."</td>";
									// echo "<td class='center'>".htmlentities($row['NAMA'])."</td>";
									// echo "</tr>";
									// }				
								// echo"</tbody>
								// </thead>
							// </table>";
						// echo"</div>
				// </div>
			// </div>
        // </div>
        // <!-- /#page-wrapper -->";
		ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-primary'>
                        <div class='panel-heading'>
                            <i class='fa fa-user fa-fw'></i> CREATE NEW USER ERROR
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>";
						echo "<div class='alert alert-primary alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                Selamat, User Baru Berhasil Di Buat <a href='#' class='alert-link'>Informasi !</a>.
                            </div>";
						echo"</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
			}else{
			ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-danger'>
                        <div class='panel-heading'>
                            <i class='fa fa-user fa-fw'></i> CREATE NEW USER ERROR
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>";
						echo "<div class='alert alert-danger alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                Mohon Maaf Anda Tidak Dapat Membuat User Baru Karena Scurity Key Yang Anda Masukan Salah <a href='#' class='alert-link'>Perhatian !</a>.
                            </div>";
						echo"</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";	
			}
		}
	}else{
		ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-danger'>
                        <div class='panel-heading'>
                            <i class='fa fa-user fa-fw'></i> CREATE NEW USER ERROR
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>";
						echo "<div class='alert alert-danger alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                Mohon Maaf Anda Tidak Dapat Membuat User Baru Karena Anda Bukan Admin <a href='#' class='alert-link'>Perhatian !</a>.
                            </div>";
						echo"</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
	}
	}
	else
	{
		ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-danger'>
                        <div class='panel-heading'>
                            <i class='fa fa-user fa-fw'></i> CREATE NEW USER ERROR
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>";
						echo "<div class='alert alert-danger alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                Mohon Maaf Anda Tidak Dapat Membuat User Baru Karena Username Dan Password Admin Salah <a href='#' class='alert-link'>Perhatian !</a>.
                            </div>";
						echo"</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
	   
	}
}	
	 
	 
	 
	 /*
	 $ynz29 = base64_encode($ynz);
	 $zyn09 = base64_encode($zyn); 	 
	 $zny95 = base64_encode($zny);
	 ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL CONFIGURASI DATABASE
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <Th>Code Encode<br>Username Database</Th>
                                        <Th>Code Encode<br>Password DataBase</Th>
										<Th>Code Encode<br>Hostname Database</Th>
										<Th>Koneksi Eksekutif App<br>(Open New Tab)</th>
										<Th>Koneksi Web Umum<br>(Open New Tab)</th>
                                    </Tr>
                                </thead>
                                <tbody>";
									
									
                                    echo "<tr class='gradeA'>";
                                    echo "<td align='center'>".htmlentities($ynz29)."</td>";
                                    echo "<td class='center'>".htmlentities($zyn09)."</td>";
                                    echo "<td class='center'>".htmlentities($zny95)."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='unduh.php'><i class='fa fa-download fa-fw' id=></i> Unduh</a></td>";
									echo "<td class='center' align='center'><a target='_blank' href='unduh-web.php'><i class='fa fa-download fa-fw' id=></i> Unduh</a></td>";
                        			echo "</tr>";
					
									
								echo"</tbody>
								</thead>
							</table>";
						echo"</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
	*/
	 
	
//}
									
									
?>
									</div>
                                </div>
                              </div>
                        </div>
                        <!-- /.panel-body -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			
                     
                 
			
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
	<script src="../js/jquery.masked-input.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
</body>

</html>