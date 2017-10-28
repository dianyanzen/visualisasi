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
	/*
					date_default_timezone_set("Asia/Jakarta");
					$array_hari = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat", "Sabtu","Minggu");
					$hari = $array_hari[date("N")];
					//Format Tanggal
					$tanggal = date ("j");

					//Array Bulan
					$array_bulan = array(1=>"JANUARI","FEBRUARI","MARET", "APRIL", "MEI", "JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER", "NOVEMBER","DESEMBER");
					$bulan = $array_bulan[date("n")];

					//Format Tahun
					$tahun = date("Y");
					
					//echo "The time is " . date("h:i:sa");
					echo "<small>".$hari.", " . $tanggal ." ". $bulan ." ". $tahun. ", Update Terakhir <span id='time-part'>".date("H:i:s")."</span>.</small></h1>";
					//echo "Today is " . date("Y.m.d") . "<br>";
					//echo "Today is " . date("Y-m-d") . "<br>";
					//echo "Today is " . date("l");
					*/
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
                                <li><a href="stdpindah.php">Pindah</a>
                                </li>
                                <li class="active"><a href="stddatang.php">Datang</a>
                                </li>
                            </ul>
					
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="kartukeluarga-pills">
								<br>
                                    <div class="col-lg-12">
										<div class="panel panel-primary">
											<div class="panel-heading">
												Statistik Pendaftaran Penduduk WNI Kota Bandung - Surat Datang
											</div>
										<div class="panel-body" >
										
										<form method="post" name="formstatistik" id="formstatistik" action="stddatang.php" role="form">
	
										<!--start row-->
										<div class="row">
											<div class="col-lg-12">
											<div class="form-group col-lg-6">
                                            <label>Pilih Kecamatan</label>
                                            <select name="NO_KEC" data-id="NO_KEC" id="NO_KEC" class="form-control" >
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
                                            <select name="NO_KEL" data-id="NO_KEL" id="NO_KEL" class="form-control">
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
                                            <select name="statistik" data-id="statistik" id="statistik" class="form-control">
                                              	<option value="1">Jumlah Kedatangan Menurut Alasan Kepindahan</option>
												<option value="2">Jumlah Kedatangan Menurut Klasifikasi Kepindahan</option>
												<option value="3">Jumlah Kedatangan Menurut Jenis Kedatangan</option>
												<option value="4">Jumlah Anggota Datang Menurut Alasan Kepindahan</option>
												<option value="5">Jumlah Anggota Datang Menurut Klasifikasi Kepindahan</option>
												<option value="6">Jumlah Anggota Datang Menurut Jenis Kedatagan </option>
												<option value="7">Jumlah Anggota Datang Menurut Jenis Kelamin </option>
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

