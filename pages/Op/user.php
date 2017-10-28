<!doctype html>
<html>
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

?> 
    <link rel="stylesheet" href="assets/css/register.css">
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
        <div class="row">

        	<div class="col-lg-6">
        		
        		<div class="register-info-wraper">
        			<div id="register-info">
        				<div class="cont2">
        					<div class="thumbnail">
								<?php
				Include('../../config/connect223.php');
				$sql= "SELECT * FROM SIAK_USER_PLUS WHERE USER_ID ='".$USER_ID."'";
					$stmt = oci_parse($conn222, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
				$query= "SELECT FACE FROM FACES WHERE NIK= '".$row['NIK']."'";
				$stid = oci_parse($conn222, $query);
				oci_execute($stid);
				$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
				// if($row>0){
				// $img = $row['FACE']->load();

				if (!$row) {
				$sql= "SELECT * FROM SIAK_USER_PLUS WHERE USER_ID ='".$USER_ID."'";
					$stmt = oci_parse($conn222, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
				$filename = 'assets/img/pp/'.$row['NIK'].'.jpg';
				if (file_exists($filename)) {
				ECHO "<img src='assets/img/pp/".$row['NIK'].".jpg' alt='Dian Yanzen' class='img-circle' style='width: 150px; height: 150px;'>";
				} 
				else {
				// echo $filename;
				ECHO "<img src='assets/img/default80x80.jpg' alt='Dian Yanzen' class='img-circle' style='width: 150px; height: 150px;'>";
				}
				} else {
				$img = $row['FACE']->load();
				// header("Content-type: image/jpeg");
				// print $img;
				ECHO "<img src='data:image/png;base64,".base64_encode($img)."' class='img-circle' style='width: 150px; height: 150px;'>";
				}
				?>
							</div><!-- /thumbnail -->
							<?php 
					$sql= "SELECT * FROM SIAK_USER_PLUS WHERE USER_ID ='".$USER_ID."'";
					$stmt = oci_parse($conn222, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
				?>
							<h2><?php echo $row['NAMA_LGKP'];?></h2>
							<hr>
        				</div>
        				<div class="row">
        					<div class="col-lg-6">
        						<div class="cont3">
        							<p><ok>Username:</ok> <?php echo $row['USER_ID'];?></p>
        							<p><ok>Jenis Kelamin:</ok> <?php $jk = $row['JENIS_KLMIN'];
									if( $jk == 1){ echo "Laki-Laki";	}else { echo "Perempuan"; }?></p>
        							<p><ok>Kantor:</ok> <?php echo $row['NAMA_KANTOR'];?></p>
        							<p><ok>Alamat Kantor:</ok> <?php echo $row['ALAMAT_KANTOR'];?></p>
        						</div>
        					</div>
        					<div class="col-lg-6">
        						<div class="cont3">
        						<p><ok>Tempat Lahir:</ok> <?php echo $row['TMPT_LHR'];?></p>
        						<p><ok>Tanggal Lahir:</ok> <?php echo $row['TGL_LHR'];?></p>
        						<p><ok>Telephone:</ok> <?php echo $row['TELP'];?></p>
        						</div>
        					</div>
        				</div><!-- /inner row -->
						
        			</div>
        		</div>

        	</div>
			<div class="col-lg-6">
        		
        		<div class="register-info-wraper">
        			<div id="register-info">
        				<div class="panel panel-primary">
											<div class="panel-heading">
												Sistem Information Administrator - Ubah Kata Sandi User
											</div>
										<div class="panel-body" >
										
										<form method="post" name="formstatistik" id="formstatistik" action="user.php?user=<?php echo htmlentities($_GET['user']) ?>" role="form">
	
																												<!--start row-->
										<div class="row">
											<div class="col-lg-12">
											<div class="form-group col-lg-4">
											<label>Old Password</label>
                                            <input name="user_psw1" id="user_psw1" class="form-control" type="password" required x-moz-errormessage="Please Insert Password User">
											</div>
											
											<div class="form-group col-lg-4">
											<label>New Password</label>
                                            <input name="user_psw2" id="user_psw2" class="form-control" type="password" required x-moz-errormessage="Please Insert Password User">
											</div>
											
											<div class="form-group col-lg-4">
											<label>Re-Password</label>
                                            <input name="user_psw3" id="user_psw3" class="form-control" type="password"  required x-moz-errormessage="Please Insert Password User">
											</div>
											</div>
											</div>
										<div class="row">
										<div class="col-lg-12">	
											
											
										</div>
										</div>
										<div class="row">
										<div class="col-lg-12">	
											
											
											</div>
										</div>
										
										</div>
										<!-- end panel -->
									<div class="panel-footer">
										<button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Update Password</button>
									</div>
									</form>
									</div>
									<?php

//if submit is not blanked i.e. it is clicked.
if (isset($_REQUEST['submit'])) //here give the name of your button on which you would like    //to perform action.
{
	?>
									<?php	
									Include('../../config/connect223.php');
									//$USER_ID = $_POST['user_id'];
									$PASSWORD1 = MD5($_POST['user_psw1']);
									$PASSWORD2 = MD5($_POST['user_psw2']);
									$PASSWORD3 = MD5($_POST['user_psw3']);
									$sql = "SELECT * FROM SIAK_USER_PLUS WHERE USER_ID = '$USER_ID' AND USER_PWD = '$PASSWORD1'";
									$result = oci_parse($conn222, $sql);
									oci_execute($result);
									$count = oci_fetch($result);
									if($count == 0){
									ECHO "
									<div class='col-lg-12'>
									<div class='alert alert-info alert-dismissable'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
									Mohon Maaf Kata Sandi Anda Salah<br><a href='#' class='alert-link'>Disduk Capil Kota Bandung !</a>.
									</div>
									</div>
									
									<!-- /#page-wrapper -->";
									}
									else 
									{
									if ( $PASSWORD2 == $PASSWORD3 ) {
									$sql= "UPDATE SIAK_USER_PLUS SET USER_PWD='$PASSWORD2' WHERE USER_ID = '$USER_ID' AND USER_PWD = '$PASSWORD1'";
									$result=oci_parse($conn222, $sql);
									oci_execute($result);
									ECHO "
									<div class='col-lg-12'>
									<div class='alert alert-info alert-dismissable'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
									Selamat, Kata Sandi Anda Anda Berhasil Di Ubah<br><a href='#' class='alert-link'>Disduk Capil Kota Bandung !</a>.
									</div>
									</div>
									
									<!-- /#page-wrapper -->"; 
									}else{
									ECHO "
									<div class='col-lg-12'>
									<div class='alert alert-info alert-dismissable'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
									Mohon Maaf Kata Sandi Anda Salah<br><a href='#' class='alert-link'>Disduk Capil Kota Bandung !</a>.
									</div>
									</div>
									
									<!-- /#page-wrapper -->"; 
									}}
									
									}?>

        				
        			</div>
        		</div>

        	</div>

		
    
    
	  </div>
    </div>
					<?php } ?>

	<div id="footerwrap">
      	<footer class="clearfix"></footer>
      	<div class="container">
      		<div class="row">
      			<div class="col-sm-12 col-lg-12">
      			<p><img src="assets/img/logo.png" alt=""></p>
				<p><?php $year=date('Y');?> <p id="footer">Copyright &copy; <?php echo $year;?> DianYanzen, DisdukCapil Kota Bandung</p>
      			</div>

      		</div><!-- /row -->
      	</div><!-- /container -->		
	</div><!-- /footerwrap -->


    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/bootstrap.js"></script>

  
</body></html>