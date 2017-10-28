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

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
 <?php
Include('../config/connect222.php');
date_default_timezone_set("Asia/Jakarta");
$nowdate = date("d/m/Y");
//COUNT BIODATA
$sqlbio= "select COUNT(NIK) AS COUNT from BIODATA_WNI WHERE TGL_ENTRI >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND TGL_ENTRI < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtbio = oci_parse($conn, $sqlbio);
oci_execute($stmtbio);
$rbio = oci_fetch_array($stmtbio);
//COUNT KELUARGA
$sqlkk= "select COUNT(NO_KK) AS COUNT from DATA_KELUARGA WHERE TGL_INSERTION >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND TGL_INSERTION < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtkk = oci_parse($conn, $sqlkk);
oci_execute($stmtkk);
$rkk = oci_fetch_array($stmtkk);
//COUNT LAHIR
$sqllhr= "SELECT COUNT(BAYI_NO) AS COUNT FROM CAPIL_LAHIR  WHERE PLPR_TGL_LAPOR >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND PLPR_TGL_LAPOR < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtlhr = oci_parse($conn, $sqllhr);
oci_execute($stmtlhr);
$rlhr = oci_fetch_array($stmtlhr);
//COUNT MATI
$sqlmati= "SELECT COUNT(MATI_NO) AS COUNT FROM CAPIL_MATI  WHERE PLPR_TGL_LAPOR >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND PLPR_TGL_LAPOR < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtmati = oci_parse($conn, $sqlmati);
oci_execute($stmtmati);
$rmati = oci_fetch_array($stmtmati);
//COUNT KAWIN
$sqlkawin= "SELECT COUNT(KAWIN_NO) AS COUNT FROM CAPIL_KAWIN  WHERE KAWIN_TGL_LAPOR >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND KAWIN_TGL_LAPOR < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtkawin = oci_parse($conn, $sqlkawin);
oci_execute($stmtkawin);
$rkawin = oci_fetch_array($stmtkawin);
//COUNT CERAI
$sqlcerai= "SELECT COUNT(CERAI_NO) AS COUNT FROM CAPIL_CERAI  WHERE CERAI_TGL_LAPOR >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND CERAI_TGL_LAPOR < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtcerai = oci_parse($conn, $sqlcerai);
oci_execute($stmtcerai);
$rcerai = oci_fetch_array($stmtcerai);
//COUNT DATANG
$sqldatang= "SELECT COUNT(NO_PINDAH) AS COUNT FROM DATANG_HEADER  WHERE CREATED_DATE >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND CREATED_DATE < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtdatang = oci_parse($conn, $sqldatang);
oci_execute($stmtdatang);
$rdatang = oci_fetch_array($stmtdatang);
//COUNT DATANG DETAIL
$sqldatangd= "SELECT COUNT(NIK) AS COUNT FROM DATANG_DETAIL  WHERE CREATED_DATE >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND CREATED_DATE < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtdatangd = oci_parse($conn, $sqldatangd);
oci_execute($stmtdatangd);
$rdatangd = oci_fetch_array($stmtdatangd);
//COUNT PINDAH
$sqlpindah= "SELECT COUNT(NO_PINDAH) AS COUNT FROM PINDAH_HEADER  WHERE CREATED_DATE >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND CREATED_DATE < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtpindah = oci_parse($conn, $sqlpindah);
oci_execute($stmtpindah);
$rpindah = oci_fetch_array($stmtpindah);
//COUNT PINDAH DETAIL
$sqlpindahd= "SELECT COUNT(NIK) AS COUNT FROM PINDAH_DETAIL  WHERE CREATED_DATE >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND CREATED_DATE < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtpindahd = oci_parse($conn, $sqlpindahd);
oci_execute($stmtpindahd);
$rpindahd = oci_fetch_array($stmtpindahd);

