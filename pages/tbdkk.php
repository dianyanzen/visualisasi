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
	<?php

session_start();

//$_SESSION['bulan'] = $BULAN;

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
                                <li class="active"><a href="tbdkk.php">Kartu Keluarga</a>
                                </li>
                                <li><a href="tbdbiodata.php">Biodata</a>
                                </li>
                                <li><a href="tbdpindah.php">Pindah</a>
                                </li>
                                <li><a href="tbddatang.php">Datang</a>
                                </li>
                            </ul>
					
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="kartukeluarga-pills">
								<br>
                                    <div class="col-lg-12">
										<div class="panel panel-primary">
											<div class="panel-heading">
												Tabel Statistik Pendaftaran Penduduk WNI Kota Bandung - Kepala Keluarga
											</div>
										<div class="panel-body" >
										
										<form method="post" name="formstable" id="formstable" action="tbdkk.php" role="form">
	
										<!--start row-->
										<div class="row">
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
										<!-- end row -->
										<!--start row-->
										<div class="row">
											<div class="col-lg-12">
											<div class="form-group col-lg-6">
                                            <label>Pilih Jenis Tabel</label>
                                            <select name="statistik" id="statistik" class="form-control" required>
                                               	<option value="1">Jumlah Kepala Keluarga Menurut Jenis Kelamin</option>
												<option value="2">Jumlah Kepala Keluarga Menurut Pendidikan Terakhir</option>
												<option value="3">Jumlah Kepala Keluarga Menurut Status Perkawinan</option>
												<option value="4">Jumlah Kepala Keluarga Menurut Golongan Darah</option>
												<option value="5">Jumlah Kepala Keluarga Menurut Agama</option>
												<option value="6">Jumlah Kepala Keluarga Menurut Penyandang Cacat</option>
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
										<button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Tampilkan Tabel</button>
									</div>
									</form>
									</div>
									<?php

