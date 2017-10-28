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

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
	<?php

session_start();

?>
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
						<li>
                            <a href="loginAbsensi.php"><i class="fa fa-desktop fa-fw"></i> Absensi Outsourcing</a>
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
                    <h1 class="page-header">Daftar Operator<br>
					<?php
					date_default_timezone_set("Asia/Jakarta");
					$array_hari = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat", "Sabtu","Minggu");
					$hari = $array_hari[date("N")];
					//Format Tanggal
					$tanggal = date ("j");

					//Array Bulan
					$array_bulan = array(1=>"Januari","Februari","Maret", "April", "Mei", "Juni","Juli","Agustus","September","Oktober", "November","Desember");
					$bulan = $array_bulan[date("n")];

					//Format Tahun
					$tahun = date("Y");
					//echo "The time is " . date("h:i:sa");
					echo "<small>".$hari.", " . $tanggal ." ". $bulan ." ". $tahun. ", Update Terakhir <span id='time-part'>".date("H:i:s")."</span>.</small></h1>";
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
			<div class="col-lg-12">
	
<div class="panel panel-default" id="opr_bar">
		<?php
Include('../config/connect223.php');

//COUNT OPERATOR
$sqlopr= "SELECT COUNT(USER_ID) AS COUNT FROM T5_SESSION";
$stmtopr = oci_parse($conn, $sqlopr);
oci_execute($stmtopr);
$ropr = oci_fetch_array($stmtopr);

//COUNT TOTAL OPERATOR
$sqloprt= "SELECT COUNT(USER_ID) AS COUNT FROM T5_SIAK_USER";
$stmtoprt = oci_parse($conn, $sqloprt);
oci_execute($stmtoprt);
$roprt = oci_fetch_array($stmtoprt);
//TAMPILKAN OPERATOR
$opr = number_format(htmlentities($ropr['COUNT']));
$oprt = number_format(htmlentities($roprt['COUNT']));
$toprt = $oprt - $opr;
$persen = ($opr / $oprt) * 100;
$tpersen = 100 - $persen;
?>
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Status Operator
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						<div>
                                    <p>
                                        <strong>Operator Aktiv</strong>
                                        <span class="pull-right text-muted"><?php echo $opr?> Pengguna</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $persen?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persen?>%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
								<div>
                                    <p>
                                        <strong>Operator Tidak Aktiv</strong>
                                        <span class="pull-right text-muted"><?php echo $toprt?> Pengguna</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $tpersen?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $tpersen?>%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
						</div>
						</div>
								
								</div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-table fa-fw"></i> Operator
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>Status Pengguna</th>
                                        <th>ID Pengguna</th>
                                        <th>Nama Pengguna</th>
                                        <th>Nama Kantor</th>
                                        <!--th>IP Address</th-->
                                        <th>Aktivitas Terakhir</th>
										<th>Detail Aktivitas</th>
                                    </tr>
                                </thead>
                                <tbody id='opr_tab'>
								<?PHP
									Include('../config/connect222.php');
									$sql= "SELECT B.USER_ID, B.NAMA_LGKP, C.LEVEL_NAME, B.NAMA_KANTOR, D.LEVEL_NAME AS GROUP_LEVEL, CASE WHEN A.IP_ADDRESS IS NULL THEN '-' ELSE A.IP_ADDRESS END AS IP_ADDRESS, CASE WHEN A.LAST_ACTIVITY IS NULL THEN '-' ELSE to_char(to_date('1970-01-01','YYYY-MM-DD') + numtodsinterval(TO_CHAR(A.LAST_ACTIVITY),'SECOND') + 7/24,'DD-MM-YYYY HH24:MI:SS') END AS LAST_ACTIVITY FROM T5_SIAK_USER B  LEFT JOIN T5_SESSION A ON A.USER_ID = B.USER_ID INNER JOIN T5_SIAK_LEVEL C ON B.USER_LEVEL = C.USER_LEVEL INNER JOIN T5_GROUP_LEVEL D ON C.GROUP_LEVEL = D.LEVEL_CODE ORDER BY A.USER_ID";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr>";
									$ipadd = htmlentities($row['IP_ADDRESS']);
									if ($ipadd =='-')
									{
									echo "<td><i class='fa fa-desktop fa-fw' style='color:red'></i> Tidak Aktif</td>";
									} else
									{
									echo "<td><i class='fa fa-desktop fa-fw' style='color:green'></i> Aktif</td>";
									}
									echo "<td>".htmlentities($row['USER_ID'])."</td>";
                                    echo "<td>".htmlentities($row['NAMA_LGKP'])."</td>";
									echo "<td class='center'>".htmlentities($row['NAMA_KANTOR'])."</td>";
                                    // echo "<td>".htmlentities($row['LEVEL_NAME'])." <font color='blue'><b>(".htmlentities($row['GROUP_LEVEL']).")</b></font></td>";
                                    // echo "<td align='center' class='center'>".htmlentities($row['IP_ADDRESS'])."</td>";
                                    echo "<td align='center' class='center gradeA'>".htmlentities($row['LAST_ACTIVITY'])."</td>";
									echo "<td class='center' align='center'><a href='indexopactivity.php?UID=".htmlentities($row['USER_ID'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
                                    echo "</tr>";
									}
									
									?>
								</tbody>
								</thead>
							</table>
						</div>
				</div>
			</div>
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
	<script src="../js/moment.min.js"></script>
	<script>
		$(document).ready(function() {
    var interval = setInterval(function() {
		var month = new Array();
		month[0] = "Januari";
		month[1] = "Februari";
		month[2] = "Maret";
		month[3] = "April";
		month[4] = "Mei";
		month[5] = "Juni";
		month[6] = "Juli";
		month[7] = "Agustus";
		month[8] = "September";
		month[9] = "Oktober";
		month[10] = "November";
		month[11] = "Desember";
		var weekday = new Array(7);
	    weekday[0] = "Minggu";
	    weekday[1] = "Senin";
	    weekday[2] = "Selasa";
	    weekday[3] = "Rabu";
	    weekday[4] = "Kamis";
	    weekday[5] = "Jumat";
	    weekday[6] = "Sabtu";
    var d = new Date();
	var x = weekday[d.getDay()];
    var n = month[d.getMonth()];
        var momentNow = moment();
        $('#date-part').html(' '
                            + momentNow.format('DD') + ' '
                            + n + ' '
                            + momentNow.format('YYYY'));
        $('#time-part').html( ' '
                            + momentNow.format('H:mm:ss'));
		 $('#day-part').html( ' '
                            + x );
    }, 100);
});
				</script>	
				<script>
	setInterval(function(){
	$("#opr_bar").load('opr_bar.php'),
	$("#opr_tab").load('opr_tab.php')
	}, 10000);

	</script>		
</body>

</html>