?>
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
               
                                <span class="input-group-btn">
                     
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
                    <h1 class="page-header">VISUALISASI PELAYANAN ADMINISTRASI KEPENDUDUKAN <BR>DAN PENCATATAN SIPIL KOTA BANDUNG<br>
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
					<div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Grafik Aktifitas
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="chartindex" style="height: 400px; width: 100%;"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
				      
                <!-- /.col-lg-4 -->
            </div>
			<div class="row">
				<div class="col-lg-12">
				 <ul class="nav nav-pills">
								</li>
                                <li><a href="#" data-toggle="tab"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i>
								<span class="sr-only">Loading...</span></a></a>
                                </li>
                                <li><button type="button" id="show" class="btn btn-primary">Tampilkan Grafik Bulanan</button>
                                </li>
								<li><button type="button" id="hide" class="btn btn-primary">Sembunyikan Grafik Bulanan</button>
                                </li>
                            </ul>
							</div>
							</div>
							<hr>
					<div class="toshow" id="toshow" style="display:none">
            <!-- /.row -->
			<div class="row">
				<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Grafik Aktifitas
                            <!--<div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>-->
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="chartkk" style="height: 400px; width: 100%;"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                   
                    
                </div>
                <!-- /.col-lg-8 -->
				<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Grafik Aktifitas
                            <!--<div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>-->
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="chartbiodata" style="height: 400px; width: 100%;"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                   
                    
                </div>
                <!-- /.col-lg-8 -->
				<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Grafik Aktifitas
                            <!--<div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>-->
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="chartpindah" style="height: 400px; width: 100%;"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                   
                    
                </div>
                <!-- /.col-lg-8 -->
				<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Grafik Aktifitas
                            <!--<div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>-->
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="chartdatang" style="height: 400px; width: 100%;"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                   
                    
                </div>
                <!-- /.col-lg-8 -->
				<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Grafik Aktifitas
                            <!--<div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>-->
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="chartlahir" style="height: 400px; width: 100%;"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                   
                    
                </div>
                <!-- /.col-lg-8 -->
				<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Grafik Aktifitas
                            <!--<div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>-->
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="chartmati" style="height: 400px; width: 100%;"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                   
                    
                </div>
                <!-- /.col-lg-8 -->
				<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Grafik Aktifitas
                            <!--<div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>-->
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="chartkawin" style="height: 400px; width: 100%;"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                   
                    
                </div>
                <!-- /.col-lg-8 -->
				<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Grafik Aktifitas
                            <!--<div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>-->
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="chartcerai" style="height: 400px; width: 100%;"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                   
                    
                </div>
                <!-- /.col-lg-8 -->
 
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
			</div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>
	<script>
$(document).ready(function(){
    $("#hide").click(function(){
        $("#toshow").hide();
    });
    $("#show").click(function(){
        $("#toshow").show();
    });
});
</script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/canvasjs/canvasjs.min.js"></script>
	<script type="text/javascript">
	function loadlink(){
    $('#links').load('index.php',function () {
         $(this).unwrap();
    });
}

