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
    <link rel="shortcut icon" href="../../../logo.png" />	
	
	<!-- Bootstrap Core CSS -->
    <link href="../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../../../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../../../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php
	session_start();
	?>

</head>

<body>
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
                <a class="navbar-brand" href="../../index.php">DisdukCapil Kota Bandung</a>
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
                            <a href="../../../../index.php"><i class="fa fa-home fa-fw"></i> Halaman Utama</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Statistik<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="../../stdisduk.php">Dafduk</a>
                                </li>
                                <li>
                                    <a href="../../stcapil.php">Capil</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Tabel<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="../../tbdisduk.php">Dafduk</a>
                                </li>
                                <li>
                                    <a href="../../tbcapil.php">Capil</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       <li>
                            <a href="../../gis/index.php"><i class="fa fa-map-marker fa-fw"></i> Informasi Geografis</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12"><?PHP

				$BULAN = $_SESSION['bulan'];
				$_SESSION['NOKEC'] = $_GET['NOKEC'];
				$NOKEC = $_SESSION['NOKEC'];
				//ECHO $NOKEC;
				//ECHO $BULAN;
				Include('../../../config/connect222.php');
					//AMBIL NAMA KECAMATAN DAN TOTAL PENJUMLAHAN NIK TIAP KELUARAHAN BERDASARKAN KECAMATAN YANG DI PILIH 
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM KEPINDAHAN MENURUT GOLONGAN DARAH KECAMATAN ".$row['NAMA_KEC']."'";
					
                    ECHO "<h1 class='page-header'>DATA KEPINDAHAN KECAMATAN ".$row['NAMA_KEC']."<br>";
					?>
					<?php
					date_default_timezone_set("Asia/Jakarta");
					$array_hari = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat", "Sabtu","Minggu");
					$hari = $array_hari[date("N")];
					//Format Tanggal
					$tanggal = date ("j");

					//Array Bulan
					$array_bulan = array(1=>"Januari","Februari","Maret", "April", "Mei", "Juni","Juli","Agustus","September","Oktober", "November","Desember");
					$bulan = $array_bulan[date("n")];
					$nowdate = date("d/m/Y");
					$BLN = substr($nowdate,3,7);
					//echo $BLN;
					//Format Tahun
					$tahun = date("Y");
		
					//echo "The time is " . date("h:i:sa");
					echo "<small>Dinas Kependudukan Dan Pencatatan Sipil Kota Bandung</small></h1>";
					//echo "<small>".$hari.", " . $tanggal ." ". $bulan ." ". $tahun. ", Update Terakhir <span id='time-part'>".date("H:i:s")."</span>.</small></h1>";
					//echo "Today is " . date("Y.m.d") . "<br>";
					//echo "Today is " . date("Y-m-d") . "<br>";
					//echo "Today is " . date("l");
					
					
					?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <!-- Isi -->
			<div class="row">
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-table fa-fw"></i> Kedatangan Anggota Menurut Jenis Pindah
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Membuat KK</th>
                                        <th>Numpang KK</th>
                                        <th>KK Tetap</th>
										<th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?PHP
									Include('../../../config/connect222.php');
									$sql= "SELECT a.NO_KEC as P99, a.NO_KEL as P1, a.NAMA_KEL AS P2, SUM(b.NUMPANG_KK) AS P3, SUM(b.MEMBUAT_KK) AS P4, SUM(b.KK_TETAP) AS P5, SUM(b.NUMPANG_KK)+ SUM(b.MEMBUAT_KK) + SUM(b.KK_TETAP)  AS P6
									FROM SETUP_KEL a INNER JOIN T5_DTG_ANGGOTA_JENIS_DATANG b
									ON a.NO_KEC=b.NO_KEC and a.NO_KEL=b.NO_KEL  WHERE a.NO_PROP='32' AND a.NO_KAB ='73' AND a.NO_KEC ='".$NOKEC."' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
									GROUP BY a.NO_KEC, a.NO_KEL, a.NAMA_KEL ORDER BY a.NO_KEL";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr class='gradeA'>";
                                    echo "<td align='center'>".htmlentities($row['P1'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P2'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P3'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P4'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P5'])."</td>";
									echo "<td class='center'>".htmlentities($row['P6'])."</td>";
									echo "<td class='center'><a href='kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw'></i> Detail</a></td>";
                                    echo "</tr>";
									}
									
									?>
								</tbody>
								</thead>
							</table>
						</div>
						<div class="panel-footer">
										 <a href="../../tbdisduk.php" class="btn btn-primary btn-lg btn-block">Kembali</a>
						</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   <!-- jQuery -->
    <script src="../../../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../../dist/js/sb-admin-2.js"></script>

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
