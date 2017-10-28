<!doctype html>
<html>
<?php require_once('head.php'); 
error_reporting(E_ERROR | E_PARSE);
$_SESSION['USER_ID'] = $_GET['user'];
$USER_DEC = $_SESSION['USER_ID'];
$USER_ID = base64_decode($USER_DEC);
Include('../../config/connect223.php');
date_default_timezone_set("Asia/Jakarta");
$sql= "SELECT USER_ID, NAMA_LGKP FROM SIAK_USER_PLUS WHERE USER_ID ='".$USER_ID."'";
$stmt = oci_parse($conn222, $sql);
oci_execute($stmt);
$row = oci_fetch_array($stmt);
$ABSEN_USERID = $row['USER_ID'];
$ABSEN_NAMA = $row['NAMA_LGKP'];
$today = date('d-m-Y');
$ABSEN_TANGGAL = $today;
?> 
  <body>
  
  	<!-- NAVIGATION MENU -->
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
				<?php
					
					$sqlchekin = "SELECT * FROM SIAK_ABSENSI WHERE USER_ID = '$USER_ID' AND TANGGAL = TO_DATE('$ABSEN_TANGGAL','DD-MM-YYYY')";
					$resultchekin = oci_parse($conn222, $sqlchekin);
					oci_execute($resultchekin);
					$countchekin = oci_fetch($resultchekin);
					if($countchekin == 0){
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
										
										$ABSEN_MASUK = date("H:i");
										$ABSEN_KELUAR = date("H:i");
										$current_time = date("H:i");
											$terlambat = "8:00";
											$date1 = DateTime::createFromFormat('H:i', $current_time);
											$date2 = DateTime::createFromFormat('H:i', $terlambat);
											if ($date1 > $date2 )
											{
											$ABSEN_KET = 'Terlambat';
											}
											else if($date1 <= $date2)
											{
											$ABSEN_KET = 'Tepat Waktu';		
											}	
										?>
                                            <td><?php echo $ABSEN_USERID; ?></td>
                                            <td><?php echo $ABSEN_NAMA; ?></td>
                                            <td><?php echo $ABSEN_TANGGAL; ?></td>
                                            <td><?php echo $ABSEN_MASUK; ?></td>
											<td><?php echo $ABSEN_KELUAR; ?></td>
											<td><?php echo $ABSEN_KET; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
						<div class="panel-footer">
					<form method="post" name="formstable" id="formstable" action="indexin.php?user=<?php echo htmlentities($_GET['user']) ?>" role="form">
                      <!--<form method="post" name="cekin" method="post" role="form" action="cekin.php?user=<?php //echo htmlentities($_GET['user']) ?>" id="cekin">-->
					<input type="hidden" name="cekin" value="ok" />
					<input type="hidden" name="ABSEN_USERID" value=<?PHP ECHO $ABSEN_USERID; ?> />
					<input type="hidden" name="ABSEN_NAMA" value=<?PHP ECHO $ABSEN_NAMA; ?> />
					<input type="hidden" name="ABSEN_TANGGAL" value=<?PHP ECHO $ABSEN_TANGGAL; ?> />
					<input type="hidden" name="ABSEN_MASUK" value=<?PHP ECHO $ABSEN_MASUK; ?> />
					<input type="hidden" name="ABSEN_KELUAR" value=<?PHP ECHO $ABSEN_KELUAR; ?> />
					<input type="hidden" name="ABSEN_KET" value=<?PHP ECHO $ABSEN_KET; ?> />
					<button type="submit" name="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-sign-in fa-1x"></i> Clock In</button>
					</form>
					</div>
			
				
				</div>
				<?php }
					 else{
					$sql = "SELECT USER_ID, NAMA, TO_CHAR(TANGGAL,'DD-MM-YYYY') AS TANGGAL, JAM_MASUK, JAM_KELUAR, KETERANGAN FROM SIAK_ABSENSI WHERE USER_ID = '$USER_ID' AND TANGGAL = TO_DATE('$ABSEN_TANGGAL','DD-MM-YYYY')";
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
										
                                            <td><?php echo $row['USER_ID']; ?></td>
                                            <td><?php echo $row['NAMA']; ?></td>
                                            <td><?php echo $row['TANGGAL']; ?></td>
                                            <td><?php echo $row['JAM_MASUK']; ?></td>
											<td><?php echo $row['JAM_KELUAR']; ?></td>
											<td><?php echo $row['KETERANGAN']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
					<div class="panel-footer">
					<a href="index.php?user=<?php echo htmlentities($_GET['user']) ?>" class="btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-circle-left fa-1x"></i> Kembali, Anda Tidak Dapat Clock In Lebih Dari 1 Kali</a>
					</div>
			
				
				</div>
					<?php					
					
					}
					?>	
				
				
				<!-- end row -->
						</div>
						<hr>
						<?PHP if (isset($_REQUEST['submit'])) //here give the name of your button on which you would like    //to perform action.
						{
							$ABSEN_USERID = $_POST['ABSEN_USERID'];
							// $ABSEN_NAMA = $_POST['ABSEN_NAMA'];
							$ABSEN_TANGGAL = $_POST['ABSEN_TANGGAL'];
							$ABSEN_MASUK = $_POST['ABSEN_MASUK'];
							$ABSEN_KELUAR = $_POST['ABSEN_KELUAR'];
							// $ABSEN_KET = $_POST['ABSEN_KET'];
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
					<div class="row">
						<div class="col-lg-12 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="text-center">
                                    <i class="fa fa-check-square-o  fa-4x"></i>
									<div class="huge"><?PHP ECHO $ABSEN_USERID ?> Anda Telah Berhasil Clock In</div>
                                </div>
                                <!--
								<div class="col-xs-10 text-right">
                                    <div class="huge">Datang</div>
                                </div>
								-->
                            </div>
                        </div>
						<div class="panel-footer">
					<a href="index.php?user=<?php echo htmlentities($_GET['user']) ?>" class="btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-circle-left fa-1x"></i> Kembali</a>
					</div>
                    </div>
                </div>
				
					</div>
					<?PHP
						}
						}
						?>
		</div><!--/span12 -->
      </div><!-- /row -->
     
    	<br>	
<?php }?>
      
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/admin.js"></script>

  
</body></html>