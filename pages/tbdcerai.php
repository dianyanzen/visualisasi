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
                                <li><a href="tbdlahir.php">Kelahiran WNI</a>
                                </li>
                                <li><a href="tbdmati.php">Kematian</a>
                                </li>
                                <li><a href="tbdkawin.php">Perkawinan</a>
                                </li>
                                <li class="active"><a href="tbdcerai.php">Perceraian</a>
                                </li>
                            </ul>
					
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="kartukeluarga-pills">
								<br>
                                    <div class="col-lg-12">
										<div class="panel panel-primary">
											<div class="panel-heading">
												Tabel Statistik Pendaftaran Penduduk WNI Kota Bandung - Akta Perceraian
											</div>
										<div class="panel-body" >
										
										<form method="post" name="formstable" id="formstable" action="tbdcerai.php" role="form">
	
										
										<!--start row-->
										<div class="row">
											<div class="col-lg-12">
											<div class="form-group col-lg-6">
                                            <label>Pilih Jenis Tabel</label>
                                            <select name="statistik" id="statistik" class="form-control" required>
												<option value="1"> Menurut Yang Mengajukan</option>
												<option value="2"> Menurut Penyebab Perceraian</option>
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
	//$NOKEC= $_REQUEST['NO_KEC'] ;
	//$NOKEL= $_REQUEST['NO_KEL'] ;
	//$_SESSION['NOKEC'] = $NOKEC;
	//$_SESSION['NOKEL'] = $NOKEL;
	
//TABEL 1
if($_REQUEST['statistik']=="1"){
	$BULAN= $_POST['bulan'];
	//MENGECEK APAKAH BULAN YANG DI PILIH TERSEDIA DI DB
	$sql= "SELECT * FROM T5_CRAI_AJUKAN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
	    $num_rows=oci_fetch($stmt);
	   if($num_rows>0){
	
		//HASIL YANG DI KELUARKAN APABILA DATA TELAH TEPAT, KECAMATAN DAN KELURAHAN DI TAMPILKAN SEMUA
	ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL PERCERAIAN MENURUT YANG MENGAJUKAN KOTA BANDUNG
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <Th>Suami</Th>
                                        <Th>Istri</Th>
										<Th>Tidak Tahu</Th>
                                        <Th>Total</Th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT SUM(SUAMI) AS P1, SUM(ISTRI) AS P2,SUM(TIDAK_TAHU) AS P3,SUM(SUAMI)+SUM(ISTRI)+SUM(TIDAK_TAHU) AS P4 FROM T5_CRAI_AJUKAN WHERE NO_PROP='32' AND NO_KAB ='73' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt,OCI_ASSOC)) != false) {
                                    echo "<tr class='gradeA'>";
                                    echo "<td class='center'>".htmlentities($row['P1'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['P2'])."</td>";
                                    echo "<td class='center'>".
									htmlentities($row['P3'])."</td>";
                                    echo "<td class='center'>".
									htmlentities($row['P4'])."</td>";
           
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
	}
	//AKHIR TABEL 1
	
	//TABEL 2
	if($_REQUEST['statistik']=="2"){
	$BULAN= $_POST['bulan'];
	//MENGECEK APAKAH BULAN YANG DI PILIH TERSEDIA DI DB
	$sql= "SELECT * FROM T5_CRAI_SEBAB WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
	    $num_rows=oci_fetch($stmt);
	   if($num_rows>0){
	
		//HASIL YANG DI KELUARKAN APABILA DATA TELAH TEPAT, KECAMATAN DAN KELURAHAN DI TAMPILKAN SEMUA
	ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL PERCERAIAN MENURUT PENYEBAB PERCERAIAN KOTA BANDUNG
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <Th>Zina</Th>
                                        <Th>Pemabuk</Th>
										<Th>Penjudi</Th>
                                        <Th>Tinggal 2 Tahun</Th>
										<Th>Penjara 5 Tahun</Th>
                                        <Th>Kdrt</Th>
										<Th>Cacat Atau Sakit</Th>
                                        <Th>Selisi Terus</Th>
										<Th>Lainnya</Th>
                                        <Th>Total</Th>
                                    </tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT SUM(ZINA) AS P1, SUM(PEMABUK) AS P2,SUM(PENJUDI) AS P3,SUM(TINGGAL_2TH) AS P4,SUM(PENJARA_5TH) AS P5,SUM(KDRT) AS P6,SUM(CACAT_SAKIT) AS P7,SUM(SELISI_TRS) AS P8,SUM(LAINNYA) AS P9,SUM(ZINA)+SUM(PEMABUK)+SUM(PENJUDI)+SUM(TINGGAL_2TH)+SUM(PENJARA_5TH)+SUM(KDRT)+SUM(CACAT_SAKIT)+SUM(SELISI_TRS)+SUM(LAINNYA) AS P10 FROM T5_CRAI_SEBAB WHERE NO_PROP='32' AND NO_KAB ='73' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt,OCI_ASSOC)) != false) {
                                    echo "<tr class='gradeA'>";
                                    echo "<td class='center'>".htmlentities($row['P1'])."	</td>";
                                    echo "<td class='center'>".htmlentities($row['P2'])."</td>";
                                    echo "<td class='center'>".
									htmlentities($row['P3'])."</td>";
                                    echo "<td class='center'>".
									htmlentities($row['P4'])."</td>";
                                    echo "<td class='center'>".
									htmlentities($row['P5'])."</td>";
                                    echo "<td class='center'>".
									htmlentities($row['P6'])."</td>";
                                    echo "<td class='center'>".
									htmlentities($row['P7'])."</td>";
                                    echo "<td class='center'>".
									htmlentities($row['P8'])."</td>";
                                    echo "<td class='center'>".
									htmlentities($row['P9'])."</td>";
                                    echo "<td class='center'>".
									htmlentities($row['P10'])."</td>";
           
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
	}
	//AKHIR TABEL 2
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