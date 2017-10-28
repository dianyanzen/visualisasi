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
                                <li><a href="tbdkk.php">Kartu Keluarga</a>
                                </li>
                                <li class="active"><a href="tbdbiodata.php">Biodata</a>
                                </li>
                                <li><a href="tbdpindah.php">Pindah</a>
                                </li>
                                <li><a href="tbddatang.php">Datang</a>
                                </li>
                            </ul>
					
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="biodata-pills">
								<br>
                                    <div class="col-lg-12">
										<div class="panel panel-primary">
											<div class="panel-heading">
												Tabel Statistik Pendaftaran Penduduk WNI Kota Bandung - Biodata
											</div>
										<div class="panel-body" >
										
										<form method="post" name="formstable" id="formstable" action="tbdbiodata.php" role="form">
	
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
                                            <label>Pilih Jenis Tabel</label>
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
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT JENIS KELAMIN KOTA BANDUNG
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
									
									$sql= "SELECT a.NO_KEC as P1, a.NAMA_KEC AS P2, SUM(b.DAK_LK) AS P3,SUM(b.DAK_LP) AS P4, SUM(b.DAK_LK) +SUM(b.DAK_LP) AS P5
									FROM SETUP_KEC a INNER JOIN T5_STT_AGR_PENDUDUK b
									ON a.NO_KEC=b.NO_KEC  WHERE a.NO_PROP='32' AND a.NO_KAB ='73' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
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
									echo "<td class='center' align='center'><a target='_blank' href='biodata-1/kecamatan/index.php?NOKEC=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT JENIS KELAMIN KOTA BANDUNG - KECAMATAN ".$row['NAMA_KEC']."
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
									
									$sql= "SELECT a.NO_KEC as P10, a.NO_KEL as P1, a.NAMA_KEL AS P2, SUM(b.DAK_LK) AS P3,SUM(b.DAK_LP) AS P4, SUM(b.DAK_LK) +SUM(b.DAK_LP) AS P5
									FROM SETUP_KEL a INNER JOIN T5_STT_AGR_PENDUDUK b
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
									echo "<td class='center' align='center'><a target='_blank' href='biodata-1/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT JENIS KELAMIN KOTA BANDUNG - KELURAHAN ".$row['NAMA_KEL']."
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
									
									$sql= "SELECT a.NO_KEC as P10, a.NO_KEL as P1, a.NAMA_KEL AS P2, SUM(b.DAK_LK) AS P3,SUM(b.DAK_LP) AS P4, SUM(b.DAK_LK) +SUM(b.DAK_LP) AS P5
									FROM SETUP_KEL a INNER JOIN T5_STT_AGR_PENDUDUK b
									ON a.NO_KEC=b.NO_KEC and a.NO_KEL=b.NO_KEL  WHERE a.NO_PROP='32' AND a.NO_KAB ='73' AND a.NO_KEC ='".$NOKEC."' AND A.NO_KEL ='".$NOKEL."' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
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
									echo "<td class='center' align='center'><a target='_blank' href='biodata-1/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT STRUKTUR UMUR KOTA BANDUNG
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Struktur Umur</th>
                                        <th>Laki-Laki</th>
                                        <th>Perempuan </th>
                                        <th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT SORT AS P5,
										CASE WHEN SORT  = '0' THEN '0-4'
								        WHEN SORT = '1' THEN '5-9'
								        WHEN SORT = '2' THEN '10-14'
										WHEN SORT = '3' THEN '15-19'
										WHEN SORT = '4' THEN '20-24'
										WHEN SORT = '5' THEN '25-29'
										WHEN SORT = '6' THEN '30-34'
										WHEN SORT = '7' THEN '35-39'
										WHEN SORT = '8' THEN '40-44'
										WHEN SORT = '9' THEN '45-49'
										WHEN SORT = '10' THEN '50-54'
										WHEN SORT = '11' THEN '55-59'
										WHEN SORT = '12' THEN '60-64'
										WHEN SORT = '13' THEN '65-69'
										WHEN SORT = '14' THEN '70-74'
    								    ELSE '>75' END AS P1, 
    								    SUM(LAKI_LAKI) AS P2, SUM(PEREMPUAN) AS P3, SUM(LAKI_LAKI)+SUM(PEREMPUAN) AS P4
									FROM T5_STT_STRUKTUR_UMUR WHERE NO_PROP='32' AND NO_KAB ='73' AND BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
									GROUP BY SORT
									ORDER BY SORT";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$i=1;
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr class='gradeA'>";
                                    echo "<td align='center'>".$i++."</td>";
                                    echo "<td class='center'>".htmlentities($row['P1'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P2'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P3'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P4'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='biodata-2/index.php?SORT=".htmlentities($row['P5'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT STRUKTUR UMUR KOTA BANDUNG - KECAMATAN ".$row['NAMA_KEC']."
                        </div>
                         <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Struktur Umur</th>
                                        <th>Laki-Laki</th>
                                        <th>Perempuan </th>
                                        <th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT SORT AS P5,
										CASE WHEN SORT  = '0' THEN '0-4'
								        WHEN SORT = '1' THEN '5-9'
								        WHEN SORT = '2' THEN '10-14'
										WHEN SORT = '3' THEN '15-19'
										WHEN SORT = '4' THEN '20-24'
										WHEN SORT = '5' THEN '25-29'
										WHEN SORT = '6' THEN '30-34'
										WHEN SORT = '7' THEN '35-39'
										WHEN SORT = '8' THEN '40-44'
										WHEN SORT = '9' THEN '45-49'
										WHEN SORT = '10' THEN '50-54'
										WHEN SORT = '11' THEN '55-59'
										WHEN SORT = '12' THEN '60-64'
										WHEN SORT = '13' THEN '65-69'
										WHEN SORT = '14' THEN '70-74'
    								    ELSE '>75' END AS P1, 
    								    SUM(LAKI_LAKI) AS P2, SUM(PEREMPUAN) AS P3, SUM(LAKI_LAKI)+SUM(PEREMPUAN) AS P4
									FROM T5_STT_STRUKTUR_UMUR WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
									GROUP BY SORT
									ORDER BY SORT";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$i=1;
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr class='gradeA'>";
                                    echo "<td align='center'>".$i++."</td>";
                                    echo "<td class='center'>".htmlentities($row['P1'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P2'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P3'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P4'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='biodata-2/index.php?SORT=".htmlentities($row['P5'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT STRUKTUR UMUR KOTA BANDUNG - KELURAHAN ".$row['NAMA_KEL']."
                        </div>
                         <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Struktur Umur</th>
                                        <th>Laki-Laki</th>
                                        <th>Perempuan </th>
                                        <th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT SORT AS P5,
										CASE WHEN SORT  = '0' THEN '0-4'
								        WHEN SORT = '1' THEN '5-9'
								        WHEN SORT = '2' THEN '10-14'
										WHEN SORT = '3' THEN '15-19'
										WHEN SORT = '4' THEN '20-24'
										WHEN SORT = '5' THEN '25-29'
										WHEN SORT = '6' THEN '30-34'
										WHEN SORT = '7' THEN '35-39'
										WHEN SORT = '8' THEN '40-44'
										WHEN SORT = '9' THEN '45-49'
										WHEN SORT = '10' THEN '50-54'
										WHEN SORT = '11' THEN '55-59'
										WHEN SORT = '12' THEN '60-64'
										WHEN SORT = '13' THEN '65-69'
										WHEN SORT = '14' THEN '70-74'
    								    ELSE '>75' END AS P1, 
    								    SUM(LAKI_LAKI) AS P2, SUM(PEREMPUAN) AS P3, SUM(LAKI_LAKI)+SUM(PEREMPUAN) AS P4
									FROM T5_STT_STRUKTUR_UMUR WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."' AND BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
									GROUP BY SORT
									ORDER BY SORT";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$i=1;
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr class='gradeA'>";
                                    echo "<td align='center'>".$i++."</td>";
                                    echo "<td class='center'>".htmlentities($row['P1'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P2'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P3'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P4'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='biodata-2/index.php?SORT=".htmlentities($row['P5'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
	$sql= "SELECT * FROM T5_STT_STATUS_PERKAWINAN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT PENDIDIKAN TERAKHIR KOTA BANDUNG
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
									FROM SETUP_KEC a INNER JOIN T5_STT_PENDIDIKAN b
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
									echo "<td class='center' align='center'><a target='_blank' href='biodata-3/kecamatan/index.php?NOKEC=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT PENDIDIKAN TERAKHIR KOTA BANDUNG - KECAMATAN ".$row['NAMA_KEC']."
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
									FROM SETUP_KEL a INNER JOIN T5_STT_PENDIDIKAN b
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
									echo "<td class='center' align='center'><a target='_blank' href='biodata-3/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT PENDIDIKAN TERAKHIR KOTA BANDUNG - KELURAHAN ".$row['NAMA_KEL']."
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
									FROM SETUP_KEL a INNER JOIN T5_STT_PENDIDIKAN b
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
									echo "<td class='center' align='center'><a target='_blank' href='biodata-3/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
	$sql= "SELECT * FROM T5_STT_PEKERJAAN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT PEKERJAAN KOTA BANDUNG
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Pekerjaan</th>
										<th>Jumlah</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT KODE_PEKERJAAN AS P3,
      CASE WHEN KODE_PEKERJAAN  = '1' THEN 'Belum/Tidak Bekerja'
         WHEN KODE_PEKERJAAN = '2' THEN 'Mengurus Rumah Tangga'
         WHEN KODE_PEKERJAAN = '3' THEN 'Pelajar/Mahasiswa'
         WHEN KODE_PEKERJAAN = '4' THEN 'Pensiunan'
         WHEN KODE_PEKERJAAN = '5' THEN 'Pegawai Negeri Sipil(PNS)'
         WHEN KODE_PEKERJAAN = '6' THEN 'Tentara Nasional Indonesia (TNI)'
         WHEN KODE_PEKERJAAN = '7' THEN 'Kepolisian RI (POLRI)'
         WHEN KODE_PEKERJAAN = '8' THEN 'Perdagangan'
         WHEN KODE_PEKERJAAN = '9' THEN 'Petani/Pekebun'
         WHEN KODE_PEKERJAAN = '10' THEN 'Peternak'
         WHEN KODE_PEKERJAAN = '11' THEN 'Nelayan/Perikanan'
         WHEN KODE_PEKERJAAN = '12' THEN 'Industri'
         WHEN KODE_PEKERJAAN = '13' THEN 'Konstruksi'
         WHEN KODE_PEKERJAAN = '14' THEN 'Transportasi'
         WHEN KODE_PEKERJAAN = '15' THEN 'Karyawan Swasta'
         WHEN KODE_PEKERJAAN = '16' THEN 'Karyawan BUMN'
         WHEN KODE_PEKERJAAN = '17' THEN 'Karyawan BUMD'
         WHEN KODE_PEKERJAAN = '18' THEN 'Karyawan Honorer'
         WHEN KODE_PEKERJAAN = '19' THEN 'Buruh Harian Lepas'
         WHEN KODE_PEKERJAAN = '20' THEN 'Buruh Tani/Perkebunan'
         WHEN KODE_PEKERJAAN = '21' THEN 'Buruh Nelayan/Perikanan'
         WHEN KODE_PEKERJAAN = '22' THEN 'Buruh Peternakan'
         WHEN KODE_PEKERJAAN = '23' THEN 'Pembantu Rumah Tangga'
         WHEN KODE_PEKERJAAN = '24' THEN 'Tukang Cukur'
         WHEN KODE_PEKERJAAN = '25' THEN 'Tukang Listrik'
         WHEN KODE_PEKERJAAN = '26' THEN 'Tukang Batu'
         WHEN KODE_PEKERJAAN = '27' THEN 'Tukang Kayu'
         WHEN KODE_PEKERJAAN = '28' THEN 'Tukang Sol Sepatu'
         WHEN KODE_PEKERJAAN = '29' THEN 'Tukang Las/Pandai Besi'
         WHEN KODE_PEKERJAAN = '30' THEN 'Tukang Jahit'
         WHEN KODE_PEKERJAAN = '31' THEN 'Tukang Gigi'
         WHEN KODE_PEKERJAAN = '32' THEN 'Penata Rias'
         WHEN KODE_PEKERJAAN = '33' THEN 'Penata Busana'
         WHEN KODE_PEKERJAAN = '34' THEN 'Penata Rambut'
         WHEN KODE_PEKERJAAN = '35' THEN 'Mekanik'
         WHEN KODE_PEKERJAAN = '36' THEN 'Seniman'
         WHEN KODE_PEKERJAAN = '37' THEN 'Tabib'
         WHEN KODE_PEKERJAAN = '38' THEN 'Paraji'
         WHEN KODE_PEKERJAAN = '39' THEN 'Perancang Busana'
         WHEN KODE_PEKERJAAN = '40' THEN 'Penterjemah'
         WHEN KODE_PEKERJAAN = '41' THEN 'Imam Masjid'
         WHEN KODE_PEKERJAAN = '42' THEN 'Pendeta'
         WHEN KODE_PEKERJAAN = '43' THEN 'Pastor'
         WHEN KODE_PEKERJAAN = '44' THEN 'Wartawan'
         WHEN KODE_PEKERJAAN = '45' THEN 'Uztadz/Mubaligh'
         WHEN KODE_PEKERJAAN = '46' THEN 'Juru Masak'
         WHEN KODE_PEKERJAAN = '47' THEN 'Promotor Acara'
         WHEN KODE_PEKERJAAN = '48' THEN 'Anggota DPR RI'
         WHEN KODE_PEKERJAAN = '49' THEN 'Anggota DPD RI'
         WHEN KODE_PEKERJAAN = '50' THEN 'Anggota BPK'
         WHEN KODE_PEKERJAAN = '51' THEN 'Presiden'
         WHEN KODE_PEKERJAAN = '52' THEN 'Wakil Presiden'
         WHEN KODE_PEKERJAAN = '53' THEN 'Anggota Mahkamah Konstitusi'
         WHEN KODE_PEKERJAAN = '54' THEN 'Anggota Kabinet Kementrian'
         WHEN KODE_PEKERJAAN = '55' THEN 'Duta Besar'
         WHEN KODE_PEKERJAAN = '56' THEN 'Gubernur'
         WHEN KODE_PEKERJAAN = '57' THEN 'Wakil Gubernur'
         WHEN KODE_PEKERJAAN = '58' THEN 'Bupati'
         WHEN KODE_PEKERJAAN = '59' THEN 'Wakil Bupati'
         WHEN KODE_PEKERJAAN = '60' THEN 'Walikota'
         WHEN KODE_PEKERJAAN = '61' THEN 'Wakil Walikota'
         WHEN KODE_PEKERJAAN = '62' THEN 'Anggota DPRD PROP'
         WHEN KODE_PEKERJAAN = '63' THEN 'Anggota DPRD Kota'
         WHEN KODE_PEKERJAAN = '64' THEN 'Dosen'
         WHEN KODE_PEKERJAAN = '65' THEN 'Guru'
         WHEN KODE_PEKERJAAN = '66' THEN 'Pilot'
         WHEN KODE_PEKERJAAN = '67' THEN 'Pengacara'
         WHEN KODE_PEKERJAAN = '68' THEN 'Notaris'
         WHEN KODE_PEKERJAAN = '69' THEN 'Arsitek'
         WHEN KODE_PEKERJAAN = '70' THEN 'Akuntan'
         WHEN KODE_PEKERJAAN = '71' THEN 'Konsultan'
         WHEN KODE_PEKERJAAN = '72' THEN 'Dokter'
         WHEN KODE_PEKERJAAN = '73' THEN 'Bidan'
         WHEN KODE_PEKERJAAN = '74' THEN 'Perawat'
         WHEN KODE_PEKERJAAN = '75' THEN 'Apoteker'
         WHEN KODE_PEKERJAAN = '76' THEN 'Psikiater/Psikolog'
         WHEN KODE_PEKERJAAN = '77' THEN 'Penyiar Televisi'
         WHEN KODE_PEKERJAAN = '78' THEN 'Penyiar Radio'
         WHEN KODE_PEKERJAAN = '79' THEN 'Pelaut'
         WHEN KODE_PEKERJAAN = '80' THEN 'Peneliti'
         WHEN KODE_PEKERJAAN = '81' THEN 'Sopir'
         WHEN KODE_PEKERJAAN = '82' THEN 'Pialang'
         WHEN KODE_PEKERJAAN = '83' THEN 'Paranormal'
         WHEN KODE_PEKERJAAN = '84' THEN 'Pedagang'
         WHEN KODE_PEKERJAAN = '85' THEN 'Perangkat Desa'
         WHEN KODE_PEKERJAAN = '86' THEN 'Kepala Desa'
         WHEN KODE_PEKERJAAN = '87' THEN 'Biarawan/Biarawati'
         WHEN KODE_PEKERJAAN = '88' THEN 'Wiraswasta'
         ELSE 'Pekerjaan Lainnya' END AS P1, 
SUM(VALUE) AS P2 FROM T5_STT_PEKERJAAN  WHERE NO_PROP='32' AND NO_KAB ='73' AND BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 GROUP BY KODE_PEKERJAAN ORDER BY KODE_PEKERJAAN";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$i=1;
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr class='gradeA'>";
									echo "<td align='center'>".$i++."</td>";
                                    echo "<td class='center'>".htmlentities($row['P1'])."</div></td>";
                                    echo "<td align='right'>".htmlentities($row['P2'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='biodata-4/index.php?PKRJN=".htmlentities($row['P3'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT PEKERJAAN KOTA BANDUNG - KECAMATAN ".$row['NAMA_KEC']."
                        </div>
                         <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Pekerjaan</th>
										<th>Jumlah</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT KODE_PEKERJAAN AS P3,
      CASE WHEN KODE_PEKERJAAN  = '1' THEN 'Belum/Tidak Bekerja'
         WHEN KODE_PEKERJAAN = '2' THEN 'Mengurus Rumah Tangga'
         WHEN KODE_PEKERJAAN = '3' THEN 'Pelajar/Mahasiswa'
         WHEN KODE_PEKERJAAN = '4' THEN 'Pensiunan'
         WHEN KODE_PEKERJAAN = '5' THEN 'Pegawai Negeri Sipil(PNS)'
         WHEN KODE_PEKERJAAN = '6' THEN 'Tentara Nasional Indonesia (TNI)'
         WHEN KODE_PEKERJAAN = '7' THEN 'Kepolisian RI (POLRI)'
         WHEN KODE_PEKERJAAN = '8' THEN 'Perdagangan'
         WHEN KODE_PEKERJAAN = '9' THEN 'Petani/Pekebun'
         WHEN KODE_PEKERJAAN = '10' THEN 'Peternak'
         WHEN KODE_PEKERJAAN = '11' THEN 'Nelayan/Perikanan'
         WHEN KODE_PEKERJAAN = '12' THEN 'Industri'
         WHEN KODE_PEKERJAAN = '13' THEN 'Konstruksi'
         WHEN KODE_PEKERJAAN = '14' THEN 'Transportasi'
         WHEN KODE_PEKERJAAN = '15' THEN 'Karyawan Swasta'
         WHEN KODE_PEKERJAAN = '16' THEN 'Karyawan BUMN'
         WHEN KODE_PEKERJAAN = '17' THEN 'Karyawan BUMD'
         WHEN KODE_PEKERJAAN = '18' THEN 'Karyawan Honorer'
         WHEN KODE_PEKERJAAN = '19' THEN 'Buruh Harian Lepas'
         WHEN KODE_PEKERJAAN = '20' THEN 'Buruh Tani/Perkebunan'
         WHEN KODE_PEKERJAAN = '21' THEN 'Buruh Nelayan/Perikanan'
         WHEN KODE_PEKERJAAN = '22' THEN 'Buruh Peternakan'
         WHEN KODE_PEKERJAAN = '23' THEN 'Pembantu Rumah Tangga'
         WHEN KODE_PEKERJAAN = '24' THEN 'Tukang Cukur'
         WHEN KODE_PEKERJAAN = '25' THEN 'Tukang Listrik'
         WHEN KODE_PEKERJAAN = '26' THEN 'Tukang Batu'
         WHEN KODE_PEKERJAAN = '27' THEN 'Tukang Kayu'
         WHEN KODE_PEKERJAAN = '28' THEN 'Tukang Sol Sepatu'
         WHEN KODE_PEKERJAAN = '29' THEN 'Tukang Las/Pandai Besi'
         WHEN KODE_PEKERJAAN = '30' THEN 'Tukang Jahit'
         WHEN KODE_PEKERJAAN = '31' THEN 'Tukang Gigi'
         WHEN KODE_PEKERJAAN = '32' THEN 'Penata Rias'
         WHEN KODE_PEKERJAAN = '33' THEN 'Penata Busana'
         WHEN KODE_PEKERJAAN = '34' THEN 'Penata Rambut'
         WHEN KODE_PEKERJAAN = '35' THEN 'Mekanik'
         WHEN KODE_PEKERJAAN = '36' THEN 'Seniman'
         WHEN KODE_PEKERJAAN = '37' THEN 'Tabib'
         WHEN KODE_PEKERJAAN = '38' THEN 'Paraji'
         WHEN KODE_PEKERJAAN = '39' THEN 'Perancang Busana'
         WHEN KODE_PEKERJAAN = '40' THEN 'Penterjemah'
         WHEN KODE_PEKERJAAN = '41' THEN 'Imam Masjid'
         WHEN KODE_PEKERJAAN = '42' THEN 'Pendeta'
         WHEN KODE_PEKERJAAN = '43' THEN 'Pastor'
         WHEN KODE_PEKERJAAN = '44' THEN 'Wartawan'
         WHEN KODE_PEKERJAAN = '45' THEN 'Uztadz/Mubaligh'
         WHEN KODE_PEKERJAAN = '46' THEN 'Juru Masak'
         WHEN KODE_PEKERJAAN = '47' THEN 'Promotor Acara'
         WHEN KODE_PEKERJAAN = '48' THEN 'Anggota DPR RI'
         WHEN KODE_PEKERJAAN = '49' THEN 'Anggota DPD RI'
         WHEN KODE_PEKERJAAN = '50' THEN 'Anggota BPK'
         WHEN KODE_PEKERJAAN = '51' THEN 'Presiden'
         WHEN KODE_PEKERJAAN = '52' THEN 'Wakil Presiden'
         WHEN KODE_PEKERJAAN = '53' THEN 'Anggota Mahkamah Konstitusi'
         WHEN KODE_PEKERJAAN = '54' THEN 'Anggota Kabinet Kementrian'
         WHEN KODE_PEKERJAAN = '55' THEN 'Duta Besar'
         WHEN KODE_PEKERJAAN = '56' THEN 'Gubernur'
         WHEN KODE_PEKERJAAN = '57' THEN 'Wakil Gubernur'
         WHEN KODE_PEKERJAAN = '58' THEN 'Bupati'
         WHEN KODE_PEKERJAAN = '59' THEN 'Wakil Bupati'
         WHEN KODE_PEKERJAAN = '60' THEN 'Walikota'
         WHEN KODE_PEKERJAAN = '61' THEN 'Wakil Walikota'
         WHEN KODE_PEKERJAAN = '62' THEN 'Anggota DPRD PROP'
         WHEN KODE_PEKERJAAN = '63' THEN 'Anggota DPRD Kota'
         WHEN KODE_PEKERJAAN = '64' THEN 'Dosen'
         WHEN KODE_PEKERJAAN = '65' THEN 'Guru'
         WHEN KODE_PEKERJAAN = '66' THEN 'Pilot'
         WHEN KODE_PEKERJAAN = '67' THEN 'Pengacara'
         WHEN KODE_PEKERJAAN = '68' THEN 'Notaris'
         WHEN KODE_PEKERJAAN = '69' THEN 'Arsitek'
         WHEN KODE_PEKERJAAN = '70' THEN 'Akuntan'
         WHEN KODE_PEKERJAAN = '71' THEN 'Konsultan'
         WHEN KODE_PEKERJAAN = '72' THEN 'Dokter'
         WHEN KODE_PEKERJAAN = '73' THEN 'Bidan'
         WHEN KODE_PEKERJAAN = '74' THEN 'Perawat'
         WHEN KODE_PEKERJAAN = '75' THEN 'Apoteker'
         WHEN KODE_PEKERJAAN = '76' THEN 'Psikiater/Psikolog'
         WHEN KODE_PEKERJAAN = '77' THEN 'Penyiar Televisi'
         WHEN KODE_PEKERJAAN = '78' THEN 'Penyiar Radio'
         WHEN KODE_PEKERJAAN = '79' THEN 'Pelaut'
         WHEN KODE_PEKERJAAN = '80' THEN 'Peneliti'
         WHEN KODE_PEKERJAAN = '81' THEN 'Sopir'
         WHEN KODE_PEKERJAAN = '82' THEN 'Pialang'
         WHEN KODE_PEKERJAAN = '83' THEN 'Paranormal'
         WHEN KODE_PEKERJAAN = '84' THEN 'Pedagang'
         WHEN KODE_PEKERJAAN = '85' THEN 'Perangkat Desa'
         WHEN KODE_PEKERJAAN = '86' THEN 'Kepala Desa'
         WHEN KODE_PEKERJAAN = '87' THEN 'Biarawan/Biarawati'
         WHEN KODE_PEKERJAAN = '88' THEN 'Wiraswasta'
         ELSE 'Pekerjaan Lainnya' END AS P1, 
SUM(VALUE) AS P2 FROM T5_STT_PEKERJAAN  WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 GROUP BY KODE_PEKERJAAN ORDER BY KODE_PEKERJAAN";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$i=1;
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr class='gradeA'>";
									echo "<td align='center'>".$i++."</td>";
                                    echo "<td class='center'>".htmlentities($row['P1'])."</div></td>";
                                    echo "<td align='right'>".htmlentities($row['P2'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='biodata-4/index.php?PKRJN=".htmlentities($row['P3'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT PEKERJAAN KOTA BANDUNG - KELURAHAN ".$row['NAMA_KEL']."
                        </div>
                         <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Pekerjaan</th>
										<th>Jumlah</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT KODE_PEKERJAAN AS P3,
      CASE WHEN KODE_PEKERJAAN  = '1' THEN 'Belum/Tidak Bekerja'
         WHEN KODE_PEKERJAAN = '2' THEN 'Mengurus Rumah Tangga'
         WHEN KODE_PEKERJAAN = '3' THEN 'Pelajar/Mahasiswa'
         WHEN KODE_PEKERJAAN = '4' THEN 'Pensiunan'
         WHEN KODE_PEKERJAAN = '5' THEN 'Pegawai Negeri Sipil(PNS)'
         WHEN KODE_PEKERJAAN = '6' THEN 'Tentara Nasional Indonesia (TNI)'
         WHEN KODE_PEKERJAAN = '7' THEN 'Kepolisian RI (POLRI)'
         WHEN KODE_PEKERJAAN = '8' THEN 'Perdagangan'
         WHEN KODE_PEKERJAAN = '9' THEN 'Petani/Pekebun'
         WHEN KODE_PEKERJAAN = '10' THEN 'Peternak'
         WHEN KODE_PEKERJAAN = '11' THEN 'Nelayan/Perikanan'
         WHEN KODE_PEKERJAAN = '12' THEN 'Industri'
         WHEN KODE_PEKERJAAN = '13' THEN 'Konstruksi'
         WHEN KODE_PEKERJAAN = '14' THEN 'Transportasi'
         WHEN KODE_PEKERJAAN = '15' THEN 'Karyawan Swasta'
         WHEN KODE_PEKERJAAN = '16' THEN 'Karyawan BUMN'
         WHEN KODE_PEKERJAAN = '17' THEN 'Karyawan BUMD'
         WHEN KODE_PEKERJAAN = '18' THEN 'Karyawan Honorer'
         WHEN KODE_PEKERJAAN = '19' THEN 'Buruh Harian Lepas'
         WHEN KODE_PEKERJAAN = '20' THEN 'Buruh Tani/Perkebunan'
         WHEN KODE_PEKERJAAN = '21' THEN 'Buruh Nelayan/Perikanan'
         WHEN KODE_PEKERJAAN = '22' THEN 'Buruh Peternakan'
         WHEN KODE_PEKERJAAN = '23' THEN 'Pembantu Rumah Tangga'
         WHEN KODE_PEKERJAAN = '24' THEN 'Tukang Cukur'
         WHEN KODE_PEKERJAAN = '25' THEN 'Tukang Listrik'
         WHEN KODE_PEKERJAAN = '26' THEN 'Tukang Batu'
         WHEN KODE_PEKERJAAN = '27' THEN 'Tukang Kayu'
         WHEN KODE_PEKERJAAN = '28' THEN 'Tukang Sol Sepatu'
         WHEN KODE_PEKERJAAN = '29' THEN 'Tukang Las/Pandai Besi'
         WHEN KODE_PEKERJAAN = '30' THEN 'Tukang Jahit'
         WHEN KODE_PEKERJAAN = '31' THEN 'Tukang Gigi'
         WHEN KODE_PEKERJAAN = '32' THEN 'Penata Rias'
         WHEN KODE_PEKERJAAN = '33' THEN 'Penata Busana'
         WHEN KODE_PEKERJAAN = '34' THEN 'Penata Rambut'
         WHEN KODE_PEKERJAAN = '35' THEN 'Mekanik'
         WHEN KODE_PEKERJAAN = '36' THEN 'Seniman'
         WHEN KODE_PEKERJAAN = '37' THEN 'Tabib'
         WHEN KODE_PEKERJAAN = '38' THEN 'Paraji'
         WHEN KODE_PEKERJAAN = '39' THEN 'Perancang Busana'
         WHEN KODE_PEKERJAAN = '40' THEN 'Penterjemah'
         WHEN KODE_PEKERJAAN = '41' THEN 'Imam Masjid'
         WHEN KODE_PEKERJAAN = '42' THEN 'Pendeta'
         WHEN KODE_PEKERJAAN = '43' THEN 'Pastor'
         WHEN KODE_PEKERJAAN = '44' THEN 'Wartawan'
         WHEN KODE_PEKERJAAN = '45' THEN 'Uztadz/Mubaligh'
         WHEN KODE_PEKERJAAN = '46' THEN 'Juru Masak'
         WHEN KODE_PEKERJAAN = '47' THEN 'Promotor Acara'
         WHEN KODE_PEKERJAAN = '48' THEN 'Anggota DPR RI'
         WHEN KODE_PEKERJAAN = '49' THEN 'Anggota DPD RI'
         WHEN KODE_PEKERJAAN = '50' THEN 'Anggota BPK'
         WHEN KODE_PEKERJAAN = '51' THEN 'Presiden'
         WHEN KODE_PEKERJAAN = '52' THEN 'Wakil Presiden'
         WHEN KODE_PEKERJAAN = '53' THEN 'Anggota Mahkamah Konstitusi'
         WHEN KODE_PEKERJAAN = '54' THEN 'Anggota Kabinet Kementrian'
         WHEN KODE_PEKERJAAN = '55' THEN 'Duta Besar'
         WHEN KODE_PEKERJAAN = '56' THEN 'Gubernur'
         WHEN KODE_PEKERJAAN = '57' THEN 'Wakil Gubernur'
         WHEN KODE_PEKERJAAN = '58' THEN 'Bupati'
         WHEN KODE_PEKERJAAN = '59' THEN 'Wakil Bupati'
         WHEN KODE_PEKERJAAN = '60' THEN 'Walikota'
         WHEN KODE_PEKERJAAN = '61' THEN 'Wakil Walikota'
         WHEN KODE_PEKERJAAN = '62' THEN 'Anggota DPRD PROP'
         WHEN KODE_PEKERJAAN = '63' THEN 'Anggota DPRD Kota'
         WHEN KODE_PEKERJAAN = '64' THEN 'Dosen'
         WHEN KODE_PEKERJAAN = '65' THEN 'Guru'
         WHEN KODE_PEKERJAAN = '66' THEN 'Pilot'
         WHEN KODE_PEKERJAAN = '67' THEN 'Pengacara'
         WHEN KODE_PEKERJAAN = '68' THEN 'Notaris'
         WHEN KODE_PEKERJAAN = '69' THEN 'Arsitek'
         WHEN KODE_PEKERJAAN = '70' THEN 'Akuntan'
         WHEN KODE_PEKERJAAN = '71' THEN 'Konsultan'
         WHEN KODE_PEKERJAAN = '72' THEN 'Dokter'
         WHEN KODE_PEKERJAAN = '73' THEN 'Bidan'
         WHEN KODE_PEKERJAAN = '74' THEN 'Perawat'
         WHEN KODE_PEKERJAAN = '75' THEN 'Apoteker'
         WHEN KODE_PEKERJAAN = '76' THEN 'Psikiater/Psikolog'
         WHEN KODE_PEKERJAAN = '77' THEN 'Penyiar Televisi'
         WHEN KODE_PEKERJAAN = '78' THEN 'Penyiar Radio'
         WHEN KODE_PEKERJAAN = '79' THEN 'Pelaut'
         WHEN KODE_PEKERJAAN = '80' THEN 'Peneliti'
         WHEN KODE_PEKERJAAN = '81' THEN 'Sopir'
         WHEN KODE_PEKERJAAN = '82' THEN 'Pialang'
         WHEN KODE_PEKERJAAN = '83' THEN 'Paranormal'
         WHEN KODE_PEKERJAAN = '84' THEN 'Pedagang'
         WHEN KODE_PEKERJAAN = '85' THEN 'Perangkat Desa'
         WHEN KODE_PEKERJAAN = '86' THEN 'Kepala Desa'
         WHEN KODE_PEKERJAAN = '87' THEN 'Biarawan/Biarawati'
         WHEN KODE_PEKERJAAN = '88' THEN 'Wiraswasta'
         ELSE 'Pekerjaan Lainnya' END AS P1, 
SUM(VALUE) AS P2 FROM T5_STT_PEKERJAAN  WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL ='".$NOKEL."'AND BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 GROUP BY KODE_PEKERJAAN ORDER BY KODE_PEKERJAAN";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$i=1;
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr class='gradeA'>";
									echo "<td align='center'>".$i++."</td>";
                                    echo "<td class='center'>".htmlentities($row['P1'])."</div></td>";
                                    echo "<td align='right'>".htmlentities($row['P2'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='biodata-4/index.php?PKRJN=".htmlentities($row['P3'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
	$sql= "SELECT * FROM T5_STT_AGAMA WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT STATUS PERKAWINAN KOTA BANDUNG
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
									FROM SETUP_KEC a INNER JOIN T5_STT_STATUS_PERKAWINAN b
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
                                    echo "<td class='center' align='center'><a target='_blank' href='biodata-5/kecamatan/index.php?NOKEC=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT STATUS PERKAWINAN KOTA BANDUNG - KECAMATAN ".$row['NAMA_KEC']."
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
									FROM SETUP_KEL a INNER JOIN T5_STT_STATUS_PERKAWINAN b
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
									echo "<td class='center' align='center'><a target='_blank' href='biodata-5/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT STATUS PERKAWINAN KOTA BANDUNG - KELURAHAN ".$row['NAMA_KEL']."
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
									FROM SETUP_KEL a INNER JOIN T5_STT_STATUS_PERKAWINAN b
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
									echo "<td class='center' align='center'><a target='_blank' href='biodata-5/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT GOLONGAN DARAH KOTA BANDUNG
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
									FROM SETUP_KEC a INNER JOIN T5_STT_GOLONGAN_DARAH b
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
									echo "<td class='center' align='center'><a target='_blank' href='biodata-6/kecamatan/index.php?NOKEC=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT GOLONGAN DARAH KOTA BANDUNG - KECAMATAN ".$row['NAMA_KEC']."
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
									FROM SETUP_KEL a INNER JOIN T5_STT_GOLONGAN_DARAH b
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
									echo "<td class='center' align='center'><a target='_blank' href='biodata-6/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT GOLONGAN DARAH KOTA BANDUNG - KELURAHAN ".$row['NAMA_KEL']."
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
									FROM SETUP_KEL a INNER JOIN T5_STT_GOLONGAN_DARAH b
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
									echo "<td class='center' align='center'><a target='_blank' href='biodata-6/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
	//STATISTIK 7
	ELSE IF($_REQUEST['statistik']=="7"){
				//JIKA STATISTIK YANG DI PILIH VALUENYA = 7
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
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT AGAMA KOTA BANDUNG
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
									FROM SETUP_KEC a INNER JOIN T5_STT_AGAMA b
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
									echo "<td class='center' align='center'><a target='_blank' href='biodata-7/kecamatan/index.php?NOKEC=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT AGAMA KOTA BANDUNG - KECAMATAN ".$row['NAMA_KEC']."
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
									FROM SETUP_KEL a INNER JOIN T5_STT_AGAMA b
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
									echo "<td class='center' align='center'><a target='_blank' href='biodata-7/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT AGAMA KOTA BANDUNG - KELURAHAN ".$row['NAMA_KEL']."
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
									FROM SETUP_KEL a INNER JOIN T5_STT_AGAMA b
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
									echo "<td class='center' align='center'><a target='_blank' href='biodata-7/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
	//STATISTIK 8
	ELSE IF($_REQUEST['statistik']=="8"){
				//JIKA STATISTIK YANG DI PILIH VALUENYA = 6
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
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT PENYANDANG CACAT KOTA BANDUNG
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
									FROM SETUP_KEC a INNER JOIN T5_STT_PENYANDANG_CACAT b
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
									echo "<td class='center' align='center'><a target='_blank' href='biodata-8/kecamatan/index.php?NOKEC=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT PENYANDANG CACAT KOTA BANDUNG - KECAMATAN ".$row['NAMA_KEC']."
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
									FROM SETUP_KEL a INNER JOIN T5_STT_PENYANDANG_CACAT b
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
									echo "<td class='center' align='center'><a target='_blank' href='biodata-8/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT PENYANDANG CACAT KOTA BANDUNG - KELURAHAN ".$row['NAMA_KEL']."
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
									FROM SETUP_KEL a INNER JOIN T5_STT_PENYANDANG_CACAT b
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
									echo "<td class='center' align='center'><a target='_blank' href='biodata-8/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
	//STATISTIK 9
	ELSE IF($_REQUEST['statistik']=="9"){
				//JIKA STATISTIK YANG DI PILIH VALUENYA = 6
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
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT WAJIB KTP KOTA BANDUNG
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
									
									$sql= "SELECT a.NO_KEC as P1, a.NAMA_KEC AS P2, SUM(b.LK) AS P3,SUM(b.LP) AS P4, SUM(b.LK) +SUM(b.LP) AS P5
									FROM SETUP_KEC a INNER JOIN T5_STT_WAJIB_KTP b
									ON a.NO_KEC=b.NO_KEC  WHERE a.NO_PROP='32' AND a.NO_KAB ='73' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
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
									echo "<td class='center' align='center'><a target='_blank' href='biodata-9/kecamatan/index.php?NOKEC=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT WAJIB KTP KOTA BANDUNG - KECAMATAN ".$row['NAMA_KEC']."
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
									
									$sql= "SELECT a.NO_KEC as P10, a.NO_KEL as P1, a.NAMA_KEL AS P2, SUM(b.LK) AS P3,SUM(b.LP) AS P4, SUM(b.LK) +SUM(b.LP) AS P5
									FROM SETUP_KEL a INNER JOIN T5_STT_WAJIB_KTP b
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
									echo "<td class='center' align='center'><a target='_blank' href='biodata-9/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT WAJIB KTP KOTA BANDUNG - KELURAHAN ".$row['NAMA_KEL']."
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
									
									$sql= "SELECT a.NO_KEC as P10, a.NO_KEL as P1, a.NAMA_KEL AS P2, SUM(b.LK) AS P3,SUM(b.LP) AS P4, SUM(b.LK) +SUM(b.LP) AS P5
									FROM SETUP_KEL a INNER JOIN T5_STT_WAJIB_KTP b
									ON a.NO_KEC=b.NO_KEC and a.NO_KEL=b.NO_KEL  WHERE a.NO_PROP='32' AND a.NO_KAB ='73' AND a.NO_KEC ='".$NOKEC."' AND A.NO_KEL ='".$NOKEL."' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
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
									echo "<td class='center' align='center'><a target='_blank' href='biodata-9/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
	//STATISTIK 10
	ELSE IF($_REQUEST['statistik']=="10"){
				//JIKA STATISTIK YANG DI PILIH VALUENYA = 10
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
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT STATUS HUBUNGAN KELUARGA KOTA BANDUNG
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                     <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Kepala Keluarga</th>
                                        <th>Suami</th>
                                        <th>Istri</th>
										<th>Anak</th>
										<th>Menantu</th>
                                        <th>Cucu</th>
										<th>Orang Tua</th>
										<th>Mertua</th>
                                        <th>Famili Lain</th>
                                        <th>Pembantu</th>
										<th>Lainnya</th>
										<th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT a.NO_KEC as P1, a.NAMA_KEC AS P2, SUM(b.KEPALA_KELUARGA) AS P3, SUM(b.SUAMI) AS P4, SUM(b.ISTRI) AS P5,SUM(b.ANAK) AS P6, SUM(b.MENANTU) AS P7, SUM(b.CUCU) AS P8,SUM(b.ORANG_TUA) AS P9, SUM(b.MERTUA) AS P10, SUM(b.FAMILI_LAIN) AS P11,SUM(b.PEMBANTU) AS P12, SUM(b.LAINNYA) AS P13, SUM(b.SUAMI) + SUM(b.ISTRI) + SUM(b.ANAK) + SUM(b.MENANTU) + SUM(b.CUCU) + SUM(b.ORANG_TUA) + SUM(b.MERTUA) + SUM(b.FAMILI_LAIN) + SUM(b.PEMBANTU) + SUM (b.LAINNYA) AS P14
									FROM SETUP_KEC a INNER JOIN T5_STT_STATHBKEL b
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
                                   
									echo "<td class='center' align='center'><a target='_blank' href='biodata-10/kecamatan/index.php?NOKEC=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT STATUS HUBUNGAN KELUARGA KOTA BANDUNG - KECAMATAN ".$row['NAMA_KEC']."
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Kepala Keluarga</th>
                                        <th>Suami</th>
                                        <th>Istri</th>
										<th>Anak</th>
										<th>Menantu</th>
                                        <th>Cucu</th>
										<th>Orang Tua</th>
										<th>Mertua</th>
                                        <th>Famili Lain</th>
                                        <th>Pembantu</th>
										<th>Lainnya</th>
										<th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT a.NO_KEC as P15, a.NO_KEL as P1, a.NAMA_KEL AS P2, SUM(b.KEPALA_KELUARGA) AS P3, SUM(b.SUAMI) AS P4, SUM(b.ISTRI) AS P5,SUM(b.ANAK) AS P6, SUM(b.MENANTU) AS P7, SUM(b.CUCU) AS P8,SUM(b.ORANG_TUA) AS P9, SUM(b.MERTUA) AS P10, SUM(b.FAMILI_LAIN) AS P11,SUM(b.PEMBANTU) AS P12, SUM(b.LAINNYA) AS P13, SUM(b.SUAMI) + SUM(b.ISTRI) + SUM(b.ANAK) + SUM(b.MENANTU) + SUM(b.CUCU) + SUM(b.ORANG_TUA) + SUM(b.MERTUA) + SUM(b.FAMILI_LAIN) + SUM(b.PEMBANTU) + SUM (b.LAINNYA) AS P14
									FROM SETUP_KEL a INNER JOIN T5_STT_STATHBKEL b
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
									echo "<td class='center' align='center'><a target='_blank' href='biodata-10/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                            <i class='fa fa-table fa-fw'></i> TABEL PENDUDUK MENURUT STATUS HUBUNGAN KELUARGA KOTA BANDUNG - KELURAHAN ".$row['NAMA_KEL']."
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Kepala Keluarga</th>
                                        <th>Suami</th>
                                        <th>Istri</th>
										<th>Anak</th>
										<th>Menantu</th>
                                        <th>Cucu</th>
										<th>Orang Tua</th>
										<th>Mertua</th>
                                        <th>Famili Lain</th>
                                        <th>Pembantu</th>
										<th>Lainnya</th>
										<th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT a.NO_KEC as P15, a.NO_KEL as P1, a.NAMA_KEL AS P2, SUM(b.KEPALA_KELUARGA) AS P3, SUM(b.SUAMI) AS P4, SUM(b.ISTRI) AS P5,SUM(b.ANAK) AS P6, SUM(b.MENANTU) AS P7, SUM(b.CUCU) AS P8,SUM(b.ORANG_TUA) AS P9, SUM(b.MERTUA) AS P10, SUM(b.FAMILI_LAIN) AS P11,SUM(b.PEMBANTU) AS P12, SUM(b.LAINNYA) AS P13, SUM(b.SUAMI) + SUM(b.ISTRI) + SUM(b.ANAK) + SUM(b.MENANTU) + SUM(b.CUCU) + SUM(b.ORANG_TUA) + SUM(b.MERTUA) + SUM(b.FAMILI_LAIN) + SUM(b.PEMBANTU) + SUM (b.LAINNYA) AS P14
									FROM SETUP_KEL a INNER JOIN T5_STT_STATHBKEL b
									ON a.NO_KEC=b.NO_KEC and a.NO_KEL=b.NO_KEL  WHERE a.NO_PROP='32' AND a.NO_KAB ='73' AND a.NO_KEC ='".$NOKEC."' AND A.NO_KEL ='".$NOKEL."' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
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
									echo "<td class='center' align='center'><a target='_blank' href='biodata-10/kecamatan/kelurahan/index.php?NOKEL=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
	//STATISTIK 11
	ELSE IF($_REQUEST['statistik']=="11"){
				//JIKA STATISTIK YANG DI PILIH VALUENYA = 6
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
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL KEPEMILIKAN AKTA MENURUT STRUKTUR UMUR KOTA BANDUNG
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Struktur Umur</th>
                                        <th>Ada Akta</th>
                                        <th>Tidak Ada Akta</th>
                                        <th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT SORT AS P5,
										CASE WHEN SORT  = '0' THEN '0-4'
								        WHEN SORT = '1' THEN '5-9'
								        WHEN SORT = '2' THEN '10-14'
										WHEN SORT = '3' THEN '15-19'
										WHEN SORT = '4' THEN '20-24'
										WHEN SORT = '5' THEN '25-29'
										WHEN SORT = '6' THEN '30-34'
										WHEN SORT = '7' THEN '35-39'
										WHEN SORT = '8' THEN '40-44'
										WHEN SORT = '9' THEN '45-49'
										WHEN SORT = '10' THEN '50-54'
										WHEN SORT = '11' THEN '55-59'
										WHEN SORT = '12' THEN '60-64'
										WHEN SORT = '13' THEN '65-69'
										WHEN SORT = '14' THEN '70-74'
    								    ELSE '>75' END AS P1, 
    								    SUM(ADA_AKTA) AS P2, SUM(TIDAK_ADA_AKTA) AS P3, SUM(ADA_AKTA)+SUM(TIDAK_ADA_AKTA) AS P4
									FROM T5_STT_STRUKTUR_UMUR WHERE NO_PROP='32' AND NO_KAB ='73' AND BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
									GROUP BY SORT
									ORDER BY SORT";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$i=1;
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr class='gradeA'>";
                                    echo "<td align='center'>".$i++."</td>";
                                    echo "<td class='center'>".htmlentities($row['P1'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P2'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P3'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P4'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='biodata-11/index.php?SORT=".htmlentities($row['P5'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                            <i class='fa fa-table fa-fw'></i> TABEL KEPEMILIKAN AKTA MENURUT STRUKTUR UMUR KOTA BANDUNG - KECAMATAN ".$row['NAMA_KEC']."
                        </div>
                         <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Struktur Umur</th>
                                        <th>Ada Akta</th>
                                        <th>Tidak Ada Akta</th>
                                        <th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT SORT AS P5,
										CASE WHEN SORT  = '0' THEN '0-4'
								        WHEN SORT = '1' THEN '5-9'
								        WHEN SORT = '2' THEN '10-14'
										WHEN SORT = '3' THEN '15-19'
										WHEN SORT = '4' THEN '20-24'
										WHEN SORT = '5' THEN '25-29'
										WHEN SORT = '6' THEN '30-34'
										WHEN SORT = '7' THEN '35-39'
										WHEN SORT = '8' THEN '40-44'
										WHEN SORT = '9' THEN '45-49'
										WHEN SORT = '10' THEN '50-54'
										WHEN SORT = '11' THEN '55-59'
										WHEN SORT = '12' THEN '60-64'
										WHEN SORT = '13' THEN '65-69'
										WHEN SORT = '14' THEN '70-74'
    								    ELSE '>75' END AS P1, 
    								    SUM(ADA_AKTA) AS P2, SUM(TIDAK_ADA_AKTA) AS P3, SUM(ADA_AKTA)+SUM(TIDAK_ADA_AKTA) AS P4
									FROM T5_STT_STRUKTUR_UMUR WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
									GROUP BY SORT
									ORDER BY SORT";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$i=1;
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr class='gradeA'>";
                                    echo "<td align='center'>".$i++."</td>";
                                    echo "<td class='center'>".htmlentities($row['P1'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P2'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P3'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P4'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='biodata-11/index.php?SORT=".htmlentities($row['P5'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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
                            <i class='fa fa-table fa-fw'></i> TABEL KEPEMILIKAN AKTA MENURUT STRUKTUR UMUR KOTA BANDUNG - KELURAHAN ".$row['NAMA_KEL']."
                        </div>
                         <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Struktur Umur</th>
                                        <th>Ada Akta</th>
                                        <th>Tidak Ada Akta</th>
                                        <th>Total</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT SORT AS P5,
										CASE WHEN SORT  = '0' THEN '0-4'
								        WHEN SORT = '1' THEN '5-9'
								        WHEN SORT = '2' THEN '10-14'
										WHEN SORT = '3' THEN '15-19'
										WHEN SORT = '4' THEN '20-24'
										WHEN SORT = '5' THEN '25-29'
										WHEN SORT = '6' THEN '30-34'
										WHEN SORT = '7' THEN '35-39'
										WHEN SORT = '8' THEN '40-44'
										WHEN SORT = '9' THEN '45-49'
										WHEN SORT = '10' THEN '50-54'
										WHEN SORT = '11' THEN '55-59'
										WHEN SORT = '12' THEN '60-64'
										WHEN SORT = '13' THEN '65-69'
										WHEN SORT = '14' THEN '70-74'
    								    ELSE '>75' END AS P1, 
    								    SUM(ADA_AKTA) AS P2, SUM(TIDAK_ADA_AKTA) AS P3, SUM(ADA_AKTA)+SUM(TIDAK_ADA_AKTA) AS P4
									FROM T5_STT_STRUKTUR_UMUR WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC='".$NOKEC."' AND NO_KEL='".$NOKEL."' AND BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
									GROUP BY SORT
									ORDER BY SORT";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$i=1;
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr class='gradeA'>";
                                    echo "<td align='center'>".$i++."</td>";
                                    echo "<td class='center'>".htmlentities($row['P1'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P2'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P3'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P4'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='biodata-11/index.php?SORT=".htmlentities($row['P5'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
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