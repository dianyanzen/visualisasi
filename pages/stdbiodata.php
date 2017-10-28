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
                                <li><a href="stdkk.php">Kartu Keluarga</a>
                                </li>
                                <li class="active"><a href="stdbiodata.php">Biodata</a>
                                </li>
                                <li><a href="stdpindah.php">Pindah</a>
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
												Statistik Pendaftaran Penduduk WNI Kota Bandung - Biodata
											</div>
										<div class="panel-body" >
										
										<form method="post" name="formstatistik" id="formstatistik" action="stdbiodata.php" role="form">
	
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
												<option value="1">Jumlah Penduduk Menurut Jenis Kelamin</option>
												<option value="2">Jumlah Penduduk Menurut Struktur Umur dan Jenis Kelamin</option>
												<option value="3">Jumlah Penduduk Menurut Pendidikan Akhir</option>
												<option value="4">Jumlah Penduduk Menurut Jenis Pekerjaan</option>
												<option value="5">Jumlah Penduduk Menurut Status Perkawinan</option>
												<option value="6">Jumlah Penduduk Menurut Golongan Darah</option>
												<option value="7">Jumlah Penduduk Menurut Agama</option>
												<option value="8">Jumlah Penduduk Menurut Penyandang Cacat</option>
												<option value="9">Jumlah Penduduk Menurut Wajib KTP</option>
												<option value="10">Jumlah Penduduk Menurut Status Hubungan Dalam Keluarga</option>
												<option value="11">Jumlah Penduduk Menurut Kepemilikan Akta</option>
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
	$NOKEC= $_REQUEST['NO_KEC'] ;
	$NOKEL= $_REQUEST['NO_KEL'] ;
	$BULAN= $_POST['bulan'];
	//MENGECEK APAKAH BULAN YANG DI PILIH TERSEDIA DI DB
	$sql= "SELECT * FROM T5_STT_AGR_PENDUDUK WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
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
									<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT JENIS KELAMIN <br>KOTA BANDUNG <br>BULAN $bln TAHUN $tahun </b></h1></div>
                                    <div id='kolkkkota1' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM PIE KEMATIAN MENURUT JENIS KELAMIN <br>KOTA BANDUNG <br>BULAN $bln TAHUN $tahun </b></h1></div>
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
									echo "<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT JENIS KELAMIN <br>KECAMATAN ".$row['NAMA_KEC']." <br> BULAN $bln TAHUN $tahun</h1></b></div>
                                    <div id='kolkkkec1' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$row = oci_fetch_array($stmt);
									echo "<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT JENIS KELAMIN <br>KECAMATAN ".$row['NAMA_KEC']." <br> BULAN $bln TAHUN $tahun</h1></b></div>
                                    <div id='kolkkkecall1' style='height: 400px; width: 100%;'></div>
                                </div>
								 <div class='panel-body'>
                                    <br><br>
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
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEL ='".$NOKEC."'";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$row = oci_fetch_array($stmt);
									echo "<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT JENIS KELAMIN <br>KELURAHAN ".$row['NAMA_KEL']." <br> BULAN $bln TAHUN $tahun</h1></b></div>
                                    <div id='kolkkkel1' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$row = oci_fetch_array($stmt);
									echo "<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT JENIS KELAMIN <br>KELURAHAN ".$row['NAMA_KEL']." <br> BULAN $bln TAHUN $tahun</h1></b></div>
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
	$sql= "SELECT * FROM T5_STT_STRUKTUR_UMUR WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
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
									<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT  STRUKTUR UMUR & JENIS KELAMIN <br> KOTA BANDUNG <br> BULAN $bln TAHUN $tahun</h1></b></div>
                                    <div id='kolkkkota2' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT  STRUKTUR UMUR & JENIS KELAMIN <br> KOTA BANDUNG <br> BULAN $bln TAHUN $tahun</h1></b></div>
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
									echo"<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT STRUKTUR UMUR & JENIS KELAMIN <br>KECAMATAN ".$row['NAMA_KEC']." <br> BULAN $bln TAHUN $tahun</h1></b></div>
                                    <div id='kolkkkec2' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
										$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
										$stmt = oci_parse($conn, $sql);
										oci_execute($stmt);
										$row = oci_fetch_array($stmt);
									echo"<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT STRUKTUR UMUR & JENIS KELAMIN <br>KECAMATAN ".$row['NAMA_KEC']." <br> BULAN $bln TAHUN $tahun</h1></b></div>
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
					echo"<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT STRUKTUR UMUR DAN JENIS KELAMIN <br>KELURAHAN ".$row['NAMA_KEL']." <br> BULAN $bln TAHUN $tahun</h1></b></div>
                                    <div id='kolkkkel2' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT STRUKTUR UMUR DAN JENIS KELAMIN <br>KELURAHAN ".$row['NAMA_KEL']." <br> BULAN $bln TAHUN $tahun</h1></b></div>
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
	$sql= "SELECT * FROM T5_STT_PENDIDIKAN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
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
									<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT PENDIDIKAN AKHIR <br> KOTA BANDUNG <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkota3' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT PENDIDIKAN AKHIR <br> KOTA BANDUNG <br> BULAN $bln TAHUN $tahun </h1></b></div>
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
									echo"<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT PENDIDIKAN TERAKHIR <br> KECAMATAN ".$row['NAMA_KEC']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkec3' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
									echo"<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT PENDIDIKAN TERAKHIR <br> KECAMATAN ".$row['NAMA_KEC']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
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
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT PENDIDIKAN TERAKHIR <br> KELURAHAN ".$row['NAMA_KEL']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkel3' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT PENDIDIKAN TERAKHIR <br> KELURAHAN ".$row['NAMA_KEL']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
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
	$sql= "SELECT * FROM T5_STT_PENDIDIKAN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
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
									<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT JENIS PEKERJAAN <br> KOTA BANDUNG <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkota4' style='height: 4000px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT JENIS PEKERJAAN <br> KOTA BANDUNG <br> BULAN $bln TAHUN $tahun </h1></b></div>
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
									echo"<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT JENIS PEKERJAAN <br> KECAMATAN ".$row['NAMA_KEC']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkec4' style='height: 4000px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
									echo"<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT JENIS PEKERJAAN <br> KECAMATAN ".$row['NAMA_KEC']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
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
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT JENIS PEKERJAAN <br> KELURAHAN ".$row['NAMA_KEL']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkel4' style='height: 4000px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT JENIS PEKERJAAN <br> KELURAHAN ".$row['NAMA_KEL']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
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
									<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT STATUS PERKAWINAN <br> KOTA BANDUNG <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkota5' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT STATUS PERKAWINAN <br> KOTA BANDUNG <br> BULAN $bln TAHUN $tahun </h1></b></div>
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
									echo"<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT STATUS PERKAWINAN <br> KECAMATAN ".$row['NAMA_KEC']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkec5' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
									echo"<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT STATUS PERKAWINAN <br> KECAMATAN ".$row['NAMA_KEC']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
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
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT STATUS PERKAWINAN <br> KELURAHAN ".$row['NAMA_KEL']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkel5' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT STATUS PERKAWINAN <br> KELURAHAN ".$row['NAMA_KEL']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
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
									<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT GOLONGAN DARAH <br> KOTA BANDUNG <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkota6' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT GOLONGAN DARAH <br> KOTA BANDUNG <br> BULAN $bln TAHUN $tahun </h1></b></div>
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
									echo"<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT GOLONGAN DARAH <br> KECAMATAN ".$row['NAMA_KEC']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkec6' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
									echo"<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT GOLONGAN DARAH <br> KECAMATAN ".$row['NAMA_KEC']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
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
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT GOLONGAN DARAH <br> KELURAHAN ".$row['NAMA_KEL']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkel6' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT GOLONGAN DARAH <br> KELURAHAN ".$row['NAMA_KEL']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
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
									<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT AGAMA <br> KOTA BANDUNG <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkota7' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT AGAMA <br> KOTA BANDUNG <br> BULAN $bln TAHUN $tahun </h1></b></div>
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
									echo"<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT AGAMA <br> KECAMATAN ".$row['NAMA_KEC']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkec7' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
									echo"<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT AGAMA <br> KECAMATAN ".$row['NAMA_KEC']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
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
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT AGAMA <br> KELURAHAN ".$row['NAMA_KEL']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkel7' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT AGAMA <br> KELURAHAN ".$row['NAMA_KEL']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
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
	//STATISTIK 8
	ELSE IF($_REQUEST['statistik']=="8"){
				//JIKA STATISTIK YANG DI PILIH VALUENYA = 8
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
									<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT PENYANDANG CACAT <br> KOTA BANDUNG <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkota8' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT PENYANDANG CACAT <br> KOTA BANDUNG <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='piekkkota8' style='height: 400px; width: 100%;'></div>
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
									echo"<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT PENYANDANG CACAT <br> KECAMATAN ".$row['NAMA_KEC']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkec8' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
									echo"<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT PENYANDANG CACAT <br> KECAMATAN ".$row['NAMA_KEC']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='piekkkec8' style='height: 400px; width: 100%;'></div>
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
					echo"<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT PENYANDANG CACAT <br> KELURAHAN ".$row['NAMA_KEL']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkel8' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT PENYANDANG CACAT <br> KELURAHAN ".$row['NAMA_KEL']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='piekkkel8' style='height: 400px; width: 100%;'></div>
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
	ELSE IF($_REQUEST['statistik']=="9"){
				//JIKA STATISTIK YANG DI PILIH VALUENYA = 9
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
									<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT WAJIB KTP <br> KOTA BANDUNG <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkota9' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT WAJIB KTP <br> KOTA BANDUNG <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='piekkkota9' style='height: 400px; width: 100%;'></div>
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
									echo"<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT WAJIB KTP <br> KECAMATAN ".$row['NAMA_KEC']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkec9' style='height: 400px; width: 100%;'></div>
                                </div>
								<div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
									echo"<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT WAJIB KTP <br> KECAMATAN ".$row['NAMA_KEC']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkecall9' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
                                    <div id='piekkkec9' style='height: 400px; width: 100%;'></div>
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
					echo"<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT WAJIB KTP <br> KELURAHAN ".$row['NAMA_KEL']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkel9' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT WAJIB KTP <br> KELURAHAN ".$row['NAMA_KEL']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='piekkkel9' style='height: 400px; width: 100%;'></div>
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
	//STATISTIK 10
	ELSE IF($_REQUEST['statistik']=="10"){
				//JIKA STATISTIK YANG DI PILIH VALUENYA = 10
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
									<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT STATUS HUBUNGAN DALAM KELUARGA <br> KOTA BANDUNG <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkota10' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT STATUS HUBUNGAN DALAM KELUARGA <br> KOTA BANDUNG <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='piekkkota10' style='height: 400px; width: 100%;'></div>
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
									echo"<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT STATUS HUBUNGAN DALAM KELUARGA <br> KECAMATAN ".$row['NAMA_KEC']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkec10' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
									echo"<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT STATUS HUBUNGAN DALAM KELUARGA <br> KECAMATAN ".$row['NAMA_KEC']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='piekkkec10' style='height: 400px; width: 100%;'></div>
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
					echo"<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT STATUS HUBUNGAN DALAM KELUARGA <br> KELURAHAN ".$row['NAMA_KEL']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkel10' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT STATUS HUBUNGAN DALAM KELUARGA <br> KELURAHAN ".$row['NAMA_KEL']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='piekkkel10' style='height: 400px; width: 100%;'></div>
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
	}//STATISTIK 11
	ELSE IF($_REQUEST['statistik']=="11"){
				//JIKA STATISTIK YANG DI PILIH VALUENYA = 11
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
									<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT KEPEMILIKAN AKTA <br> KOTA BANDUNG <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkota11' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>
									<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT KEPEMILIKAN AKTA <br> KOTA BANDUNG <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='piekkkota11' style='height: 400px; width: 100%;'></div>
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
									echo"<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT KEPEMILIKAN AKTA <br> KECAMATAN ".$row['NAMA_KEC']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkec11' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
									echo"<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT KEPEMILIKAN AKTA <br> KECAMATAN ".$row['NAMA_KEC']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='piekkkec11' style='height: 400px; width: 100%;'></div>
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
					echo"<div align='center'><h1><b>DIAGRAM KOLOM BIODATA MENURUT KEPEMILIKAN AKTA <br> KELURAHAN ".$row['NAMA_KEL']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='kolkkkel11' style='height: 400px; width: 100%;'></div>
                                </div>
                                <div class='panel-body'>
                                    <br><br>";
									$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo"<div align='center'><h1><b>DIAGRAM PIE BIODATA MENURUT KEPEMILIKAN AKTA <br> KELURAHAN ".$row['NAMA_KEL']." <br> BULAN $bln TAHUN $tahun </h1></b></div>
                                    <div id='piekkkel11' style='height: 400px; width: 100%;'></div>
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
			var kolkkkota1 = new CanvasJS.Chart('kolkkkota1', {
				//CHART COLOM MENAMPILKAN SELURUH DATA YANG DI HITUNG DAN SELURUH KECAMATAN
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM KOLOM PENDUDUK MENURUT JENIS KELAMIN KOTA BANDUNG'
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
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(DAK_LK) AS LAKI_LAKI FROM T5_STT_AGR_PENDUDUK INNER JOIN SETUP_KEC ON T5_STT_AGR_PENDUDUK.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
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
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(DAK_LP) AS PEREMPUAN FROM T5_STT_AGR_PENDUDUK INNER JOIN SETUP_KEC ON T5_STT_AGR_PENDUDUK.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  label: ".json_encode($row['NAMA_KEC'])."},"; 
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
					//text: 'DIAGRAM PIE PENDUDUK MENURUT JENIS KELAMIN KOTA BANDUNG'
				},
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
				animationEnabled: true,
				theme: "theme2",
          
				data: [
				{
					type: "pie",
			showInLegend: true,
			toolTipContent: "{y} - #percent %",
			////yValueFormatString: "#0#,. RIBU",
			legendText: "{indexLabel}",
					dataPoints: [
					<?php
					//MENAMPILKAN DATA HASIL PENJUMLAHAN DATA SELURUH KECAMATAN DISATUKAN LAKI LAKI
					$sql= "SELECT SUM(DAK_LK) AS LAKI_LAKI FROM T5_STT_AGR_PENDUDUK WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['LAKI_LAKI']))."),  indexLabel: 'LAKI-LAKI'},";
					}	
					?>
					<?php
					//MENAMPILKAN DATA HASIL PENJUMLAHAN DATA SELURUH KECAMATAN DISATUKAN PEREMPUAN
					$sql= "SELECT SUM(DAK_LP) AS PEREMPUAN FROM T5_STT_AGR_PENDUDUK WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),exploded: true,  indexLabel: 'PEREMPUAN'},"; 
					}	
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
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT JENIS KELAMIN KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
				animationEnabled: true, theme: "theme2",
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
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(DAK_LK) AS LAKI_LAKI FROM T5_STT_AGR_PENDUDUK INNER JOIN SETUP_KEC ON T5_STT_AGR_PENDUDUK.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' AND SETUP_KEC.NO_KEC =".$NOKEC." GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
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
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(DAK_LP) AS PEREMPUAN FROM T5_STT_AGR_PENDUDUK INNER JOIN SETUP_KEC ON T5_STT_AGR_PENDUDUK.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' AND SETUP_KEC.NO_KEC =".$NOKEC." GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  label: ".json_encode($row['NAMA_KEC'])."},"; 
					}	
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
			var kolkkkecall1 = new CanvasJS.Chart('kolkkkecall1', {
				//MENAMPIKAN DATA KELURAHAN BERDASARKAN KECAMATAN YANG DIPILIH
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//MENCARI NAMA KECAMATAN YANG DIPILIH
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT JENIS KELAMIN KECAMATAN ".$row['NAMA_KEC']." PER KELURAHAN'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
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
					$sql= "SELECT SETUP_KEL.NAMA_KEL, DAK_LK AS LAKI_LAKI FROM T5_STT_AGR_PENDUDUK INNER JOIN SETUP_KEL ON T5_STT_AGR_PENDUDUK.NO_KEC = SETUP_KEL.NO_KEC AND T5_STT_AGR_PENDUDUK.NO_KEL = SETUP_KEL.NO_KEL WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEL.NO_PROP='32' AND SETUP_KEL.NO_KAB='73' AND SETUP_KEL.NO_KEC ='".$NOKEC."' ORDER BY SETUP_KEL.NAMA_KEL";
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
					$sql= "SELECT SETUP_KEL.NAMA_KEL, DAK_LP AS PEREMPUAN FROM T5_STT_AGR_PENDUDUK INNER JOIN SETUP_KEL ON T5_STT_AGR_PENDUDUK.NO_KEC = SETUP_KEL.NO_KEC AND T5_STT_AGR_PENDUDUK.NO_KEL = SETUP_KEL.NO_KEL WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEL.NO_PROP='32' AND SETUP_KEL.NO_KAB='73' AND SETUP_KEL.NO_KEC ='".$NOKEC."' ORDER BY SETUP_KEL.NAMA_KEL";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  label: ".json_encode($row['NAMA_KEL'])."},"; 
					}	
					?>					
					]}
			]
					
			});
			kolkkkecall1.render();
			kolkkkecall1 = {};
  
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
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT JENIS KELAMIN KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
          //exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
				data: [
				{
					type: "pie",
			showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			legendText: "{indexLabel}",
					dataPoints: [
					<?php
					//MENCARI JUMLAH DATA YANG DIPILIH BERDASARKAN KECAMATAN
					$sql= "SELECT SUM(DAK_LK) AS LAKI_LAKI FROM T5_STT_AGR_PENDUDUK WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73' AND NO_KEC =".$NOKEC."";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['LAKI_LAKI']))."),  indexLabel: 'LAKI-LAKI'},";
					}	
					?>
					<?php
					//MENCARI JUMLAH DATA YANG DIPILIH BERDASARKAN KECAMATAN
					$sql= "SELECT SUM(DAK_LP) AS PEREMPUAN FROM T5_STT_AGR_PENDUDUK WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73' AND NO_KEC =".$NOKEC."";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  exploded: true, indexLabel: 'PEREMPUAN'},"; 
					}	
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
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT JENIS KELAMIN KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
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
					$sql= "SELECT SETUP_KEL.NAMA_KEL, DAK_LK AS LAKI_LAKI FROM T5_STT_AGR_PENDUDUK INNER JOIN SETUP_KEL ON T5_STT_AGR_PENDUDUK.NO_KEC = SETUP_KEL.NO_KEC AND T5_STT_AGR_PENDUDUK.NO_KEL = SETUP_KEL.NO_KEL WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEL.NO_PROP='32' AND SETUP_KEL.NO_KAB='73' AND SETUP_KEL.NO_KEC ='".$NOKEC."' AND SETUP_KEL.NO_KEL ='".$NOKEL."' ORDER BY SETUP_KEL.NAMA_KEL";
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
					$sql= "SELECT SETUP_KEL.NAMA_KEL, DAK_LP AS PEREMPUAN FROM T5_STT_AGR_PENDUDUK INNER JOIN SETUP_KEL ON T5_STT_AGR_PENDUDUK.NO_KEC = SETUP_KEL.NO_KEC AND T5_STT_AGR_PENDUDUK.NO_KEL = SETUP_KEL.NO_KEL WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEL.NO_PROP='32' AND SETUP_KEL.NO_KAB='73' AND SETUP_KEL.NO_KEC ='".$NOKEC."' AND SETUP_KEL.NO_KEL ='".$NOKEL."' ORDER BY SETUP_KEL.NAMA_KEL";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  label: ".json_encode($row['NAMA_KEL'])."},"; 
					}	
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
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT JENIS KELAMIN KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
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
					$sql= "SELECT DAK_LK AS LAKI_LAKI FROM T5_STT_AGR_PENDUDUK WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73' AND NO_KEC =".$NOKEC." AND NO_KEL =".$NOKEL."";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['LAKI_LAKI']))."),  indexLabel: 'LAKI-LAKI'},";
					}	
					?>
					<?php
					// MENCARI DATA PER KELURAHAN
					$sql= "SELECT DAK_LP AS PEREMPUAN FROM T5_STT_AGR_PENDUDUK WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73' AND NO_KEC =".$NOKEC." AND NO_KEL =".$NOKEL."";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  exploded: true,  indexLabel: 'PEREMPUAN'},"; 
					}	
					?>						
					]}
			]
					
			});
			piekkkel1.render();
			piekkkel1 = {};
  
  </script>
  <!--  AKHIR STATISTIK 1 -->
  
  <!-- KATEGORI Kelamin Dan Usia -->
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
					//text: 'DIAGRAM KOLOM PENDUDUK MENURUT STRUKTUR UMUR KOTA BANDUNG'
				},
				animationEnabled: true, theme: "theme2",
       //exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
				data: [
				{
					type: 'column',
					showInLegend: true, 
					legendMarkerColor: '#4661EE',
					legendText: 'Laki-Laki/Struktur Umur',
					dataPoints: [
					<?php
					//Koding Extreme
					$sql= "SELECT 
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '0' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P1,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '1' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P2,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '2' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P3,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '3' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P4,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '4' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P5,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '5' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P6,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '6' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P7,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '7' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P8,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '8' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P9,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '9' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P10,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '10' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P11,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '11' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P12,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '12' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P13,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '13' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P14,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '14' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P15,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '15' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P16
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
					legendText: 'Perempuan/Struktur Umur',
					dataPoints: [
					<?php
					//Koding Extreme
					$sql= "SELECT 
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '0' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P1,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '1' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P2,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '2' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P3,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '3' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P4,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '4' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P5,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '5' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P6,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '6' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P7,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '7' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P8,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '8' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P9,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '9' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P10,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '10' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P11,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '11' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P12,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '12' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P13,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '13' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P14,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '14' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P15,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '15' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P16
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
					$sql= "SELECT 
    (SELECT sum(LAKI_LAKI)+sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '0' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P1,
    (SELECT sum(LAKI_LAKI)+sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '1' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P2,
    (SELECT sum(LAKI_LAKI)+sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '2' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P3,
    (SELECT sum(LAKI_LAKI)+sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '3' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P4,
    (SELECT sum(LAKI_LAKI)+sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '4' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P5,
    (SELECT sum(LAKI_LAKI)+sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '5' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P6,
    (SELECT sum(LAKI_LAKI)+sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '6' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P7,
    (SELECT sum(LAKI_LAKI)+sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '7' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P8,
    (SELECT sum(LAKI_LAKI)+sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '8' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P9,
    (SELECT sum(LAKI_LAKI)+sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '9' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P10,
    (SELECT sum(LAKI_LAKI)+sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '10' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P11,
    (SELECT sum(LAKI_LAKI)+sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '11' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P12,
    (SELECT sum(LAKI_LAKI)+sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '12' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P13,
    (SELECT sum(LAKI_LAKI)+sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '13' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P14,
    (SELECT sum(LAKI_LAKI)+sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '14' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P15,
    (SELECT sum(LAKI_LAKI)+sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '15' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P16
FROM T5_STT_STRUKTUR_UMUR a WHERE ROWNUM ='1'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."), exploded: true, indexLabel: '0-4'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: '5-9'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: '10-14'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: '15-19'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: '20-24'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: '25-29'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: '30-34'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  indexLabel: '36-39'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  indexLabel: '40-44'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), indexLabel: '45-49'},";
					echo "{y: parseInt(".(json_encode($row['P11']))."), indexLabel: '50-54'},";
					echo "{y: parseInt(".(json_encode($row['P12']))."), indexLabel: '55-59'},";
					echo "{y: parseInt(".(json_encode($row['P13']))."), indexLabel: '60-64'},";	
					echo "{y: parseInt(".(json_encode($row['P14']))."), indexLabel: '65-69'},";
					echo "{y: parseInt(".(json_encode($row['P15']))."), indexLabel: '70-74'},";
					echo "{y: parseInt(".(json_encode($row['P16']))."), indexLabel: '>75'},";
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
					//AMBIL NAMA KECAMATAN DAN TOTAL PENJUMLAHAN NIK TIAP KELUARAHAN BERDASARKAN KECAMATAN YANG DI PILIH 
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT STRUKTUR UMUR KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
            //legend: {
        //verticalAlign: 'bottom',
        //horizontalAlign: 'center'
      //},
				data: [
				{
					type: 'column',
					showInLegend: true, 
					legendMarkerColor: '#4661EE',
					legendText: 'Laki-Laki/Struktur Umur',
					 //indexLabelMaxWidth: 50,
					dataPoints: [
					<?php
					//Koding Extreme
					$sql= "SELECT 
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '0' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P1,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '1' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P2,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '2' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P3,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '3' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P4,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '4' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P5,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '5' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P6,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '6' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P7,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '7' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P8,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '8' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P9,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '9' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P10,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '10' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P11,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '11' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P12,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '12' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P13,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '13' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P14,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '14' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P15,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '15' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P16
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
					legendText: 'Perempuan/Struktur Umur',
					dataPoints: [
					<?php
					//Koding Extreme
					$sql= "SELECT 
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '0' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P1,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '1' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P2,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '2' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P3,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '3' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P4,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '4' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P5,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '5' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P6,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '6' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P7,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '7' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P8,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '8' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P9,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '9' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P10,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '10' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P11,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '11' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P12,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '12' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P13,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '13' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P14,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '14' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P15,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '15' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P16
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
					//]}				
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
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT STRUKTUR UMUR KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
          //exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					//Koding Extreme
					$sql= "SELECT 
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '0' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P1,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '1' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P2,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '2' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P3,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '3' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P4,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '4' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P5,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '5' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P6,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '6' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P7,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '7' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P8,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '8' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P9,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '9' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P10,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '10' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P11,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '11' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P12,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '12' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P13,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '13' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P14,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '14' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P15,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '15' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' ) as P16
FROM T5_STT_STRUKTUR_UMUR a WHERE ROWNUM ='1'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."), exploded: true, indexLabel: '0-4'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: '5-9'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: '10-14'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: '15-19'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: '20-24'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: '25-29'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: '30-34'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  indexLabel: '36-39'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  indexLabel: '40-44'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), indexLabel: '45-49'},";
					echo "{y: parseInt(".(json_encode($row['P11']))."), indexLabel: '50-54'},";
					echo "{y: parseInt(".(json_encode($row['P12']))."), indexLabel: '55-59'},";
					echo "{y: parseInt(".(json_encode($row['P13']))."), indexLabel: '60-64'},";	
					echo "{y: parseInt(".(json_encode($row['P14']))."), indexLabel: '65-69'},";
					echo "{y: parseInt(".(json_encode($row['P15']))."), indexLabel: '70-74'},";
					echo "{y: parseInt(".(json_encode($row['P16']))."), indexLabel: '>75'},";
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
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT STRUKTUR UMUR KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
            legend: {
        verticalAlign: 'bottom',
        horizontalAlign: 'center'
      },
				data: [
				{
					type: 'column',
					showInLegend: true, 
					legendMarkerColor: '#4661EE',
					legendText: 'Laki-Laki/Struktur Umur',
					 //indexLabelMaxWidth: 50,
					dataPoints: [
					<?php
					//Koding Extreme
					$sql= "SELECT 
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '0' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P1,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '1' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P2,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '2' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P3,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '3' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P4,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '4' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P5,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '5' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P6,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '6' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P7,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '7' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P8,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '8' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P9,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '9' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P10,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '10' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P11,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '11' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P12,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '12' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P13,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '13' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P14,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '14' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P15,
    (SELECT sum(LAKI_LAKI) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '15' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P16
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
					legendText: 'Perempuan/Struktur Umur',
					dataPoints: [
					<?php
					//Koding Extreme
					$sql= "SELECT 
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '0' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P1,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '1' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P2,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '2' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P3,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '3' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P4,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '4' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P5,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '5' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P6,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '6' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P7,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '7' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P8,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '8' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P9,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '9' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P10,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '10' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P11,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '11' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P12,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '12' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P13,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '13' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P14,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '14' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P15,
    (SELECT sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '15' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P16
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
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT STRUKTUR UMUR KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
          //exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "##,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					//Koding Extreme
					$sql= "SELECT 
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '0' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P1,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '1' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P2,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '2' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P3,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '3' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P4,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '4' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P5,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '5' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P6,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '6' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P7,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '7' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P8,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '8' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P9,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '9' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P10,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '10' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P11,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '11' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P12,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '12' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P13,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '13' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P14,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '14' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P15,
    (SELECT sum(LAKI_LAKI) + sum(PEREMPUAN) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '15' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."' ) as P16
FROM T5_STT_STRUKTUR_UMUR a WHERE ROWNUM ='1'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."), exploded: true, indexLabel: '0-4'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: '5-9'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: '10-14'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: '15-19'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: '20-24'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: '25-29'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: '30-34'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  indexLabel: '36-39'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  indexLabel: '40-44'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), indexLabel: '45-49'},";
					echo "{y: parseInt(".(json_encode($row['P11']))."), indexLabel: '50-54'},";
					echo "{y: parseInt(".(json_encode($row['P12']))."), indexLabel: '55-59'},";
					echo "{y: parseInt(".(json_encode($row['P13']))."), indexLabel: '60-64'},";	
					echo "{y: parseInt(".(json_encode($row['P14']))."), indexLabel: '65-69'},";
					echo "{y: parseInt(".(json_encode($row['P15']))."), indexLabel: '70-74'},";
					echo "{y: parseInt(".(json_encode($row['P16']))."), indexLabel: '>75'},";
					?>							
					]}
			]
					
			});
			piekkkel2.render();
			piekkkel2 = {};
  
  </script>
  <!--  AKHIR STATISTIK 2 -->
  <!-- MENCARI PENDIDIKAN -->
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
					//text: 'DIAGRAM KOLOM PENDUDUK MENURUT PENDIDIKAN AKHIR KOTA BANDUNG'
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
					$sql= "SELECT SUM(PDD01) AS P1,SUM(PDD02) AS P2,SUM(PDD03) AS P3,SUM(PDD04) AS P4,SUM(PDD05) AS P5,SUM(PDD06) AS P6,SUM(PDD07) AS P7,SUM(PDD08) AS P8,SUM(PDD09) AS P9,SUM(PDD10) AS P10 FROM T5_STT_PENDIDIKAN WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'Belum Sekolah'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'Belum Tamat Sd'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'Tamat Sd'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'Tamat Smp'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'Tamat Sma'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'D-I/D-II'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'D-III'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  label: 'D-IV/S-I'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  label: 'S-II'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), label: 'S-III'},";

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
					//text: 'DIAGRAM PIE PENDUDUK MENURUT PENDIDIKAN TERAKHIR KOTA BANDUNG'
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
					$sql= "SELECT SUM(PDD01) AS P1,SUM(PDD02) AS P2,SUM(PDD03) AS P3,SUM(PDD04) AS P4,SUM(PDD05) AS P5,SUM(PDD06) AS P6,SUM(PDD07) AS P7,SUM(PDD08) AS P8,SUM(PDD09) AS P9,SUM(PDD10) AS P10 FROM T5_STT_PENDIDIKAN WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'Tidak/Belum Sekolah'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'Belum Tamat Sd'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'Tamat Sd'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'Tamat Smp'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."), exploded: true,  indexLabel: 'Tamat Sma'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'D-I/D-II'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: 'D-III'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  indexLabel: 'D-IV/S-I'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  indexLabel: 'S-II'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), indexLabel: 'S-III'},";

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
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT PENDIDIKAN TERAKHIR KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
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
					$sql= "SELECT SUM(PDD01) AS P1,SUM(PDD02) AS P2,SUM(PDD03) AS P3,SUM(PDD04) AS P4,SUM(PDD05) AS P5,SUM(PDD06) AS P6,SUM(PDD07) AS P7,SUM(PDD08) AS P8,SUM(PDD09) AS P9,SUM(PDD10) AS P10 FROM T5_STT_PENDIDIKAN WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'Belum Sekolah'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'Belum Tamat Sd'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'Tamat Sd'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'Tamat Smp'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'Tamat Sma'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'D-I/D-II'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'D-III'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  label: 'D-IV/S-I'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  label: 'S-II'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), label: 'S-III'},";
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
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT PENDIDIKAN TERAKHIR KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(PDD01) AS P1,SUM(PDD02) AS P2,SUM(PDD03) AS P3,SUM(PDD04) AS P4,SUM(PDD05) AS P5,SUM(PDD06) AS P6,SUM(PDD07) AS P7,SUM(PDD08) AS P8,SUM(PDD09) AS P9,SUM(PDD10) AS P10 FROM T5_STT_PENDIDIKAN WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC=".$NOKEC." AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'Belum Sekolah'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'Belum Tamat Sd'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'Tamat Sd'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'Tamat Smp'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),exploded:true,  indexLabel: 'Tamat Sma'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'D-I/D-II'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: 'D-III'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  indexLabel: 'D-IV/S-I'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  indexLabel: 'S-II'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."),  indexLabel: 'S-III'},";

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
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT PENDIDIKAN TERAKHIR KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
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
					$sql= "SELECT PDD01 AS P1,PDD02 AS P2,PDD03 AS P3,PDD04 AS P4,PDD05 AS P5,PDD06 AS P6, PDD07 AS P7,PDD08 AS P8,PDD09 AS P9,PDD10 AS P10 FROM T5_STT_PENDIDIKAN WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'Belum Sekolah'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'Belum Tamat Sd'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'Tamat Sd'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'Tamat Smp'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'Tamat Sma'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'D-I/D-II'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'D-III'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  label: 'D-IV/S-I'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  label: 'S-II'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), label: 'S-III'},";
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
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT PENDIDIKAN TERAKHIR KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "##,. RIBU",
			//legendText: "{indexLabel}",
						dataPoints: [
					<?php
					$sql= "SELECT PDD01 AS P1,PDD02 AS P2,PDD03 AS P3,PDD04 AS P4,PDD05 AS P5,PDD06 AS P6, PDD07 AS P7,PDD08 AS P8,PDD09 AS P9,PDD10 AS P10 FROM T5_STT_PENDIDIKAN WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'Belum Sekolah'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'Belum Tamat Sd'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'Tamat Sd'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'Tamat Smp'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."), exploded: true, indexLabel: 'Tamat Sma'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'D-I/D-II'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: 'D-III'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  indexLabel: 'D-IV/S-I'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  indexLabel: 'S-II'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."),  indexLabel: 'S-III'},";
					?>								
					]}
			]
					
			});
			piekkkel3.render();
			piekkkel3 = {};
  
  </script>
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
					//text: 'DIAGRAM KOLOM PENDUDUK MENURUT PEKERJAAN KOTA BANDUNG',
					fontSize: 30,
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
				axisX:{
          interval: 1,
		  labelFontSize: 15
					},
					 axisY:{
        labelFontSize: 15
      },

				data: [
				{
					type: 'bar',
			    //indexLabelMaxWidth: 50,
				//indexLabelWrap: true, // change to false 
				
					dataPoints: [
					<?php
					$sql= "SELECT 
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '1' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P1,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '2' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P2,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '3' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P3,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '4' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P4,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '5' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P5,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '6' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P6,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '7' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P7,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '8' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P8,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '9' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P9,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '10' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P10,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '11' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P11,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '12' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P12,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '13' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P13,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '14' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P14,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '15' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P15,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '16' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P16,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '17' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P17,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '18' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P18,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '19' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P19,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '20' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P20,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '21' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P21,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '22' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P22,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '23' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P23,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '24' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P24,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '25' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P25,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '26' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P26,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '27' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P27,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '28' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P28,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '29' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P29,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '30' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P30,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '31' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P31,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '32' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P32,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '33' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P33,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '34' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P34,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '35' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P35,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '36' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P36,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '37' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P37,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '38' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P38,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '39' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P39,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '40' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P40,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '41' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P41,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '42' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P42,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '43' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P43,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '44' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P44,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '45' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P45,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '46' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P46,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '47' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P47,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '48' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P48,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '49' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P49,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '50' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P50,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '51' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P51,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '52' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P52,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '53' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P53,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '54' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P54,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '55' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P55,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '56' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P56,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '57' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P57,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '58' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P58,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '59' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P59,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '60' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P60,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '61' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P61,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '62' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P62,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '63' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P63,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '64' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P64,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '65' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P65,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '66' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P66,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '67' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P67,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '68' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P68,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '69' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P69,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '70' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P70,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '71' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P71,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '72' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P72,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '73' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P73,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '74' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P74,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '75' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P75,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '76' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P76,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '77' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P77,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '78' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P78,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '79' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P79,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '80' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P80,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '81' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P81,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '82' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P82,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '83' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P83,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '84' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P84,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '85' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P85,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '86' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P86,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '87' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P87,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '88' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P88,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '89' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P89
FROM T5_STT_STRUKTUR_UMUR a WHERE ROWNUM ='1'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P89']))."), label: 'Pekerjaan Lainnya'},";
					echo "{y: parseInt(".(json_encode($row['P88']))."), label: 'Wiraswasta'},";
					echo "{y: parseInt(".(json_encode($row['P87']))."), label: 'Biarawan/Biarawati'},";
					echo "{y: parseInt(".(json_encode($row['P86']))."), label: 'Kepala Desa'},";
					echo "{y: parseInt(".(json_encode($row['P85']))."), label: 'Perangkat Desa'},";
					echo "{y: parseInt(".(json_encode($row['P84']))."), label: 'Pedagang'},";
					echo "{y: parseInt(".(json_encode($row['P83']))."), label: 'Paranormal'},";
					echo "{y: parseInt(".(json_encode($row['P82']))."), label: 'Pialang'},";
					echo "{y: parseInt(".(json_encode($row['P81']))."), label: 'Sopir'},";
					echo "{y: parseInt(".(json_encode($row['P80']))."), label: 'Peneliti'},";
					echo "{y: parseInt(".(json_encode($row['P79']))."), label: 'Pelaut'},";
					echo "{y: parseInt(".(json_encode($row['P78']))."), label: 'Penyiar Radio'},";
					echo "{y: parseInt(".(json_encode($row['P77']))."), label: 'Penyiar Televisi'},";
					echo "{y: parseInt(".(json_encode($row['P76']))."), label: 'Psikiater/Psikologi'},";
					echo "{y: parseInt(".(json_encode($row['P75']))."), label: 'Apoteker'},";
					echo "{y: parseInt(".(json_encode($row['P74']))."), label: 'Perawat'},";
					echo "{y: parseInt(".(json_encode($row['P73']))."), label: 'Bidan'},";
					echo "{y: parseInt(".(json_encode($row['P72']))."), label: 'Dokter'},";
					echo "{y: parseInt(".(json_encode($row['P71']))."), label: 'Konsultan'},";
					echo "{y: parseInt(".(json_encode($row['P70']))."), label: 'Akuntan'},";
					echo "{y: parseInt(".(json_encode($row['P69']))."), label: 'Arsitek'},";
					echo "{y: parseInt(".(json_encode($row['P68']))."), label: 'Notaris'},";
					echo "{y: parseInt(".(json_encode($row['P67']))."), label: 'Pengacara'},";
					echo "{y: parseInt(".(json_encode($row['P66']))."), label: 'Pilot'},";
					echo "{y: parseInt(".(json_encode($row['P65']))."), label: 'Guru'},";
					echo "{y: parseInt(".(json_encode($row['P64']))."), label: 'Dosen'},";
					echo "{y: parseInt(".(json_encode($row['P63']))."), label: 'Anggota DPRD Kota'},";
					echo "{y: parseInt(".(json_encode($row['P62']))."), label: 'Anggota DPRD Provinsi'},";
					echo "{y: parseInt(".(json_encode($row['P61']))."), label: 'Wakil Walikota'},";
					echo "{y: parseInt(".(json_encode($row['P60']))."), label: 'Walikota'},";
					echo "{y: parseInt(".(json_encode($row['P59']))."), label: 'Wakil Bupati'},";
					echo "{y: parseInt(".(json_encode($row['P58']))."), label: 'Bupati'},";
					echo "{y: parseInt(".(json_encode($row['P57']))."), label: 'Wakil Gubernur'},";
					echo "{y: parseInt(".(json_encode($row['P56']))."), label: 'Gubernur'},";
					echo "{y: parseInt(".(json_encode($row['P55']))."), label: 'Duta Besar'},";
					echo "{y: parseInt(".(json_encode($row['P54']))."), label: 'Anggota Kabinet Kementrian'},";
					echo "{y: parseInt(".(json_encode($row['P53']))."), label: 'Anggota Mahkamah Konstitusi'},";
					echo "{y: parseInt(".(json_encode($row['P52']))."), label: 'Wakil Presiden'},";
					echo "{y: parseInt(".(json_encode($row['P51']))."), label: 'Presiden'},";
					echo "{y: parseInt(".(json_encode($row['P50']))."), label: 'Anggota BPK'},";
					echo "{y: parseInt(".(json_encode($row['P49']))."), label: 'Anggota DPD RI'},";
					echo "{y: parseInt(".(json_encode($row['P48']))."), label: 'Anggota DPR RI'},";
					echo "{y: parseInt(".(json_encode($row['P47']))."), label: 'Promotor Acara'},";
					echo "{y: parseInt(".(json_encode($row['P46']))."), label: 'Juru Masak'},";
					echo "{y: parseInt(".(json_encode($row['P45']))."), label: 'Uztadz/Mubaligh'},";
					echo "{y: parseInt(".(json_encode($row['P44']))."), label: 'Wartawan'},";
					echo "{y: parseInt(".(json_encode($row['P43']))."), label: 'Pastor'},";
					echo "{y: parseInt(".(json_encode($row['P42']))."), label: 'Pendeta'},";
					echo "{y: parseInt(".(json_encode($row['P41']))."), label: 'Imam Masjid'},";
					echo "{y: parseInt(".(json_encode($row['P40']))."), label: 'Penterjemah'},";
					echo "{y: parseInt(".(json_encode($row['P39']))."), label: 'Perancang Busana'},";
					echo "{y: parseInt(".(json_encode($row['P38']))."), label: 'Paraji'},";
					echo "{y: parseInt(".(json_encode($row['P37']))."), label: 'Tabib'},";
					echo "{y: parseInt(".(json_encode($row['P36']))."), label: 'Seniman'},";
					echo "{y: parseInt(".(json_encode($row['P35']))."), label: 'Mekanik'},";
					echo "{y: parseInt(".(json_encode($row['P34']))."), label: 'Penata Rambut'},";
					echo "{y: parseInt(".(json_encode($row['P33']))."), label: 'Penata Busana'},";
					echo "{y: parseInt(".(json_encode($row['P32']))."), label: 'Penata Rias'},";
					echo "{y: parseInt(".(json_encode($row['P31']))."), label: 'Tukang Gigi'},";
					echo "{y: parseInt(".(json_encode($row['P30']))."), label: 'Tukang Jahit'},";
					echo "{y: parseInt(".(json_encode($row['P29']))."), label: 'Tukang Las/Pandai Besi'},";
					echo "{y: parseInt(".(json_encode($row['P28']))."), label: 'Tukang Sol Sepatu'},";
					echo "{y: parseInt(".(json_encode($row['P27']))."), label: 'Tukang Kayu'},";
					echo "{y: parseInt(".(json_encode($row['P26']))."), label: 'Tukang Batu'},";
					echo "{y: parseInt(".(json_encode($row['P25']))."), label: 'Tukang Listrik'},";
					echo "{y: parseInt(".(json_encode($row['P24']))."), label: 'Tukang Cukur'},";
					echo "{y: parseInt(".(json_encode($row['P23']))."), label: 'Pembantu Rumah Tangga'},";
					echo "{y: parseInt(".(json_encode($row['P22']))."), label: 'Buruh Peternakan'},";
					echo "{y: parseInt(".(json_encode($row['P21']))."), label: 'Buruh Nelayan'},";
					echo "{y: parseInt(".(json_encode($row['P20']))."), label: 'Buruh Tani'},";
					echo "{y: parseInt(".(json_encode($row['P19']))."), label: 'Buruh Harian Lepas'},";
					echo "{y: parseInt(".(json_encode($row['P18']))."), label: 'Karyawan Honorer'},";
					echo "{y: parseInt(".(json_encode($row['P17']))."), label: 'Karyawan BUMD'},";
					echo "{y: parseInt(".(json_encode($row['P16']))."), label: 'Karyawan BUMN'},";
					echo "{y: parseInt(".(json_encode($row['P15']))."), label: 'Karyawan Swasta'},";
					echo "{y: parseInt(".(json_encode($row['P14']))."), label: 'Transportasi'},";
					echo "{y: parseInt(".(json_encode($row['P13']))."), label: 'Konstruksi'},";	
					echo "{y: parseInt(".(json_encode($row['P12']))."), label: 'Industri'},";
					echo "{y: parseInt(".(json_encode($row['P11']))."), label: 'Nelayan'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), label: 'Peternak'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  label: 'Petani'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  label: 'Perdagangan'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'POLRI'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'TNI'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'PNS'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'Pensiunan'},";					
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'Pelajar/Mahasiswa'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'Mengurus Rumah Tangga'},";
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'Belum Bekerja'},";
					
					
					
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
					//text: 'DIAGRAM PIE PENDUDUK MENURUT PEKERJAAN KOTA BANDUNG'
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
					$sql= "SELECT 
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '1' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P1,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '2' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P2,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '3' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P3,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '4' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P4,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '5' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P5,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '6' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P6,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '7' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P7,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '8' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P8,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '9' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P9,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '10' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P10,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '11' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P11,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '12' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P12,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '13' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P13,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '14' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P14,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '15' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P15,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '16' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P16,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '17' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P17,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '18' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P18,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '19' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P19,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '20' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P20,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '21' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P21,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '22' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P22,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '23' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P23,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '24' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P24,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '25' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P25,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '26' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P26,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '27' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P27,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '28' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P28,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '29' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P29,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '30' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P30,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '31' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P31,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '32' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P32,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '33' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P33,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '34' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P34,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '35' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P35,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '36' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P36,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '37' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P37,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '38' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P38,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '39' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P39,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '40' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P40,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '41' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P41,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '42' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P42,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '43' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P43,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '44' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P44,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '45' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P45,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '46' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P46,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '47' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P47,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '48' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P48,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '49' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P49,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '50' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P50,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '51' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P51,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '52' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P52,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '53' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P53,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '54' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P54,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '55' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P55,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '56' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P56,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '57' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P57,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '58' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P58,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '59' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P59,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '60' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P60,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '61' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P61,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '62' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P62,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '63' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P63,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '64' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P64,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '65' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P65,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '66' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P66,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '67' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P67,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '68' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P68,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '69' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P69,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '70' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P70,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '71' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P71,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '72' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P72,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '73' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P73,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '74' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P74,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '75' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P75,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '76' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P76,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '77' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P77,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '78' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P78,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '79' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P79,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '80' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P80,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '81' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P81,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '82' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P82,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '83' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P83,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '84' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P84,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '85' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P85,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '86' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P86,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '87' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P87,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '88' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P88,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '89' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' ) as P89
FROM T5_STT_STRUKTUR_UMUR a WHERE ROWNUM ='1'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//bener
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded: true,   indexLabel: 'Belum Bekerja'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'Mengurus Rumah Tangga'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'Pelajar/Mahasiswa'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'Pensiunan'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: 'PNS'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'TNI'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: 'POLRI'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  indexLabel: 'Perdagangan'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  indexLabel: 'Petani'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), indexLabel: 'Peternak'},";
					
					echo "{y: parseInt(".(json_encode($row['P11']))."), indexLabel: 'Nelayan'},";
					echo "{y: parseInt(".(json_encode($row['P12']))."), indexLabel: 'Industri'},";
					echo "{y: parseInt(".(json_encode($row['P13']))."), indexLabel: 'Konstruksi'},";	
					echo "{y: parseInt(".(json_encode($row['P14']))."), indexLabel: 'Transportasi'},";
					echo "{y: parseInt(".(json_encode($row['P15']))."), indexLabel: 'Karyawan Swasta'},";
					echo "{y: parseInt(".(json_encode($row['P16']))."), indexLabel: 'Karyawan BUMN'},";
					echo "{y: parseInt(".(json_encode($row['P17']))."), indexLabel: 'Karyawan BUMD'},";
					echo "{y: parseInt(".(json_encode($row['P18']))."), indexLabel: 'Karyawan Honorer'},";
					echo "{y: parseInt(".(json_encode($row['P19']))."), indexLabel: 'Buruh Harian Lepas'},";
					echo "{y: parseInt(".(json_encode($row['P20']))."), indexLabel: 'Buruh Tani'},";
					echo "{y: parseInt(".(json_encode($row['P21']))."), indexLabel: 'Buruh Nelayan'},";
					echo "{y: parseInt(".(json_encode($row['P22']))."), indexLabel: 'Buruh Peternakan'},";
					echo "{y: parseInt(".(json_encode($row['P23']))."), indexLabel: 'Pembantu Rumah Tangga'},";
					echo "{y: parseInt(".(json_encode($row['P24']))."), indexLabel: 'Tukang Cukur'},";
					echo "{y: parseInt(".(json_encode($row['P25']))."), indexLabel: 'Tukang Listrik'},";
					echo "{y: parseInt(".(json_encode($row['P26']))."), indexLabel: 'Tukang Batu'},";
					echo "{y: parseInt(".(json_encode($row['P27']))."), indexLabel: 'Tukang Kayu'},";
					echo "{y: parseInt(".(json_encode($row['P28']))."), indexLabel: 'Tukang Sol Sepatu'},";
					echo "{y: parseInt(".(json_encode($row['P29']))."), indexLabel: 'Tukang Las/Pandai Besi'},";
					echo "{y: parseInt(".(json_encode($row['P30']))."), indexLabel: 'Tukang Jahit'},";
					echo "{y: parseInt(".(json_encode($row['P31']))."), indexLabel: 'Tukang Gigi'},";
					echo "{y: parseInt(".(json_encode($row['P32']))."), indexLabel: 'Penata Rias'},";
					echo "{y: parseInt(".(json_encode($row['P33']))."), indexLabel: 'Penata Busana'},";
					echo "{y: parseInt(".(json_encode($row['P34']))."), indexLabel: 'Penata Rambut'},";
					echo "{y: parseInt(".(json_encode($row['P35']))."), indexLabel: 'Mekanik'},";
					echo "{y: parseInt(".(json_encode($row['P36']))."), indexLabel: 'Seniman'},";
					echo "{y: parseInt(".(json_encode($row['P37']))."), indexLabel: 'Tabib'},";
					echo "{y: parseInt(".(json_encode($row['P38']))."), indexLabel: 'Paraji'},";
					echo "{y: parseInt(".(json_encode($row['P39']))."), indexLabel: 'Perancang Busana'},";
					echo "{y: parseInt(".(json_encode($row['P40']))."), indexLabel: 'Penterjemah'},";
					echo "{y: parseInt(".(json_encode($row['P41']))."), indexLabel: 'Imam Masjid'},";
					echo "{y: parseInt(".(json_encode($row['P42']))."), indexLabel: 'Pendeta'},";
					echo "{y: parseInt(".(json_encode($row['P43']))."), indexLabel: 'Pastor'},";
					echo "{y: parseInt(".(json_encode($row['P44']))."), indexLabel: 'Wartawan'},";
					echo "{y: parseInt(".(json_encode($row['P45']))."), indexLabel: 'Uztadz/Mubaligh'},";
					echo "{y: parseInt(".(json_encode($row['P46']))."), indexLabel: 'Juru Masak'},";
					echo "{y: parseInt(".(json_encode($row['P47']))."), indexLabel: 'Promotor Acara'},";
					echo "{y: parseInt(".(json_encode($row['P48']))."), indexLabel: 'Anggota DPR RI'},";
					echo "{y: parseInt(".(json_encode($row['P49']))."), indexLabel: 'Anggota DPD RI'},";
					echo "{y: parseInt(".(json_encode($row['P50']))."), indexLabel: 'Anggota BPK'},";
					echo "{y: parseInt(".(json_encode($row['P51']))."), indexLabel: 'Presiden'},";
					echo "{y: parseInt(".(json_encode($row['P52']))."), indexLabel: 'Wakil Presiden'},";
					echo "{y: parseInt(".(json_encode($row['P53']))."), indexLabel: 'Anggota Mahkamah Konstitusi'},";
					echo "{y: parseInt(".(json_encode($row['P54']))."), indexLabel: 'Anggota Kabinet Kementrian'},";
					echo "{y: parseInt(".(json_encode($row['P55']))."), indexLabel: 'Duta Besar'},";
					echo "{y: parseInt(".(json_encode($row['P56']))."), indexLabel: 'Gubernur'},";
					echo "{y: parseInt(".(json_encode($row['P57']))."), indexLabel: 'Wakil Gubernur'},";
					echo "{y: parseInt(".(json_encode($row['P58']))."), indexLabel: 'Bupati'},";
					echo "{y: parseInt(".(json_encode($row['P59']))."), indexLabel: 'Wakil Bupati'},";
					echo "{y: parseInt(".(json_encode($row['P60']))."), indexLabel: 'Walikota'},";
					echo "{y: parseInt(".(json_encode($row['P61']))."), indexLabel: 'Wakil Walikota'},";
					echo "{y: parseInt(".(json_encode($row['P62']))."), indexLabel: 'Anggota DPRD Provinsi'},";
					echo "{y: parseInt(".(json_encode($row['P63']))."), indexLabel: 'Anggota DPRD Kota'},";
					echo "{y: parseInt(".(json_encode($row['P64']))."), indexLabel: 'Dosen'},";
					echo "{y: parseInt(".(json_encode($row['P65']))."), indexLabel: 'Guru'},";
					echo "{y: parseInt(".(json_encode($row['P66']))."), indexLabel: 'Pilot'},";
					echo "{y: parseInt(".(json_encode($row['P67']))."), indexLabel: 'Pengacara'},";
					echo "{y: parseInt(".(json_encode($row['P68']))."), indexLabel: 'Notaris'},";
					echo "{y: parseInt(".(json_encode($row['P69']))."), indexLabel: 'Arsitek'},";
					echo "{y: parseInt(".(json_encode($row['P70']))."), indexLabel: 'Akuntan'},";
					echo "{y: parseInt(".(json_encode($row['P71']))."), indexLabel: 'Konsultan'},";
					echo "{y: parseInt(".(json_encode($row['P72']))."), indexLabel: 'Dokter'},";
					echo "{y: parseInt(".(json_encode($row['P73']))."), indexLabel: 'Bidan'},";
					echo "{y: parseInt(".(json_encode($row['P74']))."), indexLabel: 'Perawat'},";
					echo "{y: parseInt(".(json_encode($row['P75']))."), indexLabel: 'Apoteker'},";
					echo "{y: parseInt(".(json_encode($row['P76']))."), indexLabel: 'Psikiater/Psikologi'},";
					echo "{y: parseInt(".(json_encode($row['P77']))."), indexLabel: 'Penyiar Televisi'},";
					echo "{y: parseInt(".(json_encode($row['P78']))."), indexLabel: 'Penyiar Radio'},";
					echo "{y: parseInt(".(json_encode($row['P79']))."), indexLabel: 'Pelaut'},";
					echo "{y: parseInt(".(json_encode($row['P80']))."), indexLabel: 'Peneliti'},";
					echo "{y: parseInt(".(json_encode($row['P81']))."), indexLabel: 'Sopir'},";
					echo "{y: parseInt(".(json_encode($row['P82']))."), indexLabel: 'Pialang'},";
					echo "{y: parseInt(".(json_encode($row['P83']))."), indexLabel: 'Paranormal'},";
					echo "{y: parseInt(".(json_encode($row['P84']))."), indexLabel: 'Pedagang'},";
					echo "{y: parseInt(".(json_encode($row['P85']))."), indexLabel: 'Perangkat Desa'},";
					echo "{y: parseInt(".(json_encode($row['P86']))."), indexLabel: 'Kepala Desa'},";
					echo "{y: parseInt(".(json_encode($row['P87']))."), indexLabel: 'Biarawan/Biarawati'},";
					echo "{y: parseInt(".(json_encode($row['P88']))."), indexLabel: 'Wiraswasta'},";
					echo "{y: parseInt(".(json_encode($row['P89']))."), indexLabel: 'Pekerjaan Lainnya'},";
					
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
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT PEKERJAAN KECAMATAN ".$row['NAMA_KEC']."',";
					?>
					fontSize: 30,
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
				axisX:{
          interval: 1,
		  labelFontSize: 15
					},
					 axisY:{
        labelFontSize: 15
      },

				data: [
				{
					type: 'bar',
			    //indexLabelMaxWidth: 50,
				//indexLabelWrap: true, // change to false 
				
					dataPoints: [
					<?php
					$sql= "SELECT 
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '1' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P1,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '2' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P2,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '3' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P3,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '4' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P4,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '5' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P5,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '6' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P6,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '7' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P7,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '8' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P8,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '9' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P9,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '10' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P10,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '11' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P11,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '12' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P12,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '13' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P13,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '14' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P14,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '15' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P15,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '16' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P16,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '17' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P17,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '18' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P18,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '19' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P19,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '20' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P20,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '21' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P21,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '22' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P22,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '23' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P23,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '24' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P24,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '25' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P25,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '26' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P26,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '27' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P27,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '28' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P28,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '29' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P29,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '30' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P30,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '31' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P31,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '32' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P32,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '33' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P33,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '34' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P34,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '35' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P35,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '36' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P36,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '37' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P37,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '38' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P38,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '39' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P39,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '40' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P40,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '41' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P41,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '42' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P42,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '43' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P43,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '44' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P44,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '45' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P45,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '46' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P46,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '47' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P47,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '48' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P48,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '49' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P49,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '50' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P50,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '51' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P51,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '52' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P52,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '53' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P53,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '54' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P54,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '55' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P55,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '56' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P56,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '57' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P57,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '58' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P58,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '59' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P59,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '60' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P60,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '61' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P61,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '62' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P62,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '63' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P63,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '64' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P64,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '65' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P65,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '66' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P66,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '67' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P67,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '68' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P68,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '69' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P69,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '70' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P70,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '71' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P71,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '72' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P72,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '73' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P73,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '74' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P74,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '75' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P75,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '76' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P76,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '77' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P77,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '78' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P78,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '79' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P79,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '80' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P80,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '81' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P81,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '82' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P82,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '83' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P83,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '84' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P84,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '85' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P85,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '86' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P86,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '87' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P87,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '88' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P88,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '89' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P89
FROM T5_STT_STRUKTUR_UMUR a WHERE ROWNUM ='1'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P89']))."), label: 'Pekerjaan Lainnya'},";
					echo "{y: parseInt(".(json_encode($row['P88']))."), label: 'Wiraswasta'},";
					echo "{y: parseInt(".(json_encode($row['P87']))."), label: 'Biarawan/Biarawati'},";
					echo "{y: parseInt(".(json_encode($row['P86']))."), label: 'Kepala Desa'},";
					echo "{y: parseInt(".(json_encode($row['P85']))."), label: 'Perangkat Desa'},";
					echo "{y: parseInt(".(json_encode($row['P84']))."), label: 'Pedagang'},";
					echo "{y: parseInt(".(json_encode($row['P83']))."), label: 'Paranormal'},";
					echo "{y: parseInt(".(json_encode($row['P82']))."), label: 'Pialang'},";
					echo "{y: parseInt(".(json_encode($row['P81']))."), label: 'Sopir'},";
					echo "{y: parseInt(".(json_encode($row['P80']))."), label: 'Peneliti'},";
					echo "{y: parseInt(".(json_encode($row['P79']))."), label: 'Pelaut'},";
					echo "{y: parseInt(".(json_encode($row['P78']))."), label: 'Penyiar Radio'},";
					echo "{y: parseInt(".(json_encode($row['P77']))."), label: 'Penyiar Televisi'},";
					echo "{y: parseInt(".(json_encode($row['P76']))."), label: 'Psikiater/Psikologi'},";
					echo "{y: parseInt(".(json_encode($row['P75']))."), label: 'Apoteker'},";
					echo "{y: parseInt(".(json_encode($row['P74']))."), label: 'Perawat'},";
					echo "{y: parseInt(".(json_encode($row['P73']))."), label: 'Bidan'},";
					echo "{y: parseInt(".(json_encode($row['P72']))."), label: 'Dokter'},";
					echo "{y: parseInt(".(json_encode($row['P71']))."), label: 'Konsultan'},";
					echo "{y: parseInt(".(json_encode($row['P70']))."), label: 'Akuntan'},";
					echo "{y: parseInt(".(json_encode($row['P69']))."), label: 'Arsitek'},";
					echo "{y: parseInt(".(json_encode($row['P68']))."), label: 'Notaris'},";
					echo "{y: parseInt(".(json_encode($row['P67']))."), label: 'Pengacara'},";
					echo "{y: parseInt(".(json_encode($row['P66']))."), label: 'Pilot'},";
					echo "{y: parseInt(".(json_encode($row['P65']))."), label: 'Guru'},";
					echo "{y: parseInt(".(json_encode($row['P64']))."), label: 'Dosen'},";
					echo "{y: parseInt(".(json_encode($row['P63']))."), label: 'Anggota DPRD Kota'},";
					echo "{y: parseInt(".(json_encode($row['P62']))."), label: 'Anggota DPRD Provinsi'},";
					echo "{y: parseInt(".(json_encode($row['P61']))."), label: 'Wakil Walikota'},";
					echo "{y: parseInt(".(json_encode($row['P60']))."), label: 'Walikota'},";
					echo "{y: parseInt(".(json_encode($row['P59']))."), label: 'Wakil Bupati'},";
					echo "{y: parseInt(".(json_encode($row['P58']))."), label: 'Bupati'},";
					echo "{y: parseInt(".(json_encode($row['P57']))."), label: 'Wakil Gubernur'},";
					echo "{y: parseInt(".(json_encode($row['P56']))."), label: 'Gubernur'},";
					echo "{y: parseInt(".(json_encode($row['P55']))."), label: 'Duta Besar'},";
					echo "{y: parseInt(".(json_encode($row['P54']))."), label: 'Anggota Kabinet Kementrian'},";
					echo "{y: parseInt(".(json_encode($row['P53']))."), label: 'Anggota Mahkamah Konstitusi'},";
					echo "{y: parseInt(".(json_encode($row['P52']))."), label: 'Wakil Presiden'},";
					echo "{y: parseInt(".(json_encode($row['P51']))."), label: 'Presiden'},";
					echo "{y: parseInt(".(json_encode($row['P50']))."), label: 'Anggota BPK'},";
					echo "{y: parseInt(".(json_encode($row['P49']))."), label: 'Anggota DPD RI'},";
					echo "{y: parseInt(".(json_encode($row['P48']))."), label: 'Anggota DPR RI'},";
					echo "{y: parseInt(".(json_encode($row['P47']))."), label: 'Promotor Acara'},";
					echo "{y: parseInt(".(json_encode($row['P46']))."), label: 'Juru Masak'},";
					echo "{y: parseInt(".(json_encode($row['P45']))."), label: 'Uztadz/Mubaligh'},";
					echo "{y: parseInt(".(json_encode($row['P44']))."), label: 'Wartawan'},";
					echo "{y: parseInt(".(json_encode($row['P43']))."), label: 'Pastor'},";
					echo "{y: parseInt(".(json_encode($row['P42']))."), label: 'Pendeta'},";
					echo "{y: parseInt(".(json_encode($row['P41']))."), label: 'Imam Masjid'},";
					echo "{y: parseInt(".(json_encode($row['P40']))."), label: 'Penterjemah'},";
					echo "{y: parseInt(".(json_encode($row['P39']))."), label: 'Perancang Busana'},";
					echo "{y: parseInt(".(json_encode($row['P38']))."), label: 'Paraji'},";
					echo "{y: parseInt(".(json_encode($row['P37']))."), label: 'Tabib'},";
					echo "{y: parseInt(".(json_encode($row['P36']))."), label: 'Seniman'},";
					echo "{y: parseInt(".(json_encode($row['P35']))."), label: 'Mekanik'},";
					echo "{y: parseInt(".(json_encode($row['P34']))."), label: 'Penata Rambut'},";
					echo "{y: parseInt(".(json_encode($row['P33']))."), label: 'Penata Busana'},";
					echo "{y: parseInt(".(json_encode($row['P32']))."), label: 'Penata Rias'},";
					echo "{y: parseInt(".(json_encode($row['P31']))."), label: 'Tukang Gigi'},";
					echo "{y: parseInt(".(json_encode($row['P30']))."), label: 'Tukang Jahit'},";
					echo "{y: parseInt(".(json_encode($row['P29']))."), label: 'Tukang Las/Pandai Besi'},";
					echo "{y: parseInt(".(json_encode($row['P28']))."), label: 'Tukang Sol Sepatu'},";
					echo "{y: parseInt(".(json_encode($row['P27']))."), label: 'Tukang Kayu'},";
					echo "{y: parseInt(".(json_encode($row['P26']))."), label: 'Tukang Batu'},";
					echo "{y: parseInt(".(json_encode($row['P25']))."), label: 'Tukang Listrik'},";
					echo "{y: parseInt(".(json_encode($row['P24']))."), label: 'Tukang Cukur'},";
					echo "{y: parseInt(".(json_encode($row['P23']))."), label: 'Pembantu Rumah Tangga'},";
					echo "{y: parseInt(".(json_encode($row['P22']))."), label: 'Buruh Peternakan'},";
					echo "{y: parseInt(".(json_encode($row['P21']))."), label: 'Buruh Nelayan'},";
					echo "{y: parseInt(".(json_encode($row['P20']))."), label: 'Buruh Tani'},";
					echo "{y: parseInt(".(json_encode($row['P19']))."), label: 'Buruh Harian Lepas'},";
					echo "{y: parseInt(".(json_encode($row['P18']))."), label: 'Karyawan Honorer'},";
					echo "{y: parseInt(".(json_encode($row['P17']))."), label: 'Karyawan BUMD'},";
					echo "{y: parseInt(".(json_encode($row['P16']))."), label: 'Karyawan BUMN'},";
					echo "{y: parseInt(".(json_encode($row['P15']))."), label: 'Karyawan Swasta'},";
					echo "{y: parseInt(".(json_encode($row['P14']))."), label: 'Transportasi'},";
					echo "{y: parseInt(".(json_encode($row['P13']))."), label: 'Konstruksi'},";	
					echo "{y: parseInt(".(json_encode($row['P12']))."), label: 'Industri'},";
					echo "{y: parseInt(".(json_encode($row['P11']))."), label: 'Nelayan'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), label: 'Peternak'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  label: 'Petani'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  label: 'Perdagangan'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'POLRI'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'TNI'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'PNS'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'Pensiunan'},";					
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'Pelajar/Mahasiswa'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'Mengurus Rumah Tangga'},";
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'Belum Bekerja'},";
					
					
					
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
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT PEKERJAAN KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT 
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '1' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P1,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '2' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P2,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '3' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P3,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '4' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P4,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '5' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P5,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '6' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P6,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '7' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P7,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '8' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P8,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '9' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P9,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '10' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P10,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '11' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P11,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '12' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P12,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '13' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P13,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '14' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P14,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '15' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P15,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '16' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P16,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '17' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P17,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '18' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P18,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '19' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P19,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '20' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P20,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '21' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P21,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '22' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P22,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '23' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P23,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '24' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P24,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '25' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P25,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '26' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P26,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '27' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P27,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '28' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P28,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '29' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P29,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '30' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P30,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '31' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P31,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '32' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P32,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '33' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P33,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '34' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P34,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '35' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P35,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '36' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P36,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '37' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P37,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '38' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P38,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '39' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P39,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '40' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P40,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '41' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P41,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '42' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P42,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '43' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P43,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '44' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P44,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '45' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P45,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '46' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P46,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '47' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P47,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '48' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P48,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '49' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P49,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '50' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P50,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '51' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P51,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '52' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P52,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '53' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P53,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '54' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P54,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '55' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P55,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '56' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P56,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '57' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P57,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '58' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P58,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '59' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P59,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '60' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P60,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '61' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P61,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '62' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P62,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '63' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P63,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '64' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P64,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '65' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P65,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '66' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P66,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '67' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P67,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '68' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P68,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '69' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P69,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '70' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P70,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '71' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P71,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '72' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P72,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '73' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P73,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '74' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P74,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '75' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P75,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '76' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P76,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '77' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P77,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '78' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P78,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '79' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P79,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '80' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P80,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '81' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P81,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '82' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P82,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '83' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P83,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '84' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P84,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '85' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P85,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '86' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P86,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '87' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P87,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '88' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P88,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '89' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."') as P89
FROM T5_STT_STRUKTUR_UMUR a WHERE ROWNUM ='1'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//bener
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded: true,   indexLabel: 'Belum Bekerja'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'Mengurus Rumah Tangga'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'Pelajar/Mahasiswa'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'Pensiunan'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: 'PNS'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'TNI'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: 'POLRI'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  indexLabel: 'Perdagangan'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  indexLabel: 'Petani'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), indexLabel: 'Peternak'},";
					
					echo "{y: parseInt(".(json_encode($row['P11']))."), indexLabel: 'Nelayan'},";
					echo "{y: parseInt(".(json_encode($row['P12']))."), indexLabel: 'Industri'},";
					echo "{y: parseInt(".(json_encode($row['P13']))."), indexLabel: 'Konstruksi'},";	
					echo "{y: parseInt(".(json_encode($row['P14']))."), indexLabel: 'Transportasi'},";
					echo "{y: parseInt(".(json_encode($row['P15']))."), indexLabel: 'Karyawan Swasta'},";
					echo "{y: parseInt(".(json_encode($row['P16']))."), indexLabel: 'Karyawan BUMN'},";
					echo "{y: parseInt(".(json_encode($row['P17']))."), indexLabel: 'Karyawan BUMD'},";
					echo "{y: parseInt(".(json_encode($row['P18']))."), indexLabel: 'Karyawan Honorer'},";
					echo "{y: parseInt(".(json_encode($row['P19']))."), indexLabel: 'Buruh Harian Lepas'},";
					echo "{y: parseInt(".(json_encode($row['P20']))."), indexLabel: 'Buruh Tani'},";
					echo "{y: parseInt(".(json_encode($row['P21']))."), indexLabel: 'Buruh Nelayan'},";
					echo "{y: parseInt(".(json_encode($row['P22']))."), indexLabel: 'Buruh Peternakan'},";
					echo "{y: parseInt(".(json_encode($row['P23']))."), indexLabel: 'Pembantu Rumah Tangga'},";
					echo "{y: parseInt(".(json_encode($row['P24']))."), indexLabel: 'Tukang Cukur'},";
					echo "{y: parseInt(".(json_encode($row['P25']))."), indexLabel: 'Tukang Listrik'},";
					echo "{y: parseInt(".(json_encode($row['P26']))."), indexLabel: 'Tukang Batu'},";
					echo "{y: parseInt(".(json_encode($row['P27']))."), indexLabel: 'Tukang Kayu'},";
					echo "{y: parseInt(".(json_encode($row['P28']))."), indexLabel: 'Tukang Sol Sepatu'},";
					echo "{y: parseInt(".(json_encode($row['P29']))."), indexLabel: 'Tukang Las/Pandai Besi'},";
					echo "{y: parseInt(".(json_encode($row['P30']))."), indexLabel: 'Tukang Jahit'},";
					echo "{y: parseInt(".(json_encode($row['P31']))."), indexLabel: 'Tukang Gigi'},";
					echo "{y: parseInt(".(json_encode($row['P32']))."), indexLabel: 'Penata Rias'},";
					echo "{y: parseInt(".(json_encode($row['P33']))."), indexLabel: 'Penata Busana'},";
					echo "{y: parseInt(".(json_encode($row['P34']))."), indexLabel: 'Penata Rambut'},";
					echo "{y: parseInt(".(json_encode($row['P35']))."), indexLabel: 'Mekanik'},";
					echo "{y: parseInt(".(json_encode($row['P36']))."), indexLabel: 'Seniman'},";
					echo "{y: parseInt(".(json_encode($row['P37']))."), indexLabel: 'Tabib'},";
					echo "{y: parseInt(".(json_encode($row['P38']))."), indexLabel: 'Paraji'},";
					echo "{y: parseInt(".(json_encode($row['P39']))."), indexLabel: 'Perancang Busana'},";
					echo "{y: parseInt(".(json_encode($row['P40']))."), indexLabel: 'Penterjemah'},";
					echo "{y: parseInt(".(json_encode($row['P41']))."), indexLabel: 'Imam Masjid'},";
					echo "{y: parseInt(".(json_encode($row['P42']))."), indexLabel: 'Pendeta'},";
					echo "{y: parseInt(".(json_encode($row['P43']))."), indexLabel: 'Pastor'},";
					echo "{y: parseInt(".(json_encode($row['P44']))."), indexLabel: 'Wartawan'},";
					echo "{y: parseInt(".(json_encode($row['P45']))."), indexLabel: 'Uztadz/Mubaligh'},";
					echo "{y: parseInt(".(json_encode($row['P46']))."), indexLabel: 'Juru Masak'},";
					echo "{y: parseInt(".(json_encode($row['P47']))."), indexLabel: 'Promotor Acara'},";
					echo "{y: parseInt(".(json_encode($row['P48']))."), indexLabel: 'Anggota DPR RI'},";
					echo "{y: parseInt(".(json_encode($row['P49']))."), indexLabel: 'Anggota DPD RI'},";
					echo "{y: parseInt(".(json_encode($row['P50']))."), indexLabel: 'Anggota BPK'},";
					echo "{y: parseInt(".(json_encode($row['P51']))."), indexLabel: 'Presiden'},";
					echo "{y: parseInt(".(json_encode($row['P52']))."), indexLabel: 'Wakil Presiden'},";
					echo "{y: parseInt(".(json_encode($row['P53']))."), indexLabel: 'Anggota Mahkamah Konstitusi'},";
					echo "{y: parseInt(".(json_encode($row['P54']))."), indexLabel: 'Anggota Kabinet Kementrian'},";
					echo "{y: parseInt(".(json_encode($row['P55']))."), indexLabel: 'Duta Besar'},";
					echo "{y: parseInt(".(json_encode($row['P56']))."), indexLabel: 'Gubernur'},";
					echo "{y: parseInt(".(json_encode($row['P57']))."), indexLabel: 'Wakil Gubernur'},";
					echo "{y: parseInt(".(json_encode($row['P58']))."), indexLabel: 'Bupati'},";
					echo "{y: parseInt(".(json_encode($row['P59']))."), indexLabel: 'Wakil Bupati'},";
					echo "{y: parseInt(".(json_encode($row['P60']))."), indexLabel: 'Walikota'},";
					echo "{y: parseInt(".(json_encode($row['P61']))."), indexLabel: 'Wakil Walikota'},";
					echo "{y: parseInt(".(json_encode($row['P62']))."), indexLabel: 'Anggota DPRD Provinsi'},";
					echo "{y: parseInt(".(json_encode($row['P63']))."), indexLabel: 'Anggota DPRD Kota'},";
					echo "{y: parseInt(".(json_encode($row['P64']))."), indexLabel: 'Dosen'},";
					echo "{y: parseInt(".(json_encode($row['P65']))."), indexLabel: 'Guru'},";
					echo "{y: parseInt(".(json_encode($row['P66']))."), indexLabel: 'Pilot'},";
					echo "{y: parseInt(".(json_encode($row['P67']))."), indexLabel: 'Pengacara'},";
					echo "{y: parseInt(".(json_encode($row['P68']))."), indexLabel: 'Notaris'},";
					echo "{y: parseInt(".(json_encode($row['P69']))."), indexLabel: 'Arsitek'},";
					echo "{y: parseInt(".(json_encode($row['P70']))."), indexLabel: 'Akuntan'},";
					echo "{y: parseInt(".(json_encode($row['P71']))."), indexLabel: 'Konsultan'},";
					echo "{y: parseInt(".(json_encode($row['P72']))."), indexLabel: 'Dokter'},";
					echo "{y: parseInt(".(json_encode($row['P73']))."), indexLabel: 'Bidan'},";
					echo "{y: parseInt(".(json_encode($row['P74']))."), indexLabel: 'Perawat'},";
					echo "{y: parseInt(".(json_encode($row['P75']))."), indexLabel: 'Apoteker'},";
					echo "{y: parseInt(".(json_encode($row['P76']))."), indexLabel: 'Psikiater/Psikologi'},";
					echo "{y: parseInt(".(json_encode($row['P77']))."), indexLabel: 'Penyiar Televisi'},";
					echo "{y: parseInt(".(json_encode($row['P78']))."), indexLabel: 'Penyiar Radio'},";
					echo "{y: parseInt(".(json_encode($row['P79']))."), indexLabel: 'Pelaut'},";
					echo "{y: parseInt(".(json_encode($row['P80']))."), indexLabel: 'Peneliti'},";
					echo "{y: parseInt(".(json_encode($row['P81']))."), indexLabel: 'Sopir'},";
					echo "{y: parseInt(".(json_encode($row['P82']))."), indexLabel: 'Pialang'},";
					echo "{y: parseInt(".(json_encode($row['P83']))."), indexLabel: 'Paranormal'},";
					echo "{y: parseInt(".(json_encode($row['P84']))."), indexLabel: 'Pedagang'},";
					echo "{y: parseInt(".(json_encode($row['P85']))."), indexLabel: 'Perangkat Desa'},";
					echo "{y: parseInt(".(json_encode($row['P86']))."), indexLabel: 'Kepala Desa'},";
					echo "{y: parseInt(".(json_encode($row['P87']))."), indexLabel: 'Biarawan/Biarawati'},";
					echo "{y: parseInt(".(json_encode($row['P88']))."), indexLabel: 'Wiraswasta'},";
					echo "{y: parseInt(".(json_encode($row['P89']))."), indexLabel: 'Pekerjaan Lainnya'},";
					
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
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT PEKERJAAN KELURAHAN ".$row['NAMA_KEL']."',";
					?>
					fontSize: 30,
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
				axisX:{
          interval: 1,
		  labelFontSize: 15
					},
					 axisY:{
        labelFontSize: 15
      },

				data: [
				{
					type: 'bar',
			    //indexLabelMaxWidth: 50,
				//indexLabelWrap: true, // change to false 
				
					dataPoints: [
					<?php
					$sql= "SELECT 
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '1' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P1,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '2' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P2,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '3' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P3,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '4' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P4,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '5' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P5,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '6' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P6,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '7' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P7,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '8' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P8,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '9' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P9,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '10' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P10,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '11' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P11,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '12' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P12,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '13' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P13,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '14' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P14,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '15' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P15,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '16' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P16,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '17' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P17,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '18' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P18,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '19' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P19,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '20' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P20,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '21' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P21,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '22' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P22,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '23' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P23,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '24' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P24,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '25' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P25,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '26' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P26,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '27' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P27,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '28' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P28,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '29' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P29,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '30' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P30,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '31' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P31,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '32' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P32,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '33' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P33,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '34' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P34,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '35' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P35,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '36' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P36,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '37' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P37,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '38' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P38,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '39' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P39,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '40' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P40,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '41' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P41,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '42' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P42,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '43' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P43,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '44' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P44,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '45' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P45,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '46' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P46,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '47' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P47,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '48' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P48,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '49' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P49,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '50' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P50,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '51' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P51,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '52' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P52,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '53' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P53,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '54' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P54,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '55' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P55,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '56' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P56,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '57' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P57,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '58' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P58,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '59' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P59,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '60' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P60,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '61' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P61,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '62' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P62,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '63' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P63,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '64' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P64,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '65' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P65,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '66' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P66,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '67' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P67,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '68' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P68,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '69' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P69,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '70' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P70,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '71' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P71,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '72' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P72,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '73' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P73,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '74' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P74,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '75' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P75,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '76' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P76,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '77' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P77,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '78' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P78,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '79' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P79,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '80' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P80,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '81' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P81,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '82' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P82,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '83' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P83,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '84' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P84,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '85' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P85,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '86' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P86,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '87' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P87,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '88' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P88,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '89' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P89
FROM T5_STT_STRUKTUR_UMUR a WHERE ROWNUM ='1'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P89']))."), label: 'Pekerjaan Lainnya'},";
					echo "{y: parseInt(".(json_encode($row['P88']))."), label: 'Wiraswasta'},";
					echo "{y: parseInt(".(json_encode($row['P87']))."), label: 'Biarawan/Biarawati'},";
					echo "{y: parseInt(".(json_encode($row['P86']))."), label: 'Kepala Desa'},";
					echo "{y: parseInt(".(json_encode($row['P85']))."), label: 'Perangkat Desa'},";
					echo "{y: parseInt(".(json_encode($row['P84']))."), label: 'Pedagang'},";
					echo "{y: parseInt(".(json_encode($row['P83']))."), label: 'Paranormal'},";
					echo "{y: parseInt(".(json_encode($row['P82']))."), label: 'Pialang'},";
					echo "{y: parseInt(".(json_encode($row['P81']))."), label: 'Sopir'},";
					echo "{y: parseInt(".(json_encode($row['P80']))."), label: 'Peneliti'},";
					echo "{y: parseInt(".(json_encode($row['P79']))."), label: 'Pelaut'},";
					echo "{y: parseInt(".(json_encode($row['P78']))."), label: 'Penyiar Radio'},";
					echo "{y: parseInt(".(json_encode($row['P77']))."), label: 'Penyiar Televisi'},";
					echo "{y: parseInt(".(json_encode($row['P76']))."), label: 'Psikiater/Psikologi'},";
					echo "{y: parseInt(".(json_encode($row['P75']))."), label: 'Apoteker'},";
					echo "{y: parseInt(".(json_encode($row['P74']))."), label: 'Perawat'},";
					echo "{y: parseInt(".(json_encode($row['P73']))."), label: 'Bidan'},";
					echo "{y: parseInt(".(json_encode($row['P72']))."), label: 'Dokter'},";
					echo "{y: parseInt(".(json_encode($row['P71']))."), label: 'Konsultan'},";
					echo "{y: parseInt(".(json_encode($row['P70']))."), label: 'Akuntan'},";
					echo "{y: parseInt(".(json_encode($row['P69']))."), label: 'Arsitek'},";
					echo "{y: parseInt(".(json_encode($row['P68']))."), label: 'Notaris'},";
					echo "{y: parseInt(".(json_encode($row['P67']))."), label: 'Pengacara'},";
					echo "{y: parseInt(".(json_encode($row['P66']))."), label: 'Pilot'},";
					echo "{y: parseInt(".(json_encode($row['P65']))."), label: 'Guru'},";
					echo "{y: parseInt(".(json_encode($row['P64']))."), label: 'Dosen'},";
					echo "{y: parseInt(".(json_encode($row['P63']))."), label: 'Anggota DPRD Kota'},";
					echo "{y: parseInt(".(json_encode($row['P62']))."), label: 'Anggota DPRD Provinsi'},";
					echo "{y: parseInt(".(json_encode($row['P61']))."), label: 'Wakil Walikota'},";
					echo "{y: parseInt(".(json_encode($row['P60']))."), label: 'Walikota'},";
					echo "{y: parseInt(".(json_encode($row['P59']))."), label: 'Wakil Bupati'},";
					echo "{y: parseInt(".(json_encode($row['P58']))."), label: 'Bupati'},";
					echo "{y: parseInt(".(json_encode($row['P57']))."), label: 'Wakil Gubernur'},";
					echo "{y: parseInt(".(json_encode($row['P56']))."), label: 'Gubernur'},";
					echo "{y: parseInt(".(json_encode($row['P55']))."), label: 'Duta Besar'},";
					echo "{y: parseInt(".(json_encode($row['P54']))."), label: 'Anggota Kabinet Kementrian'},";
					echo "{y: parseInt(".(json_encode($row['P53']))."), label: 'Anggota Mahkamah Konstitusi'},";
					echo "{y: parseInt(".(json_encode($row['P52']))."), label: 'Wakil Presiden'},";
					echo "{y: parseInt(".(json_encode($row['P51']))."), label: 'Presiden'},";
					echo "{y: parseInt(".(json_encode($row['P50']))."), label: 'Anggota BPK'},";
					echo "{y: parseInt(".(json_encode($row['P49']))."), label: 'Anggota DPD RI'},";
					echo "{y: parseInt(".(json_encode($row['P48']))."), label: 'Anggota DPR RI'},";
					echo "{y: parseInt(".(json_encode($row['P47']))."), label: 'Promotor Acara'},";
					echo "{y: parseInt(".(json_encode($row['P46']))."), label: 'Juru Masak'},";
					echo "{y: parseInt(".(json_encode($row['P45']))."), label: 'Uztadz/Mubaligh'},";
					echo "{y: parseInt(".(json_encode($row['P44']))."), label: 'Wartawan'},";
					echo "{y: parseInt(".(json_encode($row['P43']))."), label: 'Pastor'},";
					echo "{y: parseInt(".(json_encode($row['P42']))."), label: 'Pendeta'},";
					echo "{y: parseInt(".(json_encode($row['P41']))."), label: 'Imam Masjid'},";
					echo "{y: parseInt(".(json_encode($row['P40']))."), label: 'Penterjemah'},";
					echo "{y: parseInt(".(json_encode($row['P39']))."), label: 'Perancang Busana'},";
					echo "{y: parseInt(".(json_encode($row['P38']))."), label: 'Paraji'},";
					echo "{y: parseInt(".(json_encode($row['P37']))."), label: 'Tabib'},";
					echo "{y: parseInt(".(json_encode($row['P36']))."), label: 'Seniman'},";
					echo "{y: parseInt(".(json_encode($row['P35']))."), label: 'Mekanik'},";
					echo "{y: parseInt(".(json_encode($row['P34']))."), label: 'Penata Rambut'},";
					echo "{y: parseInt(".(json_encode($row['P33']))."), label: 'Penata Busana'},";
					echo "{y: parseInt(".(json_encode($row['P32']))."), label: 'Penata Rias'},";
					echo "{y: parseInt(".(json_encode($row['P31']))."), label: 'Tukang Gigi'},";
					echo "{y: parseInt(".(json_encode($row['P30']))."), label: 'Tukang Jahit'},";
					echo "{y: parseInt(".(json_encode($row['P29']))."), label: 'Tukang Las/Pandai Besi'},";
					echo "{y: parseInt(".(json_encode($row['P28']))."), label: 'Tukang Sol Sepatu'},";
					echo "{y: parseInt(".(json_encode($row['P27']))."), label: 'Tukang Kayu'},";
					echo "{y: parseInt(".(json_encode($row['P26']))."), label: 'Tukang Batu'},";
					echo "{y: parseInt(".(json_encode($row['P25']))."), label: 'Tukang Listrik'},";
					echo "{y: parseInt(".(json_encode($row['P24']))."), label: 'Tukang Cukur'},";
					echo "{y: parseInt(".(json_encode($row['P23']))."), label: 'Pembantu Rumah Tangga'},";
					echo "{y: parseInt(".(json_encode($row['P22']))."), label: 'Buruh Peternakan'},";
					echo "{y: parseInt(".(json_encode($row['P21']))."), label: 'Buruh Nelayan'},";
					echo "{y: parseInt(".(json_encode($row['P20']))."), label: 'Buruh Tani'},";
					echo "{y: parseInt(".(json_encode($row['P19']))."), label: 'Buruh Harian Lepas'},";
					echo "{y: parseInt(".(json_encode($row['P18']))."), label: 'Karyawan Honorer'},";
					echo "{y: parseInt(".(json_encode($row['P17']))."), label: 'Karyawan BUMD'},";
					echo "{y: parseInt(".(json_encode($row['P16']))."), label: 'Karyawan BUMN'},";
					echo "{y: parseInt(".(json_encode($row['P15']))."), label: 'Karyawan Swasta'},";
					echo "{y: parseInt(".(json_encode($row['P14']))."), label: 'Transportasi'},";
					echo "{y: parseInt(".(json_encode($row['P13']))."), label: 'Konstruksi'},";	
					echo "{y: parseInt(".(json_encode($row['P12']))."), label: 'Industri'},";
					echo "{y: parseInt(".(json_encode($row['P11']))."), label: 'Nelayan'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), label: 'Peternak'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  label: 'Petani'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  label: 'Perdagangan'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'POLRI'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'TNI'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'PNS'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'Pensiunan'},";					
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'Pelajar/Mahasiswa'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'Mengurus Rumah Tangga'},";
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'Belum Bekerja'},";
					
					
					
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
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT PEKERJAAN KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, 
				theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "##,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT 
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '1' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P1,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '2' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P2,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '3' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P3,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '4' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P4,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '5' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P5,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '6' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P6,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '7' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P7,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '8' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P8,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '9' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P9,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '10' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P10,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '11' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P11,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '12' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P12,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '13' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P13,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '14' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P14,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '15' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P15,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '16' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P16,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '17' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P17,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '18' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P18,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '19' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P19,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '20' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P20,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '21' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P21,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '22' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P22,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '23' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P23,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '24' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P24,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '25' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P25,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '26' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P26,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '27' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P27,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '28' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P28,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '29' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P29,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '30' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P30,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '31' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P31,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '32' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P32,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '33' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P33,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '34' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P34,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '35' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P35,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '36' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P36,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '37' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P37,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '38' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P38,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '39' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P39,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '40' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P40,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '41' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P41,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '42' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P42,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '43' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P43,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '44' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P44,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '45' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P45,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '46' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P46,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '47' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P47,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '48' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P48,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '49' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P49,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '50' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P50,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '51' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P51,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '52' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P52,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '53' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P53,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '54' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P54,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '55' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P55,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '56' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P56,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '57' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P57,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '58' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P58,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '59' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P59,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '60' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P60,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '61' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P61,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '62' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P62,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '63' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P63,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '64' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P64,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '65' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P65,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '66' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P66,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '67' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P67,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '68' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P68,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '69' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P69,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '70' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P70,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '71' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P71,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '72' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P72,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '73' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P73,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '74' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P74,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '75' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P75,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '76' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P76,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '77' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P77,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '78' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P78,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '79' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P79,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '80' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P80,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '81' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P81,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '82' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P82,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '83' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P83,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '84' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P84,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '85' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P85,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '86' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P86,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '87' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P87,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '88' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P88,
    (SELECT sum(value) FROM T5_STT_PEKERJAAN WHERE KODE_PEKERJAAN = '89' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC ='".$NOKEC."' and NO_KEL ='".$NOKEL."') as P89
FROM T5_STT_STRUKTUR_UMUR a WHERE ROWNUM ='1'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded: true,   indexLabel: 'Belum Bekerja'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'Mengurus Rumah Tangga'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'Pelajar/Mahasiswa'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'Pensiunan'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: 'PNS'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'TNI'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: 'POLRI'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  indexLabel: 'Perdagangan'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  indexLabel: 'Petani'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), indexLabel: 'Peternak'},";
					
					echo "{y: parseInt(".(json_encode($row['P11']))."), indexLabel: 'Nelayan'},";
					echo "{y: parseInt(".(json_encode($row['P12']))."), indexLabel: 'Industri'},";
					echo "{y: parseInt(".(json_encode($row['P13']))."), indexLabel: 'Konstruksi'},";	
					echo "{y: parseInt(".(json_encode($row['P14']))."), indexLabel: 'Transportasi'},";
					echo "{y: parseInt(".(json_encode($row['P15']))."), indexLabel: 'Karyawan Swasta'},";
					echo "{y: parseInt(".(json_encode($row['P16']))."), indexLabel: 'Karyawan BUMN'},";
					echo "{y: parseInt(".(json_encode($row['P17']))."), indexLabel: 'Karyawan BUMD'},";
					echo "{y: parseInt(".(json_encode($row['P18']))."), indexLabel: 'Karyawan Honorer'},";
					echo "{y: parseInt(".(json_encode($row['P19']))."), indexLabel: 'Buruh Harian Lepas'},";
					echo "{y: parseInt(".(json_encode($row['P20']))."), indexLabel: 'Buruh Tani'},";
					echo "{y: parseInt(".(json_encode($row['P21']))."), indexLabel: 'Buruh Nelayan'},";
					echo "{y: parseInt(".(json_encode($row['P22']))."), indexLabel: 'Buruh Peternakan'},";
					echo "{y: parseInt(".(json_encode($row['P23']))."), indexLabel: 'Pembantu Rumah Tangga'},";
					echo "{y: parseInt(".(json_encode($row['P24']))."), indexLabel: 'Tukang Cukur'},";
					echo "{y: parseInt(".(json_encode($row['P25']))."), indexLabel: 'Tukang Listrik'},";
					echo "{y: parseInt(".(json_encode($row['P26']))."), indexLabel: 'Tukang Batu'},";
					echo "{y: parseInt(".(json_encode($row['P27']))."), indexLabel: 'Tukang Kayu'},";
					echo "{y: parseInt(".(json_encode($row['P28']))."), indexLabel: 'Tukang Sol Sepatu'},";
					echo "{y: parseInt(".(json_encode($row['P29']))."), indexLabel: 'Tukang Las/Pandai Besi'},";
					echo "{y: parseInt(".(json_encode($row['P30']))."), indexLabel: 'Tukang Jahit'},";
					echo "{y: parseInt(".(json_encode($row['P31']))."), indexLabel: 'Tukang Gigi'},";
					echo "{y: parseInt(".(json_encode($row['P32']))."), indexLabel: 'Penata Rias'},";
					echo "{y: parseInt(".(json_encode($row['P33']))."), indexLabel: 'Penata Busana'},";
					echo "{y: parseInt(".(json_encode($row['P34']))."), indexLabel: 'Penata Rambut'},";
					echo "{y: parseInt(".(json_encode($row['P35']))."), indexLabel: 'Mekanik'},";
					echo "{y: parseInt(".(json_encode($row['P36']))."), indexLabel: 'Seniman'},";
					echo "{y: parseInt(".(json_encode($row['P37']))."), indexLabel: 'Tabib'},";
					echo "{y: parseInt(".(json_encode($row['P38']))."), indexLabel: 'Paraji'},";
					echo "{y: parseInt(".(json_encode($row['P39']))."), indexLabel: 'Perancang Busana'},";
					echo "{y: parseInt(".(json_encode($row['P40']))."), indexLabel: 'Penterjemah'},";
					echo "{y: parseInt(".(json_encode($row['P41']))."), indexLabel: 'Imam Masjid'},";
					echo "{y: parseInt(".(json_encode($row['P42']))."), indexLabel: 'Pendeta'},";
					echo "{y: parseInt(".(json_encode($row['P43']))."), indexLabel: 'Pastor'},";
					echo "{y: parseInt(".(json_encode($row['P44']))."), indexLabel: 'Wartawan'},";
					echo "{y: parseInt(".(json_encode($row['P45']))."), indexLabel: 'Uztadz/Mubaligh'},";
					echo "{y: parseInt(".(json_encode($row['P46']))."), indexLabel: 'Juru Masak'},";
					echo "{y: parseInt(".(json_encode($row['P47']))."), indexLabel: 'Promotor Acara'},";
					echo "{y: parseInt(".(json_encode($row['P48']))."), indexLabel: 'Anggota DPR RI'},";
					echo "{y: parseInt(".(json_encode($row['P49']))."), indexLabel: 'Anggota DPD RI'},";
					echo "{y: parseInt(".(json_encode($row['P50']))."), indexLabel: 'Anggota BPK'},";
					echo "{y: parseInt(".(json_encode($row['P51']))."), indexLabel: 'Presiden'},";
					echo "{y: parseInt(".(json_encode($row['P52']))."), indexLabel: 'Wakil Presiden'},";
					echo "{y: parseInt(".(json_encode($row['P53']))."), indexLabel: 'Anggota Mahkamah Konstitusi'},";
					echo "{y: parseInt(".(json_encode($row['P54']))."), indexLabel: 'Anggota Kabinet Kementrian'},";
					echo "{y: parseInt(".(json_encode($row['P55']))."), indexLabel: 'Duta Besar'},";
					echo "{y: parseInt(".(json_encode($row['P56']))."), indexLabel: 'Gubernur'},";
					echo "{y: parseInt(".(json_encode($row['P57']))."), indexLabel: 'Wakil Gubernur'},";
					echo "{y: parseInt(".(json_encode($row['P58']))."), indexLabel: 'Bupati'},";
					echo "{y: parseInt(".(json_encode($row['P59']))."), indexLabel: 'Wakil Bupati'},";
					echo "{y: parseInt(".(json_encode($row['P60']))."), indexLabel: 'Walikota'},";
					echo "{y: parseInt(".(json_encode($row['P61']))."), indexLabel: 'Wakil Walikota'},";
					echo "{y: parseInt(".(json_encode($row['P62']))."), indexLabel: 'Anggota DPRD Provinsi'},";
					echo "{y: parseInt(".(json_encode($row['P63']))."), indexLabel: 'Anggota DPRD Kota'},";
					echo "{y: parseInt(".(json_encode($row['P64']))."), indexLabel: 'Dosen'},";
					echo "{y: parseInt(".(json_encode($row['P65']))."), indexLabel: 'Guru'},";
					echo "{y: parseInt(".(json_encode($row['P66']))."), indexLabel: 'Pilot'},";
					echo "{y: parseInt(".(json_encode($row['P67']))."), indexLabel: 'Pengacara'},";
					echo "{y: parseInt(".(json_encode($row['P68']))."), indexLabel: 'Notaris'},";
					echo "{y: parseInt(".(json_encode($row['P69']))."), indexLabel: 'Arsitek'},";
					echo "{y: parseInt(".(json_encode($row['P70']))."), indexLabel: 'Akuntan'},";
					echo "{y: parseInt(".(json_encode($row['P71']))."), indexLabel: 'Konsultan'},";
					echo "{y: parseInt(".(json_encode($row['P72']))."), indexLabel: 'Dokter'},";
					echo "{y: parseInt(".(json_encode($row['P73']))."), indexLabel: 'Bidan'},";
					echo "{y: parseInt(".(json_encode($row['P74']))."), indexLabel: 'Perawat'},";
					echo "{y: parseInt(".(json_encode($row['P75']))."), indexLabel: 'Apoteker'},";
					echo "{y: parseInt(".(json_encode($row['P76']))."), indexLabel: 'Psikiater/Psikologi'},";
					echo "{y: parseInt(".(json_encode($row['P77']))."), indexLabel: 'Penyiar Televisi'},";
					echo "{y: parseInt(".(json_encode($row['P78']))."), indexLabel: 'Penyiar Radio'},";
					echo "{y: parseInt(".(json_encode($row['P79']))."), indexLabel: 'Pelaut'},";
					echo "{y: parseInt(".(json_encode($row['P80']))."), indexLabel: 'Peneliti'},";
					echo "{y: parseInt(".(json_encode($row['P81']))."), indexLabel: 'Sopir'},";
					echo "{y: parseInt(".(json_encode($row['P82']))."), indexLabel: 'Pialang'},";
					echo "{y: parseInt(".(json_encode($row['P83']))."), indexLabel: 'Paranormal'},";
					echo "{y: parseInt(".(json_encode($row['P84']))."), indexLabel: 'Pedagang'},";
					echo "{y: parseInt(".(json_encode($row['P85']))."), indexLabel: 'Perangkat Desa'},";
					echo "{y: parseInt(".(json_encode($row['P86']))."), indexLabel: 'Kepala Desa'},";
					echo "{y: parseInt(".(json_encode($row['P87']))."), indexLabel: 'Biarawan/Biarawati'},";
					echo "{y: parseInt(".(json_encode($row['P88']))."), indexLabel: 'Wiraswasta'},";
					echo "{y: parseInt(".(json_encode($row['P89']))."), indexLabel: 'Pekerjaan Lainnya'},";
					
					?>						
					]}
			]
					
			});
			piekkkel4.render();
			piekkkel4 = {};
  
  </script>
  <!--  AKHIR STATISTIK 4 -->
  <!--STATUS PERKAWINAN -->
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
					//text: 'DIAGRAM KOLOM PENDUDUK MENURUT STATUS PERKAWINAN KOTA BANDUNG'
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
       
				data: [
				{
					type: 'column',
			    indexLabelMaxWidth: 50,
				//indexLabelWrap: true, // change to false 
				
					dataPoints: [
					<?php
					$sql= "SELECT SUM(BELUM_KAWIN) AS P1,SUM(KAWIN) AS P2,SUM(CERAI_HIDUP) AS P3,SUM(CERAI_MATI) AS P4 FROM T5_STT_STATUS_PERKAWINAN WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'Belum Kawin'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'Kawin'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'Cerai Hidup'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'Cerai Mati'},";
					
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
					//text: 'DIAGRAM PIE PENDUDUK MENURUT STATUS PERKAWINAN KOTA BANDUNG'
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
			legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(BELUM_KAWIN) AS P1,SUM(KAWIN) AS P2,SUM(CERAI_HIDUP) AS P3,SUM(CERAI_MATI) AS P4 FROM T5_STT_STATUS_PERKAWINAN WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded:true, indexLabel: 'Belum Kawin'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'Kawin'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'Cerai Hidup'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'Cerai Mati'},";
					
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
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT STATUS PERKAWINAN KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
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
					$sql= "SELECT SUM(BELUM_KAWIN) AS P1,SUM(KAWIN) AS P2,SUM(CERAI_HIDUP) AS P3,SUM(CERAI_MATI) AS P4 FROM T5_STT_STATUS_PERKAWINAN WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC ='".$NOKEC."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'Belum Kawin'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'Kawin'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'Cerai Hidup'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'Cerai Mati'},";
					
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
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT STATUS PERKAWINAN KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(BELUM_KAWIN) AS P1,SUM(KAWIN) AS P2,SUM(CERAI_HIDUP) AS P3,SUM(CERAI_MATI) AS P4 FROM T5_STT_STATUS_PERKAWINAN WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded:true, indexLabel: 'Belum Kawin'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'Kawin'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'Cerai Hidup'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'Cerai Mati'},";
					
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
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT STATUS PERKAWINAN KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
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
					$sql= "SELECT SUM(BELUM_KAWIN) AS P1,SUM(KAWIN) AS P2,SUM(CERAI_HIDUP) AS P3,SUM(CERAI_MATI) AS P4 FROM T5_STT_STATUS_PERKAWINAN WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL ='".$NOKEL."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'Belum Kawin'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'Kawin'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'Cerai Hidup'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'Cerai Mati'},";
					
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
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT STATUS PERKAWINAN KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "##,. RIBU",
			legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(BELUM_KAWIN) AS P1,SUM(KAWIN) AS P2,SUM(CERAI_HIDUP) AS P3,SUM(CERAI_MATI) AS P4 FROM T5_STT_STATUS_PERKAWINAN WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),exploded:true, indexLabel: 'Belum Kawin'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'Kawin'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'Cerai Hidup'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'Cerai Mati'},";
					
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
					//text: 'DIAGRAM KOLOM PENDUDUK MENURUT GOLONGAN DARAH KOTA BANDUNG'
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
				//indexLabelWrap: true, // change to false 
				
					dataPoints: [
					<?php
					$sql= "SELECT SUM(A) AS P1,SUM(B) AS P2,SUM(AB) AS P3,SUM(O) AS P4,SUM(A_POS) AS P5,SUM(A_MIN) AS P6,SUM(B_POS) AS P7,SUM(B_MIN) AS P8,SUM(AB_POS) AS P9,SUM(AB_MIN) AS P10,SUM(O_POS) AS P11,SUM(O_MIN) AS P12, SUM(TIDAK_TAHU) AS P13 FROM T5_STT_GOLONGAN_DARAH WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'A'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'B'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'AB'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'O'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'A+'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'A-'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'B+'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  label: 'B-'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  label: 'AB+'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), label: 'AB-'},";
					echo "{y: parseInt(".(json_encode($row['P11']))."),  label: 'O+'},";
					echo "{y: parseInt(".(json_encode($row['P12']))."), label: 'O-'},";
					echo "{y: parseInt(".(json_encode($row['P13']))."), label: 'TIDAK TAHU'},";

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
					//text: 'DIAGRAM PIE PENDUDUK MENURUT GOLONGAN DARAH KOTA BANDUNG'
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
			showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. ",
			legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(A) AS P1,SUM(B) AS P2,SUM(AB) AS P3,SUM(O) AS P4,SUM(A_POS) AS P5,SUM(A_MIN) AS P6,SUM(B_POS) AS P7,SUM(B_MIN) AS P8,SUM(AB_POS) AS P9,SUM(AB_MIN) AS P10,SUM(O_POS) AS P11,SUM(O_MIN) AS P12, SUM(TIDAK_TAHU) AS P13  FROM T5_STT_GOLONGAN_DARAH WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'A'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'B'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'AB'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'O'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: 'A+'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'A-'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: 'B+'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  indexLabel: 'B-'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  indexLabel: 'AB+'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."),  indexLabel: 'AB-'},";
					echo "{y: parseInt(".(json_encode($row['P11']))."),  indexLabel: 'O+'},";
					echo "{y: parseInt(".(json_encode($row['P12']))."),  indexLabel: 'O-'},";
					echo "{y: parseInt(".(json_encode($row['P13']))."), indexLabel: 'TIDAK TAHU'},";
					
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
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT GOLONGAN DARAH KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
				axisX:{
           interval: 1
     },
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
					$sql= "SELECT SUM(A) AS P1,SUM(B) AS P2,SUM(AB) AS P3,SUM(O) AS P4,SUM(A_POS) AS P5,SUM(A_MIN) AS P6,SUM(B_POS) AS P7,SUM(B_MIN) AS P8,SUM(AB_POS) AS P9,SUM(AB_MIN) AS P10,SUM(O_POS) AS P11,SUM(O_MIN) AS P12, SUM(TIDAK_TAHU) AS P13 FROM T5_STT_GOLONGAN_DARAH WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'A'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'B'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'AB'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'O'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'A+'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'A-'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'B+'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  label: 'B-'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  label: 'AB+'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), label: 'AB-'},";
					echo "{y: parseInt(".(json_encode($row['P11']))."),  label: 'O+'},";
					echo "{y: parseInt(".(json_encode($row['P12']))."), label: 'O-'},";
					echo "{y: parseInt(".(json_encode($row['P13']))."), label: 'TIDAK TAHU'},";

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
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT GOLONGAN DARAH KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(A) AS P1,SUM(B) AS P2,SUM(AB) AS P3,SUM(O) AS P4,SUM(A_POS) AS P5,SUM(A_MIN) AS P6,SUM(B_POS) AS P7,SUM(B_MIN) AS P8,SUM(AB_POS) AS P9,SUM(AB_MIN) AS P10,SUM(O_POS) AS P11,SUM(O_MIN) AS P12, SUM(TIDAK_TAHU) AS P13  FROM T5_STT_GOLONGAN_DARAH WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC ='".$NOKEC."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'A'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'B'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'AB'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'O'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: 'A+'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'A-'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: 'B+'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  indexLabel: 'B-'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  indexLabel: 'AB+'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."),  indexLabel: 'AB-'},";
					echo "{y: parseInt(".(json_encode($row['P11']))."),  indexLabel: 'O+'},";
					echo "{y: parseInt(".(json_encode($row['P12']))."),  indexLabel: 'O-'},";
					echo "{y: parseInt(".(json_encode($row['P13']))."), indexLabel: 'TIDAK TAHU'},";
					
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
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT GOLONGAN DARAH KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
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
					//showInLegend: true, 
					//legendMarkerColor: 'blue',
					//legendText: 'Jumlah Laki-Laki/Kecamatan',
					dataPoints: [
					<?php
					$sql= "SELECT SUM(A) AS P1,SUM(B) AS P2,SUM(AB) AS P3,SUM(O) AS P4,SUM(A_POS) AS P5,SUM(A_MIN) AS P6,SUM(B_POS) AS P7,SUM(B_MIN) AS P8,SUM(AB_POS) AS P9,SUM(AB_MIN) AS P10,SUM(O_POS) AS P11,SUM(O_MIN) AS P12, SUM(TIDAK_TAHU) AS P13 FROM T5_STT_GOLONGAN_DARAH WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'A'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'B'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'AB'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'O'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'A+'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'A-'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'B+'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  label: 'B-'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  label: 'AB+'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), label: 'AB-'},";
					echo "{y: parseInt(".(json_encode($row['P11']))."),  label: 'O+'},";
					echo "{y: parseInt(".(json_encode($row['P12']))."), label: 'O-'},";
					echo "{y: parseInt(".(json_encode($row['P13']))."), label: 'TIDAK TAHU'},";

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
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT GOLONGAN DARAH KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "##,. RIBU",
			legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(A) AS P1,SUM(B) AS P2,SUM(AB) AS P3,SUM(O) AS P4,SUM(A_POS) AS P5,SUM(A_MIN) AS P6,SUM(B_POS) AS P7,SUM(B_MIN) AS P8,SUM(AB_POS) AS P9,SUM(AB_MIN) AS P10,SUM(O_POS) AS P11,SUM(O_MIN) AS P12, SUM(TIDAK_TAHU) AS P13  FROM T5_STT_GOLONGAN_DARAH WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'A'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'B'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'AB'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'O'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: 'A+'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'A-'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: 'B+'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  indexLabel: 'B-'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  indexLabel: 'AB+'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."),  indexLabel: 'AB-'},";
					echo "{y: parseInt(".(json_encode($row['P11']))."),  indexLabel: 'O+'},";
					echo "{y: parseInt(".(json_encode($row['P12']))."),  indexLabel: 'O-'},";
					echo "{y: parseInt(".(json_encode($row['P13']))."), indexLabel: 'TIDAK TAHU'},";
					
					?>						
					]}
			]
					
			});
			piekkkel6.render();
			piekkkel6 = {};
  
  </script>
  <!--  AKHIR STATISTIK 6 -->
  <!-- STATISTIK AGAMA -->
    <!-- STATISTIK 7 -->
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
			var kolkkkota7 = new CanvasJS.Chart('kolkkkota7', {
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM KOLOM PENDUDUK MENURUT AGAMA KOTA BANDUNG'
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
       
				data: [
				{
					type: 'column',
			    indexLabelMaxWidth: 50,
				//indexLabelWrap: true, // change to false 
				
					dataPoints: [
					<?php
					$sql= "SELECT SUM(ISLAM) AS P1,SUM(KRISTEN) AS P2,SUM(KATHOLIK) AS P3,SUM(HINDU) AS P4,SUM(BUDHA) AS P5,SUM(KONGHUCU) AS P6,SUM(KEPERCAYAAN) AS P7 FROM T5_STT_AGAMA WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') + 1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'ISLAM'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'KRISTEN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'KATHOLIK'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'HINDU'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'BUDHA'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'KONGHUCU'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'KEPERCAYAAN'},";

					?>				
					]}
			]
					
			});
			kolkkkota7.render();
			kolkkkota7 = {};
  
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
			var piekkkota7 = new CanvasJS.Chart('piekkkota7', {
			colorSet: 'bdgShades',
			
				title: {
					//text: 'DIAGRAM PIE PENDUDUK MENURUT AGAMA KOTA BANDUNG'
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
					$sql= "SELECT SUM(ISLAM) AS P1,SUM(KRISTEN) AS P2,SUM(KATHOLIK) AS P3,SUM(HINDU) AS P4,SUM(BUDHA) AS P5,SUM(KONGHUCU) AS P6,SUM(KEPERCAYAAN) AS P7 FROM T5_STT_AGAMA WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') + 1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'ISLAM'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'KRISTEN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'KATHOLIK'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'HINDU'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: 'BUDHA'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'KONGHUCU'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: 'KEPERCAYAAN'},";

					?>				
					]}
			]
					
			});
			piekkkota7.render();
			piekkkota7 = {};
  
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
			var kolkkkec7 = new CanvasJS.Chart('kolkkkec7', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//AMBIL NAMA KECAMATAN DAN TOTAL PENJUMLAHAN NIK TIAP KELUARAHAN BERDASARKAN KECAMATAN YANG DI PILIH 
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT AGAMA KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
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
					$sql= "SELECT SUM(ISLAM) AS P1,SUM(KRISTEN) AS P2,SUM(KATHOLIK) AS P3,SUM(HINDU) AS P4,SUM(BUDHA) AS P5,SUM(KONGHUCU) AS P6,SUM(KEPERCAYAAN) AS P7 FROM T5_STT_AGAMA WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'ISLAM'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'KRISTEN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'KATHOLIK'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'HINDU'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'BUDHA'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'KONGHUCU'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'KEPERCAYAAN'},";
					?>					
					//]}				
					]}
			]
					
			});
			kolkkkec7.render();
			kolkkkec7 = {};
  
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
			var piekkkec7 = new CanvasJS.Chart('piekkkec7', {
			colorSet: 'bdgShades',
			
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT AGAMA KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(ISLAM) AS P1,SUM(KRISTEN) AS P2,SUM(KATHOLIK) AS P3,SUM(HINDU) AS P4,SUM(BUDHA) AS P5,SUM(KONGHUCU) AS P6,SUM(KEPERCAYAAN) AS P7 FROM T5_STT_AGAMA WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'ISLAM'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'KRISTEN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'KATHOLIK'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'HINDU'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: 'BUDHA'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'KONGHUCU'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: 'KEPERCAYAAN'},";

					?>					
					]}
			]
					
			});
			piekkkec7.render();
			piekkkec7 = {};
  
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
			var kolkkkel7 = new CanvasJS.Chart('kolkkkel7', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT AGAMA KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
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
					$sql= "SELECT ISLAM AS P1,KRISTEN AS P2,KATHOLIK AS P3,HINDU AS P4,BUDHA AS P5,KONGHUCU AS P6,KEPERCAYAAN AS P7 FROM T5_STT_AGAMA WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."'AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'ISLAM'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'KRISTEN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'KATHOLIK'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'HINDU'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'BUDHA'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'KONGHUCU'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'KEPERCAYAAN'},";
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
			var piekkkel7 = new CanvasJS.Chart('piekkkel7', {
			colorSet: 'bdgShades',
			
				title: {
						<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT AGAMA KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "##,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT ISLAM AS P1,KRISTEN AS P2,KATHOLIK AS P3,HINDU AS P4,BUDHA AS P5,KONGHUCU AS P6,KEPERCAYAAN AS P7 FROM T5_STT_AGAMA WHERE NO_PROP='32' AND NO_KAB='73' AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."'AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'ISLAM'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'KRISTEN'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'KATHOLIK'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'HINDU'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: 'BUDHA'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'KONGHUCU'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: 'KEPERCAYAAN'},";
					?>				
					]}
			]
					
			});
			piekkkel7.render();
			piekkkel7 = {};
  
  </script>
  <!--  AKHIR TEMPLATE -->
    <!-- STATISTIK TEMPLATE -->
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
			var kolkkkota8 = new CanvasJS.Chart('kolkkkota8', {
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM KOLOM PENDUDUK MENURUT PENYANDANG CACAT KOTA BANDUNG'
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
       
				data: [
				{
					type: 'column',
			    indexLabelMaxWidth: 50,
				//indexLabelWrap: true, // change to false 
				
					dataPoints: [
					<?php
					$sql= "SELECT SUM(FISIK) AS P1,SUM(NETRA) AS P2,SUM(RUNGU) AS P3,SUM(MENTAL) AS P4,SUM(FISIK_MENTAL) AS P5,SUM(LAINNYA) AS P6 FROM T5_STT_PENYANDANG_CACAT WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'FISIK'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'TUNA NETRA'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'TUNA RUNGU'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'MENTAL'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'MENTAL DAN FISIK'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'LAINNYA'},";

					?>				
					]}
			]
					
			});
			kolkkkota8.render();
			kolkkkota8 = {};
  
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
			var piekkkota8 = new CanvasJS.Chart('piekkkota8', {
			colorSet: 'bdgShades',
			
				title: {
					//text: 'DIAGRAM PIE PENDUDUK MENURUT PENYANDANG CACAT KOTA BANDUNG'
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
					$sql= "SELECT SUM(FISIK) AS P1,SUM(NETRA) AS P2,SUM(RUNGU) AS P3,SUM(MENTAL) AS P4,SUM(FISIK_MENTAL) AS P5,SUM(LAINNYA) AS P6 FROM T5_STT_PENYANDANG_CACAT WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'FISIK'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'TUNA NETRA'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'TUNA RUNGU'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'MENTAL'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: 'MENTAL DAN FISIK'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'LAINNYA'},";

					?>						
					]}
			]
					
			});
			piekkkota8.render();
			piekkkota8 = {};
  
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
			var kolkkkec8 = new CanvasJS.Chart('kolkkkec8', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//AMBIL NAMA KECAMATAN DAN TOTAL PENJUMLAHAN NIK TIAP KELUARAHAN BERDASARKAN KECAMATAN YANG DI PILIH 
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT PENYANDANG CACAT KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
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
					$sql= "SELECT SUM(FISIK) AS P1,SUM(NETRA) AS P2,SUM(RUNGU) AS P3,SUM(MENTAL) AS P4,SUM(FISIK_MENTAL) AS P5,SUM(LAINNYA) AS P6 FROM T5_STT_PENYANDANG_CACAT WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_KEC='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'FISIK'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'TUNA NETRA'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'TUNA RUNGU'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'MENTAL'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'MENTAL DAN FISIK'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'LAINNYA'},";
					?>				
					//]}				
					]}
			]
					
			});
			kolkkkec8.render();
			kolkkkec8 = {};
  
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
			var piekkkec8 = new CanvasJS.Chart('piekkkec8', {
			colorSet: 'bdgShades',
			
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT PENYANDANG CACAT KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(FISIK) AS P1,SUM(NETRA) AS P2,SUM(RUNGU) AS P3,SUM(MENTAL) AS P4,SUM(FISIK_MENTAL) AS P5,SUM(LAINNYA) AS P6 FROM T5_STT_PENYANDANG_CACAT WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_KEC='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'FISIK'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'TUNA NETRA'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'TUNA RUNGU'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'MENTAL'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: 'MENTAL DAN FISIK'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'LAINNYA'},";

					?>						
					]}
			]
					
			});
			piekkkec8.render();
			piekkkec8 = {};
  
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
			var kolkkkel8 = new CanvasJS.Chart('kolkkkel8', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT PENYANDANG CACAT KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
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
					$sql= "SELECT FISIK AS P1,NETRA AS P2,RUNGU AS P3,MENTAL AS P4,FISIK_MENTAL AS P5,LAINNYA AS P6 FROM T5_STT_PENYANDANG_CACAT WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'FISIK'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'TUNA NETRA'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'TUNA RUNGU'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'MENTAL'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'MENTAL DAN FISIK'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'LAINNYA'},";
					?>
					]}
			]
					
			});
			kolkkkel8.render();
			kolkkkel8 = {};
  
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
			var piekkkel8 = new CanvasJS.Chart('piekkkel8', {
			colorSet: 'bdgShades',
			
				title: {
						<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT PENYANDANG CACAT KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "##,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT FISIK AS P1,NETRA AS P2,RUNGU AS P3,MENTAL AS P4,FISIK_MENTAL AS P5,LAINNYA AS P6 FROM T5_STT_PENYANDANG_CACAT WHERE NO_PROP='32' AND NO_KAB='73' AND BLN >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'FISIK'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'TUNA NETRA'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'TUNA RUNGU'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'MENTAL'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: 'MENTAL DAN FISIK'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'LAINNYA'},";
					?>						
					]}
			]
					
			});
			piekkkel8.render();
			piekkkel8 = {};
  
  </script>
  <!--  AKHIR TEMPLATE -->
    <!-- STATISTIK TEMPLATE -->
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
			var kolkkkota9 = new CanvasJS.Chart('kolkkkota9', {
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM KOLOM PENDUDUK MENURUT WAJIB KTP KOTA BANDUNG'
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
       
				data: [
				{
					type: 'column',
			    indexLabelMaxWidth: 50,
				showInLegend: true, 
					legendMarkerColor: '#4661EE',
					legendText: 'Jumlah Laki-Laki/Kecamatan',
				//indexLabelWrap: true, // change to false 
				
					dataPoints: [
					<?php
					//MEMILIH SELURUH KECAMATAN DAN TOTAL PENJUMLAHAN DATA SETIAP KECAMATAN BERDASARKAN KATEGORI YANG DI PILIH (LAKI LAKI)
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(LK) AS LAKI_LAKI FROM T5_STT_WAJIB_KTP INNER JOIN SETUP_KEC ON T5_STT_WAJIB_KTP.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
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
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(LP) AS PEREMPUAN FROM T5_STT_WAJIB_KTP INNER JOIN SETUP_KEC ON T5_STT_WAJIB_KTP.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  label: ".json_encode($row['NAMA_KEC'])."},"; 
					}	
					?>					
					]}
			]
					
			});
			kolkkkota9.render();
			kolkkkota9 = {};
  
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
			var piekkkota9 = new CanvasJS.Chart('piekkkota9', {
			colorSet: 'bdgShades',
			
				title: {
					//text: 'DIAGRAM PIE PENDUDUK MENURUT WAJIB KTP KOTA BANDUNG'
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
					//MENAMPILKAN DATA HASIL PENJUMLAHAN DATA SELURUH KECAMATAN DISATUKAN LAKI LAKI
					$sql= "SELECT SUM(LK) AS LAKI_LAKI FROM T5_STT_WAJIB_KTP WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['LAKI_LAKI']))."),  indexLabel: 'LAKI-LAKI'},";
					}	
					?>
					<?php
					//MENAMPILKAN DATA HASIL PENJUMLAHAN DATA SELURUH KECAMATAN DISATUKAN PEREMPUAN
					$sql= "SELECT SUM(LP) AS PEREMPUAN FROM T5_STT_WAJIB_KTP WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),exploded: true,  indexLabel: 'PEREMPUAN'},"; 
					}	
					?>						
					]}
			]
					
			});
			piekkkota9.render();
			piekkkota9 = {};
  
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
			var kolkkkec9 = new CanvasJS.Chart('kolkkkec9', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//AMBIL NAMA KECAMATAN DAN TOTAL PENJUMLAHAN NIK TIAP KELUARAHAN BERDASARKAN KECAMATAN YANG DI PILIH 
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT WAJIB KTP KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
            //legend: {
        //verticalAlign: 'bottom',
        //horizontalAlign: 'center'
      //},
				data: [
				{
					type: 'column',
					 indexLabelMaxWidth: 50,
					 showInLegend: true, 
					legendMarkerColor: '#4661EE',
					legendText: 'Jumlah Laki-Laki/Kecamatan',
					dataPoints: [
					<?php
					//MENCARI MANA KECAMATAN DAN JUMLAH DATA YANG DI PILIH LAKI LAKI
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(LK) AS LAKI_LAKI FROM T5_STT_WAJIB_KTP INNER JOIN SETUP_KEC ON T5_STT_WAJIB_KTP.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' AND SETUP_KEC.NO_KEC =".$NOKEC." GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
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
					$sql= "SELECT SETUP_KEC.NAMA_KEC, SUM(LP) AS PEREMPUAN FROM T5_STT_WAJIB_KTP INNER JOIN SETUP_KEC ON T5_STT_WAJIB_KTP.NO_KEC = SETUP_KEC.NO_KEC WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEC.NO_PROP='32' AND SETUP_KEC.NO_KAB='73' AND SETUP_KEC.NO_KEC =".$NOKEC." GROUP BY SETUP_KEC.NAMA_KEC ORDER BY SETUP_KEC.NAMA_KEC";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  label: ".json_encode($row['NAMA_KEC'])."},"; 
					}	
					?>					
					//]}				
					]}
			]
					
			});
			kolkkkec9.render();
			kolkkkec9 = {};
  
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
			var kolkkkecall9 = new CanvasJS.Chart('kolkkkecall9', {
				//MENAMPIKAN DATA KELURAHAN BERDASARKAN KECAMATAN YANG DIPILIH
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//MENCARI NAMA KECAMATAN YANG DIPILIH
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT WAJIB KTP KECAMATAN ".$row['NAMA_KEC']." PER KELURAHAN'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
            legend: {
        verticalAlign: 'bottom',
        horizontalAlign: 'center'
      },
				data: [
				{
					type: 'column',
					showInLegend: true, 
					legendMarkerColor: '#4661EE',
					legendText: 'Jumlah Laki-Laki/Kecamatan',
					dataPoints: [
					<?php
					// MENCARI NAMA KELURAHAN DAN DATA YANG DIPILIH BERDASARKAN KECAMATAN YANG DI PILIH LAKI LAKI
					$sql= "SELECT SETUP_KEL.NAMA_KEL, LK AS LAKI_LAKI FROM T5_STT_WAJIB_KTP INNER JOIN SETUP_KEL ON T5_STT_WAJIB_KTP.NO_KEC = SETUP_KEL.NO_KEC AND T5_STT_WAJIB_KTP.NO_KEL = SETUP_KEL.NO_KEL WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEL.NO_PROP='32' AND SETUP_KEL.NO_KAB='73' AND SETUP_KEL.NO_KEC ='".$NOKEC."' ORDER BY SETUP_KEL.NAMA_KEL";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['LAKI_LAKI']))."),  label: ".json_encode($row['NAMA_KEL'])."},";
					}	
					?>					
					]},{
					type: 'column',
					showInLegend: true, 
					legendMarkerColor: '#EC5657',
					legendText: 'Jumlah Perempuan/Kecamatan',
					dataPoints: [
					<?php
					// MENCARI NAMA KELURAHAN DAN DATA YANG DIPILIH BERDASARKAN KECAMATAN YANG DI PILIH PEREMPUAN
					$sql= "SELECT SETUP_KEL.NAMA_KEL, LP AS PEREMPUAN FROM T5_STT_WAJIB_KTP INNER JOIN SETUP_KEL ON T5_STT_WAJIB_KTP.NO_KEC = SETUP_KEL.NO_KEC AND T5_STT_WAJIB_KTP.NO_KEL = SETUP_KEL.NO_KEL WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEL.NO_PROP='32' AND SETUP_KEL.NO_KAB='73' AND SETUP_KEL.NO_KEC ='".$NOKEC."' ORDER BY SETUP_KEL.NAMA_KEL";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  label: ".json_encode($row['NAMA_KEL'])."},"; 
					}	
					?>					
					]}
			]
					
			});
			kolkkkecall9.render();
			kolkkkecall9 = {};
  
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
			var piekkkec9 = new CanvasJS.Chart('piekkkec9', {
			colorSet: 'bdgShades',
			
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT WAJIB KTP KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					//MENCARI JUMLAH DATA YANG DIPILIH BERDASARKAN KECAMATAN
					$sql= "SELECT SUM(LK) AS LAKI_LAKI FROM T5_STT_WAJIB_KTP WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73' AND NO_KEC =".$NOKEC."";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['LAKI_LAKI']))."),  indexLabel: 'LAKI-LAKI'},";
					}	
					?>
					<?php
					//MENCARI JUMLAH DATA YANG DIPILIH BERDASARKAN KECAMATAN
					$sql= "SELECT SUM(LP) AS PEREMPUAN FROM T5_STT_WAJIB_KTP WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73' AND NO_KEC =".$NOKEC."";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  exploded: true, indexLabel: 'PEREMPUAN'},"; 
					}	
					?>						
					]}
			]
					
			});
			piekkkec9.render();
			piekkkec9 = {};
  
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
			var kolkkkel9 = new CanvasJS.Chart('kolkkkel9', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT WAJIB KTP KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
            legend: {
        verticalAlign: 'bottom',
        horizontalAlign: 'center'
      },
				data: [
				{
					type: 'column',
					showInLegend: true, 
					legendMarkerColor: '#4661EE',
					legendText: 'Jumlah Laki-Laki/Kecamatan',
					//showInLegend: true, 
					//legendMarkerColor: 'blue',
					//legendText: 'Jumlah Laki-Laki/Kecamatan',
					dataPoints: [
					<?php
					//MENCARI DATA DAN NAMA KELURAHAN BERDASARKAN KELURAHAN YANG DIPILIH
					$sql= "SELECT SETUP_KEL.NAMA_KEL, LK AS LAKI_LAKI FROM T5_STT_WAJIB_KTP INNER JOIN SETUP_KEL ON T5_STT_WAJIB_KTP.NO_KEC = SETUP_KEL.NO_KEC AND T5_STT_WAJIB_KTP.NO_KEL = SETUP_KEL.NO_KEL WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEL.NO_PROP='32' AND SETUP_KEL.NO_KAB='73' AND SETUP_KEL.NO_KEC ='".$NOKEC."' AND SETUP_KEL.NO_KEL ='".$NOKEL."' ORDER BY SETUP_KEL.NAMA_KEL";
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
					$sql= "SELECT SETUP_KEL.NAMA_KEL, LP AS PEREMPUAN FROM T5_STT_WAJIB_KTP INNER JOIN SETUP_KEL ON T5_STT_WAJIB_KTP.NO_KEC = SETUP_KEL.NO_KEC AND T5_STT_WAJIB_KTP.NO_KEL = SETUP_KEL.NO_KEL WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND SETUP_KEL.NO_PROP='32' AND SETUP_KEL.NO_KAB='73' AND SETUP_KEL.NO_KEC ='".$NOKEC."' AND SETUP_KEL.NO_KEL ='".$NOKEL."' ORDER BY SETUP_KEL.NAMA_KEL";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  label: ".json_encode($row['NAMA_KEL'])."},"; 
					}	
					?>
					]}
			]
					
			});
			kolkkkel9.render();
			kolkkkel9 = {};
  
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
			var piekkkel9 = new CanvasJS.Chart('piekkkel9', {
			colorSet: 'bdgShades',
			
				title: {
						<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT WAJIB KTP KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "##,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					// MENCARI DATA PER KELURAHAN 
					$sql= "SELECT LK AS LAKI_LAKI FROM T5_STT_WAJIB_KTP WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73' AND NO_KEC =".$NOKEC." AND NO_KEL =".$NOKEL."";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['LAKI_LAKI']))."),  indexLabel: 'LAKI-LAKI'},";
					}	
					?>
					<?php
					// MENCARI DATA PER KELURAHAN
					$sql= "SELECT LP AS PEREMPUAN FROM T5_STT_WAJIB_KTP WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 AND NO_PROP='32' AND NO_KAB='73' AND NO_KEC =".$NOKEC." AND NO_KEL =".$NOKEL."";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
					echo "{y: parseInt(".(json_encode($row['PEREMPUAN']))."),  exploded: true,  indexLabel: 'PEREMPUAN'},"; 
					}	
					?>					
					]}
			]
					
			});
			piekkkel9.render();
			piekkkel9 = {};
  
  </script>
  <!--  AKHIR TEMPLATE -->
    <!-- STATISTIK TEMPLATE -->
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
			var kolkkkota10 = new CanvasJS.Chart('kolkkkota10', {
			colorSet: 'bdgShades',
				title: {
					//text: 'DIAGRAM KOLOM PENDUDUK MENURUT HUBUNGAN DALAM KELUARGA KOTA BANDUNG'
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
       
				data: [
				{
					type: 'column',
			    indexLabelMaxWidth: 50,
				//indexLabelWrap: true, // change to false 
				
					dataPoints: [
					<?php
					$sql= "SELECT SUM(KEPALA_KELUARGA) AS P1,SUM(SUAMI) AS P2,SUM(ISTRI) AS P3,SUM(ANAK) AS P4,SUM(MENANTU) AS P5,SUM(CUCU) AS P6,SUM(ORANG_TUA) AS P7,SUM(MERTUA) AS P8,SUM(FAMILI_LAIN) AS P9,SUM(PEMBANTU) AS P10,SUM(LAINNYA) AS P11 FROM T5_STT_STATHBKEL WHERE BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'Kepala Keluarga'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'Suami'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'Istri'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'Anak'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'Menantu'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'Cucu'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'Orang Tua'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  label: 'Mertua'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  label: 'Famili Lain'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), label: 'Pembantu'},";
					echo "{y: parseInt(".(json_encode($row['P11']))."), label: 'Lainnya'},";

					?>					
					]}
			]
					
			});
			kolkkkota10.render();
			kolkkkota10 = {};
  
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
			var piekkkota10 = new CanvasJS.Chart('piekkkota10', {
			colorSet: 'bdgShades',
			
				title: {
					//text: 'DIAGRAM PIE PENDUDUK MENURUT HUBUNGAN DALAM KELUARGA KOTA BANDUNG'
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
					$sql= "SELECT SUM(KEPALA_KELUARGA) AS P1,SUM(SUAMI) AS P2,SUM(ISTRI) AS P3,SUM(ANAK) AS P4,SUM(MENANTU) AS P5,SUM(CUCU) AS P6,SUM(ORANG_TUA) AS P7,SUM(MERTUA) AS P8,SUM(FAMILI_LAIN) AS P9,SUM(PEMBANTU) AS P10,SUM(LAINNYA) AS P11 FROM T5_STT_STATHBKEL WHERE BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'Kepala Keluarga'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'Suami'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'Istri'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'Anak'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: 'Menantu'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'Cucu'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: 'Orang Tua'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  indexLabel: 'Mertua'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  indexLabel: 'Famili Lain'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), indexLabel: 'Pembantu'},";
					echo "{y: parseInt(".(json_encode($row['P11']))."), indexLabel: 'Lainnya'},";

					?>						
					]}
			]
					
			});
			piekkkota10.render();
			piekkkota10 = {};
  
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
			var kolkkkec10 = new CanvasJS.Chart('kolkkkec10', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//AMBIL NAMA KECAMATAN DAN TOTAL PENJUMLAHAN NIK TIAP KELUARAHAN BERDASARKAN KECAMATAN YANG DI PILIH 
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT HUBUNGAN DALAM KELUARGA KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
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
					$sql= "SELECT SUM(KEPALA_KELUARGA) AS P1,SUM(SUAMI) AS P2,SUM(ISTRI) AS P3,SUM(ANAK) AS P4,SUM(MENANTU) AS P5,SUM(CUCU) AS P6,SUM(ORANG_TUA) AS P7,SUM(MERTUA) AS P8,SUM(FAMILI_LAIN) AS P9,SUM(PEMBANTU) AS P10,SUM(LAINNYA) AS P11 FROM T5_STT_STATHBKEL WHERE BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and No_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'Kepala Keluarga'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'Suami'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'Istri'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'Anak'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'Menantu'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'Cucu'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'Orang Tua'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  label: 'Mertua'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  label: 'Famili Lain'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), label: 'Pembantu'},";
					echo "{y: parseInt(".(json_encode($row['P11']))."), label: 'Lainnya'},";

					?>					
					//]}				
					]}
			]
					
			});
			kolkkkec10.render();
			kolkkkec10 = {};
  
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
			var piekkkec10 = new CanvasJS.Chart('piekkkec10', {
			colorSet: 'bdgShades',
			
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT HUBUNGAN DALAM KELUARGA KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(KEPALA_KELUARGA) AS P1,SUM(SUAMI) AS P2,SUM(ISTRI) AS P3,SUM(ANAK) AS P4,SUM(MENANTU) AS P5,SUM(CUCU) AS P6,SUM(ORANG_TUA) AS P7,SUM(MERTUA) AS P8,SUM(FAMILI_LAIN) AS P9,SUM(PEMBANTU) AS P10,SUM(LAINNYA) AS P11 FROM T5_STT_STATHBKEL WHERE BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and No_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'Kepala Keluarga'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'Suami'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'Istri'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'Anak'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: 'Menantu'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'Cucu'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: 'Orang Tua'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  indexLabel: 'Mertua'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  indexLabel: 'Famili Lain'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), indexLabel: 'Pembantu'},";
					echo "{y: parseInt(".(json_encode($row['P11']))."), indexLabel: 'Lainnya'},";

					?>						
					]}
			]
					
			});
			piekkkec10.render();
			piekkkec10 = {};
  
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
			var kolkkkel10 = new CanvasJS.Chart('kolkkkel10', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT HUBUNGAN DALAM KELUARGA KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
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
					$sql= "SELECT SUM(KEPALA_KELUARGA) AS P1,SUM(SUAMI) AS P2,SUM(ISTRI) AS P3,SUM(ANAK) AS P4,SUM(MENANTU) AS P5,SUM(CUCU) AS P6,SUM(ORANG_TUA) AS P7,SUM(MERTUA) AS P8,SUM(FAMILI_LAIN) AS P9,SUM(PEMBANTU) AS P10,SUM(LAINNYA) AS P11 FROM T5_STT_STATHBKEL WHERE BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and No_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  label: 'Kepala Keluarga'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  label: 'Suami'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  label: 'Istri'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  label: 'Anak'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  label: 'Menantu'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  label: 'Cucu'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  label: 'Orang Tua'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  label: 'Mertua'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  label: 'Famili Lain'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), label: 'Pembantu'},";
					echo "{y: parseInt(".(json_encode($row['P11']))."), label: 'Lainnya'},";
					?>
					]}
			]
					
			});
			kolkkkel10.render();
			kolkkkel10 = {};
  
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
			var piekkkel10 = new CanvasJS.Chart('piekkkel10', {
			colorSet: 'bdgShades',
			
				title: {
						<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT HUBUNGAN DALAM KELUARGA KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "##,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(KEPALA_KELUARGA) AS P1,SUM(SUAMI) AS P2,SUM(ISTRI) AS P3,SUM(ANAK) AS P4,SUM(MENANTU) AS P5,SUM(CUCU) AS P6,SUM(ORANG_TUA) AS P7,SUM(MERTUA) AS P8,SUM(FAMILI_LAIN) AS P9,SUM(PEMBANTU) AS P10,SUM(LAINNYA) AS P11 FROM T5_STT_STATHBKEL WHERE BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and No_KEC ='".$NOKEC."' and NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."),  indexLabel: 'Kepala Keluarga'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'Suami'},";
					echo "{y: parseInt(".(json_encode($row['P3']))."),  indexLabel: 'Istri'},";
					echo "{y: parseInt(".(json_encode($row['P4']))."),  indexLabel: 'Anak'},";
					echo "{y: parseInt(".(json_encode($row['P5']))."),  indexLabel: 'Menantu'},";
					echo "{y: parseInt(".(json_encode($row['P6']))."),  indexLabel: 'Cucu'},";
					echo "{y: parseInt(".(json_encode($row['P7']))."),  indexLabel: 'Orang Tua'},";
					echo "{y: parseInt(".(json_encode($row['P8']))."),  indexLabel: 'Mertua'},";
					echo "{y: parseInt(".(json_encode($row['P9']))."),  indexLabel: 'Famili Lain'},";
					echo "{y: parseInt(".(json_encode($row['P10']))."), indexLabel: 'Pembantu'},";
					echo "{y: parseInt(".(json_encode($row['P11']))."), indexLabel: 'Lainnya'},";

				
					?>						
					]}
			]
					
			});
			piekkkel10.render();
			piekkkel10 = {};
  
  </script>
  <!--  AKHIR TEMPLATE -->
    <!-- STATISTIK TEMPLATE -->
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
			var kolkkkota11 = new CanvasJS.Chart('kolkkkota11', {
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
			kolkkkota11.render();
			kolkkkota11 = {};
  
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
			var piekkkota11 = new CanvasJS.Chart('piekkkota11', {
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
			piekkkota11.render();
			piekkkota11 = {};
  
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
			var kolkkkec11 = new CanvasJS.Chart('kolkkkec11', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//AMBIL NAMA KECAMATAN DAN TOTAL PENJUMLAHAN NIK TIAP KELUARAHAN BERDASARKAN KECAMATAN YANG DI PILIH 
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT KEPEMILIKAN AKTA KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
            //legend: {
        //verticalAlign: 'bottom',
        //horizontalAlign: 'center'
      //},
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
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '0' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P1,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '1' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P2,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '2' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P3,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '3' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P4,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '4' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P5,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '5' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P6,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '6' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P7,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '7' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P8,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '8' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P9,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '9' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P10,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '10' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P11,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '11' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P12,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '12' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P13,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '13' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P14,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '14' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P15,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '15' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P16
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
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '0' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P1,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '1' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P2,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '2' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P3,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '3' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P4,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '4' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P5,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '5' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P6,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '6' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P7,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '7' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P8,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '8' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P9,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '9' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P10,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '10' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P11,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '11' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P12,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '12' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P13,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '13' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P14,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '14' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P15,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '15' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P16
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
					//]}				
					]}
			]
					
			});
			kolkkkec11.render();
			kolkkkec11 = {};
  
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
			var piekkkec11 = new CanvasJS.Chart('piekkkec11', {
			colorSet: 'bdgShades',
			
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT KEPEMILIKAN AKTA KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(ADA_AKTA) AS P1, SUM(TIDAK_ADA_AKTA) AS P2 FROM T5_STT_STRUKTUR_UMUR WHERE BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' AND NO_KEC='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."), exploded: true, indexLabel: 'Ada Akta'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'Tidak Ada Akta'},";

					?>								
					]}
			]
					
			});
			piekkkec11.render();
			piekkkec11 = {};
  
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
			var kolkkkel11 = new CanvasJS.Chart('kolkkkel11', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT KEPEMILIKAN AKTA KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
            legend: {
        verticalAlign: 'bottom',
        horizontalAlign: 'center'
      },
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
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '0' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P1,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '1' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P2,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '2' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P3,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '3' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P4,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '4' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P5,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '5' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P6,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '6' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P7,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '7' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P8,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '8' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P9,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '9' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P10,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '10' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P11,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '11' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P12,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '12' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P13,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '13' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P14,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '14' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P15,
    (SELECT sum(ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '15' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' ) as P16
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
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '0' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P1,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '1' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P2,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '2' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P3,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '3' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P4,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '4' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P5,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '5' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P6,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '6' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P7,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '7' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P8,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '8' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P9,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '9' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P10,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '10' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P11,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '11' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P12,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '12' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P13,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '13' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P14,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '14' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P15,
    (SELECT sum(TIDAK_ADA_AKTA) FROM T5_STT_STRUKTUR_UMUR WHERE SORT = '15' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' and NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."') as P16
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
			kolkkkel11.render();
			kolkkkel11 = {};
  
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
			var piekkkel11 = new CanvasJS.Chart('piekkkel11', {
			colorSet: 'bdgShades',
			
				title: {
						<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT KEPEMILIKAN AKTA KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "##,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "SELECT SUM(ADA_AKTA) AS P1, SUM(TIDAK_ADA_AKTA) AS P2 FROM T5_STT_STRUKTUR_UMUR WHERE BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 AND NO_PROP = '32' and NO_KAB = '73' AND NO_KEC='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "{y: parseInt(".(json_encode($row['P1']))."), exploded: true, indexLabel: 'Ada Akta'},";
					echo "{y: parseInt(".(json_encode($row['P2']))."),  indexLabel: 'Tidak Ada Akta'},";

					?>						
					]}
			]
					
			});
			piekkkel11.render();
			piekkkel11 = {};
  
  </script>
  <!--  AKHIR TEMPLATE -->
  
  <!-- BUAT COPAS -->
  <!-- STATISTIK TEMPLATE -->
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
			var kolkkkotaXXN = new CanvasJS.Chart('kolkkkotaXXN', {
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
			    indexLabelMaxWidth: 50,
				//indexLabelWrap: true, // change to false 
				
					dataPoints: [
					<?php
					$sql= "XXXSQLXXX";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "XXXROWXXX";

					?>					
					]}
			]
					
			});
			kolkkkotaXXN.render();
			kolkkkotaXXN = {};
  
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
			var piekkkotaXXN = new CanvasJS.Chart('piekkkotaXXN', {
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
					$sql= "XXXSQLXXX";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "XXXROWXXX";

					?>						
					]}
			]
					
			});
			piekkkotaXXN.render();
			piekkkotaXXN = {};
  
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
			var kolkkkecXXN = new CanvasJS.Chart('kolkkkecXXN', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					//AMBIL NAMA KECAMATAN DAN TOTAL PENJUMLAHAN NIK TIAP KELUARAHAN BERDASARKAN KECAMATAN YANG DI PILIH 
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT KEPEMILIKAN AKTA KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
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
					$sql= "XXXSQLXXX";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "XXXROWXXX";
					?>					
					//]}				
					]}
			]
					
			});
			kolkkkecXXN.render();
			kolkkkecXXN = {};
  
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
			var piekkkecXXN = new CanvasJS.Chart('piekkkecXXN', {
			colorSet: 'bdgShades',
			
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT KEPEMILIKAN AKTA KECAMATAN ".$row['NAMA_KEC']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "#0#,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "XXXSQLXXX";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "XXXROWXXX";

					?>						
					]}
			]
					
			});
			piekkkecXXN.render();
			piekkkecXXN = {};
  
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
			var kolkkkelXXN = new CanvasJS.Chart('kolkkkelXXN', {
			colorSet: 'bdgShades',
				title: {
					<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT KEPEMILIKAN AKTA KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
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
					$sql= "XXXSQLXXX";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "XXXROWXXX";
					?>
					]}
			]
					
			});
			kolkkkelXXN.render();
			kolkkkelXXN = {};
  
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
			var piekkkelXXN = new CanvasJS.Chart('piekkkelXXN', {
			colorSet: 'bdgShades',
			
				title: {
						<?PHP
					$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL='".$NOKEL."' ";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM PIE PENDUDUK MENURUT KEPEMILIKAN AKTA KELURAHAN ".$row['NAMA_KEL']."'";
					?>
				},
				animationEnabled: true, theme: "theme2",
				//exportFileName: "Diagram DisdukCapil Kota Bandung",
				//exportEnabled: true,
          
				data: [
				{
					type: "pie",
			//showInLegend: true,
			toolTipContent: "{y} - #percent %",
			//yValueFormatString: "##,. RIBU",
			//legendText: "{indexLabel}",
					dataPoints: [
					<?php
					$sql= "XXXSQLXXX";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					echo "XXXROWXXX";
					?>						
					]}
			]
					
			});
			piekkkelXXN.render();
			piekkkelXXN = {};
  
  </script>
  <!--  AKHIR TEMPLATE -->
  
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