//if submit is not blanked i.e. it is clicked.
if (isset($_REQUEST['submit'])) //here give the name of your button on which you would like    //to perform action.
{
	$BULAN= $_POST['bulan'];
	$_SESSION['bulan'] = $BULAN;
	$NOKEC= $_REQUEST['NO_KEC'] ;
	$NOKEL= $_REQUEST['NO_KEL'] ;
	$_SESSION['NOKEC'] = $NOKEC;
	$_SESSION['NOKEL'] = $NOKEL;
	if($_REQUEST['statistik']=="1"){
		//JIKA STATISTIK YANG DI PILIH VALUENYA = 1(JENIS KELAMIN)
	$NOKEC= $_REQUEST['NO_KEC'] ;
	$NOKEL= $_REQUEST['NO_KEL'] ;
	$BULAN= $_POST['bulan'];
	//MENGECEK APAKAH BULAN YANG DI PILIH TERSEDIA DI DB
	$sql= "SELECT * FROM T5_KEPKEL_KELAMIN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
	    $num_rows=oci_fetch($stmt);
	   if($num_rows>0){
	if($_REQUEST['NO_KEC']=="0" && $_REQUEST['NO_KEL']=="0")
	{
		//HASIL YANG DI KELUARKAN APABILA DATA TELAH TEPAT, KECAMATAN DAN KELURAHAN DI TAMPILKAN SEMUA
	ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL KEPALA KELUARGA MENURUT JENIS KELAMIN KOTA BANDUNG
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Laki-Laki</th>
                                        <th>Perempuan</th>
                                        <th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT a.NO_KEC as P1, a.NAMA_KEC AS P2, SUM(b.LK) AS P3, SUM(b.LP) AS P4, SUM(b.LK)+SUM(b.LP) AS P5
									FROM SETUP_KEC a INNER JOIN T5_KEPKEL_KELAMIN b
									ON a.NO_KEC=b.NO_KEC WHERE a.NO_PROP='32' AND a.NO_KAB ='73' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
									GROUP BY a.NO_KEC, a.NAMA_KEC ORDER BY a.NO_KEC";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr class='gradeA'>";
                                    echo "<td align='center'>".htmlentities($row['P1'])."</div></td>";
                                    echo "<td class='center'>".htmlentities($row['P2'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P3'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P4'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P5'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='keluarga-1/kecamatan/index.php?NOKEC=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
                                    echo "</tr>";
									}
									
								echo"</tbody>
								</thead>
							</table>
						</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
	 
	} ELSE if($_REQUEST['NO_KEC']<>"0" && $_REQUEST['NO_KEL']=="0"){
		//DATA DI KELUARKAN APABILA MEMILIH KATEGORI KECAMATAN
		$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		$row = oci_fetch_array($stmt);
		ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL KEPALA KELUARGA MENURUT JENIS KELAMIN KOTA BANDUNG - KECAMATAN ".$row['NAMA_KEC']."
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>No Kelurahan</th>
                                        <th>Nama Kelurahan</th>
                                        <th>Laki-Laki</th>
                                        <th>Perempuan</th>
                                        <th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT SETUP_KEL.NO_KEC AS P6, SETUP_KEL.NO_KEL AS P1, SETUP_KEL.NAMA_KEL AS P2, LK AS P3, LP AS P4, LK+LP AS P5 FROM T5_KEPKEL_KELAMIN INNER JOIN SETUP_KEL ON SETUP_KEL.NO_KEL = T5_KEPKEL_KELAMIN.NO_KEL AND SETUP_KEL.NO_KEC = T5_KEPKEL_KELAMIN.NO_KEC AND SETUP_KEL.NO_KAB = T5_KEPKEL_KELAMIN.NO_KAB AND SETUP_KEL.NO_PROP = T5_KEPKEL_KELAMIN.NO_PROP WHERE T5_KEPKEL_KELAMIN.NO_PROP ='32' AND T5_KEPKEL_KELAMIN.NO_KAB ='73' AND T5_KEPKEL_KELAMIN.NO_KEC ='".$NOKEC."' AND T5_KEPKEL_KELAMIN.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND T5_KEPKEL_KELAMIN.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr class='gradeA'>";
                                    echo "<td align='center'>".htmlentities($row['P1'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P2'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P3'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P4'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P5'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='keluarga-1/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
                                    echo "</tr>";
									}
									
								echo"</tbody>
								</thead>
							</table>
						</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
	} ELSE if($_REQUEST['NO_KEC']<>"0" && $_REQUEST['NO_KEL']<>"0"){
		//DATA YANG DI PILIH APABILA MEMILIH KATEGORI KELURAHAN
		$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL ='".$NOKEL."'";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		$row = oci_fetch_array($stmt);
		ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL KEPALA KELUARGA MENURUT JENIS KELAMIN KOTA BANDUNG - KELURAHAN ".$row['NAMA_KEL']."
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>No Kelurahan</th>
                                        <th>Nama Kelurahan</th>
                                        <th>Laki-Laki</th>
                                        <th>Perempuan</th>
                                        <th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT SETUP_KEL.NO_KEC AS P6, SETUP_KEL.NO_KEL AS P1, SETUP_KEL.NAMA_KEL AS P2, LK AS P3, LP AS P4, LK+LP AS P5 FROM T5_KEPKEL_KELAMIN INNER JOIN SETUP_KEL ON SETUP_KEL.NO_KEL = T5_KEPKEL_KELAMIN.NO_KEL AND SETUP_KEL.NO_KEC = T5_KEPKEL_KELAMIN.NO_KEC AND SETUP_KEL.NO_KAB = T5_KEPKEL_KELAMIN.NO_KAB AND SETUP_KEL.NO_PROP = T5_KEPKEL_KELAMIN.NO_PROP WHERE T5_KEPKEL_KELAMIN.NO_PROP ='32' AND T5_KEPKEL_KELAMIN.NO_KAB ='73' AND T5_KEPKEL_KELAMIN.NO_KEC ='".$NOKEC."' AND T5_KEPKEL_KELAMIN.NO_KEL ='".$NOKEL."' AND T5_KEPKEL_KELAMIN.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND T5_KEPKEL_KELAMIN.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr class='gradeA'>";
                                    echo "<td align='center'>".htmlentities($row['P1'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P2'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P3'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P4'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P5'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='keluarga-1/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
                                    echo "</tr>";
									}
									
								echo"</tbody>
								</thead>
							</table>
						</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
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
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL KEPALA KELUARGA MENURUT PENDIDIKAN TERAKHIR KOTA BANDUNG
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Belum Sekolah</th>
                                        <th>Belum Tamat Sd</th>
                                        <th>Tamat Sd</th>
										<th>Tamat Smp</th>
										<th>Tamat Sma</th>
                                        <th>D-I/ D-II</th>
                                        <th>D-III</th>
										<th>D-IV/ SI</th>
										<th>S-II</th>
										<th>S-III</th>
										<th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT a.NO_KEC as P1, a.NAMA_KEC AS P2, SUM(b.PDD01) AS P3, SUM(b.PDD02) AS P4, SUM(b.PDD03) AS P5,SUM(b.PDD04) AS P6, SUM(b.PDD05) AS P7, SUM(b.PDD06) AS P8,SUM(b.PDD07) AS P9, SUM(b.PDD08) AS P10, SUM(b.PDD09) AS P11,SUM(b.PDD10) AS P12, SUM(b.PDD01)+SUM(b.PDD02)+SUM(b.PDD03)+SUM(b.PDD04)+SUM(b.PDD05)+SUM(b.PDD06)+SUM(b.PDD07)+SUM(b.PDD08)+SUM(b.PDD09)+SUM(b.PDD10) AS P13
									FROM SETUP_KEC a INNER JOIN T5_KEPKEL_PENDIDIKAN b
									ON a.NO_KEC=b.NO_KEC WHERE a.NO_PROP='32' AND a.NO_KAB ='73' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
									GROUP BY a.NO_KEC, a.NAMA_KEC ORDER BY a.NO_KEC";
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
                                    echo "<td class='center'>".htmlentities($row['P7'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P8'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P9'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P10'])."</td>";
									echo "<td class='center'>".htmlentities($row['P11'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P12'])."</td>";
									echo "<td class='center'>".htmlentities($row['P13'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='keluarga-2/kecamatan/index.php?NOKEC=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
                                    echo "</tr>";
									}
									
								echo"</tbody>
								</thead>
							</table>
						</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
	 
	} ELSE if($_REQUEST['NO_KEC']<>"0" && $_REQUEST['NO_KEL']=="0"){
		//DATA DI KELUARKAN APABILA MEMILIH KATEGORI KECAMATAN
		$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		$row = oci_fetch_array($stmt);
		ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL KEPALA KELUARGA MENURUT PENDIDIKAN TERAKHIR KOTA BANDUNG - KECAMATAN ".$row['NAMA_KEC']."
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Belum Sekolah</th>
                                        <th>Belum Tamat Sd</th>
                                        <th>Tamat Sd</th>
										<th>Tamat Smp</th>
										<th>Tamat Sma</th>
                                        <th>D-I/ D-II</th>
                                        <th>D-III</th>
										<th>D-IV/ SI</th>
										<th>S-II</th>
										<th>S-III</th>
										<th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT a.NO_KEC AS P14, a.NO_KEL as P1, a.NAMA_KEL AS P2, SUM(b.PDD01) AS P3, SUM(b.PDD02) AS P4, SUM(b.PDD03) AS P5,SUM(b.PDD04) AS P6, SUM(b.PDD05) AS P7, SUM(b.PDD06) AS P8,SUM(b.PDD07) AS P9, SUM(b.PDD08) AS P10, SUM(b.PDD09) AS P11,SUM(b.PDD10) AS P12, SUM(b.PDD01)+SUM(b.PDD02)+SUM(b.PDD03)+SUM(b.PDD04)+SUM(b.PDD05)+SUM(b.PDD06)+SUM(b.PDD07)+SUM(b.PDD08)+SUM(b.PDD09)+SUM(b.PDD10) AS P13
									FROM SETUP_KEL a INNER JOIN T5_KEPKEL_PENDIDIKAN b
									ON a.NO_KEL=b.NO_KEL and a.NO_KEC=b.NO_KEC WHERE a.NO_PROP='32' AND a.NO_KAB ='73' and b.NO_KEC ='".$NOKEC."'  and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
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
                                    echo "<td class='center'>".htmlentities($row['P7'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P8'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P9'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P10'])."</td>";
									echo "<td class='center'>".htmlentities($row['P11'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P12'])."</td>";
									echo "<td class='center'>".htmlentities($row['P13'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='keluarga-2/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
                                    echo "</tr>";
									}
									
								echo"</tbody>
								</thead>
							</table>
						</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
	} ELSE if($_REQUEST['NO_KEC']<>"0" && $_REQUEST['NO_KEL']<>"0"){
		//DATA YANG DI PILIH APABILA MEMILIH KATEGORI KELURAHAN
		$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL ='".$NOKEL."'";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		$row = oci_fetch_array($stmt);
		ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL KEPALA KELUARGA MENURUT PENDIDIKAN TERAKHIR KOTA BANDUNG - KELURAHAN ".$row['NAMA_KEL']."
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Belum Sekolah</th>
                                        <th>Belum Tamat Sd</th>
                                        <th>Tamat Sd</th>
										<th>Tamat Smp</th>
										<th>Tamat Sma</th>
                                        <th>D-I/ D-II</th>
                                        <th>D-III</th>
										<th>D-IV/ SI</th>
										<th>S-II</th>
										<th>S-III</th>
										<th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT a.NO_KEC AS P14, a.NO_KEL as P1, a.NAMA_KEL AS P2, SUM(b.PDD01) AS P3, SUM(b.PDD02) AS P4, SUM(b.PDD03) AS P5,SUM(b.PDD04) AS P6, SUM(b.PDD05) AS P7, SUM(b.PDD06) AS P8,SUM(b.PDD07) AS P9, SUM(b.PDD08) AS P10, SUM(b.PDD09) AS P11,SUM(b.PDD10) AS P12, SUM(b.PDD01)+SUM(b.PDD02)+SUM(b.PDD03)+SUM(b.PDD04)+SUM(b.PDD05)+SUM(b.PDD06)+SUM(b.PDD07)+SUM(b.PDD08)+SUM(b.PDD09)+SUM(b.PDD10) AS P13
									FROM SETUP_KEL a INNER JOIN T5_KEPKEL_PENDIDIKAN b
									ON a.NO_KEL=b.NO_KEL and a.NO_KEC=b.NO_KEC WHERE a.NO_PROP='32' AND a.NO_KAB ='73' and b.NO_KEC ='".$NOKEC."' and b.NO_KEL ='".$NOKEL."' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
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
                                    echo "<td class='center'>".htmlentities($row['P7'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P8'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P9'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P10'])."</td>";
									echo "<td class='center'>".htmlentities($row['P11'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P12'])."</td>";
									echo "<td class='center'>".htmlentities($row['P13'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='keluarga-2/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
                                    echo "</tr>";
									}
									
								echo"</tbody>
								</thead>
							</table>
						</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
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
	$sql= "SELECT * FROM T5_KEPKEL_STATUS_PERKAWINAN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
	    $num_rows=oci_fetch($stmt);
	   if($num_rows>0){
	if($_REQUEST['NO_KEC']=="0" && $_REQUEST['NO_KEL']=="0")
	{
		//HASIL YANG DI KELUARKAN APABILA DATA TELAH TEPAT, KECAMATAN DAN KELURAHAN DI TAMPILKAN SEMUA
	ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL KEPALA KELUARGA MENURUT STATUS PERKAWINAN KOTA BANDUNG
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Belum Kawin</th>
                                        <th>Kawin</th>
                                        <th>Cerai Hidup</th>
										<th>Cerai Mati</th>
										<th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT a.NO_KEC as P1, a.NAMA_KEC AS P2, SUM(b.BELUM_KAWIN) AS P3, SUM(b.KAWIN) AS P4, SUM(b.CERAI_HIDUP) AS P5,SUM(b.CERAI_MATI) AS P6, SUM(b.KAWIN)+SUM(b.BELUM_KAWIN)+SUM(b.CERAI_HIDUP)+SUM(b.CERAI_MATI) AS P7
									FROM SETUP_KEC a INNER JOIN T5_KEPKEL_STATUS_PERKAWINAN b
									ON a.NO_KEC=b.NO_KEC WHERE a.NO_PROP='32' AND a.NO_KAB ='73' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
									GROUP BY a.NO_KEC, a.NAMA_KEC ORDER BY a.NO_KEC";
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
                                    echo "<td class='center'>".htmlentities($row['P7'])."</td>";
                                    echo "<td class='center' align='center'><a target='_blank' href='keluarga-3/kecamatan/index.php?NOKEC=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
                                    echo "</tr>";
                                   
									}
									
								echo"</tbody>
								</thead>
							</table>
						</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
	 
	} ELSE if($_REQUEST['NO_KEC']<>"0" && $_REQUEST['NO_KEL']=="0"){
		//DATA DI KELUARKAN APABILA MEMILIH KATEGORI KECAMATAN
		$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		$row = oci_fetch_array($stmt);
		ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL KEPALA KELUARGA MENURUT STATUS PERKAWINAN KOTA BANDUNG - KECAMATAN ".$row['NAMA_KEC']."
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Belum Kawin</th>
                                        <th>Kawin</th>
                                        <th>Cerai Hidup</th>
										<th>Cerai Mati</th>
										<th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT a.NO_KEC as P8, a.NO_KEL as P1, a.NAMA_KEL AS P2, SUM(b.BELUM_KAWIN) AS P3, SUM(b.KAWIN) AS P4, SUM(b.CERAI_HIDUP) AS P5,SUM(b.CERAI_MATI) AS P6, SUM(b.KAWIN)+SUM(b.BELUM_KAWIN)+SUM(b.CERAI_HIDUP)+SUM(b.CERAI_MATI) AS P7
									FROM SETUP_KEL a INNER JOIN T5_KEPKEL_STATUS_PERKAWINAN b
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
                                    echo "<td class='center'>".htmlentities($row['P7'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='keluarga-3/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
                                    echo "</tr>";
									}
									
								echo"</tbody>
								</thead>
							</table>
						</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
	} ELSE if($_REQUEST['NO_KEC']<>"0" && $_REQUEST['NO_KEL']<>"0"){
		//DATA YANG DI PILIH APABILA MEMILIH KATEGORI KELURAHAN
		$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL ='".$NOKEL."'";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		$row = oci_fetch_array($stmt);
		ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL KEPALA KELUARGA MENURUT STATUS PERKAWINAN KOTA BANDUNG - KELURAHAN ".$row['NAMA_KEL']."
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Belum Kawin</th>
                                        <th>Kawin</th>
                                        <th>Cerai Hidup</th>
										<th>Cerai Mati</th>
										<th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT a.NO_KEC as P8, a.NO_KEL as P1, a.NAMA_KEL AS P2, SUM(b.BELUM_KAWIN) AS P3, SUM(b.KAWIN) AS P4, SUM(b.CERAI_HIDUP) AS P5,SUM(b.CERAI_MATI) AS P6, SUM(b.KAWIN)+SUM(b.BELUM_KAWIN)+SUM(b.CERAI_HIDUP)+SUM(b.CERAI_MATI) AS P7
									FROM SETUP_KEL a INNER JOIN T5_KEPKEL_STATUS_PERKAWINAN b
									ON a.NO_KEC=b.NO_KEC and a.NO_KEL=b.NO_KEL  WHERE a.NO_PROP='32' AND a.NO_KAB ='73' AND a.NO_KEC ='".$NOKEC."' and a.NO_KEL='".$NOKEL."' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
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
                                    echo "<td class='center'>".htmlentities($row['P7'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='keluarga-1/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
                                    echo "</tr>";
									}
									
								echo"</tbody>
								</thead>
							</table>
						</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
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
	$sql= "SELECT * FROM T5_KEPKEL_GOLONGAN_DARAH WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
	    $num_rows=oci_fetch($stmt);
	   if($num_rows>0){
	if($_REQUEST['NO_KEC']=="0" && $_REQUEST['NO_KEL']=="0")
	{
		//HASIL YANG DI KELUARKAN APABILA DATA TELAH TEPAT, KECAMATAN DAN KELURAHAN DI TAMPILKAN SEMUA
	ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL KEPALA KELUARGA MENURUT GOLONGAN DARAH KOTA BANDUNG
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kecamatan</th>
                                        <th>A</th>
                                        <th>B</th>
                                        <th>AB</th>
										<th>O</th>
										<th>A+</th>
                                        <th>A-</th>
                                        <th>B+</th>
										<th>B-</th>
										<th>AB+</th>
                                        <th>AB-</th>
                                        <th>O+</th>
										<th>O-</th>
										<th>Tidak Tahu</th>
										<th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT a.NO_KEC as P1, a.NAMA_KEC AS P2, SUM(b.A) AS P3,SUM(b.B) AS P4,SUM(b.AB) AS P5,SUM(b.O) AS P6,SUM(b.A_POS) AS P7,SUM(b.A_MIN) AS P8,SUM(b.B_POS) AS P9,SUM(b.B_MIN) AS P10,SUM(b.AB_POS) AS P11,SUM(b.AB_MIN) AS P12,SUM(b.O_POS) AS P13,SUM(b.O_MIN) AS P14, SUM(b.TIDAK_TAHU) AS P15, SUM(A) +SUM(B) +SUM(AB) +SUM(O) +SUM(A_POS) +SUM(A_MIN) +SUM(B_POS)+SUM(B_MIN) +SUM(AB_POS)+SUM(AB_MIN) +SUM(O_POS) + SUM(O_MIN) + SUM(TIDAK_TAHU) as P16
									FROM SETUP_KEC a INNER JOIN T5_KEPKEL_GOLONGAN_DARAH b
									ON a.NO_KEC=b.NO_KEC WHERE a.NO_PROP='32' AND a.NO_KAB ='73' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
									GROUP BY a.NO_KEC, a.NAMA_KEC ORDER BY a.NO_KEC";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr class='gradeA'>";
                                    echo "<td align='center'>".htmlentities($row['P1'])."</div></td>";
                                    echo "<td class='center'>".htmlentities($row['P2'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P3'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P4'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P5'])."</td>";
									echo "<td align='center'>".htmlentities($row['P6'])."</div></td>";
                                    echo "<td class='center'>".htmlentities($row['P7'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P8'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P9'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P10'])."</td>";
									echo "<td align='center'>".htmlentities($row['P11'])."</div></td>";
                                    echo "<td class='center'>".htmlentities($row['P12'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P13'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P14'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P15'])."</td>";
									echo "<td class='center'>".htmlentities($row['P16'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='keluarga-4/kecamatan/index.php?NOKEC=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
                                    echo "</tr>";
									}
									
								echo"</tbody>
								</thead>
							</table>
						</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
	 
	} ELSE if($_REQUEST['NO_KEC']<>"0" && $_REQUEST['NO_KEL']=="0"){
		//DATA DI KELUARKAN APABILA MEMILIH KATEGORI KECAMATAN
		$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		$row = oci_fetch_array($stmt);
		ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL KEPALA KELUARGA MENURUT GOLONGAN DARAH KOTA BANDUNG - KECAMATAN ".$row['NAMA_KEC']."
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kecamatan</th>
                                        <th>A</th>
                                        <th>B</th>
                                        <th>AB</th>
										<th>O</th>
										<th>A+</th>
                                        <th>A-</th>
                                        <th>B+</th>
										<th>B-</th>
										<th>AB+</th>
                                        <th>AB-</th>
                                        <th>O+</th>
										<th>O-</th>
										<th>Tidak Tahu</th>
										<th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT a.NO_KEC as P17, a.NO_KEL as P1, a.NAMA_KEL AS P2, SUM(b.A) AS P3,SUM(b.B) AS P4,SUM(b.AB) AS P5,SUM(b.O) AS P6,SUM(b.A_POS) AS P7,SUM(b.A_MIN) AS P8,SUM(b.B_POS) AS P9,SUM(b.B_MIN) AS P10,SUM(b.AB_POS) AS P11,SUM(b.AB_MIN) AS P12,SUM(b.O_POS) AS P13,SUM(b.O_MIN) AS P14, SUM(b.TIDAK_TAHU) AS P15, SUM(A) +SUM(B) +SUM(AB) +SUM(O) +SUM(A_POS) +SUM(A_MIN) +SUM(B_POS)+SUM(B_MIN) +SUM(AB_POS)+SUM(AB_MIN) +SUM(O_POS) + SUM(O_MIN) + SUM(TIDAK_TAHU) as P16
									FROM SETUP_KEL a INNER JOIN T5_KEPKEL_GOLONGAN_DARAH b
									ON a.NO_KEC=b.NO_KEC and a.NO_KEL=b.NO_KEL  WHERE a.NO_PROP='32' AND a.NO_KAB ='73' AND a.NO_KEC ='".$NOKEC."' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
									GROUP BY a.NO_KEC, a.NO_KEL, a.NAMA_KEL ORDER BY a.NO_KEL";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr class='gradeA'>";
                                    echo "<td align='center'>".htmlentities($row['P1'])."</div></td>";
                                    echo "<td class='center'>".htmlentities($row['P2'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P3'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P4'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P5'])."</td>";
									echo "<td align='center'>".htmlentities($row['P6'])."</div></td>";
                                    echo "<td class='center'>".htmlentities($row['P7'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P8'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P9'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P10'])."</td>";
									echo "<td align='center'>".htmlentities($row['P11'])."</div></td>";
                                    echo "<td class='center'>".htmlentities($row['P12'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P13'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P14'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P15'])."</td>";
									echo "<td class='center'>".htmlentities($row['P16'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='keluarga-4/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
                                    echo "</tr>";
									}
									
								echo"</tbody>
								</thead>
							</table>
						</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
	} ELSE if($_REQUEST['NO_KEC']<>"0" && $_REQUEST['NO_KEL']<>"0"){
		//DATA YANG DI PILIH APABILA MEMILIH KATEGORI KELURAHAN
		$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL ='".$NOKEL."'";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		$row = oci_fetch_array($stmt);
		ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL KEPALA KELUARGA MENURUT GOLONGAN DARAH KOTA BANDUNG - KELURAHAN ".$row['NAMA_KEL']."
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kecamatan</th>
                                        <th>A</th>
                                        <th>B</th>
                                        <th>AB</th>
										<th>O</th>
										<th>A+</th>
                                        <th>A-</th>
                                        <th>B+</th>
										<th>B-</th>
										<th>AB+</th>
                                        <th>AB-</th>
                                        <th>O+</th>
										<th>O-</th>
										<th>Tidak Tahu</th>
										<th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT a.NO_KEC as P17, a.NO_KEL as P1, a.NAMA_KEL AS P2, SUM(b.A) AS P3,SUM(b.B) AS P4,SUM(b.AB) AS P5,SUM(b.O) AS P6,SUM(b.A_POS) AS P7,SUM(b.A_MIN) AS P8,SUM(b.B_POS) AS P9,SUM(b.B_MIN) AS P10,SUM(b.AB_POS) AS P11,SUM(b.AB_MIN) AS P12,SUM(b.O_POS) AS P13,SUM(b.O_MIN) AS P14, SUM(b.TIDAK_TAHU) AS P15, SUM(A) +SUM(B) +SUM(AB) +SUM(O) +SUM(A_POS) +SUM(A_MIN) +SUM(B_POS)+SUM(B_MIN) +SUM(AB_POS)+SUM(AB_MIN) +SUM(O_POS) + SUM(O_MIN) + SUM(TIDAK_TAHU) as P16
									FROM SETUP_KEL a INNER JOIN T5_KEPKEL_GOLONGAN_DARAH b
									ON a.NO_KEC=b.NO_KEC and a.NO_KEL=b.NO_KEL  WHERE a.NO_PROP='32' AND a.NO_KAB ='73' AND a.NO_KEC ='".$NOKEC."' AND a.NO_KEL ='".$NOKEL."' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
									GROUP BY a.NO_KEC, a.NO_KEL, a.NAMA_KEL ORDER BY a.NO_KEL";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr class='gradeA'>";
                                    echo "<td align='center'>".htmlentities($row['P1'])."</div></td>";
                                    echo "<td class='center'>".htmlentities($row['P2'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P3'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P4'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P5'])."</td>";
									echo "<td align='center'>".htmlentities($row['P6'])."</div></td>";
                                    echo "<td class='center'>".htmlentities($row['P7'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P8'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P9'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P10'])."</td>";
									echo "<td align='center'>".htmlentities($row['P11'])."</div></td>";
                                    echo "<td class='center'>".htmlentities($row['P12'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P13'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P14'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P15'])."</td>";
									echo "<td class='center'>".htmlentities($row['P16'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='keluarga-4/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
                                    echo "</tr>";
									}
									
								echo"</tbody>
								</thead>
							</table>
						</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
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
	$sql= "SELECT * FROM T5_KEPKEL_AGAMA WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
	    $num_rows=oci_fetch($stmt);
	   if($num_rows>0){
	if($_REQUEST['NO_KEC']=="0" && $_REQUEST['NO_KEL']=="0")
	{
		//HASIL YANG DI KELUARKAN APABILA DATA TELAH TEPAT, KECAMATAN DAN KELURAHAN DI TAMPILKAN SEMUA
	ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL KEPALA KELUARGA MENURUT AGAMA KOTA BANDUNG
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Islam</th>
                                        <th>Kristen</th>
                                        <th>Katholik</th>
										<th>Hindu</th>
										<th>Budha</th>
                                        <th>Konghucu</th>
                                        <th>Kepercayaan</th>
										<th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT a.NO_KEC as P1, a.NAMA_KEC AS P2, SUM(b.ISLAM) AS P3,SUM(b.KRISTEN) AS P4,SUM(b.KATHOLIK) AS P5,SUM(b.HINDU) AS P6,SUM(b.BUDHA) AS P7,SUM(b.KONGHUCU) AS P8,SUM(b.KEPERCAYAAN) AS P9,SUM(b.ISLAM) +SUM(b.KRISTEN) +SUM(b.KATHOLIK) +SUM(b.HINDU) +SUM(b.BUDHA) +SUM(b.KONGHUCU) +SUM(b.KEPERCAYAAN) AS P10 
									FROM SETUP_KEC a INNER JOIN T5_KEPKEL_AGAMA b
									ON a.NO_KEC=b.NO_KEC  WHERE a.NO_PROP='32' AND a.NO_KAB ='73' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
									GROUP BY a.NO_KEC, a.NAMA_KEC ORDER BY a.NO_KEC";
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
                                    echo "<td class='center'>".htmlentities($row['P7'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P8'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P9'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P10'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='keluarga-5/kecamatan/index.php?NOKEC=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
                                    echo "</tr>";
									}
									
								echo"</tbody>
								</thead>
							</table>
						</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
	 
	 
	} ELSE if($_REQUEST['NO_KEC']<>"0" && $_REQUEST['NO_KEL']=="0"){
		//DATA DI KELUARKAN APABILA MEMILIH KATEGORI KECAMATAN
		$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		$row = oci_fetch_array($stmt);
		ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL KEPALA KELUARGA MENURUT AGAMA KOTA BANDUNG - KECAMATAN ".$row['NAMA_KEC']."
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Islam</th>
                                        <th>Kristen</th>
                                        <th>Katholik</th>
										<th>Hindu</th>
										<th>Budha</th>
                                        <th>Konghucu</th>
                                        <th>Kepercayaan</th>
										<th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT a.NO_KEC as P11, a.NO_KEL as P1, a.NAMA_KEL AS P2, SUM(b.ISLAM) AS P3,SUM(b.KRISTEN) AS P4,SUM(b.KATHOLIK) AS P5,SUM(b.HINDU) AS P6,SUM(b.BUDHA) AS P7,SUM(b.KONGHUCU) AS P8,SUM(b.KEPERCAYAAN) AS P9,SUM(b.ISLAM) +SUM(b.KRISTEN) +SUM(b.KATHOLIK) +SUM(b.HINDU) +SUM(b.BUDHA) +SUM(b.KONGHUCU) +SUM(b.KEPERCAYAAN) AS P10 
									FROM SETUP_KEL a INNER JOIN T5_KEPKEL_AGAMA b
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
                                    echo "<td class='center'>".htmlentities($row['P7'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P8'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P9'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P10'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='keluarga-5/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
                                    echo "</tr>";
									}
									
								echo"</tbody>
								</thead>
							</table>
						</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
	} ELSE if($_REQUEST['NO_KEC']<>"0" && $_REQUEST['NO_KEL']<>"0"){
		//DATA YANG DI PILIH APABILA MEMILIH KATEGORI KELURAHAN
		$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL ='".$NOKEL."'";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		$row = oci_fetch_array($stmt);
		ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL KEPALA KELUARGA MENURUT AGAMA KOTA BANDUNG - KELURAHAN ".$row['NAMA_KEL']."
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Islam</th>
                                        <th>Kristen</th>
                                        <th>Katholik</th>
										<th>Hindu</th>
										<th>Budha</th>
                                        <th>Konghucu</th>
                                        <th>Kepercayaan</th>
										<th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT a.NO_KEC as P11, a.NO_KEL as P1, a.NAMA_KEL AS P2, SUM(b.ISLAM) AS P3,SUM(b.KRISTEN) AS P4,SUM(b.KATHOLIK) AS P5,SUM(b.HINDU) AS P6,SUM(b.BUDHA) AS P7,SUM(b.KONGHUCU) AS P8,SUM(b.KEPERCAYAAN) AS P9,SUM(b.ISLAM) +SUM(b.KRISTEN) +SUM(b.KATHOLIK) +SUM(b.HINDU) +SUM(b.BUDHA) +SUM(b.KONGHUCU) +SUM(b.KEPERCAYAAN) AS P10 
									FROM SETUP_KEL a INNER JOIN T5_KEPKEL_AGAMA b
									ON a.NO_KEC=b.NO_KEC and a.NO_KEL=b.NO_KEL  WHERE a.NO_PROP='32' AND a.NO_KAB ='73' AND a.NO_KEC ='".$NOKEC."' AND a.NO_KEL ='".$NOKEL."' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
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
                                    echo "<td class='center'>".htmlentities($row['P7'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P8'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P9'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P10'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='keluarga-5/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
                                    echo "</tr>";
									}
									
								echo"</tbody>
								</thead>
							</table>
						</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
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
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL KEPALA KELUARGA MENURUT PENYANDANG CACAT KOTA BANDUNG
                        </div>
                         <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Fisik</th>
                                        <th>Netra</th>
                                        <th>Rungu</th>
										<th>Mental</th>
										<th>Fisik Mental</th>
                                        <th>Lainnya</th>
										<th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT a.NO_KEC as P1, a.NAMA_KEC AS P2, SUM(b.FISIK) AS P3,SUM(b.NETRA) AS P4,SUM(b.RUNGU) AS P5,SUM(b.MENTAL) AS P6,SUM(b.FISIK_MENTAL) AS P7,SUM(b.LAINNYA) AS P8,SUM(b.FISIK) +SUM(b.NETRA) +SUM(b.RUNGU) +SUM(b.MENTAL) +SUM(b.FISIK_MENTAL)+SUM(b.LAINNYA) AS P9 
									FROM SETUP_KEC a INNER JOIN T5_KEPKEL_PENYANDANG_CACAT b
									ON a.NO_KEC=b.NO_KEC  WHERE a.NO_PROP='32' AND a.NO_KAB ='73' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
									GROUP BY a.NO_KEC, a.NAMA_KEC ORDER BY a.NO_KEC";
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
                                    echo "<td class='center'>".htmlentities($row['P7'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P8'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P9'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='keluarga-6/kecamatan/index.php?NOKEC=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
                                    echo "</tr>";
									}
									
								echo"</tbody>
								</thead>
							</table>
						</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
	 
	} ELSE if($_REQUEST['NO_KEC']<>"0" && $_REQUEST['NO_KEL']=="0"){
		//DATA DI KELUARKAN APABILA MEMILIH KATEGORI KECAMATAN
		$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		$row = oci_fetch_array($stmt);
		ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL KEPALA KELUARGA MENURUT PENYANDANG CACAT KOTA BANDUNG - KECAMATAN ".$row['NAMA_KEC']."
                        </div>
                         <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Fisik</th>
                                        <th>Netra</th>
                                        <th>Rungu</th>
										<th>Mental</th>
										<th>Fisik Mental</th>
                                        <th>Lainnya</th>
										<th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT a.NO_KEC as P10, a.NO_KEL as P1, a.NAMA_KEL AS P2, SUM(b.FISIK) AS P3,SUM(b.NETRA) AS P4,SUM(b.RUNGU) AS P5,SUM(b.MENTAL) AS P6,SUM(b.FISIK_MENTAL) AS P7,SUM(b.LAINNYA) AS P8,SUM(b.FISIK) +SUM(b.NETRA) +SUM(b.RUNGU) +SUM(b.MENTAL) +SUM(b.FISIK_MENTAL)+SUM(b.LAINNYA) AS P9 
									FROM SETUP_KEL a INNER JOIN T5_KEPKEL_PENYANDANG_CACAT b
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
                                    echo "<td class='center'>".htmlentities($row['P7'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P8'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P9'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='keluarga-6/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
                                    echo "</tr>";
									}
									
								echo"</tbody>
								</thead>
							</table>
						</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
	} ELSE if($_REQUEST['NO_KEC']<>"0" && $_REQUEST['NO_KEL']<>"0"){
		//DATA YANG DI PILIH APABILA MEMILIH KATEGORI KELURAHAN
		$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL ='".$NOKEL."'";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		$row = oci_fetch_array($stmt);
		ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL KEPALA KELUARGA MENURUT PENYANDANG CACAT KOTA BANDUNG - KELURAHAN ".$row['NAMA_KEL']."
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Fisik</th>
                                        <th>Netra</th>
                                        <th>Rungu</th>
										<th>Mental</th>
										<th>Fisik Mental</th>
                                        <th>Lainnya</th>
										<th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT a.NO_KEC as P10, a.NO_KEL as P1, a.NAMA_KEL AS P2, SUM(b.FISIK) AS P3,SUM(b.NETRA) AS P4,SUM(b.RUNGU) AS P5,SUM(b.MENTAL) AS P6,SUM(b.FISIK_MENTAL) AS P7,SUM(b.LAINNYA) AS P8,SUM(b.FISIK) +SUM(b.NETRA) +SUM(b.RUNGU) +SUM(b.MENTAL) +SUM(b.FISIK_MENTAL)+SUM(b.LAINNYA) AS P9 
									FROM SETUP_KEL a INNER JOIN T5_KEPKEL_PENYANDANG_CACAT b
									ON a.NO_KEC=b.NO_KEC and a.NO_KEL=b.NO_KEL  WHERE a.NO_PROP='32' AND a.NO_KAB ='73' AND a.NO_KEC ='".$NOKEC."' AND a.NO_KEL ='".$NOKEL."' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
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
                                    echo "<td class='center'>".htmlentities($row['P7'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P8'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P9'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='keluarga-6/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
                                    echo "</tr>";
									}
									
								echo"</tbody>
								</thead>
							</table>
						</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->";
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

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
<script src="../js/jquery.masked-input.js"></script>
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