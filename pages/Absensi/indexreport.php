<!DOCTYPE html>
<html lang="en">

<?php require_once('head.php'); 
$_SESSION['USER_ID'] = $_GET['user'];
$USER_DEC = $_SESSION['USER_ID'];
$USER_ID = base64_decode($USER_DEC);
?> 
		

<body onload='loadCategories()'>
    <div id="wrapper">

        <!-- Navigation -->
        <?php require_once('nav.php'); ?> 
<?PHP		
					Include('../../config/connect223.php');
					$sql = "SELECT * FROM SIAK_USER_PLUS WHERE USER_ID ='".$USER_ID."'";
					$result = oci_parse($conn222, $sql);
					oci_execute($result);
					$count = oci_fetch($result);
					if($count == 0){ ?>
						<div id="page-wrapper">
						<div class="row">
						<div class="col-lg-12">
						<h1 class='page-header'>Mohon Maaf Anda Harus Login Terlebih Dahulu<br>
						</div>
						</div>
						<div class="row">
						<div class="col-lg-12">
						<div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-desktop fa-fw"></i> Absensi Operator Komputer
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						<div class="row">
						 <img src="../../images/404.jpg"  alt="Cinque Terre" width="100%" height="700">
						
						</div>
						</div>
						</div>
						</div>
						</div>
						</div>
				<?php
					}
					else
					{
						?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                   <div class="panel-body">
                            <!-- Nav tabs -->
                       
					
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="kartukeluarga-pills">
								<br>
                                    <div class="col-lg-12">
										




										<div class="panel panel-primary">
											<div class="panel-heading">
												Rekap Absensi Bulanan
											</div>
										<div class="panel-body" >
										
										<form method="post" name="formstatistik" id="formstatistik" action="indexreport.php?user=<?php echo htmlentities($_GET['user']) ?>" role="form">
	
																												<!--start row-->
										<div class="row">
											<div class="col-lg-12">
											
                                            
											
										<!-- Div -->
											<div class="form-group col-lg-12">
											<label>Masukan Bulan Dan Tahun</label>
                                            <input name="bulan" id="bulan" class="form-control" placeholder="MM-YYYY" type="text" pattern=".{7,}" data-masked-input="99-9999" placeholder="MM-YYYY" maxlength="7" required x-moz-errormessage="Format Bulan Dan Tahun Salah">
											
											</div>
										
											</div>
											</div>
										
									
										
										</div>
										<!-- end panel -->
									<div class="panel-footer">
										<button type="submit" name="cari" class="btn btn-primary btn-lg btn-block">Tampilkan Absensi</button>
									</div>
									</form>
									</div>
<?php									
 if (isset($_REQUEST['cari'])) //here give the name of your button on which you would like    //to perform action.
{
	Include('../../config/connect223.php');
	 $BULAN = $_POST['bulan'];
	
	$sql= "SELECT * FROM T5_OP WHERE TRUNC(TANGGAL,'MM') >= TO_DATE('".$BULAN."','MM/yyyy') AND TRUNC(TANGGAL,'MM') < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
	
		$stmt = oci_parse($conn222, $sql);
		oci_execute($stmt);
	    $num_rows=oci_fetch($stmt);
	   if($num_rows>0){
		
		//HASIL YANG DI KELUARKAN APABILA DATA TELAH TEPAT, KECAMATAN DAN KELURAHAN DI TAMPILKAN SEMUA
	ECHO "<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-table fa-fw'></i> TABEL ABSENSI OPERATOR KOMPUTER KOTA BANDUNG
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <Th>User ID</Th>
                                        <Th>Nama</Th>
										<Th>Hadir</Th>
                                        <Th>Tepat Waktu</Th>
										<Th>Terlambat</Th>
										<Th>Unduh</Th>
									</tr>
                                </thead>
                                <tbody>";
									
									$sql= "SELECT USER_ID, NAMA, COUNT(*) AS HADIR,COUNT(CASE WHEN KETERANGAN = 'Tepat Waktu' THEN 1 ELSE NULL END) AS TEPAT_WAKTU,COUNT(CASE WHEN KETERANGAN = 'Terlambat' THEN 1 ELSE NULL END) AS TERLAMBAT FROM T5_OP WHERE TRUNC(TANGGAL,'MM') >= TO_DATE('".$BULAN."','MM/yyyy') AND TRUNC(TANGGAL,'MM') < TO_DATE('".$BULAN."','MM/yyyy') +1 GROUP BY USER_ID,NAMA ORDER BY HADIR DESC, TEPAT_WAKTU DESC";
									$stmt = oci_parse($conn222, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt,OCI_ASSOC)) != false) {
                                    echo "<tr class='gradeA'>";
                                    echo "<td class='center'>".htmlentities($row['USER_ID'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['NAMA'])."</td>";
                                    echo "<td class='center'>".
									htmlentities($row['HADIR'])."</td>";
                                    echo "<td class='center'>".
									htmlentities($row['TEPAT_WAKTU'])."</td>";
									echo "<td class='center'>".
									htmlentities($row['TERLAMBAT'])."</td>";
									echo "<td class='center'><a target='_blank' href='../report/data/absen.php?USR=".htmlentities($row['USER_ID'])."&BULAN=".htmlentities($BULAN)."'><i class='fa fa-download fa-fw'></i> Unduh</a></td>";
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
?>
									<?php

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
    <script src="../../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>
	<script src="../../js/jquery.masked-input.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

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