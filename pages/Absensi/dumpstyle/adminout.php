<!DOCTYPE html>
<html lang="en">

<?php require_once('adminhead.php'); 
$_SESSION['USER_ID'] = $_GET['user'];
$USER_ID = $_SESSION['USER_ID'];
	?> 
	<style>
a:link, a:visited {

    text-decoration: none;
    display: inline-block;
}


a:hover, a:active {

}
</style>

<body>
    <div id="wrapper">

        <!-- Navigation -->
        <?php require_once('adminnav.php'); ?> 

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
				<?php
				Include('../../config/connect223.php');
					//AMBIL NAMA KECAMATAN DAN TOTAL PENJUMLAHAN NIK TIAP KELUARAHAN BERDASARKAN KECAMATAN YANG DI PILIH 
					$sql= "SELECT USER_ID, NAMA_LGKP FROM SIAK_USER_PLUS WHERE USER_ID ='".$USER_ID."'";
					$stmt = oci_parse($conn222, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM BIODATA MENURUT GOLONGAN DARAH KECAMATAN ".$row['NAMA_KEC']."'";
					
                    ECHO "<h1 class='page-header'>FORM ABSENSI OPERATOR ".$row['NAMA_LGKP']."<br>";
			
					?>
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
					
					//Format Date
					$today = date('d/m/Y');
					
					//echo "The time is " . date("h:i:sa");
					
					//echo "Today is " . date("Y.m.d") . "<br>";
					//echo "Today is " . date("Y-m-d") . "<br>";
					//echo "Today is " . date("l");
					?>
					
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <!-- Isi -->
			<div class="row">
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
				<?php
				if($_REQUEST['absensi']=="ok")
				{
					$ABSEN_USERID = $row['USER_ID'];
					$ABSEN_NAMA = $row['NAMA_LGKP'];
					$ABSEN_TANGGAL = $today;
					$sqlchekin = "SELECT * FROM SIAK_ABSENSI WHERE USER_ID = '$ABSEN_USERID' AND TANGGAL = TO_DATE('$ABSEN_TANGGAL','DD/MM/YYYY')";
					$resultchekin = oci_parse($conn222, $sqlchekin);
					oci_execute($resultchekin);
					$countchekin = oci_fetch($resultchekin);
					if($countchekin == 0){
					?>
					<div class="panel panel-red">
                        <div class="panel-heading">
                            <i class="fa fa-desktop fa-fw"></i> Absensi Operator Komputer
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="col-lg-12 col-md-6">
						<div class="panel panel-primary">
						
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						<div class="row">
                      <div class="col-lg-12 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="text-center">
                                    <i class="fa fa-exclamation-triangle  fa-4x"></i>
									<div class="huge"><?PHP ECHO $ABSEN_USERID ?> Anda Harus Check In Terlebih Dahulu</div>
                                </div>
                                <!--
								<div class="col-xs-10 text-right">
                                    <div class="huge">Datang</div>
                                </div>
								-->
                            </div>
                        </div>
                    </div>
                </div>
				</div>
				
				
				</div>
				</div>
				
				</div>
                            <!-- /.table-responsive -->
                        </div>
						<div class="panel-footer">
					<form method="post" name="formstable" id="formstable" action="admin.php?user=<?php echo htmlentities($_GET['user']) ?>" role="form">
                      <!--<form method="post" name="cekin" method="post" role="form" action="cekin.php?user=<?php //echo htmlentities($_GET['user']) ?>" id="cekin">-->
					<input type="hidden" name="cekout" value="ok" />
					<input type="hidden" name="ABSEN_USERID" value=<?PHP ECHO $ABSEN_USERID; ?> />
					<input type="hidden" name="ABSEN_TANGGAL" value=<?PHP ECHO $ABSEN_TANGGAL; ?> />
					<input type="hidden" name="ABSEN_KELUAR" value=<?PHP ECHO $ABSEN_KELUAR; ?> />
					<a href="admin.php?user=<?php echo htmlentities($_GET['user']) ?>" class="btn btn-danger btn-lg btn-block"><i class="fa fa-sign-in fa-1x"></i> Check Out</a>
					</form>
					</div>
			
				
				</div>
					<?php
					}
					else
					{
					$ABSEN_KELUAR = date("H:i");
					$ABSEN_USERID = $row['USER_ID'];
					$ABSEN_NAMA = $row['NAMA_LGKP'];
					$ABSEN_TANGGAL = $today;
					$sql = "SELECT * FROM SIAK_ABSENSI WHERE USER_ID = '$ABSEN_USERID' AND TANGGAL = TO_DATE('$ABSEN_TANGGAL','DD/MM/YYYY')";
					$stmt = oci_parse($conn222, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					?>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-desktop fa-fw"></i> Absensi Operator Komputer
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>USER ID</th>
                                            <th>NAMA</th>
                                            <th>TANGGAL</th>
                                            <th>JAM MASUK</th>
											<th>JAM KELUAR</th>
											<th>KETERANGAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
										<?php 
										
										?>
                                            <td><?php echo $row['USER_ID']; ?></td>
                                            <td><?php echo $row['NAMA'];  ?></td>
                                            <td><?php echo $row['TANGGAL'];  ?></td>
                                            <td><?php echo $row['JAM_MASUK'];  ?></td>
											<td><?php echo $ABSEN_KELUAR; ?></td>
											<td><?php echo $row['KETERANGAN']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
						<div class="panel-footer">
					<form method="post" name="formstable" id="formstable" action="admin.php?user=<?php echo htmlentities($_GET['user']) ?>" role="form">
                      <!--<form method="post" name="cekin" method="post" role="form" action="cekin.php?user=<?php //echo htmlentities($_GET['user']) ?>" id="cekin">-->
					<input type="hidden" name="cekout" value="ok" />
					<input type="hidden" name="ABSEN_USERID" value=<?PHP ECHO $ABSEN_USERID; ?> />
					<input type="hidden" name="ABSEN_TANGGAL" value=<?PHP ECHO $ABSEN_TANGGAL; ?> />
					<input type="hidden" name="ABSEN_KELUAR" value=<?PHP ECHO $ABSEN_KELUAR; ?> />
					<button type="submit" name="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-sign-in fa-1x"></i> Check Out</button>
					</form>
					</div>
			
				
				</div>
					<?php }
					// }
					}
					?>
				<!-- end row -->
						</div>
						
						
				</div>
			</div>
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
	<script src="../../js/moment.min.js"></script>
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
