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
					$sql= "SELECT * FROM SIAK_USER_PLUS WHERE USER_ID ='".$USER_ID."'";
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
		
					//echo "The time is " . date("h:i:sa");
					echo "<small>".$hari.", " . $tanggal ." ". $bulan ." ". $tahun. ",  <span id='time-part'>".date("H:i:s")."</span>.</small></h1>";
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
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-desktop fa-fw"></i> Absensi Operator Komputer
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						<div class="row">
						<!-- /.CEKIN -->
						<div class="col-lg-6 col-md-6">
						<div class="panel panel-primary">
						
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						<div class="row">
						<form id="formcekin" action="adminin.php?user=<?php echo htmlentities($_GET['user']) ?>" method="post">
                      <!--<form method="post" name="cekin" method="post" role="form" action="adminin.php?user=<?php //echo htmlentities($_GET['user']) ?>" id="cekin">-->
					  <input type="hidden" name="absensi" value="ok" />					
					 <a href="#" onclick="document.getElementById('formcekin').submit();" class="col-lg-6 col-md-6">
                    <div class="panel panel-green">
					
                        <div class="panel-heading">
                            <div class="row">
                                <div class="text-center">
                                    <i class="fa fa-sign-in fa-4x"></i>
									<div class="huge">Check In</div>
                                </div>
                                <!--
								<div class="col-xs-10 text-right">
                                    <div class="huge">Datang</div>
                                </div>
								-->
                            </div>
                        </div>
                    </div>
					</a>
					</form>
					<form id="formcekout" action="adminout.php?user=<?php echo htmlentities($_GET['user']) ?>" method="post">
					<input type="hidden" name="absensi" value="ok" />
					<a href="#" onclick="document.getElementById('formcekout').submit();" class="col-lg-6 col-md-6">
                    <div class="panel panel-red">
					
                        <div class="panel-heading">
                            <div class="row">
                                <div class="text-center">
                                    <i class="fa fa-sign-out fa-4x"></i>
									<div class="huge">Check Out</div>
                                </div>
                                <!--
								<div class="col-xs-10 text-right">
                                    <div class="huge">Datang</div>
                                </div>
								-->
                            </div>
                        </div>
                    </div>
					</a>
					</form>
				</div>
				
				
				</div>
				</div>
				
				</div>
				<!-- end one -->
				<div class="col-lg-6 col-md-6">
						<div class="panel panel-primary">
						
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						<div class="row">
					<form id="formstatus" action="statusadmin.php?user=<?php echo htmlentities($_GET['user']) ?>" method="post">
					<input type="hidden" name="status" value="ok" />
                      <a href="#" onclick="document.getElementById('formstatus').submit();" class="col-lg-12 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="text-center">
                                    <i class="fa fa-steam-square fa-4x"></i>
									<div class="huge">Rekap Absensi</div>
                                </div>
                                <!--
								<div class="col-xs-10 text-right">
                                    <div class="huge">Datang</div>
                                </div>
								-->
                            </div>
                        </div>
                    </div>
                </a>
				</form>
				</div>
				
				
				</div>
				</div>
				
				</div>
				<!-- end one -->
				
				</div>
				<!-- end row -->
				<div class="row">
				<?php
				if (isset($_REQUEST['submit'])) //here give the name of your button on which you would like    //to perform action.
				{
				if($_REQUEST['cekin']=="ok")
					{
					$ABSEN_USERID = $_POST['ABSEN_USERID'];
					Include('../../config/connect223.php');
					$sql= "SELECT * FROM SIAK_USER_PLUS WHERE USER_ID ='".$USER_ID."'";
					$stmt = oci_parse($conn222, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					$ABSEN_NAMA = $row['NAMA_LGKP'];
					$ABSEN_TANGGAL = $_POST['ABSEN_TANGGAL'];
					$ABSEN_MASUK = $_POST['ABSEN_MASUK'];
					$ABSEN_KELUAR = $_POST['ABSEN_KELUAR'];
					$ABSEN_KET = $_POST['ABSEN_KET'];
					$terlambat = "8:00";
					$date1 = DateTime::createFromFormat('H:i', $ABSEN_MASUK);
					$date2 = DateTime::createFromFormat('H:i', $terlambat);
					if ($date1 > $date2 )
					
					{
					$ABSEN_KET = 'Terlambat';
					}
					else if($date1 < $date2 )
					{
					$ABSEN_KET = 'Tepat Waktu';		
					}
					$sqlchekin = "SELECT * FROM SIAK_ABSENSI WHERE USER_ID = '$ABSEN_USERID' AND TANGGAL = TO_DATE('$ABSEN_TANGGAL','DD/MM/YYYY')";
					$resultchekin = oci_parse($conn222, $sqlchekin);
					oci_execute($resultchekin);
					$countchekin = oci_fetch($resultchekin);
					if($countchekin == 0){
						//ECHO $sqlchekin;
					$sql= "INSERT INTO SIAK_ABSENSI (USER_ID, NAMA, TANGGAL, JAM_MASUK, JAM_KELUAR, KETERANGAN) VALUES ('$ABSEN_USERID','$ABSEN_NAMA',TO_DATE('$ABSEN_TANGGAL','DD/MM/YYYY'),'$ABSEN_MASUK','$ABSEN_KELUAR','$ABSEN_KET')";
					$result=oci_parse($conn222, $sql);
					oci_execute($result);
					?>
					<div class="col-lg-12 col-md-6">
						<div class="panel panel-primary">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						<div class="row">
                      <div class="col-lg-12 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="text-center">
                                    <i class="fa fa-check-square-o  fa-4x"></i>
									<div class="huge"><?PHP ECHO $ABSEN_USERID ?> Anda Telah Berhasil Check In</div>
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
				<!-- end one -->
					<?php
					}
					else {
					?>
					<div class="col-lg-12 col-md-6">
						<div class="panel panel-primary">
						
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						<div class="row">
                      <div class="col-lg-12 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="text-center">
                                    <i class="fa fa-check-square-o  fa-4x"></i>
									<div class="huge"><?PHP ECHO $ABSEN_USERID ?> Anda Tidak Dapat Check In Lebih Dari 1 Kali</div>
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
				<!-- end one -->
					<?php
					}
					}
					else if($_REQUEST['cekout']=="ok")
					{
					$ABSEN_USERID = $_POST['ABSEN_USERID'];
					$ABSEN_TANGGAL = $_POST['ABSEN_TANGGAL'];
					$ABSEN_KELUAR = $_POST['ABSEN_KELUAR'];
					$sql= "UPDATE SIAK_ABSENSI SET JAM_KELUAR = '$ABSEN_KELUAR' WHERE USER_ID = '$ABSEN_USERID' AND TANGGAL = TO_DATE('$ABSEN_TANGGAL','DD/MM/YYYY')";
					// ECHO $ABSEN_NAMA;
					// ECHO $sql ;
					$result=oci_parse($conn222, $sql);
					oci_execute($result);
						// $update = " UPDATE SIAK_ABSENSI SET JAM_KELUAR = :ABSEN_KELUAR; WHERE USER_ID = :ABSEN_USERID; AND TANGGAL = TO_DATE(:ABSEN_TANGGAL;,'DD/MM/YYYY')";
						// $stmt = oci_parse($conn, $update);
						// oci_bind_by_name($stmt, ':ABSEN_USERID', $ABSEN_USERID);
						// oci_bind_by_name($stmt, ':ABSEN_TANGGAL', $ABSEN_TANGGAL);
						// oci_bind_by_name($stmt, ':ABSEN_KELUAR', $ABSEN_KELUAR);
						// $result = oci_execute($stmt, OCI_DEFAULT);
						// if (!$result) {
						// echo oci_error();   
						// }
						?>
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
                                    <i class="fa fa-check-square-o  fa-4x"></i>
									<div class="huge"><?PHP ECHO $ABSEN_USERID ?> Anda Telah Berhasil Check Out</div>
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
				<!-- end one -->
					<?php
					}
				}
					?>
					</div>
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
