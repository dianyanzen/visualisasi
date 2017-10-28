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
						 <img src="../../images/404.jpg" alt="Cinque Terre" width="100%" height="700">
						
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
                    <h1 class="page-header">Detail Aktivitas Operator
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
										<th>Status Pengguna</th>
                                        <th>ID Pengguna</th>
                                        <th>Nama Pengguna</th>
                                        <th>Nama Kantor</th>
                                        <!--th>IP Address</th-->
                                        <th>Aktivitas Terakhir</th>
										<th>Detail Aktivitas</th>
                                    </tr>
                                </thead>
                                <tbody id='opr_tab'>
								<?PHP
									Include('../../config/connect223.php');
									date_default_timezone_set("Asia/Jakarta");
									$nowdate = date("d/m/Y");
									$sql= "SELECT B.USER_ID, B.NAMA_LGKP, C.LEVEL_NAME, B.NAMA_KANTOR, D.LEVEL_NAME AS GROUP_LEVEL, CASE WHEN A.IP_ADDRESS IS NULL THEN '-' ELSE A.IP_ADDRESS END AS IP_ADDRESS, CASE WHEN A.LAST_ACTIVITY IS NULL THEN '-' ELSE to_char(to_date('1970-01-01','YYYY-MM-DD') + numtodsinterval(TO_CHAR(A.LAST_ACTIVITY),'SECOND') + 7/24,'DD-MM-YYYY HH24:MI:SS') END AS LAST_ACTIVITY FROM SIAK_USER_PLUS B  LEFT JOIN T5_SESSION@DB5 A ON A.USER_ID = B.USER_ID INNER JOIN T5_SIAK_LEVEL@DB5 C ON B.USER_LEVEL = C.USER_LEVEL INNER JOIN T5_GROUP_LEVEL@DB5 D ON C.GROUP_LEVEL = D.LEVEL_CODE WHERE B.USER_LEVEL != '11'  ORDER BY B.USER_ID";
									$stmt = oci_parse($conn222, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr>";
									$ipadd = htmlentities($row['IP_ADDRESS']);
									if ($ipadd =='-')
									{
									echo "<td><i class='fa fa-desktop fa-fw' style='color:red'></i> Tidak Aktif</td>";
									} else
									{
									echo "<td><i class='fa fa-desktop fa-fw' style='color:green'></i> Aktif</td>";
									}
									echo "<td>".htmlentities($row['USER_ID'])."</td>";
                                    echo "<td>".htmlentities($row['NAMA_LGKP'])."</td>";
									echo "<td class='center'>".htmlentities($row['NAMA_KANTOR'])."</td>";
                                    // echo "<td>".htmlentities($row['LEVEL_NAME'])." <font color='blue'><b>(".htmlentities($row['GROUP_LEVEL']).")</b></font></td>";
                                    // echo "<td align='center' class='center'>".htmlentities($row['IP_ADDRESS'])."</td>";
                                    echo "<td align='center' class='center gradeA'>".htmlentities($row['LAST_ACTIVITY'])."</td>";
									echo "<td class='center' align='center'><a href='indexopactivity.php?UID=".htmlentities($row['USER_ID'])."&user=".htmlentities($_GET['user'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
                                    echo "</tr>";
									}
									}
									?>
								</tbody>
								</thead>
							</table>
						</div>
						
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<? } ?>
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
				<script>
	setInterval(function(){
	// $("#opr_tab").load('opr_tab_ao.php')
	// }, 10000);

	</script>		
</body>

</html>