loadlink(); // This will run on page load
setInterval(function(){
    loadlink() // this will run after every 5 seconds
}, 5000);
	</script>
   <script type="text/javascript">
		//window.onload = function () {
			var chartindex = new CanvasJS.Chart("chartindex", {
				title: {
					text: "Informasi Data (<?php echo $hari.", ". $tanggal ." ". $bulan ." ". $tahun;?>)"
				},
				data: [{
					type: "column",
					dataPoints: [
						<?php echo"{y: parseInt(".(json_encode($rkk['COUNT']))."), label: 'Kartu Keluarga'},"; ?>
						<?php echo"{y: parseInt(".(json_encode($rbio['COUNT']))."), label: 'Biodata'},"; ?>
						<?php echo"{y: parseInt(".(json_encode($rpindah['COUNT']))."), label: 'Pindah'},"; ?>
						<?php echo"{y: parseInt(".(json_encode($rdatang['COUNT']))."), label: 'Kedatangan'},"; ?>
						<?php echo"{y: parseInt(".(json_encode($rlhr['COUNT']))."), label: 'Kelahiran'},"; ?>
						<?php echo"{y: parseInt(".(json_encode($rmati['COUNT']))."), label: 'Kematian'},"; ?>
						<?php echo"{y: parseInt(".(json_encode($rkawin['COUNT']))."), label: 'Perkawinan'},"; ?>
						<?php echo"{y: parseInt(".(json_encode($rcerai['COUNT']))."), label: 'Perceraian'},"; ?>
						//{ y: 30, label: "Kematian" },
						//{ y: 50, label: "Perkawinan" },
						//{ y: 28, label: "Perceraian" },
						]
				}]
			});
			chartindex.render();
			chartindex = {};
		//}
	</script>
	<script type='text/javascript'>
  //window.onload = function () {
    var chartkk = new CanvasJS.Chart('chartkk',
    {
      title:{
        text: 'Pembuatan Kartu Keluarga Satu Bulan Terakhir'    
      },
      animationEnabled: true,
      axisY: {
        title: 'Berdasarkan Hari'
      },
      legend: {
        verticalAlign: 'bottom',
        horizontalAlign: 'center'
      },
      theme: 'theme2',
      data: [

      {        
        type: 'column',  
        showInLegend: true, 
        legendMarkerColor: 'grey',
        legendText: 'Pembuatan Kartu Keluarga/Hari',
        dataPoints: [
		<?php
		$sql= "SELECT COUNT(NO_KK) AS COUNT, TRUNC(TGL_INSERTION) AS TANGGAL FROM DATA_KELUARGA  WHERE TGL_INSERTION >= TO_DATE('".$nowdate."','dd/MM/yyyy')-30 AND TGL_INSERTION < TO_DATE('".$nowdate."','dd/MM/yyyy') +1 group by TRUNC(TGL_INSERTION) ORDER BY TRUNC(TGL_INSERTION)";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
		echo"{y: parseInt(".(json_encode($row['COUNT']))."), label: ".json_encode($row['TANGGAL'])."},";
		}
		?>
        ]
      }   
      ]
    });

    chartkk.render();
	chartkk = {};
  //}
  </script>
  <script type='text/javascript'>
  //window.onload = function () {
    var chartbiodata = new CanvasJS.Chart('chartbiodata',
    {
      title:{
        text: 'Pembuatan Biodata Satu Bulan Terakhir'    
      },
      animationEnabled: true,
      axisY: {
        title: 'Berdasarkan Hari'
      },
      legend: {
        verticalAlign: 'bottom',
        horizontalAlign: 'center'
      },
      theme: 'theme2',
      data: [

      {        
        type: 'column',  
        showInLegend: true, 
        legendMarkerColor: 'grey',
        legendText: 'Pembuatan Biodata/Hari',
        dataPoints: [
		<?php
		$sql= "SELECT COUNT(NIK) AS COUNT, TRUNC(TGL_ENTRI) AS TANGGAL FROM BIODATA_WNI  WHERE TGL_ENTRI >= TO_DATE('".$nowdate."','dd/MM/yyyy')-30 AND TGL_ENTRI < TO_DATE('".$nowdate."','dd/MM/yyyy') +1 group by TRUNC(TGL_ENTRI) ORDER BY TRUNC(TGL_ENTRI)";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
		echo"{y: parseInt(".(json_encode($row['COUNT']))."), label: ".json_encode($row['TANGGAL'])."},";
		}
		?>
        ]
      }   
      ]
    });

    chartbiodata.render();
	chartbiodata = {};
  //}
  </script>
  <script type='text/javascript'>
  //window.onload = function () {
    var chartpindah = new CanvasJS.Chart('chartpindah',
    {
      title:{
        text: 'Pembuatan Surat Pindah Satu Bulan Terakhir'    
      },
      animationEnabled: true,
      axisY: {
        title: 'Berdasarkan Hari'
      },
      legend: {
        verticalAlign: 'bottom',
        horizontalAlign: 'center'
      },
      theme: 'theme2',
      data: [

      {        
        type: 'column',  
        showInLegend: true, 
        legendMarkerColor: 'grey',
        legendText: 'Pembuatan Surat Pindah/Hari',
        dataPoints: [
		<?php
		$sql= "SELECT COUNT(NO_PINDAH) AS COUNT, TRUNC(CREATED_DATE) AS TANGGAL FROM PINDAH_HEADER  WHERE CREATED_DATE >= TO_DATE('".$nowdate."','dd/MM/yyyy')-30 AND CREATED_DATE < TO_DATE('".$nowdate."','dd/MM/yyyy') +1 group by TRUNC(CREATED_DATE) ORDER BY TRUNC(CREATED_DATE)";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
		echo"{y: parseInt(".(json_encode($row['COUNT']))."), label: ".json_encode($row['TANGGAL'])."},";
		}
		?>
        ]
      }   
      ]
    });

    chartpindah.render();
	chartpindah = {};
  //}
  </script>
  <script type='text/javascript'>
  //window.onload = function () {
    var chartdatang = new CanvasJS.Chart('chartdatang',
    {
      title:{
        text: 'Pembuatan Surat Datang Satu Bulan Terakhir'    
      },
      animationEnabled: true,
      axisY: {
        title: 'Berdasarkan Hari'
      },
      legend: {
        verticalAlign: 'bottom',
        horizontalAlign: 'center'
      },
      theme: 'theme2',
      data: [

      {        
        type: 'column',  
        showInLegend: true, 
        legendMarkerColor: 'grey',
        legendText: 'Pembuatan Surat Datang/Hari',
        dataPoints: [
		<?php
		$sql= "SELECT COUNT(NO_PINDAH) AS COUNT, TRUNC(CREATED_DATE) AS TANGGAL FROM DATANG_HEADER  WHERE CREATED_DATE >= TO_DATE('".$nowdate."','dd/MM/yyyy')-30 AND CREATED_DATE < TO_DATE('".$nowdate."','dd/MM/yyyy') +1 group by TRUNC(CREATED_DATE) ORDER BY TRUNC(CREATED_DATE)";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
		echo"{y: parseInt(".(json_encode($row['COUNT']))."), label: ".json_encode($row['TANGGAL'])."},";
		}
		?>
        ]
      }   
      ]
    });

    chartdatang.render();
	chartdatang = {};
  //}
  </script>
  <script type='text/javascript'>
  //window.onload = function () {
    var chartlahir = new CanvasJS.Chart('chartlahir',
    {
      title:{
        text: 'Pembuatan Akta Kelahiran Satu Bulan Terakhir'    
      },
      animationEnabled: true,
      axisY: {
        title: 'Berdasarkan Hari'
      },
      legend: {
        verticalAlign: 'bottom',
        horizontalAlign: 'center'
      },
      theme: 'theme2',
      data: [

      {        
        type: 'column',  
        showInLegend: true, 
        legendMarkerColor: 'grey',
        legendText: 'Pembuatan Akta Kelahiran/Hari',
        dataPoints: [
		<?php
		$sql= "SELECT COUNT(BAYI_NO) AS COUNT, TRUNC(PLPR_TGL_LAPOR) AS TANGGAL FROM CAPIL_LAHIR  WHERE PLPR_TGL_LAPOR >= TO_DATE('".$nowdate."','dd/MM/yyyy')-30 AND PLPR_TGL_LAPOR < TO_DATE('".$nowdate."','dd/MM/yyyy') +1 group by TRUNC(PLPR_TGL_LAPOR) ORDER BY TRUNC(PLPR_TGL_LAPOR)";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
		echo"{y: parseInt(".(json_encode($row['COUNT']))."), label: ".json_encode($row['TANGGAL'])."},";
		}
		?>
        ]
      }   
      ]
    });

    chartlahir.render();
	chartlahir = {};
  //}
  </script><script type='text/javascript'>
  //window.onload = function () {
    var chartmati = new CanvasJS.Chart('chartmati',
    {
      title:{
        text: 'Pembuatan Akta Kematian Satu Bulan Terakhir'    
      },
      animationEnabled: true,
      axisY: {
        title: 'Berdasarkan Hari'
      },
      legend: {
        verticalAlign: 'bottom',
        horizontalAlign: 'center'
      },
      theme: 'theme2',
      data: [

      {        
        type: 'column',  
        showInLegend: true, 
        legendMarkerColor: 'grey',
        legendText: 'Pembuatan Akta Kematian/Hari',
        dataPoints: [
		<?php
		$sql= "SELECT COUNT(MATI_NO) AS COUNT, TRUNC(PLPR_TGL_LAPOR) AS TANGGAL FROM CAPIL_MATI  WHERE PLPR_TGL_LAPOR >= TO_DATE('".$nowdate."','dd/MM/yyyy')-30 AND PLPR_TGL_LAPOR < TO_DATE('".$nowdate."','dd/MM/yyyy') +1 group by TRUNC(PLPR_TGL_LAPOR) ORDER BY TRUNC(PLPR_TGL_LAPOR)";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
		echo"{y: parseInt(".(json_encode($row['COUNT']))."), label: ".json_encode($row['TANGGAL'])."},";
		}
		?>
        ]
      }   
      ]
    });

    chartmati.render();
	chartmati = {};
  //}
  </script><script type='text/javascript'>
  //window.onload = function () {
    var chartkawin = new CanvasJS.Chart('chartkawin',
    {
      title:{
        text: 'Pembuatan Akta Perkawinan Satu Bulan Terakhir'    
      },
      animationEnabled: true,
      axisY: {
        title: 'Berdasarkan Hari'
      },
      legend: {
        verticalAlign: 'bottom',
        horizontalAlign: 'center'
      },
      theme: 'theme2',
      data: [

      {        
        type: 'column',  
        showInLegend: true, 
        legendMarkerColor: 'grey',
        legendText: 'Pembuatan Akta Perkawinan/Hari',
        dataPoints: [
		<?php
		$sql= "SELECT COUNT(KAWIN_NO) AS COUNT, TRUNC(KAWIN_TGL_LAPOR) AS TANGGAL FROM CAPIL_KAWIN  WHERE KAWIN_TGL_LAPOR >= TO_DATE('".$nowdate."','dd/MM/yyyy')-30 AND KAWIN_TGL_LAPOR < TO_DATE('".$nowdate."','dd/MM/yyyy') +1 group by TRUNC(KAWIN_TGL_LAPOR) ORDER BY TRUNC(KAWIN_TGL_LAPOR)";
		oci_execute($stmt);
		while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
		echo"{y: parseInt(".(json_encode($row['COUNT']))."), label: ".json_encode($row['TANGGAL'])."},";
		}
		?>
        ]
      }   
      ]
    });

    chartkawin.render();
	chartkawin = {};
  //}
  </script><script type='text/javascript'>
  //window.onload = function () {
    var chartcerai = new CanvasJS.Chart('chartcerai',
    {
      title:{
        text: 'Pembuatan Akta Cerai Satu Bulan Terakhir'    
      },
      animationEnabled: true,
      axisY: {
        title: 'Berdasarkan Hari'
      },
      legend: {
        verticalAlign: 'bottom',
        horizontalAlign: 'center'
      },
      theme: 'theme2',
      data: [

      {        
        type: 'column',  
        showInLegend: true, 
        legendMarkerColor: 'grey',
        legendText: 'Pembuatan Akta Cerai/Hari',
        dataPoints: [
		<?php
		$sql= "SELECT COUNT(CERAI_NO) AS COUNT, TRUNC(CERAI_TGL_LAPOR) AS TANGGAL FROM CAPIL_CERAI  WHERE CERAI_TGL_LAPOR >= TO_DATE('".$nowdate."','dd/MM/yyyy')-30 AND CERAI_TGL_LAPOR < TO_DATE('".$nowdate."','dd/MM/yyyy') +1 group by TRUNC(CERAI_TGL_LAPOR) ORDER BY TRUNC(CERAI_TGL_LAPOR)";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
		echo"{y: parseInt(".(json_encode($row['COUNT']))."), label: ".json_encode($row['TANGGAL'])."},";
		}
		?>
        ]
      }   
      ]
    });

    chartcerai.render();
	chartcerai = {};
  //}
  </script>
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
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
</body>

</html>
