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
           <th>User ID</th>
			<th>Waktu</th>
             <th>Modul</th>
             <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
									<?PHP
									$urut = 0 ;
									Include('../../config/connect222.php');
									date_default_timezone_set("Asia/Jakarta");
									$nowdate = date("d/m/Y");
									$sql= "SELECT A.USER_ID, TO_CHAR(A.ACTIVITY_DATE, 'MM/DD/YYYY HH24:MI:SS')AS ACTIVITY_DATE, B.ACTIVITY_NAME AS P1,C.ACTIVITY_NAME AS P2, A.ACTIVITY_DESC AS P3 FROM T5_HIST_ACTIVITY A INNER JOIN T5_HIST_ACTIVITY_REF B ON A.ACTIVITY_TYPE = B.ACTIVITY_ID INNER JOIN T5_HIST_ACTIVITY_REF C ON A.ACTIVITY_MOD = C.ACTIVITY_ID WHERE ACTIVITY_DATE >= TO_DATE('".$nowdate."','DD/MM/yyyy') AND ACTIVITY_DATE < TO_DATE('".$nowdate."','DD/MM/yyyy')+1 AND USER_ID ='".$USER_ID."' ORDER BY A.ACTIVITY_DATE DESC";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    $urut = $urut + 1 ;
									if ($urut % 2 == 0) {
									echo "<tr class='even gradeC'>";	
									}else{
									echo "<tr class='ood gradeC'>";	
									}
									echo "<td>".htmlentities($row['USER_ID'])."</td>";
									echo "<td>".htmlentities($row['ACTIVITY_DATE'])."</td>";
                                    echo "<td>".htmlentities($row['P1'])." ".htmlentities($row['P2'])."</td>";
									echo "<td>".$row['P3']."</td>";
                                    // echo "<td>".htmlentities($row['LEVEL_NAME'])." <font color='blue'><b>(".htmlentities($row['GROUP_LEVEL']).")</b></font></td>";
                                    // echo "<td align='center' class='center'>".htmlentities($row['IP_ADDRESS'])."</td>";
                                    // echo "<td align='center' class='center gradeA'>".htmlentities($row['LAST_ACTIVITY'])."</td>";
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
