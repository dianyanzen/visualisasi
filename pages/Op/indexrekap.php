<!DOCTYPE html>
<html lang="en">

<?php require_once('head.php'); 
error_reporting(E_ERROR | E_PARSE);
$_SESSION['USER_ID'] = $_GET['user'];
$USER_DEC = $_SESSION['USER_ID'];
$USER_ID = base64_decode($USER_DEC);
Include('../../config/connect223.php');
$sql= "SELECT USER_ID, NAMA_LGKP FROM SIAK_USER_PLUS WHERE USER_ID ='".$USER_ID."'";
$stmt = oci_parse($conn222, $sql);
oci_execute($stmt);
$row = oci_fetch_array($stmt);
date_default_timezone_set("Asia/Jakarta");
$today = date('m/Y');
$ABSEN_USERID = $row['USER_ID'];
$ABSEN_NAMA = $row['NAMA_LGKP'];
$ABSEN_TANGGAL = $today;
?> 
<link href="assets/css/table.css" rel="stylesheet">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/datatables/jquery.dataTables.js"></script>
  			<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#dt1').dataTable();
			} );
	</script>
<body>
   

        <!-- Navigation -->
        <?php require_once('nav.php'); ?> 
					<?PHP		
					Include('../../config/connect223.php');
					$sql = "SELECT * FROM SIAK_USER_PLUS WHERE USER_ID ='".$USER_ID."'";
					$result = oci_parse($conn222, $sql);
					oci_execute($result);
					$count = oci_fetch($result);
					if($count == 0){ ?>
					 <div class="container">
					 <div class="row">
						
						<div class="col-lg-12">
						<div class="panel panel-primary">
                        <div class="panel-heading">
                         <img src="../../images/404.jpg"  alt="Cinque Terre" width="100%" height="700">
                        </div>
                        
						</div>
						</div>
		
					 </div>
					 </div>
					<?php
					}else{
					?>
	<div class="container">
	<!-- CONTENT -->
	<div class="row">
	<div class="col-lg-12">
	<div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-desktop fa-fw"></i> Rekap Absensi Operator Komputer
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							

		<table class="display" id="dt1">
        <thead>
          <tr>
            <th>No</th>
            <th>USER ID</th>
            <th>NAMA</th>
            <th>TANGGAL</th>
			<th>JAM MASUK</th>
			<th>JAM KELUAR</th>
			<th>JAM KERJA</th>
			<th>KETERANGAN</th>
          </tr>
        </thead>
        <tbody>
									<?PHP
									$urut = 0 ;
									$sql= "SELECT TO_CHAR(TRUNC(SYSDATE, 'MM') + LEVEL - 1,'DD-MM-YYYY') AS DAY
											FROM DUAL
											CONNECT BY TRUNC(TRUNC(SYSDATE, 'MM') + LEVEL - 1, 'MM') = TRUNC(SYSDATE, 'MM')";
									$stmt = oci_parse($conn222, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
									$sql2= "SELECT USER_ID, NAMA_LGKP FROM SIAK_USER_PLUS WHERE USER_ID ='$ABSEN_USERID'";
									$stmt2 = oci_parse($conn222, $sql2);
									oci_execute($stmt2);
									$row2 = oci_fetch_array($stmt2);
                                    $urut = $urut + 1 ;
									if ($urut % 2 == 0) {
									echo "<tr class='even gradeC'>";	
									}else{
									echo "<tr class='ood gradeC'>";	
									}
						
									echo "<td>".$urut."</td>";
									echo "<td>".htmlentities($row2['USER_ID'])."</td>";
									echo "<td>".htmlentities($row2['NAMA_LGKP'])."</td>";
									echo "<td>".htmlentities($row['DAY'])."</td>";
									$sql3= "SELECT JAM_MASUK, JAM_KELUAR, KETERANGAN FROM SIAK_ABSENSI WHERE USER_ID ='$ABSEN_USERID' AND TANGGAL = TO_DATE('".$row['DAY']."','DD-MM-YYYY')";
									$stmt3 = oci_parse($conn222, $sql3);
									oci_execute($stmt3);
									$row3 = oci_fetch_array($stmt3);
									$JMSK = htmlentities($row3['JAM_MASUK']);
									if ($JMSK =='')
									{
										echo "<td align='center' class='center gradeA'>-</td>";
										echo "<td align='center' class='center gradeA'>-</td>";
										echo "<td align='center' class='center gradeA'>-</td>";
										echo "<td align='center' class='center gradeA'>-</td>";
									}ELSE{
										echo "<td align='center' class='center gradeA'>".htmlentities($row3['JAM_MASUK'])."</td>";
										echo "<td align='center' class='center gradeA'>".htmlentities($row3['JAM_KELUAR'])."</td>";
										$first  = new DateTime( $row3['JAM_MASUK'] );
										$second = new DateTime( $row3['JAM_KELUAR'] );
										$diff = $first->diff( $second );
										echo "<td align='center' class='center gradeA'>".htmlentities($diff->format( '%H Jam %I Menit' ))."</td>";
										echo "<td align='center' class='center gradeA'>".htmlentities($row3['KETERANGAN'])."</td>";
									}
                                    echo "</tr>";
									}
									?>
        </tbody>
      </table><!--/END SECOND TABLE -->
	
	</div>
	</div>
	<!--COntainer and row-->
	</div>
	</div>
	</div>
					
           <?php }?>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/admin.js"></script>
<!-- Bootstrap Core JavaScript -->
    

    <!-- Metis Menu Plugin JavaScript -->
    

    
  
</body></html>