//if submit is not blanked i.e. it is clicked.
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
	
	//MENGECEK APAKAH BULAN YANG DI PILIH TERSEDIA DI DB
	$sql= "SELECT * FROM T5_DTG_ANGGOTA_KELAMIN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
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
									<div align='center'><h1> <b> DIAGRAM KOLOM JUMLAH DATANG MENURUT ALASAN KEPINDAHAN <br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='kolkkota1' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1> <b> DIAGRAM PIE JUMLAH DATANG MENURUT ALASAN KEPINDAHAN <br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='piekkkota1' style='height: 400px; width: 100%;'></div>
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
					echo"<div align='center'><h1> <b> DIAGRAM KOLOM JUMLAH DATANG MENURUT ALASAN KEPINDAHAN <br>KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun</b></h1></div>
					
                                    <div id='kolkkkec1' style='height: 400px; width: 100%;'></div>
                                </div>
                                 <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1> <b> DIAGRAM PIE JUMLAH DATANG MENURUT ALASAN KEPINDAHAN <br>KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun</b></h1></div>
					
                                    <div id='piekkkec1' style='height: 400px; width: 100%;'></div>
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
					echo"<div align='center'><h1> <b> DIAGRAM KOLOM JUMLAH DATANG MENURUT ALASAN KEPINDAHAN KELURAHAN <br> KELURAHAN ".$row['NAMA_KEL']." BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='kolkkkel1' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1> <b> DIAGRAM PIE JUMLAH DATANG MENURUT ALASAN KEPINDAHAN KELURAHAN <br> KELURAHAN ".$row['NAMA_KEL']." <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='piekkkel1' style='height: 400px; width: 100%;'></div>
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
	$sql= "SELECT * FROM T5_KEPKEL_PENDIDIKAN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
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
									<div align='center'><h1> <b> DIAGRAM KOLOM JUMLAH DATANG MENURUT KLASIFIKASI KEPINDAHAN <br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='kolkkkota2' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1> <b> DIAGRAM PIE JUMLAH DATANG MENURUT KLASIFIKASI KEPINDAHAN <br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='piekkkota2' style='height: 400px; width: 100%;'></div>
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
					echo"<div align='center'><h1> <b> DIAGRAM KOLOM KEDATANGAN MENURUT KLASIFIKASI KEPINDAHAN <br>KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='kolkkkec2' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1> <b> DIAGRAM PIE KEDATANGAN MENURUT KLASIFIKASI KEPINDAHAN <br>KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='piekkkec2' style='height: 400px; width: 100%;'></div>
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
					echo"<div align='center'><h1> <b> DIAGRAM KOLOM JUMLAH KEDATANGAN MENURUT KLASIFIKASI KEPINDAHAN KECAMATAN ".$row['NAMA_KEL']." <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='kolkkkel2' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1> <b> DIAGRAM PIE JUMLAH KEDATANGAN MENURUT KLASIFIKASI KEPINDAHAN KECAMATAN ".$row['NAMA_KEL']." <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='piekkkel2' style='height: 400px; width: 100%;'></div>
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
	$sql= "SELECT * FROM T5_KEPKEL_PENDIDIKAN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
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
									<div align='center'><h1> <b> DIAGRAM KOLOM JUMLAH KEDATANGAN MENURUT JENIS KEDATANGAN <br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='kolkkkota3' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1> <b> DIAGRAM PIE JUMLAH KEDATANGAN MENURUT JENIS KEDATANGAN <br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='piekkkota3' style='height: 400px; width: 100%;'></div>
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
					echo"<div align='center'><h1> <b> DIAGRAM KOLOM JUMLAH KEDATANGAN MENURUT JENIS KEDATANGAN KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='kolkkkec3' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1> <b> DIAGRAM PIE JUMLAH KEDATANGAN MENURUT JENIS KEDATANGAN KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='piekkkec3' style='height: 400px; width: 100%;'></div>
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
					echo"<div align='center'><h1> <b> DIAGRAM KOLOM JUMLAH KEDATANGAN MENURUT JENIS KEDATANGAN KELURAHAN ".$row['NAMA_KEL']." <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='kolkkkel3' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1> <b> DIAGRAM PIE JUMLAH KEDATANGAN MENURUT JENIS KEDATANGAN KELURAHAN ".$row['NAMA_KEL']." <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='piekkkel3' style='height: 400px; width: 100%;'></div>
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
//STATISTIK 4
	ELSE IF($_REQUEST['statistik']=="4"){
				//JIKA STATISTIK YANG DI PILIH VALUENYA = 4
	$NOKEC= $_REQUEST['NO_KEC'] ;
	$NOKEL= $_REQUEST['NO_KEL'] ;
	$BULAN= $_POST['bulan'];
	//MENGECEK APAKAH BULAN YANG DI PILIH TERSEDIA DI DB
	$sql= "SELECT * FROM T5_KEPKEL_PENDIDIKAN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
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
									<div align='center'><h1> <b> DIAGRAM KOLOM JUMLAH ANGGOTA DATANGAN MENURUT ALASAN KEPINDAHAN <br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='kolkkkota4' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1> <b> DIAGRAM PIE JUMLAH ANGGOTA DATANGAN MENURUT ALASAN KEPINDAHAN <br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='piekkkota4' style='height: 400px; width: 100%;'></div>
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
					echo"<div align='center'><h1> <b> DIAGRAM KOLOM JUMLAH ANGGOTA DATANG MENURUT ALASAN KEPINDAHAN KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='kolkkkec4' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1> <b> DIAGRAM PIE JUMLAH ANGGOTA DATANG MENURUT ALASAN KEPINDAHAN KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='piekkkec4' style='height: 400px; width: 100%;'></div>
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
					echo"<div align='center'><h1> <b> DIAGRAM KOLOM JUMLAH ANGGOTA DATANG MENURUT ALASAN KEPINDAHAN KELURAHAN ".$row['NAMA_KEL']." <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='kolkkkel4' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1> <b> DIAGRAM PIE JUMLAH ANGGOTA DATANG MENURUT ALASAN KEPINDAHAN KELURAHAN ".$row['NAMA_KEL']." <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='piekkkel4' style='height: 400px; width: 100%;'></div>
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
	//STATISTIK 5
	ELSE IF($_REQUEST['statistik']=="5"){
				//JIKA STATISTIK YANG DI PILIH VALUENYA = 5
	$NOKEC= $_REQUEST['NO_KEC'] ;
	$NOKEL= $_REQUEST['NO_KEL'] ;
	$BULAN= $_POST['bulan'];
	//MENGECEK APAKAH BULAN YANG DI PILIH TERSEDIA DI DB
	$sql= "SELECT * FROM T5_KEPKEL_PENDIDIKAN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
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
									<div align='center'><h1> <b> DIAGRAM KOLOM JUMLAH ANGGOTA DATANG MENURUT KLASIFIKASI KEPINDAHAN <br> KOTA BANDUNG <br> BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='kolkkkota5' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1> <b> DIAGRAM PIE JUMLAH ANGGOTA DATANG MENURUT KLASIFIKASI KEPINDAHAN <br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='piekkkota5' style='height: 400px; width: 100%;'></div>
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
					echo"<div align='center'><h1> <b> DIAGRAM KOLOM JUMLAH ANGGOTA DATANG MENURUT KLASIFIKASI KEPINDAHAN KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='kolkkkec5' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1> <b> DIAGRAM PIE JUMLAH ANGGOTA DATANG MENURUT KLASIFIKASI KEPINDAHAN KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='piekkkec5' style='height: 400px; width: 100%;'></div>
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
					echo"<div align='center'><h1> <b> DIAGRAM KOLOM JUMLAH ANGGOTA DATANG MENURUT KLASIFIKASI KEPINDAHAN KELURAHAN ".$row['NAMA_KEL']." <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='kolkkkel5' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
						$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1> <b> DIAGRAM PIE JUMLAH ANGGOTA DATANG MENURUT KLASIFIKASI KEPINDAHAN KELURAHAN ".$row['NAMA_KEL']." <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='piekkkel5' style='height: 400px; width: 100%;'></div>
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
	//STATISTIK 6
	ELSE IF($_REQUEST['statistik']=="6"){
				//JIKA STATISTIK YANG DI PILIH VALUENYA = 6
	$NOKEC= $_REQUEST['NO_KEC'] ;
	$NOKEL= $_REQUEST['NO_KEL'] ;
	$BULAN= $_POST['bulan'];
	//MENGECEK APAKAH BULAN YANG DI PILIH TERSEDIA DI DB
	$sql= "SELECT * FROM T5_KEPKEL_PENDIDIKAN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
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
									<div align='center'><h1> <b> DIAGRAM KOLOM JUMLAH ANGGGOTA DATANG MENURUT JENIS KEDATANGAN <br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='kolkkkota6' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1> <b> DIAGRAM PIE JUMLAH ANGGGOTA DATANG MENURUT JENIS KEDATANGAN <br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='piekkkota6' style='height: 400px; width: 100%;'></div>
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
					echo"<div align='center'><h1> <b> DIAGRAM KOLOM JUMLAH ANGGGOTA DATANG MENURUT JENIS KEDATANGAN KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='kolkkkec6' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1> <b> DIAGRAM KOLOM JUMLAH ANGGGOTA DATANG MENURUT JENIS KEDATANGAN KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='piekkkec6' style='height: 400px; width: 100%;'></div>
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
					echo"<div align='center'><h1> <b> DIAGRAM KOLOM JUMLAH ANGGGOTA DATANG MENURUT JENIS KEDATANGAN KELURAHAN ".$row['NAMA_KEL']." <br>
                                    <div id='kolkkkel6' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1> <b> DIAGRAM PIE JUMLAH ANGGGOTA DATANG MENURUT JENIS KEDATANGAN KELURAHAN ".$row['NAMA_KEL']." <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='piekkkel6' style='height: 400px; width: 100%;'></div>
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
	//STATISTIK 7
	ELSE IF($_REQUEST['statistik']=="7"){
				//JIKA STATISTIK YANG DI PILIH VALUENYA = 7
	$NOKEC= $_REQUEST['NO_KEC'] ;
	$NOKEL= $_REQUEST['NO_KEL'] ;
	$BULAN= $_POST['bulan'];
	//MENGECEK APAKAH BULAN YANG DI PILIH TERSEDIA DI DB
	$sql= "SELECT * FROM T5_KEPKEL_PENDIDIKAN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
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
									<div align='center'><h1> <b> DIAGRAM KOLOM JUMLAH ANGGOTA DATANG MENURUT JENIS KELAMIN <br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='kolkkkota7' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1> <b> DIAGRAM PIE JUMLAH ANGGOTA DATANG MENURUT JENIS KELAMIN <br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='piekkkota7' style='height: 400px; width: 100%;'></div>
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
					echo"<div align='center'><h1> <b> DIAGRAM KOLOM JUMLAH ANGGOTA DATANG MENURUT JENIS KELAMIN KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
									
                                    <div id='kolkkke7' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1> <b> DIAGRAM PIE JUMLAH ANGGOTA DATANG MENURUT JENIS KELAMIN KECAMATAN ".$row['NAMA_KEC']." <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='piekkkec7' style='height: 400px; width: 100%;'></div>
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
					echo"<div align='center'><h1> <b> DIAGRAM KOLOM JUMLAH ANGGOTA DATANG MENURUT JENIS KELAMIN KELURAHAN ".$row['NAMA_KEL']." <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='kolkkkel7' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1> <b> DIAGRAM PIE JUMLAH ANGGOTA DATANG MENURUT JENIS KELAMIN KELURAHAN ".$row['NAMA_KEL']." <br>BULAN $bln TAHUN $tahun</b></h1></div>
                                    <div id='piekkkel7' style='height: 400px; width: 100%;'></div>
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
	//MASUKAN STATISTIK BARU DISINI
	//!!!!!!!!!!!!!!!!!!!!!!!!!!!
	// ERROR STATISTIK
	else {
	Echo" <div class='col-lg-12'>
                    
                              <div class='alert alert-danger alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                Maaf Statistik Tidak Dapat Di Tampilkan, <a href='index.php' class='alert-link'>Klik Untuk Kembali</a>.
                            </div>
                    
                </div>
                            ";
	} 
}

 ?>

			</div>
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
	 <?php

date_default_timezone_set("Asia/Jakarta");
$nowdate = date("d/m/Y");

?>
<!-- KATEGORI APABILA DIPILIH BERDASARKAN JENIS KELAMIN -->
<!-- STATISTIK 1 -->
<!-- KATEGORI APABILA KECAMATAN DAN KELURAHAN TIDAK DI PILIH-->
 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//ULAH DI UBAH WARNA PARANTI CHART

                '#4661EE',
				'#EC5657',
				'#1BCDD1',
				'#8FAABB',
				'#B08BEB',
				'#3EA0DD',
				'#F5A52A',
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                              
                ]);
			var kolkkota1 = new CanvasJS.Chart('kolkkota1', {
				//CHART COLOM MENAMPILKAN SELURUH DATA YANG DI HITUNG DAN SELURUH KECAMATAN
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM KOLOM JUMLAH DATANG MENURUT ALASAN KEPINDAHAN KOTA BANDUNG'
				},
				animationEnabled: true,
            legend: {
        verticalAlign: 'bottom',
        horizontalAlign: 'center'
      },
				data: [
				{
					type: 'column',
					
					dataPoints: [
					<?php
					//awal
					//MEMILIH SELURUH KECAMATAN DAN TOTAL PENJUMLAHAN DATA SETIAP KECAMATAN BERDASARKAN KATEGORI YANG DI PILIH 
					$sql= "SELECT SUM(PEKERJAAN) AS P1,SUM(PENDIDIKAN) AS P2,SUM(KEAMANAN) AS P3, SUM(KESEHATAN) AS P4, SUM(PERUMAHAN) AS P5, SUM(KELUARGA) AS P6, SUM(LAIN_LAIN) AS P7 FROM T5_DTG_SURAT_ALASAN  WHERE BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'KESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'LAIN-LAIN'},";
					?>					
					]}
			]
					
			});
			kolkkota1.render();
			kolkkota1 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                ]);
			var piekkkota1 = new CanvasJS.Chart('piekkkota1', {
				//CHART PIE MENAMPILKAN SELURUH DATA YANG DI HITUNG
			colorSet: 'bdgShades',
			
				title: {
					//text: 'DIAGRAM PIE JUMLAH DATANG MENURUT ALASAN KEPINDAHAN KOTA BANDUNG'
				},
				animationEnabled: true,
          
				data: [
				{
					type: "pie",
			showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			legendText: "{indexLabel}",
					dataPoints: [
										<?php
					//1
					//MEMILIH SELURUH KECAMATAN DAN TOTAL PENJUMLAHAN DATA SETIAP KECAMATAN BERDASARKAN KATEGORI YANG DI PILIH (PEREMPUAN)
					$sql= "SELECT SUM(PEKERJAAN) AS P1,SUM(PENDIDIKAN) AS P2,SUM(KEAMANAN) AS P3, SUM(KESEHATAN) AS P4, SUM(PERUMAHAN) AS P5, SUM(KELUARGA) AS P6, SUM(LAIN_LAIN) AS P7 FROM T5_DTG_SURAT_ALASAN  WHERE BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),   indexLabel: 'KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),   indexLabel: 'KESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),   indexLabel: 'PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),    indexLabel: 'KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),   indexLabel: 'LAIN-LAIN'},";
					?>											
					]}
			]
					
			});
			piekkkota1.render();
			piekkkota1 = {};
  
  </script>
  <!-- GRAFIK DATA APABILA HANYA KECAMATAN SAJA YANG DIPILIH-->

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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                               
                ]);
			var kolkkkec1 = new CanvasJS.Chart('kolkkkec1', {
				//CHART KOLOM YANG MENAMPILKAN DATA HASIL PENJUMLAHAN PER KECAMATAN YANG DIPILIH
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//MENCARI MANA KECAMATAN YANG DI PILIH
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM JUMLAH DATANG MENURUT ALASAN KEPINDAHAN KECAMATAN ".$row['NAMA_KEC']."'";
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
					dataPoints: [
					<?php
					//2
					//MENCARI MANA KECAMATAN DAN JUMLAH DATA YANG DI PILIH
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(PEKERJAAN) AS P1,SUM(PENDIDIKAN) AS P2,SUM(KEAMANAN) AS P3, SUM(KESEHATAN) AS P4, SUM(PERUMAHAN) AS P5, SUM(KELUARGA) AS P6, SUM(LAIN_LAIN) AS P7 FROM T5_DTG_SURAT_ALASAN INNER JOIN SETUP_KEC ON T5_DTG_SURAT_ALASAN.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' AND SETUP_KEC.NO_KEC ='".$NOKEC."' GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
                    $row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'KESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'LAIN-LAIN'},";
					?>	
									
					]}
			]
					
			});
			kolkkkec1.render();
			kolkkkec1 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                              
                ]);
			var piekkkec1 = new CanvasJS.Chart('piekkkec1', {
			colorSet: 'bdgShades',
			
				title: {
					<?PHP
					//MENCARI NAMA KECAMATAN YANG DIPILIH
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JUMLAH DATANG MENURUT ALASAN KEPINDAHAN KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true,
          
				data: [
				{
					type: "pie",
			showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			legendText: "{indexLabel}",
					dataPoints: [
					<?php
					//3
					//MENCARI MANA KECAMATAN DAN JUMLAH DATA YANG DI PILIH LAKI LAKI
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(PEKERJAAN) AS P1,SUM(PENDIDIKAN) AS P2,SUM(KEAMANAN) AS P3, SUM(KESEHATAN) AS P4, SUM(PERUMAHAN) AS P5, SUM(KELUARGA) AS P6, SUM(LAIN_LAIN) AS P7 FROM T5_DTG_SURAT_ALASAN INNER JOIN SETUP_KEC ON T5_DTG_SURAT_ALASAN.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' AND SETUP_KEC.NO_KEC ='".$NOKEC."' GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
                    $row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'KESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: 'PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: 'LAIN-LAIN'},";
					?>						
					]}
			]
					
			});
			piekkkec1.render();
			piekkkec1 = {};
  
  </script>
  <!-- GRAFIK DATA APABILA KECAMATAN DAN KELURAHAN DIPILIH-->

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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                               
                ]);
			var kolkkkel1 = new CanvasJS.Chart('kolkkkel1', {
				//MENCARI BAR DATA PER KELURAHAN
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//MENCARI NAMA KELURAHAN
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM  JUMLAH DATANG MENURUT ALASAN KEPINDAHAN KELURAHAN ".$row['NAMA_KEL']."'";
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
					dataPoints: [
					<?php
					//4
					//MENCARI DATA DAN NAMA KELURAHAN BERDASARKAN KELURAHAN YANG DIPILIH
					$sql= "";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'KESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'LAIN-LAIN'},";
					?>
								]}
			]
					
			});
			piekkkec1.render();
			piekkkec1 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                               
                ]);
			var kolkkkel1 = new CanvasJS.Chart('kolkkkel1', {
				//MENCARI BAR DATA PER KELURAHAN
			colorSet: 'bdgShades',
				title: {
						<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM JUMLAH DATANG MENURUT ALASAN KEPINDAHAN KELURAHAN ".$row['NAMA_KEL']."'";
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
					//showInLegend: true, 
					//legendMarkerColor: 'blue',
					//legendText: 'Jumlah Laki-Laki/Kecamatan',
					dataPoints: [
					<?php
					$sql= "SELECT SETUP_KEL.NAMA_KEL, PEKERJAAN AS P1,PENDIDIKAN AS P2,KEAMANAN AS P3, KESEHATAN AS P4, PERUMAHAN AS P5, KELUARGA AS P6, LAIN_LAIN AS P7 FROM T5_DTG_SURAT_ALASAN INNER JOIN SETUP_KEL ON T5_DTG_SURAT_ALASAN.NO_KEC = SETUP_KEL.NO_KEC AND T5_DTG_SURAT_ALASAN.NO_KEL = SETUP_KEL.NO_KEL WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEL.NO_PROP='32' AND SETUP_KEL.NO_KAB='73' AND SETUP_KEL.NO_KEC ='".$NOKEC."' AND SETUP_KEL.NO_KEL ='".$NOKEL."' ORDER BY SETUP_KEL.NAMA_KEL";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'KESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'LAIN-LAIN'},";
					?>				
					]}
			]
					
			});
			kolkkkel1.render();
			kolkkkel1 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                               
                ]);
			var piekkkel1 = new CanvasJS.Chart('piekkkel1', {
				//MENCARI DATA PIE PER KELURAHAN
			colorSet: 'bdgShades',
			
				title: {
						<?PHP
						// MENCARI NAMA KELURAHAN
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JUMLAH DATANG MENURUT ALASAN KEPINDAHAN KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true,
          
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
					$sql= "SELECT SETUP_KEL.NAMA_KEL, PEKERJAAN AS P1,PENDIDIKAN AS P2,KEAMANAN AS P3, KESEHATAN AS P4, PERUMAHAN AS P5, KELUARGA AS P6, LAIN_LAIN AS P7 FROM T5_DTG_SURAT_ALASAN INNER JOIN SETUP_KEL ON T5_DTG_SURAT_ALASAN.NO_KEC = SETUP_KEL.NO_KEC AND T5_DTG_SURAT_ALASAN.NO_KEL = SETUP_KEL.NO_KEL WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEL.NO_PROP='32' AND SETUP_KEL.NO_KAB='73' AND SETUP_KEL.NO_KEC ='".$NOKEC."' AND SETUP_KEL.NO_KEL ='".$NOKEL."' ORDER BY SETUP_KEL.NAMA_KEL";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'KESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: 'PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: 'LAIN-LAIN'},";
					?>		
			
					]}
			]
					
			});
			piekkkel1.render();
			piekkkel1 = {};
  
  </script>
  <!--  AKHIR STATISTIK 1 -->
  
  <!-- KATEGORI KLASIFIKASISISIS KEPINDDAHAHAN -->
  <!-- STATISTIK 2 -->
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                ]);
			var kolkkkota2 = new CanvasJS.Chart('kolkkkota2', {
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM KOLOM KEDATANGAN MENURUT KLASIFIKASI KEPINDAHAN KOTA BANDUNG'
				},
				animationEnabled: true,
       
				data: [
				{
					type: 'column',
			    indexLabelMaxWidth: 50,
				//indexLabelWrap: true, // change to false 
				
					dataPoints: [
					<?php
					$sql= "SELECT SUM(ANTAR_DESA) AS P1, SUM(ANTAR_KEC) AS P2,SUM(ANTAR_KAB) AS P3, SUM(ANTAR_PROV) AS P4 FROM T5_DTG_SURAT_KLASIFIKASI WHERE BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'ANTAR DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'ANATAR KEC'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'ANTAR KAB'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'ANTAR PROV'},";
					
					?>					
					]}
			]
					
			});
			kolkkkota2.render();
			kolkkkota2 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                ]);
			var piekkkota2 = new CanvasJS.Chart('piekkkota2', {
			colorSet: 'bdgShades',
			
				title: {
					//text: 'DIAGRAM PIE KEDATANGAN MENURUT KLASIFIKASI KEPINDAHAN KOTA BANDUNG'
				},
				legend: {
			itemMaxWidth: 100,
			itemWrap: true,
			horizontalAlign: "center"// Change to true or false 
			},
				animationEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. ",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(ANTAR_DESA) AS P1,SUM(ANTAR_KEC) AS P2,SUM(ANTAR_KAB) AS P3, SUM(ANTAR_PROV) AS P4 FROM T5_DTG_SURAT_KLASIFIKASI WHERE BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'ANTAR DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'ANATAR KEC'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'ANTAR KAB'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'ANTAR PROV'},";

					?>						
					]}
			]
					
			});
			piekkkota2.render();
			piekkkota2 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                              
                ]);
			var kolkkkec2 = new CanvasJS.Chart('kolkkkec2', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//AMBIL NAMA KECAMATAN DAN TOTAL PENJUMLAHAN NITIAP KELUARAHAN BERDASARKAN KECAMATAN YANG DI PILIH 
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM KEDATANGAN MENURUT KLASIFIKASI KEPINDAHAN KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true,
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
					$sql= "SELECT SUM(ANTAR_DESA) AS P1,SUM(ANTAR_KEC) AS P2,SUM(ANTAR_KAB) AS P3,SUM(ANTAR_PROV) AS P4 FROM T5_DTG_SURAT_KLASIFIKASI WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'ANTAR DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'ANTAR KEC'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'ANTAR KAB'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'ANTAR PROV'},";
					?>
					]}
			]
					
			});
			kolkkkec2.render();
			kolkkkec2 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                ]);
			var piekkkec2 = new CanvasJS.Chart('piekkkec2', {
			colorSet: 'bdgShades',
			
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE KEDATANGAN MENURUT KLASIFIKASI KEPINDAHAN ". $row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(ANTAR_DESA) AS P1,SUM(ANTAR_KEC) AS P2,SUM(ANTAR_KAB) AS P3, SUM(ANTAR_PROV) AS P4 FROM T5_DTG_SURAT_KLASIFIKASI INNER JOIN SETUP_KEC ON T5_DTG_SURAT_KLASIFIKASI.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' AND SETUP_KEC.NO_KEC ='".$NOKEC."' GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
                    $row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'ANTAR DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'ANTAR KEC'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'ANTAR KAB'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'ANTAR PROV'},";
				

					?>						
					]}
			]
					
			});
			piekkkec2.render();
			piekkkec2 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                ]);
			var kolkkkel2 = new CanvasJS.Chart('kolkkkel2', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM JUMLAH KEDATANGAN MENURUT KLASIFIKASI KEPINDAHAN KECAMATAN ".$row['NAMA_KEL']."'";
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
					//showInLegend: true, 
					//legendMarkerColor: 'blue',
					//legendText: 'Jumlah Laki-Laki/Kecamatan',
					dataPoints: [
					<?php
					$sql= "SELECT ANTAR_DESA AS P1,ANTAR_KEC AS P2,ANTAR_KAB AS P3,ANTAR_PROV AS P4 FROM T5_DTG_SURAT_KLASIFIKASI WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'ANTAR DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'ANTAR KEC'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'ANTAR KAB'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'ANTAR PROV'},";
					
					?>
					]}
			]
					
			});
			kolkkkel2.render();
			kolkkkel2 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                                  
                ]);
			var piekkkel2 = new CanvasJS.Chart('piekkkel2', {
			colorSet: 'bdgShades',
			
				title: {
						<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JKEDATANGAN MENURUT KLASIFIKASI KEPINDAHAN KECAMATAN  ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "##,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT ANTAR_DESA AS P1,ANTAR_KEC AS P2,ANTAR_KAB AS P3,ANTAR_PROV AS P4 FROM T5_DTG_SURAT_KLASIFIKASI WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'ANTAR DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'ANTAR KEC'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'ANTAR KAB'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'ANTAR PROV'},";
					?>						
					]}
			]
					
			});
			piekkkel2.render();
			piekkkel2 = {};
  
  </script>
  <!--  AKHIR STATISTIK 2 -->
  <!-- MENCARI STATUS PERKAWINAN -->
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                ]);
			var kolkkkota3 = new CanvasJS.Chart('kolkkkota3', {
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM KOLOM JUMLAH KEDATANGAN MENURUT JENIS KEDATANGAN  KOTA BANDUNG'
				},
				animationEnabled: true,
       
				data: [
				{
					type: 'column',
			    indexLabelMaxWidth: 50,
				//indexLabelWrap: true, // change to false 
				
					dataPoints: [
					<?php
					$sql= "SELECT SUM(NUMPANG_KK)AS P1,SUM(MEMBUAT_KK) AS P2,SUM(KK_TETAP) AS P3 FROM T5_DTG_SURAT_JENIS_DATANG  WHERE BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'NUMPANG KK'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'MEMBUAT KK BARU'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'KK TETAP'},";
					
					
					?>					
					]}
			]
					
			});
			kolkkkota3.render();
			kolkkkota3 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                ]);
			var piekkkota3 = new CanvasJS.Chart('piekkkota3', {
			colorSet: 'bdgShades',
			
				title: {
					//text: 'DIAGRAM PIE JUMLAH KEDATANGAN MENURUT JENIS KEDATANGAN KOTA BANDUNG'
				},
				legend: {
			//itemMaxWidth: 100,
			//itemWrap: true,
			horizontalAlign: "center"// Change to true or false 
			},
				animationEnabled: true,
          
				data: [
				{
					type: "pie",
			showInLegend: true,
			legendText: "{indexLabel}",
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. ",
			
					dataPoints: [
					<?php
					$sql= "SELECT SUM(NUMPANG_KK)AS P1,SUM(MEMBUAT_KK) AS P2,SUM(KK_TETAP) AS P3 FROM T5_DTG_SURAT_JENIS_DATANG  WHERE BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'NUMPANG KK'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'MEMBUAT KK BARU'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),   indexLabel: 'KK TETAP'},";
					
					

					?>						
					]}
			]
					
			});
			piekkkota3.render();
			piekkkota3 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                              
                ]);
			var kolkkkec3 = new CanvasJS.Chart('kolkkkec3', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//AMBIL NAMA KECAMATAN DAN TOTAL PENJUMLAHAN NIK TIAP KELUARAHAN BERDASARKAN KECAMATAN YANG DI PILIH 
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM JUMLAH KEDATANGAN MENURUT JENIS KEDATANGAN KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true,
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
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(NUMPANG_KK) AS P1,SUM(MEMBUAT_KK) AS P2,SUM(KK_TETAP) AS P3 FROM T5_DTG_SURAT_JENIS_DATANG INNER JOIN SETUP_KEC ON T5_DTG_SURAT_JENIS_DATANG.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' AND SETUP_KEC.NO_KEC ='".$NOKEC."' GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
                    $row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'NUMPANG KK'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'MEMBUAT KK BARU'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'KK TETAP'},";
					
					?>					
					//]}				
					]}
			]
					
			});
			kolkkkec3.render();
			kolkkkec3 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                ]);
			var piekkkec3 = new CanvasJS.Chart('piekkkec3', {
			colorSet: 'bdgShades',
			
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JUMLAH KEDATANGAN MENURUT JENIS KEDATANGAN KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true,
          
				data: [
				{
					type: "pie",
			showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(NUMPANG_KK) AS P1,SUM(MEMBUAT_KK) AS P2,SUM(KK_TETAP) AS P3 FROM T5_DTG_SURAT_JENIS_DATANG INNER JOIN SETUP_KEC ON T5_DTG_SURAT_JENIS_DATANG.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' AND SETUP_KEC.NO_KEC ='".$NOKEC."' GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
                    $row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'NUMPANG KK'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'MEMBUAT KK BARU'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'KK TETAP'},";

					?>						
					]}
			]
					
			});
			piekkkec3.render();
			piekkkec3 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                ]);
			var kolkkkel3 = new CanvasJS.Chart('kolkkkel3', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM JUMLAH KEDATANGAN MENURUT JENIS KEDATANGAN KELURAHAN ".$row['NAMA_KEL']."'";
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
					//showInLegend: true, 
					//legendMarkerColor: 'blue',
					//legendText: 'Jumlah Laki-Laki/Kecamatan',
					dataPoints: [
					<?php
					$sql= "SELECT NUMPANG_KK AS P1,MEMBUAT_KK AS P2,KK_TETAP AS P3  FROM T5_DTG_SURAT_JENIS_DATANG WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'NUMPANG KK'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'MEMBUAT KK BARU'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'KK TETAP'},";
					
					?>
					]}
			]
					
			});
			kolkkkel3.render();
			kolkkkel3 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                                  
                ]);
			var piekkkel3 = new CanvasJS.Chart('piekkkel3', {
			colorSet: 'bdgShades',
			
				title: {
						<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JUMLAH KEDATANGAN MENURUT JENIS KEDATANGAN KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true,
          
				data: [
				{
					type: "pie",
			showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "##,. RIBU",
			legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT NUMPANG_KK AS P1,MEMBUAT_KK AS P2,KK_TETAP AS P3  FROM T5_DTG_SURAT_JENIS_DATANG WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'NUMPANG KK'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'MEMBUAT KK BARU'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'KK TETAP'},";
					?>						
					]}
			]
					
			});
			piekkkel3.render();
			piekkkel3 = {};
  
  </script>
  <!--  AKHIR STATISTIK 3 -->
  <!--  STATISTIK GOLONGAN DARAH -->
  <!-- STATISTIK 4 -->
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                ]);
			var kolkkkota4 = new CanvasJS.Chart('kolkkkota4', {
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM KOLOM JUMLAH ANGGOTA DATANG MENURUT ALASAN KEPINDAHAN KOTA BANDUNG'
				},
				animationEnabled: true,
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
					$sql= "SELECT SUM(PEKERJAAN)AS P1,SUM(PENDIDIKAN) AS P2,SUM(KEAMANAN) AS P3,SUM(KESEHATAN) AS P4,SUM(PERUMAHAN) AS P5,SUM(KELUARGA) AS P6,SUM(LAIN_LAIN) AS P7 FROM T5_DTG_ANGGOTA_ALASAN  WHERE BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'KESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'LAIN-LAIN'},";

					?>					
					]}
			]
					
			});
			kolkkkota4.render();
			kolkkkota4 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                ]);
			var piekkkota4 = new CanvasJS.Chart('piekkkota4', {
			colorSet: 'bdgShades',
			
				title: {
					//text: 'DIAGRAM JUMLAH ANGGOTA DATANG MENURUT ALASAN KEPINDAHAN  KOTA BANDUNG'
				},
				legend: {
			itemMaxWidth: 100,
			itemWrap: true,
			horizontalAlign: "center"// Change to true or false 
			},
				animationEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. ",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(PEKERJAAN) AS P1,SUM(PENDIDIKAN) AS P2,SUM(KEAMANAN) AS P3,SUM(KESEHATAN) AS P4,SUM(PERUMAHAN) AS P5,SUM(KELUARGA) AS P6,SUM(LAIN_LAIN) AS P7 FROM T5_DTG_ANGGOTA_ALASAN WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'KESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: 'PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: 'LAIN-LAIN'},";
					
					?>						
					]}
			]
					
			});
			piekkkota4.render();
			piekkkota4 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                              
                ]);
			var kolkkkec4 = new CanvasJS.Chart('kolkkkec4', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//AMBIL NAMA KECAMATAN DAN TOTAL PENJUMLAHAN NIK TIAP KELUARAHAN BERDASARKAN KECAMATAN YANG DI PILIH 
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM JUMLAH ANGGOTA DATANG MENURUT ALASAN KEPINDAHAN KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true,
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
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(PEKERJAAN) AS P1,SUM(PENDIDIKAN) AS P2,SUM(KEAMANAN) AS P3, SUM(KESEHATAN) AS P4, SUM(PERUMAHAN) AS P5, SUM(KELUARGA) AS P6, SUM(LAIN_LAIN) AS P7 FROM T5_DTG_ANGGOTA_ALASAN INNER JOIN SETUP_KEC ON T5_DTG_ANGGOTA_ALASAN.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' AND SETUP_KEC.NO_KEC ='".$NOKEC."' GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'KESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'LAIN-LAIN'},";
					
					?>					
					//]}				
					]}
			]
					
			});
			kolkkkec4.render();
			kolkkkec4 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                ]);
			var piekkkec4 = new CanvasJS.Chart('piekkkec4', {
			colorSet: 'bdgShades',
			
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE DATANG MENURUT ALASAN KEPINDAHAN KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(PEKERJAAN) AS P1,SUM(PENDIDIKAN) AS P2,SUM(KEAMANAN) AS P3, SUM(KESEHATAN) AS P4, SUM(PERUMAHAN) AS P5, SUM(KELUARGA) AS P6, SUM(LAIN_LAIN) AS P7 FROM T5_DTG_ANGGOTA_ALASAN INNER JOIN SETUP_KEC ON T5_DTG_ANGGOTA_ALASAN.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' AND SETUP_KEC.NO_KEC ='".$NOKEC."' GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";

					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'KESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: 'PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: 'LAIN-LAIN'},";
					
					?>						
					]}
			]
					
			});
			piekkkec4.render();
			piekkkec4 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                ]);
			var kolkkkel4 = new CanvasJS.Chart('kolkkkel4', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM JUMLAH ANGGOTA DATANG MENURUT ALASAN KEPINDAHAN KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true,
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
					$sql= "SELECT SETUP_KEL.NAMA_KEL, PEKERJAAN AS P1,PENDIDIKAN AS P2,KEAMANAN AS P3, KESEHATAN AS P4, PERUMAHAN AS P5, KELUARGA AS P6, LAIN_LAIN AS P7 FROM T5_DTG_ANGGOTA_ALASAN INNER JOIN SETUP_KEL ON T5_DTG_ANGGOTA_ALASAN.NO_KEC = SETUP_KEL.NO_KEC AND T5_DTG_ANGGOTA_ALASAN.NO_KEL = SETUP_KEL.NO_KEL WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEL.NO_PROP='32' AND SETUP_KEL.NO_KAB='73' AND SETUP_KEL.NO_KEC ='".$NOKEC."' AND SETUP_KEL.NO_KEL ='".$NOKEL."' ORDER BY SETUP_KEL.NAMA_KEL";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'KESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'LAIN_LAIN'},";
					
					?>
					]}
			]
					
			});
			kolkkkel4.render();
			kolkkkel4 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                                  
                ]);
			var piekkkel4 = new CanvasJS.Chart('piekkkel4', {
			colorSet: 'bdgShades',
			
				title: {
						<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JUMLAH ANGGOTA DATANG MENURUT ALASAN KEPINDAHAN KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "##,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SETUP_KEL.NAMA_KEL, PEKERJAAN AS P1,PENDIDIKAN AS P2,KEAMANAN AS P3, KESEHATAN AS P4, PERUMAHAN AS P5, KELUARGA AS P6, LAIN_LAIN AS P7 FROM T5_DTG_ANGGOTA_ALASAN INNER JOIN SETUP_KEL ON T5_DTG_ANGGOTA_ALASAN.NO_KEC = SETUP_KEL.NO_KEC AND T5_DTG_ANGGOTA_ALASAN.NO_KEL = SETUP_KEL.NO_KEL WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEL.NO_PROP='32' AND SETUP_KEL.NO_KAB='73' AND SETUP_KEL.NO_KEC ='".$NOKEC."' AND SETUP_KEL.NO_KEL ='".$NOKEL."' ORDER BY SETUP_KEL.NAMA_KEL";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'PEKERJAAN'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'PENDIDIKAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'KEAMANAN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'KESEHATAN'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: 'PERUMAHAN'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'KELUARGA'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: 'LAIN_LAIN'},";
					
					?>						
					]}
			]
					
			});
			piekkkel4.render();
			piekkkel4 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                ]);
			var kolkkkota5 = new CanvasJS.Chart('kolkkkota5', {
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM KOLOM JUMLAH ANGGOTA DATANG MENURUT KLASIFIKASI KEPINDAHAN KOTA BANDUNG'
				},
				animationEnabled: true,
       
				data: [
				{
					type: 'column',
			    indexLabelMaxWidth: 50,
				//indexLabelWrap: true, // change to false 
				
					dataPoints: [
					<?php
					$sql= "SELECT SUM(ANTAR_DESA) AS P1,SUM(ANTAR_KEC) AS P2,SUM(ANTAR_KAB) AS P3,SUM(ANTAR_PROV) AS P4 FROM T5_DTG_ANGGOTA_KLASIFIKASI WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') + 1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'ANTAR DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'ANTAR KEC'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'ANTAR KAB'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'ANTAR PROV'},";
					

					?>					
					]}
			]
					
			});
			kolkkkota5.render();
			kolkkkota5 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                ]);
			var piekkkota5 = new CanvasJS.Chart('piekkkota5', {
			colorSet: 'bdgShades',
			
				title: {
					//text: 'DIAGRAM PIE JUMLAH ANGGOTA DATANG MENURUT KLASIFIKASI KEPINDAHAN KOTA BANDUNG'
				},
				legend: {
			itemMaxWidth: 100,
			itemWrap: true,
			horizontalAlign: "center"// Change to true or false 
			},
				animationEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. ",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(ANTAR_DESA) AS P1,SUM(ANTAR_KEC) AS P2,SUM(ANTAR_KAB) AS P3,SUM(ANTAR_PROV) AS P4 FROM T5_DTG_ANGGOTA_KLASIFIKASI WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') + 1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'ANTAR DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'ANTAR KEC'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'ANTAR KAB'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel:  'ANTAR PROV'},";

					?>						
					]}
			]
					
			});
			piekkkota5.render();
			piekkkota5 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                              
                ]);
			var kolkkkec5 = new CanvasJS.Chart('kolkkkec5', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//AMBIL NAMA KECAMATAN DAN TOTAL PENJUMLAHAN NIK TIAP KELUARAHAN BERDASARKAN KECAMATAN YANG DI PILIH 
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM JUMLAH ANGGOTA DATANG MENURUT KLASIFIKASI KEPINDAHAN KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true,
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
					$sql= "SELECT SUM(ANTAR_DESA) AS P1,SUM(ANTAR_KEC) AS P2,SUM(ANTAR_KAB) AS P3,SUM(ANTAR_PROV) AS P4 FROM T5_DTG_ANGGOTA_KLASIFIKASI WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'ANTAR DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'ANTAR KEC'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'ANTAR KAB'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'ANTAR PROV'},";
					
					?>					
					//]}				
					]}
			]
					
			});
			kolkkkec5.render();
			kolkkkec5 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                ]);
			var piekkkec5 = new CanvasJS.Chart('piekkkec5', {
			colorSet: 'bdgShades',
			
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JUMLAH ANGGOTA DATANG MENURUT KLASIFIKASI KEPINDAHAN KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(ANTAR_DESA) AS P1,SUM(ANTAR_KEC) AS P2,SUM(ANTAR_KAB) AS P3,SUM(ANTAR_PROV) AS P4 FROM T5_DTG_ANGGOTA_KLASIFIKASI WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'ANTAR DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'ANTAR KEC'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'ANTAR KAB'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'ANTAR PROV'},";

					?>						
					]}
			]
					
			});
			piekkkec5.render();
			piekkkec5 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                ]);
			var kolkkkel5 = new CanvasJS.Chart('kolkkkel5', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM JUMLAH ANGGOTA DATANG MENURUT KLASIFIKASI KEPINDAHAN KELURAHAN ".$row['NAMA_KEL']."'";
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
					//showInLegend: true, 
					//legendMarkerColor: 'blue',
					//legendText: 'Jumlah Laki-Laki/Kecamatan',
					dataPoints: [
					<?php
					$sql= "SELECT ANTAR_DESA AS P1,ANTAR_KEC AS P2,ANTAR_KAB AS P3,ANTAR_PROV AS P4 FROM T5_DTG_ANGGOTA_KLASIFIKASI WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."'AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'ANTAR DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'ANTAR KEC'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'ANTAR KAB'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'ANTAR PROV'},";
				
					?>
					]}
			]
					
			});
			kolkkkel5.render();
			kolkkkel5 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                                  
                ]);
			var piekkkel5 = new CanvasJS.Chart('piekkkel5', {
			colorSet: 'bdgShades',
			
				title: {
						<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JUMLAH ANGGOTA DATANG MENURUT KLASIFIKASI KEPINDAHAN KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "##,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT ANTAR_DESA AS P1,ANTAR_KEC AS P2,ANTAR_KAB AS P3,ANTAR_PROV AS P4 FROM T5_DTG_ANGGOTA_KLASIFIKASI WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."'AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'ANTAR DESA'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'ANTAR KEC'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'ANTAR KAB'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'ANTAR PROV'},";
					?>						
					]}
			]
					
			});
			piekkkel5.render();
			piekkkel5 = {};
  
  </script>
  <!--  AKHIR STATISTIK 5-->
  
    <!-- STATISTIK 6 -->
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                ]);
			var kolkkkota6 = new CanvasJS.Chart('kolkkkota6', {
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM KOLOM JUMLAH ANGGGOTA DATANG MENURUT JENIS KEDATANGAN KOTA BANDUNG'
				},
				animationEnabled: true,
       
				data: [
				{
					type: 'column',
			    indexLabelMaxWidth: 50,
				//indexLabelWrap: true, // change to false 
				
					dataPoints: [
					<?php
					$sql= "SELECT SUM(NUMPANG_KK) AS P1,SUM(MEMBUAT_KK) AS P2,SUM(KK_TETAP) AS P3 FROM T5_DTG_ANGGOTA_JENIS_DATANG WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'NUMPANG KK'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'MEMBUAT KK BARU'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'KK TETAP'},";
			
					?>					
					]}
			]
					
			});
			kolkkkota6.render();
			kolkkkota6 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                ]);
			var piekkkota6 = new CanvasJS.Chart('piekkkota6', {
			colorSet: 'bdgShades',
			
				title: {
					//text: 'DIAGRAM PIE JUMLAH DATANG MENURUT JENIS KEDATANGAN KOTA BANDUNG'
				},
				legend: {
			itemMaxWidth: 100,
			itemWrap: true,
			horizontalAlign: "center"// Change to true or false 
			},
				animationEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. ",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(NUMPANG_KK) AS P1,SUM(MEMBUAT_KK) AS P2,SUM(KK_TETAP) AS P3 FROM T5_DTG_ANGGOTA_JENIS_DATANG WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'NUMPANG KK'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'MEMBUAT KK BARU'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'KK TETAP'},";

					?>						
					]}
			]
					
			});
			piekkkota6.render();
			piekkkota6 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                              
                ]);
			var kolkkkec6 = new CanvasJS.Chart('kolkkkec6', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//AMBIL NAMA KECAMATAN DAN TOTAL PENJUMLAHAN NIK TIAP KELUARAHAN BERDASARKAN KECAMATAN YANG DI PILIH 
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM JUMLAH ANGGGOTA DATANG MENURUT JENIS KEDATANGAN KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true,
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
					$sql= "SELECT SUM(NUMPANG_KK) AS P1,SUM(MEMBUAT_KK) AS P2,SUM(KK_TETAP) AS P3 FROM T5_DTG_ANGGOTA_JENIS_DATANG WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_KEC='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'NUMPANG KK'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'MEMBUAT KK BARU'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'KK TETAP'},";
					
					?>					
					//]}				
					]}
			]
					
			});
			kolkkkec6.render();
			kolkkkec6 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                ]);
			var piekkkec6 = new CanvasJS.Chart('piekkkec6', {
			colorSet: 'bdgShades',
			
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JUMLAH ANGGGOTA DATANG MENURUT JENIS KEDATANGAN KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(NUMPANG_KK) AS P1,SUM(MEMBUAT_KK) AS P2,SUM(KK_TETAP) AS P3 FROM T5_DTG_ANGGOTA_JENIS_DATANG WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_KEC='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'NUMPANG KK'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'MEMBUAT KK BARU'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'KK TETAP'},";

					?>						
					]}
			]
					
			});
			piekkkec6.render();
			piekkkec6 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                               
                ]);
			var kolkkkel6 = new CanvasJS.Chart('kolkkkel6', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM JUMLAH ANGGGOTA DATANG MENURUT JENIS KEDATANGAN KELURAHAN ".$row['NAMA_KEL']."'";
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
					//showInLegend: true, 
					//legendMarkerColor: 'blue',
					//legendText: 'Jumlah Laki-Laki/Kecamatan',
					dataPoints: [
					<?php
					$sql= "SELECT NUMPANG_KK AS P1,MEMBUAT_KK AS P2,KK_TETAP AS P3 FROM T5_DTG_ANGGOTA_JENIS_DATANG WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'NUMPANG KK'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'MEMBUAT KK BARU'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'KK TETAP'},";
					
					?>
					]}
			]
					
			});
			kolkkkel6.render();
			kolkkkel6 = {};
  
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
				'#23BFAA',
				'#FAA586',
				'#EB8CC6',
                                  
                ]);
			var piekkkel6 = new CanvasJS.Chart('piekkkel6', {
			colorSet: 'bdgShades',
			
				title: {
						<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JUMLAH ANGGGOTA DATANG MENURUT JENIS KEDATANGAN KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "##,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT NUMPANG_KK AS P1,MEMBUAT_KK AS P2,KK_TETAP AS P3 FROM T5_DTG_ANGGOTA_JENIS_DATANG WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'NUMPANG KK'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'MEMBUAT KK BARU'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'KK TETAP'},";
					?>						
					]}
			]
					
			});
			piekkkel6.render();
			piekkkel6 = {};
  
  </script>
  <!--  AKHIR STATISTIK 6 -->
  
  <!-- STATISTIK 7 -->
 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//ULAH DI UBAH WARNA PARANTI CHART

                '#0000FF',
                '#b82601'
                               
                ]);
			var kolkkkota7 = new CanvasJS.Chart('kolkkkota7', {
				//CHART COLOM MENAMPILKAN SELURUH DATA YANG DI HITUNG DAN SELURUH KECAMATAN
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM KOLOM JUMLAH ANGGOTA DATANG MENURUT JENIS KELAMIN KOTA BANDUNG'
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
					//MEMILIH SELURUH KECAMATAN DAN TOTAL PENJUMLAHAN DATA SETIAP KECAMATAN BERDASARKAN KATEGORI YANG DI PILIH (LAKI LAKI)
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(LK) AS LAKI_LAKI FROM T5_DTG_ANGGOTA_KELAMIN INNER JOIN SETUP_KEC ON T5_DTG_ANGGOTA_KELAMIN.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
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
					//MEMILIH SELURUH KECAMATAN DAN TOTAL PENJUMLAHAN DATA SETIAP KECAMATAN BERDASARKAN KATEGORI YANG DI PILIH (PEREMPUAN)
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(LP) AS PEREMPUAN FROM T5_DTG_ANGGOTA_KELAMIN INNER JOIN SETUP_KEC ON T5_DTG_ANGGOTA_KELAMIN.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  label: ".json_encode($row['NAMA_KEC'])."},"; 
					}	
					?>					
					]}
			]
					
			});
			kolkkkota7.render();
			kolkkkota7 = {};
  
  </script>
	
  
