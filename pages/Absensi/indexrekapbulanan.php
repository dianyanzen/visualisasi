<!DOCTYPE html>
<html lang="en">

<?php require_once('head.php'); 
$_SESSION['USER_ID'] = $_GET['user'];
$USER_DEC = $_SESSION['USER_ID'];
$USER_ID = base64_decode($USER_DEC);
?> 
<body>
    <div id="wrapper">
<!-- Navigation -->
         <?php require_once('nav.php'); ?> 
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Rekap Absensi Bulanan Operator <?PHP 
					$_SESSION['UID'] = $_GET['UID'];
					$USER_ID = $_SESSION['UID'];
					ECHO $USER_ID;
					?>
					<br>
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
					echo "<small>Bulan ". $bulan ." ". $tahun. "</small></h1>";
					//echo "Today is " . date("Y.m.d") . "<br>";
					//echo "Today is " . date("Y-m-d") . "<br>";
					//echo "Today is " . date("l");
					?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <!-- Isi -->
            <!-- /.row -->
			
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-desktop fa-fw"></i> Rekap Absensi Operator Komputer
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                           
<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
											<th>No</th>
                                            <th>USER ID</th>
                                            <th>NAMA</th>
                                            <th>TANGGAL</th>
                                            <th>JAM MASUK</th>
											<th>JAM KELUAR</th>
											<th>KETERANGAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?PHP
									Include('../../config/connect223.php');
									$urut = 0 ;
									$sql= "SELECT TO_CHAR(TRUNC(SYSDATE, 'MM') + LEVEL - 1,'DD-MM-YYYY') AS DAY
											FROM DUAL
											CONNECT BY TRUNC(TRUNC(SYSDATE, 'MM') + LEVEL - 1, 'MM') = TRUNC(SYSDATE, 'MM')";
									$stmt = oci_parse($conn222, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
									$sql2= "SELECT USER_ID, NAMA_LGKP FROM SIAK_USER_PLUS WHERE USER_ID ='$USER_ID'";
									$stmt2 = oci_parse($conn222, $sql2);
									oci_execute($stmt2);
									$row2 = oci_fetch_array($stmt2);
                                    echo "<tr>";
									$urut = $urut + 1 ;
									echo "<td>".$urut."</td>";
									echo "<td>".htmlentities($row2['USER_ID'])."</td>";
									echo "<td>".htmlentities($row2['NAMA_LGKP'])."</td>";
									echo "<td>".htmlentities($row['DAY'])."</td>";
									$sql3= "SELECT JAM_MASUK, JAM_KELUAR, KETERANGAN FROM SIAK_ABSENSI WHERE USER_ID ='$USER_ID' AND TANGGAL = TO_DATE('".$row['DAY']."','DD-MM-YYYY')";
									$stmt3 = oci_parse($conn222, $sql3);
									oci_execute($stmt3);
									$row3 = oci_fetch_array($stmt3);
									$JMSK = htmlentities($row3['JAM_MASUK']);
									if ($JMSK =='')
									{
										echo "<td align='center' class='center gradeA'>-</td>";
										echo "<td align='center' class='center gradeA'>-</td>";
										echo "<td align='center' class='center gradeA'>-</td>";
									}ELSE{
										echo "<td align='center' class='center gradeA'>".htmlentities($row3['JAM_MASUK'])."</td>";
										echo "<td align='center' class='center gradeA'>".htmlentities($row3['JAM_KELUAR'])."</td>";
										echo "<td align='center' class='center gradeA'>".htmlentities($row3['KETERANGAN'])."</td>";
									}
                                    echo "</tr>";
									}
									?>
                                    </tbody>
                                </table>						
							
                            <!-- /.table-responsive -->
                        
						
						</div>
						<div class="panel-footer">
										 <a href="indexrekap.php?user=<?php echo htmlentities($_GET['user']) ?>" class="btn btn-primary btn-lg btn-block">Kembali</a>
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
	<script src="../js/moment.min.js"></script>
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
				<script>
	setInterval(function(){
	// $("#opr_tab").load('opr_tab_ao.php')
	// }, 10000);

	</script>		
</body>

</html>
