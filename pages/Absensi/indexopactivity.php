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
                    <h1 class="page-header">Detail Aktivitas Operator <?PHP 
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
					echo "<small>".$hari.", " . $tanggal ." ". $bulan ." ". $tahun. ", Update Terakhir <span id='time-part'>".date("H:i:s")."</span>.</small></h1>";
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
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-table fa-fw"></i> Aktivitas Operator
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>User ID</th>
										<th>Waktu</th>
                                        <th>Modul</th>
                                        <th>Keterangan</th>
                                   
                                    </tr>
                                </thead>
                                <tbody id='opr_tab'>
								<?PHP
									Include('../../config/connect222.php');
									date_default_timezone_set("Asia/Jakarta");
									$nowdate = date("d/m/Y");
									$sql= "SELECT A.USER_ID, TO_CHAR(A.ACTIVITY_DATE, 'MM/DD/YYYY HH24:MI:SS')AS ACTIVITY_DATE, B.ACTIVITY_NAME AS P1,C.ACTIVITY_NAME AS P2, A.ACTIVITY_DESC AS P3 FROM T5_HIST_ACTIVITY A INNER JOIN T5_HIST_ACTIVITY_REF B ON A.ACTIVITY_TYPE = B.ACTIVITY_ID INNER JOIN T5_HIST_ACTIVITY_REF C ON A.ACTIVITY_MOD = C.ACTIVITY_ID WHERE ACTIVITY_DATE >= TO_DATE('".$nowdate."','DD/MM/yyyy') AND ACTIVITY_DATE < TO_DATE('".$nowdate."','DD/MM/yyyy')+1 AND USER_ID ='".$USER_ID."' ORDER BY A.ACTIVITY_DATE DESC";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr>";
									echo "<td>".htmlentities($row['USER_ID'])."</td>";
									echo "<td>".htmlentities($row['ACTIVITY_DATE'])."</td>";
                                    echo "<td>".htmlentities($row['P1'])." ".htmlentities($row['P2'])."</td>";
									echo "<td class='center'>".$row['P3']."</td>";
                                    // echo "<td>".htmlentities($row['LEVEL_NAME'])." <font color='blue'><b>(".htmlentities($row['GROUP_LEVEL']).")</b></font></td>";
                                    // echo "<td align='center' class='center'>".htmlentities($row['IP_ADDRESS'])."</td>";
                                    // echo "<td align='center' class='center gradeA'>".htmlentities($row['LAST_ACTIVITY'])."</td>";
                                    echo "</tr>";
									}
									
									?>
								</tbody>
								</thead>
							</table>
						</div>
						<div class="panel-footer">
										 <a href="indexop.php?user=<?php echo htmlentities($_GET['user']) ?>" class="btn btn-primary btn-lg btn-block">Kembali</a>
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
