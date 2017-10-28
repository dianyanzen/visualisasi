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
<!-- Start Php -->
	<?php
session_start();
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
								</li>
                                <li><a href="#" data-toggle="tab"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i>
								<span class="sr-only">Loading...</span></a></a>
                                </li>
                                <li class="active"><a href="stdlahir.php">Kelahiran</a>
                                </li>
                                <li><a href="stdmati.php">Kematian</a>
                                </li>
                                <li><a href="stdkawin.php">Perkawinan</a>
                                </li>
                                <li><a href="stdcerai.php">Perceraian</a>
                                </li>
                            </ul>
					
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="kartukeluarga-pills">
								<br>
                                    <div class="col-lg-12">
										<div class="panel panel-primary">
											<div class="panel-heading">
												Statistik Pendaftaran Penduduk WNI Kota Bandung - Akta Kelahiran
											</div>
										<div class="panel-body" >
										
										<form method="post" name="formstatistik" id="formstatistik" action="stdlahir.php" role="form">
	
										
										<!--start row-->
										<div class="row">
											<div class="col-lg-12">
											<div class="form-group col-lg-6">
                                            <label>Pilih Jenis Statistik</label>
                                            <select name="statistik" id="statistik" class="form-control" required>
                                               	<option value="1">Menurut Jenis Kelamin</option>
												<option value="2">Menurut Penolong Kelahiran</option>
												<option value="3">Menurut Tempat Dilahirkan</option>
												<option value="4">Menurut Jenis Kelahiran</option>												
												<option value="5">Menurut Kepemilikan Akta 0-18 Tahun</option>
												<option value="6">Menurut Kepemilikan Akta Keseluruhan</option>
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
	//statistik1
	if($_REQUEST['statistik']=="1"){
		//JIKA STATISTIK YANG DI PILIH VALUENYA = 1(JENIS KELAMIN)
	//$NOKEC= $_REQUEST['NO_KEC'] ;
	//$NOKEL= $_REQUEST['NO_KEL'] ;
	$BULAN= $_POST['bulan'];
	//MENGECEK APAKAH BULAN YANG DI PILIH TERSEDIA DI DB
	$sql= "SELECT * FROM T5_STT_AGR_PENDUDUK WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
	    $num_rows=oci_fetch($stmt);
	   if($num_rows>0){
	
	
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
									<div align='center'><h1><b>DIAGRAM KOLOM KELAHIRAN MENURUT JENIS KELAMIN<br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='kolkkkota1' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM PIE KELAHIRAN MENURUT JENIS KELAMIN<br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun </b></h1></div>
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
	//akhir statistik
	
	//STATISTIK 2
	ELSE IF($_REQUEST['statistik']=="2"){
				//JIKA STATISTIK YANG DI PILIH VALUENYA = 2
	//$NOKEC= $_REQUEST['NO_KEC'] ;
	//$NOKEL= $_REQUEST['NO_KEL'] ;
	$BULAN= $_POST['bulan'];
	//MENGECEK APAKAH BULAN YANG DI PILIH TERSEDIA DI DB
	$sql= "SELECT * FROM T5_STT_STRUKTUR_UMUR WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
	    $num_rows=oci_fetch($stmt);
	   if($num_rows>0){
	
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
									<div align='center'><h1><b>DIAGRAM KOLOM KELAHIRAN MENURUT PENOLONG KELAHIRAN<br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='kolkkkota2' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM PIE KELAHIRAN MENURUT PENOLONG KELAHIRAN<br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun </b></h1></div>
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
	//akhir stat
	
	//STATISTIK 3
	ELSE IF($_REQUEST['statistik']=="3"){
				//JIKA STATISTIK YANG DI PILIH VALUENYA = 3
	//$NOKEC= $_REQUEST['NO_KEC'] ;
	//$NOKEL= $_REQUEST['NO_KEL'] ;
	$BULAN= $_POST['bulan'];
	//MENGECEK APAKAH BULAN YANG DI PILIH TERSEDIA DI DB
	$sql= "SELECT * FROM T5_STT_PENDIDIKAN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
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
									<div align='center'><h1><b>DIAGRAM KOLOM KELAHIRAN MENURUT TEMPAT DI LAHIRKAN<br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='kolkkkota3' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM PIE KELAHIRAN MENURUT TEMPAT DI LAHIRKAN<br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun </b></h1></div>
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
	//akhir stat
//STATISTIK 5
	ELSE IF($_REQUEST['statistik']=="5"){
				//JIKA STATISTIK YANG DI PILIH VALUENYA = 4
	//$NOKEC= $_REQUEST['NO_KEC'] ;
	$//NOKEL= $_REQUEST['NO_KEL'] ;
	$BULAN= $_POST['bulan'];
	//MENGECEK APAKAH BULAN YANG DI PILIH TERSEDIA DI DB
	$sql= "SELECT * FROM T5_STT_PENDIDIKAN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
	    $num_rows=oci_fetch($stmt);
	   if($num_rows>0){
	
	
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
									<div align='center'><h1><b>DIAGRAM KOLOM KEPEMILIKAN AKTA MENURUT USIA 0-18 TAHUN<br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='kolkkkota5' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM PIE KEPEMILIKAN AKTA MENURUT USIA 0-18 TAHUN<br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun </b></h1></div>
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
				//JIKA STATISTIK YANG DI PILIH VALUENYA = 4
	//$NOKEC= $_REQUEST['NO_KEC'] ;
	$//NOKEL= $_REQUEST['NO_KEL'] ;
	$BULAN= $_POST['bulan'];
	//MENGECEK APAKAH BULAN YANG DI PILIH TERSEDIA DI DB
	$sql= "SELECT * FROM T5_STT_PENDIDIKAN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
	    $num_rows=oci_fetch($stmt);
	   if($num_rows>0){
	
	
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
									<div align='center'><h1><b>DIAGRAM KOLOM KEPEMILIKAN AKTA KESELURUHAN<br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='kolkkkota6' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM PIE KEPEMILIKAN AKTA KESELURUHAN<br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun </b></h1></div>
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
	//$NOKEC= $_REQUEST['NO_KEC'] ;
	$//NOKEL= $_REQUEST['NO_KEL'] ;
	$BULAN= $_POST['bulan'];
	//MENGECEK APAKAH BULAN YANG DI PILIH TERSEDIA DI DB
	$sql= "SELECT * FROM T5_STT_PENDIDIKAN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
	    $num_rows=oci_fetch($stmt);
	   if($num_rows>0){
	
	
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
									<div align='center'><h1><b>DIAGRAM KOLOM KELAHIRAN MENURUT JENIS KELAHIRAN<br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='kolkkkota4' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM PIE KELAHIRAN MENURUT JENIS KELAHIRAN<br> KOTA BANDUNG <br>BULAN $bln TAHUN $tahun </b></h1></div>
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
	// akhir stat cuy
	}
	?>
	
            
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

<!-- KATEGORI APABILA DIPILIH BERDASARKAN JENIS KELAMIN -->
<!-- STATISTIK 1 -->
<!-- KATEGORI APABILA KECAMATAN DAN KELURAHAN TIDAK DI PILIH-->
 <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//ULAH DI UBAH WARNA PARANTI CHART
				
                '#00BFFF',
                '#FF1493',
                                                 
                ]);
			var kolkkkota1 = new CanvasJS.Chart('kolkkkota1', {
				//CHART COLOM MENAMPILKAN SELURUH DATA YANG DI HITUNG DAN SELURUH KECAMATAN
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM KOLOM KELAHIRAN MENURUT JENIS KELAMIN KOTA BANDUNG'
				},
				//backgroundColor: "dimgrey",
				theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
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
					$sql= "SELECT SUM(LK) AS LAKI_LAKI FROM T5_LHR_JENIS_KELAMIN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['LAKI_LAKI']))."),  label: 'laki-laki'},";
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
					$sql= "SELECT SUM(LP) AS PEREMPUAN FROM T5_LHR_JENIS_KELAMIN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  label: 'Laki-Laki    Perempuan'},";
					}	
					?>					
					]}
			]
					
			});
			kolkkkota1.render();
			kolkkkota1 = {};
  
  </script>
	
  <script type='text/javascript'>
	
		CanvasJS.addColorSet('bdgShades',
                [//colorSet Array

               '#00BFFF',
               '#FF1493',
                               
                ]);
			var piekkkota1 = new CanvasJS.Chart('piekkkota1', {
			colorSet: 'bdgShades',
			
				title: {
					//text: 'DIAGRAM PIE PENDUDUK MENURUT STRUKTUR UMUR KOTA BANDUNG'
				},
				legend: {
			itemMaxWidth: 100,
			itemWrap: true,
			horizontalAlign: "center"// Change to true or false 
			},
				animationEnabled: true, theme: "theme2",
          //exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. ",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					//MEMILIH SELURUH KECAMATAN DAN TOTAL PENJUMLAHAN DATA SETIAP KECAMATAN BERDASARKAN KATEGORI YANG DI PILIH (LAKI LAKI)
					$sql= "SELECT SUM(LK) AS P1 , SUM(LP) AS P2 FROM T5_LHR_JENIS_KELAMIN WHERE BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded:true,  label: 'Laki-Laki'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),exploded:true,  label: 'Perempuan'},";
					
					?>						
					]}
			]
					
			});
			piekkkota1.render();
			piekkkota1 = {};
  
  </script>
  <!--  AKHIR STATISTIK 1 -->
  
  
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
					//text: 'DIAGRAM KOLOM KELAHIRAN MENURUT PENOLONG KELAHIRAN KOTA BANDUNG'
				},
				animationEnabled: true, theme: "theme2",
       //exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
				data: [
				{
					type: 'column',
					//showInLegend: true, 
					
					
					dataPoints: [
					<?php
					$sql= "SELECT SUM(DOKTER) AS P1,SUM(BIDAN) AS P2,SUM(DUKUN) AS P3,SUM(LAINNYA) AS P4 FROM T5_LHR_PENOLONG_LAHIR WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded:true,  label: 'DOKTER'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),exploded:true,  label: 'BIDAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),exploded:true,  label: 'DUKUN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),exploded:true,  label: 'LAINNYA'},";
					
				
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
					//text: 'DIAGRAM KOLOM KELAHIRAN MENURUT PENOLONG KELAHIRAN KOTA BANDUNG'
				},
				legend: {
			itemMaxWidth: 100,
			itemWrap: true,
			horizontalAlign: "center"// Change to true or false 
			},
				animationEnabled: true, theme: "theme2",
          //exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. ",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(DOKTER) AS P1,SUM(BIDAN) AS P2,SUM(DUKUN) AS P3,SUM(LAINNYA) AS P4 FROM T5_LHR_PENOLONG_LAHIR WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded:true,  label: 'DOKTER'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),exploded:true,  label: 'BIDAN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),exploded:true,  label: 'DUKUN'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),exploded:true,  label: 'LAINNYA'},";
					?>						
					]}
			]
					
			});
			piekkkota2.render();
			piekkkota2 = {};
  
  </script>
  <!-- Grafik Kecamatan Pilih <>0-->

   
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
					//text: 'DIAGRAM KOLOM KELAHIRAN MENURUT TEMPAT DI LAHIRKAN KOTA BANDUNG'
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
       			//exportEnabled: true,
				axisX:{
           interval: 1
     },
	 
				data: [
				{
					type: 'column',
			    indexLabelMaxWidth: 50,
				indexLabelWrap: true, // change to false 
				
					dataPoints: [
					<?php
					$sql= "SELECT SUM(RS) AS P1,SUM(PUSKESMAS) AS P2,SUM(POLINDES) AS P3,SUM(RUMAH) AS P4,SUM(LAINNYA) AS P5 FROM T5_LHR_TEMPAT_DILAHIRKAN WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded:true,  label: 'RS'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),exploded:true,  label: 'PUSKESMAS'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),exploded:true,  label: 'POLINDES'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),exploded:true,  label: 'RUMAH'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),exploded:true,  label: 'LAINNYA'},";

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
					//text: 'DIAGRAM PIE KELAHIRAN MENURUT TEMPAT DI LAHIRKAN KOTA BANDUNG'
				},
				legend: {
			//itemMaxWidth: 100,
			//itemWrap: true,
			horizontalAlign: "center"// Change to true or false 
			},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			//legendText: "{indexLabel}",
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. ",
			
					dataPoints: [
					<?php
					$sql= "SELECT SUM(L1) AS P1,SUM(L2) AS P2,SUM(L3) AS P3,SUM(L4) AS P4,SUM(L5) AS P5 FROM T5_LHR_JENIS_LAHIR WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded:true,  label: 'TUNGGAL'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),exploded:true,  label: 'KEMBAR DUA'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),exploded:true,  label: 'KEMBAR TIGA'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),exploded:true,  label: 'KEMBAR EMPAT'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),exploded:true,  label: 'KEMBAR BANYAK/LAINNYA'},";
					?>			
					]}
			]
					
			});
			piekkkota3.render();
			piekkkota3 = {};
  
  </script>
  <!-- Grafik Kecamatan Pilih <>0-->


  <!--  AKHIR STATISTIK 3 -->
  <!--  STATISTIK PEKERJAAN -->
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
					//text: 'DIAGRAM KOLOM KELAHIRAN MENURUT JENIS KELAHIRAN KOTA BANDUNG',
					
				},
				animationEnabled: true,
				theme: "theme2",
				exportFileName:"Diagram Disdukcapil Kota Bandung",
				exportEnable: true,

				data: [
				{
					type: 'column',
					indexLabelMaxWidth: 50,
			    //indexLabelMaxWidth: 50,
				//indexLabelWrap: true, // change to false 
				
					dataPoints: [
					<?php
					$sql= "SELECT SUM(L1) AS P1,SUM(L2) AS P2,SUM(L3) AS P3,SUM(L4) AS P4,SUM(L5) AS P5 FROM T5_LHR_JENIS_LAHIR WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'TUNGGAL'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'KEMBAR DUA'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."), label: 'KEMBAR TIGA'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'KEMBAR EMPAT'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'KEMBAR BANYAK/LAINNYA'},";
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
					//text: 'DIAGRAM PIE KELAHIRAN MENURUT JENIS KELAHIRAN KOTA BANDUNG'
				},
				legend: {
			itemMaxWidth: 50,
			itemWrap: true,
			horizontalAlign: "center"// Change to true or false 
			},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. ",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(L1) AS P1,SUM(L2) AS P2,SUM(L3) AS P3,SUM(L4) AS P4,SUM(L5) AS P5 FROM T5_LHR_JENIS_LAHIR WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'TUNGGAL'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'KEMBAR DUA'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."), label: 'KEMBAR TIGA'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'KEMBAR EMPAT'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'KEMBAR BANYAK/LAINNYA'},";
					
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
			var kolkkkota5 = new CanvasJS.Chart('kolkkkota5', {
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM KOLOM PENDUDUK MENURUT KEPEMILIKAN AKTA KOTA BANDUNG'
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
				
				data: [
				{
					type: 'column',
					showInLegend: true, 
					legendMarkerColor: '#4661EE',
					legendText: 'Ada Akta/Struktur Umur',
			    indexLabelMaxWidth: 50,
				//indexLabelWrap: true, // change to false 
				
					dataPoints: [
					<?php
					//Koding Extreme
					$sql= "SELECT SUM(ADA_AKTA) AS P1 FROM T5_STT_AKTA18 WHERE BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP='32' AND NO_KAB='73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'Ada Akta'},";
					}
					?>					
					]},{
					type: 'column',
					showInLegend: true, 
					legendMarkerColor: '#EC5657',
					legendText: 'Tidak Ada Akta/Struktur Umur',
					dataPoints: [
					<?php
					//Koding Extreme
					$sql= "SELECT SUM(TIDAK_ADA_AKTA) AS P1 FROM T5_STT_AKTA18 WHERE BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP='32' AND NO_KAB='73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'Tidak Ada Akta'},";
					}
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
					//text: 'DIAGRAM PIE PENDUDUK MENURUT KEPEMILIKAN AKTA KOTA BANDUNG'
				},
				legend: {
			itemMaxWidth: 100,
			itemWrap: true,
			horizontalAlign: "center"// Change to true or false 
			},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. ",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(ADA_AKTA) AS P1, SUM(TIDAK_ADA_AKTA) AS P2 FROM T5_STT_AKTA18 WHERE BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."), exploded: true, indexLabel: 'Ada Akta'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'Tidak Ada Akta'},";

					?>						
					]}
			]
					
			});
			piekkkota5.render();
			piekkkota5 = {};
  
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
			var kolkkkota6 = new CanvasJS.Chart('kolkkkota6', {
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM KOLOM PENDUDUK MENURUT KEPEMILIKAN AKTA KOTA BANDUNG'
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
       
				data: [
				{
					type: 'column',
					showInLegend: true, 
					legendMarkerColor: '#4661EE',
					legendText: 'Ada Akta/Struktur Umur',
			    indexLabelMaxWidth: 50,
				//indexLabelWrap: true, // change to false 
				
					dataPoints: [
					<?php
					//Koding Extreme
					$sql= "SELECT 
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '0' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P1,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '1' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P2,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '2' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P3,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '3' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P4,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '4' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P5,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '5' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P6,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '6' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P7,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '7' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P8,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '8' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P9,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '9' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P10,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '10' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P11,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '11' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P12,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '12' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P13,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '13' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P14,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '14' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P15,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '15' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P16
FROM T5_STT_STRUKTUR_UMUR a WHERE ROWNUM ='1'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: '0-4'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: '5-9'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: '10-14'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: '15-19'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: '20-24'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: '25-29'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: '30-34'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  label: '36-39'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  label: '40-44'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), label: '45-49'},";
					echo "{y: parseInt(".(json_encode($row['P11']))."), label: '50-54'},";
					echo "{y: parseInt(".(json_encode($row['P12']))."), label: '55-59'},";
					echo "{y: parseInt(".(json_encode($row['P13']))."), label: '60-64'},";	
					echo "{y: parseInt(".(json_encode($row['P14']))."), label: '65-69'},";
					echo "{y: parseInt(".(json_encode($row['P15']))."), label: '70-74'},";
					echo "{y: parseInt(".(json_encode($row['P16']))."), label: '>75'},";
					?>					
					]},{
					type: 'column',
					showInLegend: true, 
					legendMarkerColor: '#EC5657',
					legendText: 'Tidak Ada Akta/Struktur Umur',
					dataPoints: [
					<?php
					//Koding Extreme
					$sql= "SELECT 
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '0' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P1,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '1' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P2,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '2' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P3,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '3' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P4,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '4' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P5,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '5' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P6,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '6' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P7,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '7' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P8,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '8' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P9,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '9' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P10,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '10' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P11,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '11' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P12,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '12' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P13,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '13' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P14,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '14' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P15,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '15' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P16
FROM T5_STT_STRUKTUR_UMUR a WHERE ROWNUM ='1'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: '0-4'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: '5-9'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: '10-14'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: '15-19'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: '20-24'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: '25-29'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: '30-34'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  label: '36-39'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  label: '40-44'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), label: '45-49'},";
					echo "{y: parseInt(".(json_encode($row['P11']))."), label: '50-54'},";
					echo "{y: parseInt(".(json_encode($row['P12']))."), label: '55-59'},";
					echo "{y: parseInt(".(json_encode($row['P13']))."), label: '60-64'},";	
					echo "{y: parseInt(".(json_encode($row['P14']))."), label: '65-69'},";
					echo "{y: parseInt(".(json_encode($row['P15']))."), label: '70-74'},";
					echo "{y: parseInt(".(json_encode($row['P16']))."), label: '>75'},";
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
					//text: 'DIAGRAM PIE PENDUDUK MENURUT KEPEMILIKAN AKTA KOTA BANDUNG'
				},
				legend: {
			itemMaxWidth: 100,
			itemWrap: true,
			horizontalAlign: "center"// Change to true or false 
			},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. ",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(ADA_AKTA) AS P1, SUM(TIDAK_ADA_AKTA) AS P2 FROM T5_STT_STRUKTUR_UMUR WHERE BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."), exploded: true, indexLabel: 'Ada Akta'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'Tidak Ada Akta'},";

					?>						
					]}
			]
					
			});
			piekkkota6.render();
			piekkkota6 = {};
  
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