<!-- Page-Level Demo Scripts - Notifications - Use for reference -->
	<script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//ULAH DI UBAH WARNA PARANTI CHART

                '#0000FF',
                '#b82601'
                               
                ]);
			var piekkkota7 = new CanvasJS.Chart('piekkkota7', {
				//CHART COLOM MENAMPILKAN SELURUH DATA YANG DI HITUNG DAN SELURUH KECAMATAN
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM PIE JUMLAH ANGGOTA DATANG MENURUT JENIS KELAMIN KOTA BANDUNG'
				},
				animationEnabled: true,
            legend: {
        verticalAlign: 'bottom',
        horizontalAlign: 'center'
      },
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			legendText: "{indexLabel}",
					dataPoints: [
					<?php
					//MENAMPILKAN DATA HASIL PENJUMLAHAN DATA SELURUH KECAMATAN DISATUKAN LAKI LAKI
					$sql= "SELECT SUM(LK) AS LAKI_LAKI FROM T5_DTG_ANGGOTA_KELAMIN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['LAKI_LAKI']))."), exploded: true, indexLabel: 'LAKI-LAKI'},";
					}	
					?>
					<?php
					//MENAMPILKAN DATA HASIL PENJUMLAHAN DATA SELURUH KECAMATAN DISATUKAN PEREMPUAN
					$sql= "SELECT SUM(LP) AS PEREMPUAN FROM T5_DTG_ANGGOTA_KELAMIN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  indexLabel: 'PEREMPUAN'},"; 
					}	
					?>					
					]}
			]
					
			});
			piekkkota7.render();
			piekkkota7 = {};
  
  </script>
   <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

                '#0000FF',
                '#b82601'
                               
                ]);
			var kolkkke7 = new CanvasJS.Chart('kolkkke7', {
				//CHART KOLOM YANG MENAMPILKAN DATA HASIL PENJUMLAHAN PER KECAMATAN YANG DIPILIH
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//MENCARI MANA KECAMATAN YANG DI PILIH
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM JUMLAH ANGGOTA DATANG MENURUT JENIS KELAMIN KECAMATAN ".$row['NAMA_KEC']."'";
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
					//MENCARI MANA KECAMATAN DAN JUMLAH DATA YANG DI PILIH LAKI LAKI
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(LK) AS LAKI_LAKI FROM T5_DTG_ANGGOTA_KELAMIN INNER JOIN SETUP_KEC ON T5_DTG_ANGGOTA_KELAMIN.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' AND SETUP_KEC.NO_KEC =".$NOKEC." GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
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
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(LP) AS PEREMPUAN FROM T5_DTG_ANGGOTA_KELAMIN INNER JOIN SETUP_KEC ON T5_DTG_ANGGOTA_KELAMIN.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' AND SETUP_KEC.NO_KEC =".$NOKEC." GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  label: ".json_encode($row['NAMA_KEC'])."},"; 
					}	
					?>					
					]}
			]
					
			});
			kolkkke7.render();
			kolkkke7 = {};
  
  </script>
  
  
  	 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

                '#0000FF',
                '#b82601'
                               
                ]);
			var piekkkec7 = new CanvasJS.Chart('piekkkec7', {
			colorSet: 'bdgShades',
			
				title: {
					<?PHP
					//MENCARI NAMA KECAMATAN YANG DIPILIH
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JUMLAH ANGGOTA DATANG MENURUT JENIS KELAMIN KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true,
          
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
					$sql= "SELECT SUM(LK) AS LAKI_LAKI FROM T5_DTG_ANGGOTA_KELAMIN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73' AND NO_KEC =".$NOKEC."";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['LAKI_LAKI']))."),  indexLabel: 'LAKI-LAKI'},";
					}	
					?>
					<?php
					//MENCARI JUMLAH DATA YANG DIPILIH BERDASARKAN KECAMATAN
					$sql= "SELECT SUM(LP) AS PEREMPUAN FROM T5_DTG_ANGGOTA_KELAMIN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73' AND NO_KEC =".$NOKEC."";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  indexLabel: 'PEREMPUAN'},"; 
					}	
					?>						
					]}
			]
					
			});
			piekkkec7.render();
			piekkkec7 = {};
  
  </script>
  
  <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

                '#0000FF',
                '#b82601'
                               
                ]);
			var kolkkkel7 = new CanvasJS.Chart('kolkkkel7', {
				//MENCARI BAR DATA PER KELURAHAN
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//MENCARI NAMA KELURAHAN
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM JUMLAH ANGGOTA DATANG MENURUT JENIS KELAMIN KELURAHAN ".$row['NAMA_KEL']."'";
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
					//MENCARI DATA DAN NAMA KELURAHAN BERDASARKAN KELURAHAN YANG DIPILIH
					$sql= "SELECT SETUP_KEL.NAMA_KEL, LK AS LAKI_LAKI FROM T5_DTG_ANGGOTA_KELAMIN INNER JOIN SETUP_KEL ON T5_DTG_ANGGOTA_KELAMIN.NO_KEC = SETUP_KEL.NO_KEC AND T5_DTG_ANGGOTA_KELAMIN.NO_KEL = SETUP_KEL.NO_KEL WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEL.NO_PROP='32' AND SETUP_KEL.NO_KAB='73' AND SETUP_KEL.NO_KEC ='".$NOKEC."' AND SETUP_KEL.NO_KEL ='".$NOKEL."' ORDER BY SETUP_KEL.NAMA_KEL";
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
					$sql= "SELECT SETUP_KEL.NAMA_KEL, LP AS PEREMPUAN FROM T5_DTG_ANGGOTA_KELAMIN INNER JOIN SETUP_KEL ON T5_DTG_ANGGOTA_KELAMIN.NO_KEC = SETUP_KEL.NO_KEC AND T5_DTG_ANGGOTA_KELAMIN.NO_KEL = SETUP_KEL.NO_KEL WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEL.NO_PROP='32' AND SETUP_KEL.NO_KAB='73' AND SETUP_KEL.NO_KEC ='".$NOKEC."' AND SETUP_KEL.NO_KEL ='".$NOKEL."' ORDER BY SETUP_KEL.NAMA_KEL";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  label: ".json_encode($row['NAMA_KEL'])."},"; 
					}	
					?>					
					]}
			]
					
			});
			kolkkkel7.render();
			kolkkkel7 = {};
  
  </script>
  
  <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

                '#0000FF',
                '#b82601'
                               
                ]);
			var piekkkel7 = new CanvasJS.Chart('piekkkel7', {
				//MENCARI DATA PIE PER KELURAHAN
			colorSet: 'bdgShades',
			
				title: {
						<?PHP
						// MENCARI NAMA KELURAHAN
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE JUMLAH ANGGOTA DATANG MENURUT JENIS KELAMIN KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true,
          
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
					$sql= "SELECT LK AS LAKI_LAKI FROM T5_DTG_ANGGOTA_KELAMIN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73' AND NO_KEC =".$NOKEC." AND NO_KEL =".$NOKEL."";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['LAKI_LAKI']))."),  indexLabel: 'LAKI-LAKI'},";
					}	
					?>
					<?php
					// MENCARI DATA PER KELURAHAN
					$sql= "SELECT LP AS PEREMPUAN FROM T5_DTG_ANGGOTA_KELAMIN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73' AND NO_KEC =".$NOKEC." AND NO_KEL =".$NOKEL."";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  indexLabel: 'PEREMPUAN'},"; 
					}	
					?>						
					]}
			]
					
			});
			piekkkel7.render();
			piekkkel7 = {};
  
  </script>
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
