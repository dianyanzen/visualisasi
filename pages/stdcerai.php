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
	<!-- Start Php -->
	<?php
					//date_default_timezone_set("Asia/Jakarta");
					//$array_hari = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat", "Sabtu","Minggu");
					//$hari = $array_hari[date("N")];
					//Format Tanggal
					//$tanggal = date ("j");

					//Array Bulan
					//$array_bulan = array(1=>"JANUARI","FEBRUARI","MARET", "APRIL", "MEI", "JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER", "NOVEMBER","DESEMBER");
					//$bulan = $array_bulan[date("n")];

					//Format Tahun
					//$tahun = date("Y");
					
					//echo "The time is " . date("h:i:sa");
					//echo "<small>".$hari.", " . $tanggal ." ". $bulan ." ". $tahun. ", Update Terakhir <span id='time-part'>".date("H:i:s")."</span>.</small></h1>";
					//echo "Today is " . date("Y.m.d") . "<br>";
					//echo "Today is " . date("Y-m-d") . "<br>";
					//echo "Today is " . date("l");
					?>

	<?php

			Include('../config/connect222.php');
			$sql = "SELECT NO_KEC, NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB='73' ORDER BY NAMA_KEC";
			$stmt = oci_parse($conn, $sql);
			oci_execute($stmt);

			while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
			$categories[] = array("id" => $row['NO_KEC'], "val" => $row['NAMA_KEC']);
			$subcats[$row['NO_KEC']][] = array("id" => "0", "val" => "SELURUH KELURAHAN");
			}

			$sqlnokel = "SELECT NO_KEL, NAMA_KEL, NO_KEC FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB='73' ORDER BY NAMA_KEL";
			$stmtnokel = oci_parse($conn, $sqlnokel);
			oci_execute($stmtnokel);

			while (($rownokel = oci_fetch_array($stmtnokel, OCI_ASSOC)) != false){
			$subcats[$rownokel['NO_KEC']][] = array("id" => $rownokel['NO_KEL'], "val" => $rownokel['NAMA_KEL']);
			}

			$jsonCats = json_encode($categories);
			$jsonSubCats = json_encode($subcats);


			//OPTION NOMOR KECAMATAN
			$sqlnokec = "SELECT NO_KEC, NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB='73' ORDER BY NO_KEC";
			$stmtnokec = oci_parse($conn, $sqlnokec);
			oci_execute($stmtnokec);
			?>
			
	<script type='text/javascript'>
      <?php
        echo "var categories = $jsonCats; \n";
        echo "var subcats = $jsonSubCats; \n";
      ?>
      function loadCategories(){
        var select = document.getElementById("NO_KEC");
        select.onchange = updateSubCats;

      }
      function updateSubCats(){
        var catSelect = this;
        var catid = this.value;
        var subcatSelect = document.getElementById("NO_KEL");
        subcatSelect.options.length = 1; //delete all options if any present
		$("#NO_KEL").html("<option value='0' selected='selected'>SELURUH KELURAHAN</option>");
        for(var i = 1; i < subcats[catid].length; i++){
          subcatSelect.options[i] = new Option(subcats[catid][i].val,subcats[catid][i].id);
        }
		var s = document.getElementById("NO_KEC");
		var NO_KEC = NO_KEC.options[s.selectedIndex].value;
		if (NO_KEC = 0) {
			
		}
		
      }
    </script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

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
                <a class="navbar-brand" href="index.php">Disduk Capil Bandung</a>
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
                                    <a href="stdisduk.php">Disduk</a>
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
                                    <a href="tbdisduk.php">Disduk</a>
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
								</li>
                                <li><a href="#" data-toggle="tab"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i>
								<span class="sr-only">Loading...</span></a></a>
                                </li>
                                <li><a href="stdlahir.php">Kelahiran</a>
                                </li>
                                <li><a href="stdmati.php">Kematian</a>
                                </li>
                                <li><a href="stdkawin.php">Perkawinan</a>
                                </li>
                                <li class="active"><a href="stdcerai.php">Perceraian</a>
                                </li>
                            </ul>
					
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="kartukeluarga-pills">
								<br>
                                    <div class="col-lg-12">
										<div class="panel panel-primary">
											<div class="panel-heading">
												Statistik Pendaftaran Penduduk WNI Kota Bandung - Akta Kematian
											</div>
										<div class="panel-body" >
										
										<form method="post" name="formstatistik" id="formstatistik" action="stdcerai.php" role="form">
	
										<div class="row">
											<div class="col-lg-12">
											<div class="form-group col-lg-6">
                                            <label>Pilih Jenis Statistik</label>
                                            <select name="statistik" id="statistik" class="form-control" required>
												<option value="1">Menurut Yang Mengajukan</option>
												<option value="2">Menurut Penyebab Perceraian</option>
                                            </select>
                                        </div>
										<!-- Div -->
										<div class="form-group col-lg-6">
											<label>Masukan Bulan Dan Tahun</label>
                                            <input name="bulan" id="bulan" class="form-control" placeholder="MM-YYYY" type="text" pattern=".{7,}" data-masked-input="99-9999" placeholder="MM-YYYY" maxlength="7" required x-moz-errormessage="Format Bulan Dan Tahun Salah">
											</div>
											</div>
										</div>
										<!-- end row -->
										</div>
										<!-- end panel -->
									<div class="panel-footer">
										<button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Tampilkan Statistik</button>
									</div>
									</form>
									</div>
								
			
	<?php
	if (isset($_REQUEST['submit'])) //here give the name of your button on which you would like    //to perform action.
{
	//$NOKEC= $_REQUEST['NO_KEC'] ;
	//$NOKEL= $_REQUEST['NO_KEL'] ;
	$BULAN= $_POST['bulan'];
	$tahun = substr($BULAN, -4, 4);
	$rest = substr($BULAN, 0, -5);
	if($rest =="01"){
	$bln = "JANUARI";
	}
	else if ($rest =="02"){
	$bln = "FEBRUARI";
	}
	else if ($rest =="03"){
	$bln = "MARET";
	}
	else if ($rest =="04"){
	$bln = "APRIL";
	}
	else if ($rest =="05"){
	$bln = "MEI";
	}
	else if ($rest =="06"){
	$bln = "JUNI";
	}
	else if ($rest =="07"){
	$bln = "JULI";
	}
	else if ($rest =="08"){
	$bln = "AGUSTUS";
	}
	else if ($rest =="09"){
	$bln = "SEPTEMBER";
	}
	else if ($rest =="10"){
	$bln = "OKTOBER";
	}
	else if ($rest =="11"){
	$bln = "NOVEMBER";
	}
	else if ($rest =="12"){
	$bln = "DESEMBER";
	}else{
	$bln = "Bulan Salah";
	}
		//STATISTIK 1
		if($_REQUEST['statistik']=="1"){
		//JIKA STATISTIK YANG DI PILIH VALUENYA = 1
	//$NOKEC= $_REQUEST['NO_KEC'] ;
	//$NOKEL= $_REQUEST['NO_KEL'] ;
	$BULAN= $_POST['bulan'];
	//MENGECEK APAKAH BULAN YANG DI PILIH TERSEDIA DI DB
	$sql= "SELECT * FROM T5_CRAI_AJUKAN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
	    $num_rows=oci_fetch($stmt);
	   if($num_rows>0){
		   ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-primary'>
                        <div class='panel-heading'>
                            Statistik Pendaftaran Penduduk WNI Kota Bandung
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                           

                            <!-- Tab panes -->
                           
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM KOLOM PERCERAIAN MENURUT YANG MENGAJUKAN <br>KOTA BANDUNG <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='kolceraikota1' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
                                    <div align='center'><h1><b>DIAGRAM PIE PERCERAIAN MENURUT YANG MENGAJUKAN <br>KOTA BANDUNG<br>BULAN $bln TAHUN $tahun </b></h1></div>
									<div id='pieceraikota1' style='height: 400px; width: 100%;'></div>
                                </div>
                              
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                <!-- /.col-lg-6 -->
            </div>";
	
 }else {
		//ERROR HANDLE BULAN SALAH PILIH
	Echo" <div class='col-lg-12'>
                    
                              <div class='alert alert-danger alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                Maaf Statistik Tidak Dapat Di Tampilkan Karena Bulan Yang Anda Pilih : ".$BULAN." Tidak Ada Di Database Kami, <a href='index.php' class='alert-link'>Klik Untuk Kembali</a>.
                            </div>
                    
                </div>
                            ";
		}
	//END CEK BULAN
}
	//AKHIR STATISTIK 1
	
	//STATISTIK 2
	if($_REQUEST['statistik']=="2"){
		//JIKA STATISTIK YANG DI PILIH VALUENYA = 2
	//$NOKEC= $_REQUEST['NO_KEC'] ;
	//$NOKEL= $_REQUEST['NO_KEL'] ;
	$BULAN= $_POST['bulan'];
	//MENGECEK APAKAH BULAN YANG DI PILIH TERSEDIA DI DB
	$sql= "SELECT * FROM T5_CRAI_SEBAB WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
	    $num_rows=oci_fetch($stmt);
	   if($num_rows>0){
		   ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-primary'>
                        <div class='panel-heading'>
                            Statistik Pendaftaran Penduduk WNI Kota Bandung
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                           

                            <!-- Tab panes -->
                           
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM KOLOM PERCERAIAN MENURUT PENYEBAB PERCERAIAN <br>KOTA BANDUNG <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='kolceraikota2' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
                                    <div align='center'><h1><b>DIAGRAM PIE PERCERAIAN MENURUT PENYEBAB PERCERAIAN <br>KOTA BANDUNG<br>BULAN $bln TAHUN $tahun </b></h1></div>
									<div id='pieceraikota2' style='height: 400px; width: 100%;'></div>
                                </div>
                              
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                <!-- /.col-lg-6 -->
            </div>";
	
 }else {
		//ERROR HANDLE BULAN SALAH PILIH
	Echo" <div class='col-lg-12'>
                    
                              <div class='alert alert-danger alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                Maaf Statistik Tidak Dapat Di Tampilkan Karena Bulan Yang Anda Pilih : ".$BULAN." Tidak Ada Di Database Kami, <a href='index.php' class='alert-link'>Klik Untuk Kembali</a>.
                            </div>
                    
                </div>
                            ";
		}
	//END CEK BULAN
}

	//AKHIR STATISTIK 2
	
	}

   ?>
   
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Charts JavaScript -->
    <script src="../vendor/canvasjs/canvasjs.min.js"></script>
    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
 	<!-- Input Mask 
	<script src="../js/jquery-1.7.2.js"></script>
	-->
	<script src="../js/jquery.masked-input.js"></script>

	
	<script type='text/javascript'>
   CanvasJS.addColorSet('bdgShades',
                [//ULAH DI UBAH WARNA PARANTI CHART

                '#000080',
                '#b82601',
				'#228B22',
				
                ]);
				
			var kolceraikota1 = new CanvasJS.Chart('kolceraikota1', {
				//CHART COLOM MENAMPILKAN SELURUH DATA YANG DI HITUNG DAN SELURUH KECAMATAN
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM KOLOM JUMLAH ANGGOTA PINDAH MENURUT JENIS KELAMIN DI KOTA BANDUNG'
				},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,
				
            legend: {
        verticalAlign: 'bottom',
        horizontalAlign: 'center'
      },
				data: [
				{
					type: 'column',
					 indexLabelMaxWidth: 50,
					dataPoints: [
					<?php
					$sql= "SELECT SUM(SUAMI) AS P1,SUM(ISTRI) AS P2,SUM(TIDAK_TAHU) AS P3 FROM T5_CRAI_AJUKAN WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'DARI SUAMI'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'DARI ISTRI'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'TIDAK TAHU'},";
					
					?>					
					]}
			]
					
			});
			kolceraikota1.render();
			kolceraikota1 = {};
  
  </script>
  
  <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

                '#000080',
                '#b82601',
				'#228B22',
                               
                ]);
			var pieceraikota1 = new CanvasJS.Chart('pieceraikota1', {
				//CHART PIE MENAMPILKAN SELURUH DATA YANG DI HITUNG
			colorSet: 'bdgShades',
			
				title: {
					//text: 'DIAGRAM PIE JUMLAH ANGGOTA PINDAH MENURUT JENIS KELAMIN DI KOTA BANDUNG'
				},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,
				
				data: [
				{
					type: "pie",
			showInLegend: true,
			toolTipContent: "{y} - #percent %",
			yValueFormatString: "#0#,. RIBU",
			legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(SUAMI) AS P1,SUM(ISTRI) AS P2,SUM(TIDAK_TAHU) AS P3 FROM T5_CRAI_AJUKAN WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded:true,  label: 'DARI SUAMI'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),exploded:true,  label: 'DARI ISTRI'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),exploded:true,  label: 'TIDAK TAHU'},";
					?>						
					]}
			]
					
			});
			pieceraikota1.render();
			pieceraikota1 = {};
  
  </script>

  <!-- AKHIR STATISTIK 1 -->
  
  <!-- STATISTIK 2 -->
  	<script type='text/javascript'>
   CanvasJS.addColorSet('bdgShades',
                [//ULAH DI UBAH WARNA PARANTI CHART

                '#000080',
                '#b82601',
				'#228B22',
				'#EC5657',
				'#4B0082',
				'#8FAABB',
                '#3EA0DD', 
				'#DEB887',
				'#5F9EAD',
             
                ]);
				
			var kolceraikota2 = new CanvasJS.Chart('kolceraikota2', {
				//CHART COLOM MENAMPILKAN SELURUH DATA YANG DI HITUNG DAN SELURUH KECAMATAN
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM KOLOM JUMLAH ANGGOTA PINDAH MENURUT JENIS KELAMIN DI KOTA BANDUNG'
				},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,
				
            legend: {
        verticalAlign: 'bottom',
        horizontalAlign: 'center'
      },
				data: [
				{
					type: 'column',
					 indexLabelMaxWidth: 50,
					dataPoints: [
					<?php
					$sql= "SELECT SUM(ZINA) AS P1,SUM(PEMABUK) AS P2,SUM(PENJUDI) AS P3,SUM(TINGGAL_2TH) AS P4,SUM(PENJARA_5TH) AS P5,SUM(KDRT) AS P6,SUM(CACAT_SAKIT) AS P7,SUM(SELISI_TRS) AS P8,SUM(LAINNYA) AS P9 FROM T5_CRAI_SEBAB WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'KARENA ZINA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'KARENA PEMABUK'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'KARENA PENJUDI'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'KARENA DITINGGAL 2 TAHUN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'KARENA DIPENJARA 5 TAHUN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'KARENA KDRT'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'KARENA CACAT ATAU SAKIT'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'KARENA SELISIH TERUS'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'KARENA LAINNYA'},";
					?>					
					]}
			]
					
			});
			kolceraikota2.render();
			kolceraikota2 = {};
  
  </script>
  
  <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

                '#000080',
                '#b82601',
				'#228B22',
				'#EC5657',
				'#4B0082',
				'#8FAABB',
                '#3EA0DD', 
				'#DEB887',
				'#5F9EAD',
				
                ]);
			var pieceraikota2 = new CanvasJS.Chart('pieceraikota2', {
				//CHART PIE MENAMPILKAN SELURUH DATA YANG DI HITUNG
			colorSet: 'bdgShades',
			
				title: {
					//text: 'DIAGRAM PIE JUMLAH ANGGOTA PINDAH MENURUT JENIS KELAMIN DI KOTA BANDUNG'
				},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,
				
				data: [
				{
					type: "pie",
			showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(ZINA) AS P1,SUM(PEMABUK) AS P2,SUM(PENJUDI) AS P3,SUM(TINGGAL_2TH) AS P4,SUM(PENJARA_5TH) AS P5,SUM(KDRT) AS P6,SUM(CACAT_SAKIT) AS P7,SUM(SELISI_TRS) AS P8,SUM(LAINNYA) AS P9 FROM T5_CRAI_SEBAB WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded:true,  label: 'KARENA ZINA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),exploded:true,  label: 'KARENA PEMABUK'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),exploded:true,  label: 'KARENA PENJUDI'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),exploded:true,  label: 'KARENA DITINGGAL 2 TAHUN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),exploded:true,  label: 'KARENA DIPENJARA 5 TAHUN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),exploded:true,  label: 'KARENA KDRT'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),exploded:true,  label: 'KARENA CACAT ATAU SAKIT'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),exploded:true,  label: 'KARENA SELISIH TERUS'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),exploded:true,  label: 'KARENA LAINNYA'},";
					?>
					]}
			]
					
			});
			pieceraikota2.render();
			pieceraikota2 = {};
  
  </script>
  
	<!-- AKHIR STATISTIK 2 -->

<!-- Page-Level Demo Scripts - Notifications - Use for reference -->
    <script>
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
    // popover demo
    $("[data-toggle=popover]")
        .popover()
    </script>

	</body>

</html>