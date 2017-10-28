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
                                <li><a href="stdkk.php">Kartu Keluarga</a>
                                </li>
                                <li><a href="stdbiodata.php">Biodata</a>
                                </li>
                                <li class="active"><a href="stdpindah.php">Pindah</a>
                                </li>
                                <li><a href="stddatang.php">Datang</a>
                                </li>
                            </ul>
					
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="kartukeluarga-pills">
								<br>
                                    <div class="col-lg-12">
										<div class="panel panel-primary">
											<div class="panel-heading">
												Statistik Pendaftaran Penduduk WNI Kota Bandung - Surat Pindah
											</div>
										<div class="panel-body" >
										
										<form method="post" name="formstatistik" id="formstatistik" action="stdpindah.php" role="form">
	
										<!--start row-->
										<div class="row">
											<div class="col-lg-12">
											<div class="form-group col-lg-6">
                                            <label>Pilih Kecamatan</label>
                                            <select name="NO_KEC"  id="NO_KEC" class="form-control" >
                                               <option value="0" selected="selected">SELURUH KECAMATAN</option>
												<?php
									while (($rownokec = oci_fetch_array($stmtnokec, OCI_ASSOC)) != false) {
									echo "<option value='".$rownokec['NO_KEC']."'>";
									echo $rownokec['NAMA_KEC']." (".$rownokec['NO_KEC'].")";
									echo "</option>";
									}
									?>
                                            </select>
                                        </div>
										<!-- Div -->
										<div class="form-group col-lg-6">
											<label>Pilih Kelurahan</label>
                                            <select name="NO_KEL" id="NO_KEL" class="form-control">
												<option value="0" selected="selected">SELURUH KELURAHAN</option>
											</select>
										</div>
											</div>
										</div>
										<!-- end row -->
										<!--start row-->
										<div class="row">
											<div class="col-lg-12">
											<div class="form-group col-lg-6">
                                            <label>Pilih Jenis Statistik</label>
                                            <select name="statistik" id="statistik" class="form-control" required>
												<option value="1">Jumlah Anggota Pindah Menurut Jenis Kelamin</option>
												<option value="2">Jumlah Anggota Pindah Menurut Klasifikasi</option>
												<option value="3">Jumlah Anggota Pindah Menurut Alasan</option>
												<option value="4">Jumlah Surat Pindah Menurut Klasifikasi</option>
												<option value="5">Jumlah Surat Pindah Menurut Alasan</option>
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
	$NOKEC= $_REQUEST['NO_KEC'] ;
	$NOKEL= $_REQUEST['NO_KEL'] ;
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

		if($_REQUEST['statistik']=="1"){
		//JIKA STATISTIK YANG DI PILIH VALUENYA = 1(JENIS KELAMIN)
	$NOKEC= $_REQUEST['NO_KEC'] ;
	$NOKEL= $_REQUEST['NO_KEL'] ;
	$BULAN= $_POST['bulan'];
	//MENGECEK APAKAH BULAN YANG DI PILIH TERSEDIA DI DB
	$sql= "SELECT * FROM T5_PDH_ANGGOTA_KELAMIN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
	    $num_rows=oci_fetch($stmt);
	   if($num_rows>0){
		   if($_REQUEST['NO_KEC']=="0" && $_REQUEST['NO_KEL']=="0")
	{
		//HASIL YANG DI KELUARKAN APABILA DATA TELAH TEPAT, KECAMATAN DAN KELURAHAN DI TAMPILKAN SEMUA
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
									<div align='center'><h1><b>DIAGRAM KOLOM JUMLAH ANGGOTA PINDAH MENURUT JENIS KELAMIN <br>KOTA BANDUNG <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='kolpindahkota1' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
                                    <div align='center'><h1><b>DIAGRAM PIE JUMLAH ANGGOTA PINDAH MENURUT JENIS KELAMIN <br>KOTA BANDUNG<br>BULAN $bln TAHUN $tahun </b></h1></div>
									<div id='piepindahkota1' style='height: 400px; width: 100%;'></div>
                                </div>
                              
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                <!-- /.col-lg-6 -->
            </div>";
	
	}ELSE if($_REQUEST['NO_KEC']<>"0" && $_REQUEST['NO_KEL']=="0"){
		//DATA DI KELUARKAN APABILA MEMILIH KATEGORI KECAMATAN
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
                                    <br><br>";
									$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(LP) AS PEREMPUAN FROM T5_PDH_ANGGOTA_KELAMIN INNER JOIN SETUP_KEC ON T5_PDH_ANGGOTA_KELAMIN.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' AND SETUP_KEC.NO_KEC =".$NOKEC." GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$row = oci_fetch_array($stmt);
									echo "<div align='center'><h1><b>DIAGRAM KOLOM JUMLAH ANGGOTA PINDAH MENURUT JENIS KELAMIN <br>KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='kolpindahkec1' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									//$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(LP) AS PEREMPUAN FROM T5_PDH_ANGGOTA_KELAMIN INNER JOIN SETUP_KEC ON T5_PDH_ANGGOTA_KELAMIN.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' AND SETUP_KEC.NO_KEC =".$NOKEC." GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
									//$stmt = oci_parse($conn, $sql);
									//oci_execute($stmt);
									//$row = oci_fetch_array($stmt);
									echo "<div align='center'><h1><b>DIAGRAM KOLOM JUMLAH ANGGOTA PINDAH MENURUT JENIS KELAMIN<br>KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='kolpindahkecall1' style='height: 400px; width:100%;'></div>
                                </div>
								 <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(LP) AS PEREMPUAN FROM T5_PDH_ANGGOTA_KELAMIN INNER JOIN SETUP_KEC ON T5_PDH_ANGGOTA_KELAMIN.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' AND SETUP_KEC.NO_KEC =".$NOKEC." GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$row = oci_fetch_array($stmt);
									echo "<div align='center'><h1><b>DIAGRAM PIE JUMLAH ANGGOTA PINDAH MENURUT JENIS KELAMIN <br>KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='piepindahkec1' style='height: 400px; width: 100%;'></div>
                                </div>
                              
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                <!-- /.col-lg-6 -->
            </div>";
	}ELSE if($_REQUEST['NO_KEC']<>"0" && $_REQUEST['NO_KEL']<>"0"){
		//DATA YANG DI PILIH APABILA MEMILIH KATEGORI KELURAHAN
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
                                    <br><br>";
									$sql= "SELECT SETUP_KEL.NAMA_KEL, SUM(LK) AS LAKI_LAKI FROM T5_PDH_ANGGOTA_KELAMIN INNER JOIN SETUP_KEL ON T5_PDH_ANGGOTA_KELAMIN.NO_KEL = SETUP_KEL.NO_KEL WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEL.NO_PROP='32' AND SETUP_KEL.NO_KAB='73' AND SETUP_KEL.NO_KEC ='".$NOKEC."' AND SETUP_KEL.NO_KEL ='".$NOKEL."' GROUP BY SETUP_KEL.NAMA_KEL ORDER BY SETUP_KEL.NAMA_KEL";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "<div align='center'><h1><b>DIAGRAM KOLOM JUMLAH ANGGOTA PINDAH MENURUT JENIS KELAMIN <br> KELURAHAN ".$row['NAMA_KEL']." <br>BULAN $bln TAHUN $tahun</b></h1></div>
					
									
                                    <div id='kolpindahkel1' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT SETUP_KEL.NAMA_KEL, SUM(LK) AS LAKI_LAKI FROM T5_PDH_ANGGOTA_KELAMIN INNER JOIN SETUP_KEL ON T5_PDH_ANGGOTA_KELAMIN.NO_KEL = SETUP_KEL.NO_KEL WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEL.NO_PROP='32' AND SETUP_KEL.NO_KAB='73' AND SETUP_KEL.NO_KEC ='".$NOKEC."' AND SETUP_KEL.NO_KEL ='".$NOKEL."' GROUP BY SETUP_KEL.NAMA_KEL ORDER BY SETUP_KEL.NAMA_KEL";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "<div align='center'><h1><b>DIAGRAM PIE JUMLAH ANGGOTA PINDAH MENURUT JENIS KELAMIN <br> KELURAHAN ".$row['NAMA_KEL']." <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='piepindahkel1' style='height: 400px; width: 100%;'></div>
                                </div>
                              
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                <!-- /.col-lg-6 -->
            </div>";
	}
	//END CEK KECAMATAN
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
	
//STATISTIK 2
	ELSE IF($_REQUEST['statistik']=="2"){
				//JIKA STATISTIK YANG DI PILIH VALUENYA = 2
	$NOKEC= $_REQUEST['NO_KEC'] ;
	$NOKEL= $_REQUEST['NO_KEL'] ;
	$BULAN= $_POST['bulan'];
	//MENGECEK APAKAH BULAN YANG DI PILIH TERSEDIA DI DB
	$sql= "SELECT * FROM T5_PDH_ANGGOTA_KLASIFIKASI WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
	    $num_rows=oci_fetch($stmt);
	   if($num_rows>0){
	if($_REQUEST['NO_KEC']=="0" && $_REQUEST['NO_KEL']=="0")
	{
		//HASIL YANG DI KELUARKAN APABILA DATA TELAH TEPAT, KECAMATAN DAN KELURAHAN DI TAMPILKAN SEMUA
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
									<div align='center'><h1><b>DIAGRAM KOLOM JUMLAH ANGGOTA PINDAH MENURUT KLASIFIKASI <br>KOTA BANDUNG <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='kolpindahkota2' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM PIE JUMLAH ANGGOTA PINDAH MENURUT KLASIFIKASI <br>KOTA BANDUNG <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='piepindahkota2' style='height: 400px; width: 100%;'></div>
                                </div>
                              
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                <!-- /.col-lg-6 -->
            </div>";
	 
	} ELSE if($_REQUEST['NO_KEC']<>"0" && $_REQUEST['NO_KEL']=="0"){
		//DATA DI KELUARKAN APABILA MEMILIH KATEGORI KECAMATAN
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
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$row = oci_fetch_array($stmt);
									echo "<div align='center'><h1><b>DIAGRAM KOLOM JUMLAH ANGGOTA PINDAH MENURUT KLASIFIKASI KEPINDAHAN <br> KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='kolpindahkec2' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$row = oci_fetch_array($stmt);
									echo "<div align='center'><h1><b>DIAGRAM PIE JUMLAH ANGGOTA PINDAH MENURUT KLASIFIKASI KEPINDAHAN <br> KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='piepindahkec2' style='height: 400px; width: 100%;'></div>
                                </div>
                              
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                <!-- /.col-lg-6 -->
            </div>";
	} ELSE if($_REQUEST['NO_KEC']<>"0" && $_REQUEST['NO_KEL']<>"0"){
		//DATA YANG DI PILIH APABILA MEMILIH KATEGORI KELURAHAN
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
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$row = oci_fetch_array($stmt);
									echo "<div align='center'><h1><b>DIAGRAM KOLOM JUMLAH ANGGOTA PINDAH MENURUT KLASIFIKASI KEPINDAHAN <br> KELURAHAN ".$row['NAMA_KEL']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='kolpindahkel2' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$row = oci_fetch_array($stmt);
									echo "<div align='center'><h1><b>DIAGRAM KOLOM JUMLAH ANGGOTA PINDAH MENURUT KLASIFIKASI KEPINDAHAN <br> KELURAHAN ".$row['NAMA_KEL']."<br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='piepindahkel2' style='height: 400px; width: 100%;'></div>
                                </div>
                              
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                <!-- /.col-lg-6 -->
            </div>";
	}
	//END CEK KECAMATAN
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

//STATISTIK 3
	ELSE IF($_REQUEST['statistik']=="3"){
				//JIKA STATISTIK YANG DI PILIH VALUENYA = 3
	$NOKEC= $_REQUEST['NO_KEC'] ;
	$NOKEL= $_REQUEST['NO_KEL'] ;
	$BULAN= $_POST['bulan'];
	//MENGECEK APAKAH BULAN YANG DI PILIH TERSEDIA DI DB
	$sql= "SELECT * FROM T5_PDH_ANGGOTA_ALASAN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
	    $num_rows=oci_fetch($stmt);
	   if($num_rows>0){
	if($_REQUEST['NO_KEC']=="0" && $_REQUEST['NO_KEL']=="0")
	{
		//HASIL YANG DI KELUARKAN APABILA DATA TELAH TEPAT, KECAMATAN DAN KELURAHAN DI TAMPILKAN SEMUA
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
									<div align='center'><h1><b>DIAGRAM KOLOM JUMLAH ANGGOTA PINDAH MENURUT KLASIFIKASI <br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='kolpindahkota3' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM PIE JUMLAH ANGGOTA PINDAH MENURUT KLASIFIKASI <br>KOTA BANDUNG<br> BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='piepindahkota3' style='height: 400px; width: 100%;'></div>
                                </div>
                              
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                <!-- /.col-lg-6 -->
            </div>";
	 
	} ELSE if($_REQUEST['NO_KEC']<>"0" && $_REQUEST['NO_KEL']=="0"){
		//DATA DI KELUARKAN APABILA MEMILIH KATEGORI KECAMATAN
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
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$row = oci_fetch_array($stmt);
									echo "<div align='center'><h1><b>DIAGRAM KOLOM JUMLAH ANGGOTA PINDAH MENURUT ALASAN KEPINDAHAN <br> KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='kolpindahkec3' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$row = oci_fetch_array($stmt);
									echo "<div align='center'><h1><b>DIAGRAM PIE JUMLAH ANGGOTA PINDAH MENURUT ALASAN KEPINDAHAN <br> KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='piepindahkec3' style='height: 400px; width: 100%;'></div>
                                </div>
                              
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                <!-- /.col-lg-6 -->
            </div>";
	} ELSE if($_REQUEST['NO_KEC']<>"0" && $_REQUEST['NO_KEL']<>"0"){
		//DATA YANG DI PILIH APABILA MEMILIH KATEGORI KELURAHAN
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
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$row = oci_fetch_array($stmt);
									echo "<div align='center'><h1><b>DIAGRAM KOLOM JUMLAH ANGGOTA PINDAH MENURUT ALASAN KEPINDAHAN <br> KELURAHAN ".$row['NAMA_KEL']." <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='kolpindahkel3' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$row = oci_fetch_array($stmt);
									echo "<div align='center'><h1><b>DIAGRAM PIE JUMLAH ANGGOTA PINDAH MENURUT ALASAN KEPINDAHAN <br> KELURAHAN ".$row['NAMA_KEL']." <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='piepindahkel3' style='height: 400px; width: 100%;'></div>
                                </div>
                              
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                <!-- /.col-lg-6 -->
            </div>";
	}
	//END CEK KECAMATAN
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
//AKHIR STATISTIK 3

//STATISTIK 4
	ELSE IF($_REQUEST['statistik']=="4"){
				//JIKA STATISTIK YANG DI PILIH VALUENYA = 4
	$NOKEC= $_REQUEST['NO_KEC'] ;
	$NOKEL= $_REQUEST['NO_KEL'] ;
	$BULAN= $_POST['bulan'];
	//MENGECEK APAKAH BULAN YANG DI PILIH TERSEDIA DI DB
	$sql= "SELECT * FROM T5_PDH_SURAT_KLASIFIKASI WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
	    $num_rows=oci_fetch($stmt);
	   if($num_rows>0){
	if($_REQUEST['NO_KEC']=="0" && $_REQUEST['NO_KEL']=="0")
	{
		//HASIL YANG DI KELUARKAN APABILA DATA TELAH TEPAT, KECAMATAN DAN KELURAHAN DI TAMPILKAN SEMUA
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
									<div align='center'><h1><b>DIAGRAM KOLOM JUMLAH SURAT PINDAH MENURUT KLASIFIKASI KEPINDAHAN <br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='kolpindahkota4' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM PIE JUMLAH SURAT PINDAH MENURUT KLASIFIKASI KEPINDAHAN <br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='piepindahkota4' style='height: 400px; width: 100%;'></div>
                                </div>
                              
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                <!-- /.col-lg-6 -->
            </div>";
	 
	} ELSE if($_REQUEST['NO_KEC']<>"0" && $_REQUEST['NO_KEL']=="0"){
		//DATA DI KELUARKAN APABILA MEMILIH KATEGORI KECAMATAN
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
                                    <br><br>";
								$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
								$stmt = oci_parse($conn, $sql);
								oci_execute($stmt);
								$row = oci_fetch_array($stmt);
								echo "<div align='center'><h1><b>DIAGRAM KOLOM JUMLAH SURAT PINDAH MENURUT KLASIFIKASI KEPINDAHAN <br> KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='kolpindahkec4' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$row = oci_fetch_array($stmt);
									echo "<div align='center'><h1><b>DIAGRAM PIE JUMLAH SURAT PINDAH MENURUT KLASIFIKASI KEPINDAHAN <br> KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='piepindahkec4' style='height: 400px; width: 100%;'></div>
                                </div>
                              
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                <!-- /.col-lg-6 -->
            </div>";
	} ELSE if($_REQUEST['NO_KEC']<>"0" && $_REQUEST['NO_KEL']<>"0"){
		//DATA YANG DI PILIH APABILA MEMILIH KATEGORI KELURAHAN
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
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$row = oci_fetch_array($stmt);
									echo "<div align='center'><h1><b>DIAGRAM KOLOM JUMLAH SURAT PINDAH MENURUT KLASIFIKASI KEPINDAHAN <br> KELURAHAN ".$row['NAMA_KEL']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='kolpindahkel4' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$row = oci_fetch_array($stmt);
									echo "<div align='center'><h1><b>DIAGRAM PIE JUMLAH SURAT PINDAH MENURUT KLASIFIKASI KEPINDAHAN <br> KELURAHAN ".$row['NAMA_KEL']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='piepindahkel4' style='height: 400px; width: 100%;'></div>
                                </div>
                              
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                <!-- /.col-lg-6 -->
            </div>";
	}
	//END CEK KECAMATAN
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

	//AKHIR STATISTIK 4
	
	//STATISTIK 5
	ELSE IF($_REQUEST['statistik']=="5"){
				//JIKA STATISTIK YANG DI PILIH VALUENYA = 5
	$NOKEC= $_REQUEST['NO_KEC'] ;
	$NOKEL= $_REQUEST['NO_KEL'] ;
	$BULAN= $_POST['bulan'];
	//MENGECEK APAKAH BULAN YANG DI PILIH TERSEDIA DI DB
	$sql= "SELECT * FROM T5_PDH_SURAT_ALASAN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
	    $num_rows=oci_fetch($stmt);
	   if($num_rows>0){
	if($_REQUEST['NO_KEC']=="0" && $_REQUEST['NO_KEL']=="0")
	{
		//HASIL YANG DI KELUARKAN APABILA DATA TELAH TEPAT, KECAMATAN DAN KELURAHAN DI TAMPILKAN SEMUA
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
									<div align='center'><h1><b>DIAGRAM KOLOM JUMLAH SURAT PINDAH MENURUT ALASAN KEPINDAHAN <br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='kolpindahkota5' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM KOLOM JUMLAH SURAT PINDAH MENURUT ALASAN KEPINDAHAN <br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='piepindahkota5' style='height: 400px; width: 100%;'></div>
                                </div>
                              
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                <!-- /.col-lg-6 -->
            </div>";
	 
	} ELSE if($_REQUEST['NO_KEC']<>"0" && $_REQUEST['NO_KEL']=="0"){
		//DATA DI KELUARKAN APABILA MEMILIH KATEGORI KECAMATAN
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
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$row = oci_fetch_array($stmt);
									echo "<div align='center'><h1><b>DIAGRAM KOLOM JUMLAH SURAT PINDAH MENURUT ALASAN KEPINDAHAN <br> KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='kolpindahkec5' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$row = oci_fetch_array($stmt);
									echo "<div align='center'><h1><b>DIAGRAM PIE JUMLAH SURAT PINDAH MENURUT ALASAN KEPINDAHAN <br> KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='piepindahkec5' style='height: 400px; width: 100%;'></div>
                                </div>
                              
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                <!-- /.col-lg-6 -->
            </div>";
	} ELSE if($_REQUEST['NO_KEC']<>"0" && $_REQUEST['NO_KEL']<>"0"){
		//DATA YANG DI PILIH APABILA MEMILIH KATEGORI KELURAHAN
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
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$row = oci_fetch_array($stmt);
									echo "<div align='center'><h1><b>DIAGRAM KOLOM JUMLAH SURAT PINDAH MENURUT ALASAN KEPINDAHAN <br> KELURAHAN ".$row['NAMA_KEL']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='kolpindahkel5' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$row = oci_fetch_array($stmt);
									echo "<div align='center'><h1><b>DIAGRAM PIE JUMLAH SURAT PINDAH MENURUT ALASAN KEPINDAHAN <br> KELURAHAN ".$row['NAMA_KEL']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='piepindahkel5' style='height: 400px; width: 100%;'></div>
                                </div>
                              
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                <!-- /.col-lg-6 -->
            </div>";
	}
	//END CEK KECAMATAN
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
}
	//AKHIR STATISTIK 5
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

                '#0000FF',
                '#b82601'
                               
                ]);
				
			var kolpindahkota1 = new CanvasJS.Chart('kolpindahkota1', {
				//CHART COLOM MENAMPILKAN SELURUH DATA YANG DI HITUNG DAN SELURUH KECAMATAN
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM KOLOM JUMLAH ANGGOTA PINDAH MENURUT JENIS KELAMIN DI KOTA BANDUNG'
				},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,
				
				axisX:{
			interval: 1
			},
				
            legend: {
        verticalAlign: 'bottom',
        horizontalAlign: 'center'
      },
				data: [
				{
					type: 'column',
					showInLegend: true, 
					legendMarkerColor: 'blue',
					legendText: 'Jumlah Laki-Laki/Kecamatan',
					dataPoints: [
					<?php
					//MEMILIH SELURUH KECAMATAN DAN TOTAL PENJUMLAHAN DATA SETIAP KECAMATAN BERDASARKAN KATEGORI YANG DI PILIH (LAKI LAKI)
					$sql= "SELECT SETUP_KEC.NO_KEC, SETUP_KEC.NAMA_KEC, SUM(LK) AS LAKI_LAKI FROM T5_PDH_ANGGOTA_KELAMIN INNER JOIN SETUP_KEC ON T5_PDH_ANGGOTA_KELAMIN.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' GROUP BY SETUP_KEC.NO_KEC , SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NO_KEC";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['LAKI_LAKI']))."),  label: ".json_encode($row['NO_KEC'])."},";
					}	
					?>					
					]},{
					type: 'column',
					showInLegend: true, 
					legendMarkerColor: '#b82601',
					legendText: 'Jumlah Perempuan/Kecamatan',
					dataPoints: [
					<?php
					//MEMILIH SELURUH KECAMATAN DAN TOTAL PENJUMLAHAN DATA SETIAP KECAMATAN BERDASARKAN KATEGORI YANG DI PILIH (PEREMPUAN)
					$sql= "SELECT SETUP_KEC.NO_KEC , SETUP_KEC.NAMA_KEC, SUM(LP) AS PEREMPUAN FROM T5_PDH_ANGGOTA_KELAMIN INNER JOIN SETUP_KEC ON T5_PDH_ANGGOTA_KELAMIN.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' GROUP BY SETUP_KEC.NO_KEC, SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NO_KEC";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  label: ".json_encode($row['NO_KEC'])."},"; 
					}	
					?>					
					]}
			]
					
			});
			kolpindahkota1.render();
			kolpindahkota1 = {};
  
  </script>
  <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

                '#0000FF',
                '#b82601'
                               
                ]);
			var piepindahkota1 = new CanvasJS.Chart('piepindahkota1', {
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
					//MENAMPILKAN DATA HASIL PENJUMLAHAN DATA SELURUH KECAMATAN DISATUKAN LAKI LAKI
					$sql= "SELECT SUM(LK) AS LAKI_LAKI FROM T5_PDH_ANGGOTA_KELAMIN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['LAKI_LAKI']))."),exploded:true,  indexLabel: 'LAKI-LAKI'},";
					}	
					?>
					<?php
					//MENAMPILKAN DATA HASIL PENJUMLAHAN DATA SELURUH KECAMATAN DISATUKAN PEREMPUAN
					$sql= "SELECT SUM(LP) AS PEREMPUAN FROM T5_PDH_ANGGOTA_KELAMIN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),exploded:true,  indexLabel: 'PEREMPUAN'},"; 
					}	
					?>						
					]}
			]
					
			});
			piepindahkota1.render();
			piepindahkota1 = {};
  
  </script>
   <!-- GRAFIK DATA APABILA HANYA KECAMATAN SAJA YANG DIPILIH-->

 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

                '#0000FF',
                '#b82601'
                               
                ]);
			var kolpindahkec1 = new CanvasJS.Chart('kolpindahkec1', {
				//CHART KOLOM YANG MENAMPILKAN DATA HASIL PENJUMLAHAN PER KECAMATAN YANG DIPILIH
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//MENCARI MANA KECAMATAN YANG DI PILIH
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(LP) AS PEREMPUAN FROM T5_PDH_ANGGOTA_KELAMIN INNER JOIN SETUP_KEC ON T5_PDH_ANGGOTA_KELAMIN.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' AND SETUP_KEC.NO_KEC =".$NOKEC." GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JUMLAH ANGGOTA PINDAH MENURUT JENIS KELAMIN DI KECAMATAN ".$row['NAMA_KEC']."'";
					?>
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
					showInLegend: true, 
					legendMarkerColor: 'blue',
					legendText: 'Jumlah Laki-Laki/Kecamatan',
					dataPoints: [
					<?php
					//MENCARI MANA KECAMATAN DAN JUMLAH DATA YANG DI PILIH LAKI LAKI
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(LK) AS LAKI_LAKI FROM T5_PDH_ANGGOTA_KELAMIN INNER JOIN SETUP_KEC ON T5_PDH_ANGGOTA_KELAMIN.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' AND SETUP_KEC.NO_KEC =".$NOKEC." GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['LAKI_LAKI']))."),  label: ".json_encode($row['NAMA_KEC'])."},";
					}	
					?>					
					]},{
					type: 'column',
					showInLegend: true, 
					legendMarkerColor: '#b82601',
					legendText: 'Jumlah Perempuan/Kecamatan',
					dataPoints: [
					<?php
					//MENCARI MANA KECAMATAN DAN JUMLAH DATA YANG DI PILIH PEREMPUAN
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(LP) AS PEREMPUAN FROM T5_PDH_ANGGOTA_KELAMIN INNER JOIN SETUP_KEC ON T5_PDH_ANGGOTA_KELAMIN.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' AND SETUP_KEC.NO_KEC =".$NOKEC." GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  label: ".json_encode($row['NAMA_KEC'])."},"; 
					}	
					?>					
					]}
			]
					
			});
			kolpindahkec1.render();
			kolpindahkec1 = {};
  
  </script>
  
   <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

                '#0000FF',
                '#b82601'
                               
                ]);
			var kolpindahkecall1 = new CanvasJS.Chart('kolpindahkecall1', {
				//MENAMPIKAN DATA KELURAHAN BERDASARKAN KECAMATAN YANG DIPILIH
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//MENCARI NAMA KECAMATAN YANG DIPILIH
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(LP) AS PEREMPUAN FROM T5_PDH_ANGGOTA_KELAMIN INNER JOIN SETUP_KEC ON T5_PDH_ANGGOTA_KELAMIN.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' AND SETUP_KEC.NO_KEC =".$NOKEC." GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM JUMLAH ANGGOTA PINDAH MENURUT JENIS KELAMIN DI KECAMATAN ".$row['NAMA_KEC']." PER KELURAHAN'";
					?>
				},
				animationEnabled: true,
            legend: {
        verticalAlign: 'bottom',
        horizontalAlign: 'center'
      },
				data: [
				{
					type: 'column',
					showInLegend: true, 
					legendMarkerColor: 'blue',
					legendText: 'Jumlah Laki-Laki/Kecamatan',
					dataPoints: [
					<?php
					// MENCARI NAMA KELURAHAN DAN DATA YANG DIPILIH BERDASARKAN KECAMATAN YANG DI PILIH LAKI LAKI
					$sql= "SELECT SETUP_KEL.NAMA_KEL, SUM(LK)AS LAKI_LAKI FROM T5_PDH_ANGGOTA_KELAMIN INNER JOIN SETUP_KEL ON T5_PDH_ANGGOTA_KELAMIN.NO_KEC = SETUP_KEL.NO_KEC AND T5_PDH_ANGGOTA_KELAMIN.NO_KEL = SETUP_KEL.NO_KEL WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEL.NO_PROP='32' AND SETUP_KEL.NO_KAB='73' AND SETUP_KEL.NO_KEC =".$NOKEC." GROUP BY SETUP_KEL.NAMA_KEL ORDER BY SETUP_KEL.NAMA_KEL";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['LAKI_LAKI']))."),  label: ".json_encode($row['NAMA_KEL'])."},";
					}	
					?>					
					]},{
					type: 'column',
					showInLegend: true, 
					legendMarkerColor: '#b82601',
					legendText: 'Jumlah Perempuan/Kecamatan',
					dataPoints: [
					<?php
					// MENCARI NAMA KELURAHAN DAN DATA YANG DIPILIH BERDASARKAN KECAMATAN YANG DI PILIH PEREMPUAN
					$sql= "SELECT SETUP_KEL.NAMA_KEL, SUM(LP)AS PEREMPUAN FROM T5_PDH_ANGGOTA_KELAMIN INNER JOIN SETUP_KEL ON T5_PDH_ANGGOTA_KELAMIN.NO_KEC = SETUP_KEL.NO_KEC AND T5_PDH_ANGGOTA_KELAMIN.NO_KEL = SETUP_KEL.NO_KEL WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEL.NO_PROP='32' AND SETUP_KEL.NO_KAB='73' AND SETUP_KEL.NO_KEC =".$NOKEC." GROUP BY SETUP_KEL.NAMA_KEL ORDER BY SETUP_KEL.NAMA_KEL";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  label: ".json_encode($row['NAMA_KEL'])."},"; 
					}	
					?>					
					]}
			]
					
			});
			kolpindahkecall1.render();
			kolpindahkecall1 = {};
  
  </script>
  
	 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

                '#0000FF',
                '#b82601'
                               
                ]);
			var piepindahkec1 = new CanvasJS.Chart('piepindahkec1', {
			colorSet: 'bdgShades',
			
				title: {
					<?PHP
					//MENCARI NAMA KECAMATAN YANG DIPILIH
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(LP) AS PEREMPUAN FROM T5_PDH_ANGGOTA_KELAMIN INNER JOIN SETUP_KEC ON T5_PDH_ANGGOTA_KELAMIN.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' AND SETUP_KEC.NO_KEC =".$NOKEC." GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JUMLAH ANGGOTA PINDAH MENURUT JENIS KELAMIN DI KECAMATAN ".$row['NAMA_KEC']."'";
					?>
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
					//MENCARI JUMLAH DATA YANG DIPILIH BERDASARKAN KECAMATAN
					$sql= "SELECT SUM(LK) AS LAKI_LAKI FROM T5_PDH_ANGGOTA_KELAMIN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73' AND NO_KEC =".$NOKEC."";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['LAKI_LAKI']))."),exploded:true,  indexLabel: 'LAKI-LAKI'},";
					}	
					?>
					<?php
					//MENCARI JUMLAH DATA YANG DIPILIH BERDASARKAN KECAMATAN
					$sql= "SELECT SUM(LP) AS PEREMPUAN FROM T5_PDH_ANGGOTA_KELAMIN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73' AND NO_KEC =".$NOKEC."";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),exploded:true,  indexLabel: 'PEREMPUAN'},"; 
					}	
					?>						
					]}
			]
					
			});
			piepindahkec1.render();
			piepindahkec1 = {};
  
  </script>
  <!-- GRAFIK DATA APABILA KECAMATAN DAN KELURAHAN DIPILIH-->

  <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

                '#0000FF',
                '#b82601'
                               
                ]);
			var kolpindahkel1 = new CanvasJS.Chart('kolpindahkel1', {
				//MENCARI BAR DATA PER KELURAHAN
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//MENCARI NAMA KELURAHAN
					$sql= "SELECT SETUP_KEL.NAMA_KEL, SUM(LK) AS LAKI_LAKI FROM T5_PDH_ANGGOTA_KELAMIN INNER JOIN SETUP_KEL ON T5_PDH_ANGGOTA_KELAMIN.NO_KEL = SETUP_KEL.NO_KEL WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEL.NO_PROP='32' AND SETUP_KEL.NO_KAB='73' AND SETUP_KEL.NO_KEC ='".$NOKEC."' AND SETUP_KEL.NO_KEL ='".$NOKEL."' GROUP BY SETUP_KEL.NAMA_KEL ORDER BY SETUP_KEL.NAMA_KEL";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM JUMLAH ANGGOTA PINDAH MENURUT JENIS KELAMIN DI KELURAHAN ".$row['NAMA_KEL']."'";
					?>
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
					showInLegend: true, 
					legendMarkerColor: 'blue',
					legendText: 'Jumlah Laki-Laki/Kecamatan',
					dataPoints: [
					<?php
					//MENCARI DATA DAN NAMA KELURAHAN BERDASARKAN KELURAHAN YANG DIPILIH
					$sql= "SELECT SETUP_KEL.NAMA_KEL, SUM(LK) AS LAKI_LAKI FROM T5_PDH_ANGGOTA_KELAMIN INNER JOIN SETUP_KEL ON T5_PDH_ANGGOTA_KELAMIN.NO_KEC = SETUP_KEL.NO_KEC AND T5_PDH_ANGGOTA_KELAMIN.NO_KEL = SETUP_KEL.NO_KEL WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEL.NO_PROP='32' AND SETUP_KEL.NO_KAB='73' AND SETUP_KEL.NO_KEC ='".$NOKEC."' AND SETUP_KEL.NO_KEL ='".$NOKEL."' GROUP BY SETUP_KEL.NAMA_KEL ORDER BY SETUP_KEL.NAMA_KEL";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['LAKI_LAKI']))."),  label: ".json_encode($row['NAMA_KEL'])."},";
					}	
					?>					
					]},{
					type: 'column',
					showInLegend: true, 
					legendMarkerColor: '#b82601',
					legendText: 'Jumlah Perempuan/Kecamatan',
					dataPoints: [
					<?php
					//MENCARI DATA DAN NAMA KELURAHAN BERDASARKAN KELURAHAN YANG DIPILIH
					$sql= "SELECT SETUP_KEL.NAMA_KEL, SUM(LP) AS PEREMPUAN FROM T5_PDH_ANGGOTA_KELAMIN INNER JOIN SETUP_KEL ON T5_PDH_ANGGOTA_KELAMIN.NO_KEC = SETUP_KEL.NO_KEC AND T5_PDH_ANGGOTA_KELAMIN.NO_KEL = SETUP_KEL.NO_KEL WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEL.NO_PROP='32' AND SETUP_KEL.NO_KAB='73' AND SETUP_KEL.NO_KEC ='".$NOKEC."' AND SETUP_KEL.NO_KEL ='".$NOKEL."' GROUP BY SETUP_KEL.NAMA_KEL ORDER BY SETUP_KEL.NAMA_KEL";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  label: ".json_encode($row['NAMA_KEL'])."},"; 
					}	
					?>					
					]}
			]
					
			});
			kolpindahkel1.render();
			kolpindahkel1 = {};
  
  </script>
	 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

                '#0000FF',
                '#b82601'
                               
                ]);
			var piepindahkel1 = new CanvasJS.Chart('piepindahkel1', {
				//MENCARI DATA PIE PER KELURAHAN
			colorSet: 'bdgShades',
			
				title: {
						<?PHP
						// MENCARI NAMA KELURAHAN
					$sql= "SELECT SETUP_KEL.NAMA_KEL, LP AS PEREMPUAN FROM T5_PDH_ANGGOTA_KELAMIN INNER JOIN SETUP_KEL ON T5_PDH_ANGGOTA_KELAMIN.NO_KEC = SETUP_KEL.NO_KEC AND T5_PDH_ANGGOTA_KELAMIN.NO_KEL = SETUP_KEL.NO_KEL WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEL.NO_PROP='32' AND SETUP_KEL.NO_KAB='73' AND SETUP_KEL.NO_KEC ='".$NOKEC."' AND SETUP_KEL.NO_KEL ='".$NOKEL."' ORDER BY SETUP_KEL.NAMA_KEL";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JUMLAH ANGGOTA PINDAH MENURUT JENIS KELAMIN DI KELURAHAN ".$row['NAMA_KEL']."'";
					?> 
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
			//yValueFormatString: "##,. RIBU",
			legendText: "{indexLabel}",
					dataPoints: [
					<?php
					// MENCARI DATA PER KELURAHAN 
					$sql= "SELECT LK AS LAKI_LAKI FROM T5_PDH_ANGGOTA_KELAMIN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73' AND NO_KEC =".$NOKEC." AND NO_KEL =".$NOKEL."";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['LAKI_LAKI']))."),exploded:true,  indexLabel: 'LAKI-LAKI'},";
					}	
					?>
					<?php
					// MENCARI DATA PER KELURAHAN
					$sql= "SELECT LP AS PEREMPUAN FROM T5_PDH_ANGGOTA_KELAMIN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73' AND NO_KEC =".$NOKEC." AND NO_KEL =".$NOKEL."";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),exploded:true,  indexLabel: 'PEREMPUAN'},"; 
					}	
					?>						
					]}
			]
					
			});
			piepindahkel1.render();
			piepindahkel1 = {};
  
  </script>
  <!-- AKHIR STATISTIK 1 -->
  
  <!-- STATISTIK 2 -->
 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

                '#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',
                               
                ]);
			var kolpindahkota2 = new CanvasJS.Chart('kolpindahkota2', {
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM KOLOM JUMLAH ANGGOTA PINDAH MENURUT KLASIFIKASI KEPINDAHAN DI KOTA BANDUNG'
				},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,
       
				data: [
				{
					type: 'column',
			    indexLabelMaxWidth: 50,
				//indexLabelWrap: true, // change to false 
				
					dataPoints: [
					<?php
					$sql= "SELECT SUM(ANTAR_DESA) AS P1,SUM(ANTAR_KEC) AS P2,SUM(ANTAR_KAB) AS P3,SUM(ANTAR_PROV) AS P4 FROM T5_PDH_ANGGOTA_KLASIFIKASI WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'Antar DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'Antar KECAMATAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'Antar KABUPATEN/KOTA'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'Antar PROVINSI'},";
	
					?>					
					]}
			]
					
			});
			kolpindahkota2.render();
			kolpindahkota2 = {};
  
  </script>
  	 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

                '#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',

                               
                ]);
			var piepindahkota2 = new CanvasJS.Chart('piepindahkota2', {
			colorSet: 'bdgShades',
			
				title: {
					//text: 'DIAGRAM PIE JUMLAH ANGGOTA PINDAH MENURUT KLASIFIKASI KEPINDAHAN DI KOTA BANDUNG'
				},
				legend: {
			//itemMaxWidth: 100,
			//itemWrap: true,
			horizontalAlign: "center"// Change to true or false 
			},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,
          
				data: [
				{
					type: "pie",
			showInLegend: true,
			legendText: "{indexLabel}",
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. ",
			
					dataPoints: [
					<?php
					$sql= "SELECT SUM(ANTAR_DESA) AS P1,SUM(ANTAR_KEC) AS P2,SUM(ANTAR_KAB) AS P3,SUM(ANTAR_PROV) AS P4 FROM T5_PDH_ANGGOTA_KLASIFIKASI WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded:true,  indexLabel: 'Antar DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),exploded:true,  indexLabel: 'Antar KECAMATAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),exploded:true,  indexLabel: 'Antar KABUPATEN/KOTA'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),exploded:true,  indexLabel: 'Antar PROVINSI'},";
					

					?>						
					]}
			]
					
			});
			piepindahkota2.render();
			piepindahkota2 = {};
  
  </script>
  
  <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array
				
				'#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',

                              
                ]);
			var kolpindahkec2 = new CanvasJS.Chart('kolpindahkec2', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//AMBIL NAMA KECAMATAN DAN TOTAL PENJUMLAHAN NIK TIAP KELUARAHAN BERDASARKAN KECAMATAN YANG DI PILIH 
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM JUMLAH ANGGOTA PINDAH MENURUT KLASIFIKASI KEPINDAHAN DI KECAMATAN ".$row['NAMA_KEC']."'";
					?>
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
					$sql= "SELECT SUM(ANTAR_DESA) AS P1,SUM(ANTAR_KEC) AS P2,SUM(ANTAR_KAB) AS P3,SUM(ANTAR_PROV) AS P4 FROM T5_PDH_ANGGOTA_KLASIFIKASI WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC=".$NOKEC." AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'Antar DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'Antar KECAMATAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'Antar KABUPATEN/KOTA'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'Antar PROVINSI'},";

					?>					
					//]}				
					]}
			]
					
			});
			kolpindahkec2.render();
			kolpindahkec2 = {};
  
  </script>

	 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array
	
				'#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',

                               
                ]);
			var piepindahkec2 = new CanvasJS.Chart('piepindahkec2', {
			colorSet: 'bdgShades',
			
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JUMLAH ANGGOTA PINDAH MENURUT KLASIFIKASI KEPINDAHAN DI KECAMATAN ".$row['NAMA_KEC']."'";
					?>
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
					$sql= "SELECT SUM(ANTAR_DESA) AS P1,SUM(ANTAR_KEC) AS P2,SUM(ANTAR_KAB) AS P3,SUM(ANTAR_PROV) AS P4 FROM T5_PDH_ANGGOTA_KLASIFIKASI WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC=".$NOKEC." AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded:true,  indexLabel: 'Antar DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),exploded:true,  indexLabel: 'Antar KECAMATAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),exploded:true,  indexLabel: 'Antar KABUPATEN/KOTA'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),exploded:true,  indexLabel: 'Antar PROVINSI'},";

					?>						
					]}
			]
					
			});
			piepindahkec2.render();
			piepindahkec2 = {};
  
  </script>
  <!-- Grafik Kecamatan Pilih <>0 kelurahan pilih <>0-->

 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

              
                '#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',
                               
                ]);
			var kolpindahkel2 = new CanvasJS.Chart('kolpindahkel2', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM JUMLAH ANGGOTA PINDAH MENURUT KLASIFIKASI KEPINDAHAN DI KELURAHAN ".$row['NAMA_KEL']."'";
					?>
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
					//showInLegend: true, 
					//legendMarkerColor: 'blue',
					//legendText: 'Jumlah Laki-Laki/Kecamatan',
					dataPoints: [
					<?php
					$sql= "SELECT ANTAR_DESA AS P1, ANTAR_KEC P2, ANTAR_KAB AS P3, ANTAR_PROV AS P4 FROM T5_PDH_ANGGOTA_KLASIFIKASI WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'Antar DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'Antar KECAMATAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'Antar KABUPATEN/KOTA'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'Antar PROVINSI'},";
					?>
					]}
			]
					
			});
			kolpindahkel2.render();
			kolpindahkel2 = {};
  
  </script>
  
	 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

				'#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',
                                  
                ]);
			var piepindahkel2 = new CanvasJS.Chart('piepindahkel2', {
			colorSet: 'bdgShades',
			
				title: {
						<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JUMLAH PINDAH ANGGOTA MENURUT KLASIFIKASI KEPINDAHAN DI KELURAHAN ".$row['NAMA_KEL']."'";
					?>
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
			//yValueFormatString: "##,. RIBU",
			legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT ANTAR_DESA AS P1, ANTAR_KEC P2, ANTAR_KAB AS P3, ANTAR_PROV AS P4 FROM T5_PDH_ANGGOTA_KLASIFIKASI WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded:true,  label: 'Antar DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),exploded:true,  label: 'Antar KECAMATAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),exploded:true,  label: 'Antar KABUPATEN/KOTA'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),exploded:true,  label: 'Antar PROVINSI'},";
					?>						
					]}
			]
					
			});
			piepindahkel2.render();
			piepindahkel2 = {};
  
  </script>
  <!--  AKHIR STATISTIK 2 -->
 
   <!-- STATISTIK 3 -->
 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

                '#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',
                '#B08BEB',
				'#3EA0DD',
				'#F5A52A',
				
                ]);
			var kolpindahkota3 = new CanvasJS.Chart('kolpindahkota3', {
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM KOLOM JUMLAH ANGGOTA PINDAH MENURUT ALASAN KEPINDAHAN DI KOTA BANDUNG'
				},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,
				
				axisX:{
			interval: 1
			},
       
				data: [
				{
					type: 'column',
			    indexLabelMaxWidth: 50,
				//indexLabelWrap: true, // change to false 
				
					dataPoints: [
					<?php
					$sql= "SELECT SUM(PEKERJAAN) AS P1,SUM(PENDIDIKAN) AS P2,SUM(KEAMANAN) AS P3,SUM(KESEHATAN) AS P4,SUM(PERUMAHAN) AS P5,SUM(KELUARGA) AS P6,SUM(LAIN_LAIN) AS P7 FROM T5_PDH_ANGGOTA_ALASAN WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'ALASAN PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'ALASAN PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'ALASAN KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'AKESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'ALASAN PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'ALASAN KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'LAINNYA'},";
	
					?>					
					]}
			]
					
			});
			kolpindahkota3.render();
			kolpindahkota3 = {};
	</script>
	<script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

                '#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',
				'#B08BEB',
				'#3EA0DD',
				'#F5A52A',
                               
                ]);
			var piepindahkota3 = new CanvasJS.Chart('piepindahkota3', {
			colorSet: 'bdgShades',
			
				title: {
					//text: 'DIAGRAM PIE JUMLAH ANGGOTA PINDAH MENURUT ALASAN KEPINDAHAN DI KOTA BANDUNG'
				},
				legend: {
			itemMaxWidth: 100,
			itemWrap: true,
			horizontalAlign: "center"// Change to true or false 
			},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. ",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(PEKERJAAN) AS P1,SUM(PENDIDIKAN) AS P2,SUM(KEAMANAN) AS P3,SUM(KESEHATAN) AS P4,SUM(PERUMAHAN) AS P5,SUM(KELUARGA) AS P6,SUM(LAIN_LAIN) AS P7 FROM T5_PDH_ANGGOTA_ALASAN WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded:true,  indexLabel: 'ALASAN PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),exploded:true,  indexLabel: 'ALASAN PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),exploded:true,  indexLabel: 'ALASAN KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),exploded:true,  indexLabel: 'AKESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),exploded:true,  indexLabel: 'ALASAN PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),exploded:true,  indexLabel: 'ALASAN KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),exploded:true,  indexLabel: 'LAINNYA'},";
					?>						
					]}
			]
					
			});
			piepindahkota3.render();
			piepindahkota3 = {};
  
  </script>
	
	 <!-- Grafik Kecamatan Pilih <>0-->

 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array
				
				'#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',
				'#B08BEB',
				'#3EA0DD',
				'#F5A52A',
                              
                ]);
			var kolpindahkec3 = new CanvasJS.Chart('kolpindahkec3', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//AMBIL NAMA KECAMATAN DAN TOTAL PENJUMLAHAN NIK TIAP KELUARAHAN BERDASARKAN KECAMATAN YANG DI PILIH 
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM JUMLAH ANGGOTA PINDAH MENURUT KLASIFIKASI KEPINDAHAN DI KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,
				
            //legend: {
        //verticalAlign: 'bottom',
        //horizontalAlign: 'center'
      //},
	  axisX:{
           interval: 1
     },
				data: [
				{
					type: 'column',
					 indexLabelMaxWidth: 50,
					dataPoints: [
					<?php
					$sql= "SELECT SUM(PEKERJAAN) AS P1,SUM(PENDIDIKAN) AS P2,SUM(KEAMANAN) AS P3,SUM(KESEHATAN) AS P4,SUM(PERUMAHAN) AS P5,SUM(KELUARGA) AS P6,SUM(LAIN_LAIN) AS P7 FROM T5_PDH_ANGGOTA_ALASAN WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'ALASAN PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'ALASAN PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'ALASAN KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'ALASAN KESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'ALASAN PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'ALASAN KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'ALASAN LAINNYA'},";
					?>					
					//]}				
					]}
			]
					
			});
			kolpindahkec3.render();
			kolpindahkec3 = {};
  
  </script>

	 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array
	
				'#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',
				'#B08BEB',
				'#3EA0DD',
				'#F5A52A',
                               
                ]);
			var piepindahkec3 = new CanvasJS.Chart('piepindahkec3', {
			colorSet: 'bdgShades',
			
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JUMLAH ANGGOTA PINDAH MENURUT ALASAN KEPINDAHAN DI KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(PEKERJAAN) AS P1,SUM(PENDIDIKAN) AS P2,SUM(KEAMANAN) AS P3,SUM(KESEHATAN) AS P4,SUM(PERUMAHAN) AS P5,SUM(KELUARGA) AS P6,SUM(LAIN_LAIN) AS P7 FROM T5_PDH_ANGGOTA_ALASAN WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded:true,  label: 'ALASAN PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),exploded:true,  label: 'ALASAN PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),exploded:true,  label: 'ALASAN KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),exploded:true,  label: 'ALASAN KESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),exploded:true,  label: 'ALASAN PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),exploded:true,  label: 'ALASAN KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),exploded:true,  label: 'ALASAN LAINNYA'},";
					?>						
					]}
			]
					
			});
			piepindahkec3.render();
			piepindahkec3 = {};
  
  </script>
  <!-- Grafik Kecamatan Pilih <>0 kelurahan pilih <>0-->

 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

              
                '#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',
				'#B08BEB',
				'#3EA0DD',
				'#F5A52A',
   
                ]);
			var kolpindahkel3 = new CanvasJS.Chart('kolpindahkel3', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM JUMLAH ANGGOTA PINDAH MENURUT ALASAN KEPINDAHAN DI KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,
				
            legend: {
        verticalAlign: 'bottom',
        horizontalAlign: 'center'
      },
	  axisX:{
           interval: 1
     },
				data: [
				{
					type: 'column',
					//showInLegend: true, 
					//legendMarkerColor: 'blue',
					//legendText: 'Jumlah Laki-Laki/Kecamatan',
					dataPoints: [
					<?php
					$sql= "SELECT PEKERJAAN AS P1,PENDIDIKAN AS P2,KEAMANAN AS P3,KESEHATAN AS P4,PERUMAHAN AS P5,KELUARGA AS P6,LAIN_LAIN AS P7 FROM T5_PDH_ANGGOTA_ALASAN WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."'AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'ALASAN PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'ALASAN PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'ALASAN KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'ALASAN KESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'ALASAN PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'ALASAN KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'LAINNYA'},";

					?>
					]}
			]
					
			});
			kolpindahkel3.render();
			kolpindahkel3 = {};
  
  </script>
	 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

				'#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',
				'#B08BEB',
				'#3EA0DD',
				'#F5A52A',
                                  
                ]);
			var piepindahkel3 = new CanvasJS.Chart('piepindahkel3', {
			colorSet: 'bdgShades',
			
				title: {
						<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JUMLAH ANGGOTA PINDAH MENURUT ALASAN KEPINDAHAN DI KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "##,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT PEKERJAAN AS P1,PENDIDIKAN AS P2,KEAMANAN AS P3,KESEHATAN AS P4,PERUMAHAN AS P5,KELUARGA AS P6,LAIN_LAIN AS P7 FROM T5_PDH_ANGGOTA_ALASAN WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."'AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded:true,  label: 'ALASAN PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),exploded:true,  label: 'ALASAN PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),exploded:true,  label: 'ALASAN KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),exploded:true,  label: 'ALASAN KESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),exploded:true,  label: 'ALASAN PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),exploded:true,  label: 'ALASAN KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),exploded:true,  label: 'LAINNYA'},";
					
					?>						
					]}
			]
					
			});
			piepindahkel3.render();
			piepindahkel3 = {};
  
  </script>
  <!--  AKHIR STATISTIK 3 -->
  
  <!-- STATISTIK 4 -->
 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

                '#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',
                               
                ]);
			var kolpindahkota4 = new CanvasJS.Chart('kolpindahkota4', {
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM KOLOM JUMLAH SURAT PINDAH MENURUT KLASIFIKASI KEPINDAHAN DI KOTA BANDUNG'
				},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,
       
				data: [
				{
					type: 'column',
			    indexLabelMaxWidth: 50,
				//indexLabelWrap: true, // change to false 
				
					dataPoints: [
					<?php
					$sql= "SELECT SUM(ANTAR_DESA) AS P1,SUM(ANTAR_KEC) AS P2,SUM(ANTAR_KAB) AS P3,SUM(ANTAR_PROV) AS P4 FROM T5_PDH_SURAT_KLASIFIKASI WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'Antar DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'Antar KECAMATAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'Antar KABUPATEN/KOTA'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'Antar PROVINSI'},";
	
					?>					
					]}
			]
					
			});
			kolpindahkota4.render();
			kolpindahkota4 = {};
  
  </script>
  	 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

                '#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',

                               
                ]);
			var piepindahkota4 = new CanvasJS.Chart('piepindahkota4', {
			colorSet: 'bdgShades',
			
				title: {
					//text: 'DIAGRAM PIE JUMLAH SURAT PINDAH MENURUT KLASIFIKASI KEPINDAHAN DI KOTA BANDUNG'
				},
				legend: {
			//itemMaxWidth: 100,
			//itemWrap: true,
			horizontalAlign: "center"// Change to true or false 
			},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,
          
				data: [
				{
					type: "pie",
			showInLegend: true,
			legendText: "{indexLabel}",
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. ",
			
					dataPoints: [
					<?php
					$sql= "SELECT SUM(ANTAR_DESA) AS P1,SUM(ANTAR_KEC) AS P2,SUM(ANTAR_KAB) AS P3,SUM(ANTAR_PROV) AS P4 FROM T5_PDH_SURAT_KLASIFIKASI WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded:true,  indexLabel: 'Antar DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),exploded:true,  indexLabel: 'Antar KECAMATAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),exploded:true,  indexLabel: 'Antar KABUPATEN/KOTA'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),exploded:true,  indexLabel: 'Antar PROVINSI'},";
					

					?>						
					]}
			]
					
			});
			piepindahkota4.render();
			piepindahkota4 = {};
  
  </script>
  
  <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array
				
				'#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',

                              
                ]);
			var kolpindahkec4 = new CanvasJS.Chart('kolpindahkec4', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//AMBIL NAMA KECAMATAN DAN TOTAL PENJUMLAHAN NIK TIAP KELUARAHAN BERDASARKAN KECAMATAN YANG DI PILIH 
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM JUMLAH SURAT PINDAH MENURUT KLASIFIKASI KEPINDAHAN DI KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,
				
            //legend: {
        //verticalAlign: 'bottom',
        //horizontalAlign: 'center'
      //},
				data: [
				{
					type: 'column',
					 indexLabelMaxWidth: 50,
					dataPoints: [
					<?php
					$sql= "SELECT SUM(ANTAR_DESA) AS P1,SUM(ANTAR_KEC) AS P2,SUM(ANTAR_KAB) AS P3,SUM(ANTAR_PROV) AS P4 FROM T5_PDH_SURAT_KLASIFIKASI WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC=".$NOKEC." AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'Antar DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'Antar KECAMATAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'Antar KABUPATEN/KOTA'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'Antar PROVINSI'},";

					?>					
					//]}				
					]}
			]
					
			});
			kolpindahkec4.render();
			kolpindahkec4 = {};
  
  </script>

	 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array
	
				'#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',

                               
                ]);
			var piepindahkec4 = new CanvasJS.Chart('piepindahkec4', {
			colorSet: 'bdgShades',
			
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JUMLAH SURAT PINDAH MENURUT KLASIFIKASI KEPINDAHAN DI KECAMATAN ".$row['NAMA_KEC']."'";
					?>
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
					$sql= "SELECT SUM(ANTAR_DESA) AS P1,SUM(ANTAR_KEC) AS P2,SUM(ANTAR_KAB) AS P3,SUM(ANTAR_PROV) AS P4 FROM T5_PDH_SURAT_KLASIFIKASI WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC=".$NOKEC." AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded:true,  indexLabel: 'Antar DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),exploded:true,  indexLabel: 'Antar KECAMATAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),exploded:true,  indexLabel: 'Antar KABUPATEN/KOTA'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),exploded:true,  indexLabel: 'Antar PROVINSI'},";

					?>						
					]}
			]
					
			});
			piepindahkec4.render();
			piepindahkec4 = {};
  
  </script>
  <!-- Grafik Kecamatan Pilih <>0 kelurahan pilih <>0-->

 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

              
                '#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',
                               
                ]);
			var kolpindahkel4 = new CanvasJS.Chart('kolpindahkel4', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM JUMLAH SURAT PINDAH MENURUT KLASIFIKASI KEPINDAHAN DI KELURAHAN ".$row['NAMA_KEL']."'";
					?>
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
					//showInLegend: true, 
					//legendMarkerColor: 'blue',
					//legendText: 'Jumlah Laki-Laki/Kecamatan',
					dataPoints: [
					<?php
					$sql= "SELECT ANTAR_DESA AS P1, ANTAR_KEC P2, ANTAR_KAB AS P3, ANTAR_PROV AS P4 FROM T5_PDH_SURAT_KLASIFIKASI WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'Antar DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'Antar KECAMATAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'Antar KABUPATEN/KOTA'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'Antar PROVINSI'},";
					?>
					]}
			]
					
			});
			kolpindahkel4.render();
			kolpindahkel4 = {};
  
  </script>
  
	 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

				'#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',
                                  
                ]);
			var piepindahkel4 = new CanvasJS.Chart('piepindahkel4', {
			colorSet: 'bdgShades',
			
				title: {
						<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JUMLAH SURAT PINDAH MENURUT KLASIFIKASI KEPINDAHAN DI KELURAHAN ".$row['NAMA_KEL']."'";
					?>
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
			//yValueFormatString: "##,. RIBU",
			legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT ANTAR_DESA AS P1, ANTAR_KEC P2, ANTAR_KAB AS P3, ANTAR_PROV AS P4 FROM T5_PDH_SURAT_KLASIFIKASI WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded:true,  label: 'Antar DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),exploded:true,  label: 'Antar KECAMATAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),exploded:true,  label: 'Antar KABUPATEN/KOTA'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),exploded:true,  label: 'Antar PROVINSI'},";
					?>						
					]}
			]
					
			});
			piepindahkel4.render();
			piepindahkel4 = {};
  
  </script>
  <!--  AKHIR STATISTIK 4 -->
  
  <!-- STATISTIK 5 -->
 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

                '#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',
                '#B08BEB',
				'#3EA0DD',
				'#F5A52A',
				
                ]);
			var kolpindahkota5 = new CanvasJS.Chart('kolpindahkota5', {
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM KOLOM JUMLAH SURAT PINDAH MENURUT ALASAN KEPINDAHAN DI KOTA BANDUNG'
				},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,
				
				axisX:{
			interval: 1
			},
       
				data: [
				{
					type: 'column',
			    indexLabelMaxWidth: 50,
				//indexLabelWrap: true, // change to false 
				
					dataPoints: [
					<?php
					$sql= "SELECT SUM(PEKERJAAN) AS P1,SUM(PENDIDIKAN) AS P2,SUM(KEAMANAN) AS P3,SUM(KESEHATAN) AS P4,SUM(PERUMAHAN) AS P5,SUM(KELUARGA) AS P6,SUM(LAIN_LAIN) AS P7 FROM T5_PDH_SURAT_ALASAN WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'ALASAN PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'ALASAN PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'ALASAN KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'AKESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'ALASAN PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'ALASAN KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'LAINNYA'},";
	
					?>					
					]}
			]
					
			});
			kolpindahkota5.render();
			kolpindahkota5 = {};
	</script>
	<script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

                '#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',
				'#B08BEB',
				'#3EA0DD',
				'#F5A52A',
                               
                ]);
			var piepindahkota5 = new CanvasJS.Chart('piepindahkota5', {
			colorSet: 'bdgShades',
			
				title: {
					text: 'DIAGRAM PIE JUMLAH SURAT PINDAH MENURUT ALASAN KEPINDAHAN DI KOTA BANDUNG'
				},
				//legend: {
			//itemMaxWidth: 100,
			//itemWrap: true,
			//horizontalAlign: "center"// Change to true or false 
			//},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. ",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(PEKERJAAN) AS P1,SUM(PENDIDIKAN) AS P2,SUM(KEAMANAN) AS P3,SUM(KESEHATAN) AS P4,SUM(PERUMAHAN) AS P5,SUM(KELUARGA) AS P6,SUM(LAIN_LAIN) AS P7 FROM T5_PDH_SURAT_ALASAN WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "{y: parseInt(".(json_encode($row['P1']))."),exploded:true,  indexLabel: 'ALASAN PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),exploded:true,  indexLabel: 'ALASAN PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),exploded:true,  indexLabel: 'ALASAN KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),exploded:true,  indexLabel: 'AKESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),exploded:true,  indexLabel: 'ALASAN PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),exploded:true,  indexLabel: 'ALASAN KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),exploded:true,  indexLabel: 'LAINNYA'},";
					?>						
					]}
			]
					
			});
			piepindahkota5.render();
			piepindahkota5 = {};
  
  </script>
	
	 <!-- Grafik Kecamatan Pilih <>0-->

 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array
				
				'#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',
				'#B08BEB',
				'#3EA0DD',
				'#F5A52A',
                              
                ]);
			var kolpindahkec5 = new CanvasJS.Chart('kolpindahkec5', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//AMBIL NAMA KECAMATAN DAN TOTAL PENJUMLAHAN NIK TIAP KELUARAHAN BERDASARKAN KECAMATAN YANG DI PILIH 
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM JUMLAH SURAT PINDAH MENURUT KLASIFIKASI KEPINDAHAN DI KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,
				
            //legend: {
        //verticalAlign: 'bottom',
        //horizontalAlign: 'center'
      //},
	  axisX:{
           interval: 1
     },
				data: [
				{
					type: 'column',
					 indexLabelMaxWidth: 50,
					dataPoints: [
					<?php
					$sql= "SELECT SUM(PEKERJAAN) AS P1,SUM(PENDIDIKAN) AS P2,SUM(KEAMANAN) AS P3,SUM(KESEHATAN) AS P4,SUM(PERUMAHAN) AS P5,SUM(KELUARGA) AS P6,SUM(LAIN_LAIN) AS P7 FROM T5_PDH_SURAT_ALASAN WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'ALASAN PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'ALASAN PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'ALASAN KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'ALASAN KESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'ALASAN PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'ALASAN KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'ALASAN LAINNYA'},";
					?>					
					//]}				
					]}
			]
					
			});
			kolpindahkec5.render();
			kolpindahkec5 = {};
  
  </script>

	 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array
	
				'#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',
				'#B08BEB',
				'#3EA0DD',
				'#F5A52A',
                               
                ]);
			var piepindahkec5 = new CanvasJS.Chart('piepindahkec5', {
			colorSet: 'bdgShades',
			
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JUMLAH SURAT PINDAH MENURUT ALASAN KEPINDAHAN DI KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(PEKERJAAN) AS P1,SUM(PENDIDIKAN) AS P2,SUM(KEAMANAN) AS P3,SUM(KESEHATAN) AS P4,SUM(PERUMAHAN) AS P5,SUM(KELUARGA) AS P6,SUM(LAIN_LAIN) AS P7 FROM T5_PDH_SURAT_ALASAN WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded:true,  label: 'ALASAN PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),exploded:true,  label: 'ALASAN PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),exploded:true,  label: 'ALASAN KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),exploded:true,  label: 'ALASAN KESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),exploded:true,  label: 'ALASAN PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),exploded:true,  label: 'ALASAN KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),exploded:true,  label: 'ALASAN LAINNYA'},";
					?>						
					]}
			]
					
			});
			piepindahkec5.render();
			piepindahkec5 = {};
  
  </script>
  <!-- Grafik Kecamatan Pilih <>0 kelurahan pilih <>0-->

 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

              
                '#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',
				'#B08BEB',
				'#3EA0DD',
				'#F5A52A',
   
                ]);
			var kolpindahkel5 = new CanvasJS.Chart('kolpindahkel5', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM JUMLAH SURAT PINDAH MENURUT ALASAN KEPINDAHAN DI KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,
				
            legend: {
        verticalAlign: 'bottom',
        horizontalAlign: 'center'
      },
	  axisX:{
           interval: 1
     },
				data: [
				{
					type: 'column',
					//showInLegend: true, 
					//legendMarkerColor: 'blue',
					//legendText: 'Jumlah Laki-Laki/Kecamatan',
					dataPoints: [
					<?php
					$sql= "SELECT PEKERJAAN AS P1,PENDIDIKAN AS P2,KEAMANAN AS P3,KESEHATAN AS P4,PERUMAHAN AS P5,KELUARGA AS P6,LAIN_LAIN AS P7 FROM T5_PDH_SURAT_ALASAN WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."'AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'ALASAN PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'ALASAN PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'ALASAN KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'ALASAN KESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'ALASAN PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'ALASAN KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'LAINNYA'},";

					?>
					]}
			]
					
			});
			kolpindahkel5.render();
			kolpindahkel5 = {};
  
  </script>
	 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

				'#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',
				'#B08BEB',
				'#3EA0DD',
				'#F5A52A',
                                  
                ]);
			var piepindahkel5 = new CanvasJS.Chart('piepindahkel5', {
			colorSet: 'bdgShades',
			
				title: {
						<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JUMLAH SURAT PINDAH MENURUT ALASAN KEPINDAHAN DI KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "##,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT PEKERJAAN AS P1,PENDIDIKAN AS P2,KEAMANAN AS P3,KESEHATAN AS P4,PERUMAHAN AS P5,KELUARGA AS P6,LAIN_LAIN AS P7 FROM T5_PDH_SURAT_ALASAN WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."'AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded:true,  label: 'ALASAN PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),exploded:true,  label: 'ALASAN PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),exploded:true,  label: 'ALASAN KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),exploded:true,  label: 'ALASAN KESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),exploded:true, label: 'ALASAN PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),exploded:true,  label: 'ALASAN KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),exploded:true,  label: 'LAINNYA'},";
					
					?>						
					]}
			]
					
			});
			piepindahkel5.render();
			piepindahkel5 = {};
  
  </script>
  <!--  AKHIR STATISTIK 5 -->
  
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