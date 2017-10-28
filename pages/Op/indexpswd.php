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
                       
					<ul class="nav nav-pills">
								</li>
                                <li><a href="#" data-toggle="tab"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i>
								<span class="sr-only">Loading...</span></a></a>
                                </li>
								<li><a href="indexprofil.php?user=<?php echo htmlentities($_GET['user']) ?>">Data Pengguna</a>
								</li>
                                <li class="active"><a href="#">Kata Sandi</a>                     
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="kartukeluarga-pills">
								<br>
                                    <div class="col-lg-12">
										
									<?php

//if submit is not blanked i.e. it is clicked.
if (isset($_REQUEST['submit'])) //here give the name of your button on which you would like    //to perform action.
{
	?><div class="panel panel-primary">
											<div class="panel-heading">
												Sistem Information Administrator - Ubah Kata Sandi User
											</div>
										<div class="panel-body" >
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
									ECHO "<div class='row'>
									<div class='col-lg-12'>
									<div class='alert alert-info alert-dismissable'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
									Mohon Maaf Kata Sandi Anda Salah <a href='#' class='alert-link'>Disduk Capil Kota Bandung !</a>.
									</div>
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
									ECHO "<div class='row'>
									<div class='col-lg-12'>
									<div class='alert alert-info alert-dismissable'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
									Selamat, Kata Sandi Anda Anda Berhasil Di Ubah <a href='#' class='alert-link'>Disduk Capil Kota Bandung !</a>.
									</div>
									</div>
									</div>
									<!-- /#page-wrapper -->"; 
									}else{
									ECHO "<div class='row'>
									<div class='col-lg-12'>
									<div class='alert alert-info alert-dismissable'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
									Mohon Maaf Kata Sandi Anda Salah <a href='#' class='alert-link'>Disduk Capil Kota Bandung !</a>.
									</div>
									</div>
									</div>
									<!-- /#page-wrapper -->"; 
									}}?>
										<form method="post" name="formstatistik" id="formstatistik" action="indexpswd.php?user=<?php echo htmlentities($_GET['user']) ?>" role="form">
	
																												<!--start row-->
										<div class="row">
											<div class="col-lg-12">
											<div class="form-group col-lg-4">
											<label>Password Lama</label>
                                            <input name="user_psw1" id="user_psw1" class="form-control" type="password" required x-moz-errormessage="Please Insert Password User">
											</div>
											
											<div class="form-group col-lg-4">
											<label>Password Baru</label>
                                            <input name="user_psw2" id="user_psw2" class="form-control" type="password" required x-moz-errormessage="Please Insert Password User">
											</div>
											
											<div class="form-group col-lg-4">
											<label>Ulangi Password Baru</label>
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
									</div> <?php
		
}else{ ?>
	<div class="panel panel-primary">
											<div class="panel-heading">
												Sistem Information Administrator - Ubah Kata Sandi User
											</div>
										<div class="panel-body" >
										
										<form method="post" name="formstatistik" id="formstatistik" action="indexpswd.php?user=<?php echo htmlentities($_GET['user']) ?>" role="form">
	
																												<!--start row-->
										<div class="row">
											<div class="col-lg-12">
											<div class="form-group col-lg-4">
											<label>Password Lama</label>
                                            <input name="user_psw1" id="user_psw1" class="form-control" type="password" required x-moz-errormessage="Please Insert Password User">
											</div>
											
											<div class="form-group col-lg-4">
											<label>Password Baru</label>
                                            <input name="user_psw2" id="user_psw2" class="form-control" type="password" required x-moz-errormessage="Please Insert Password User">
											</div>
											
											<div class="form-group col-lg-4">
											<label>Ulangi Password Baru</label>
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
}
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