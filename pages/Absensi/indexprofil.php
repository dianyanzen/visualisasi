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
                                <li class="active"><a href="#">Data Pengguna</a>
                                </li>
                                <li><a href="indexpswd.php?user=<?php echo htmlentities($_GET['user']) ?>">Kata Sandi</a>
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
	Include('../../config/connect223.php');
	 //$USER_ID = $_POST['user_id'];
	 $NAMA_LGKP = $_POST['nama_lgkp'];
	 $NIK = $_POST['nik'];
	 $TMPT_LHR = $_POST['tmpt_lhr'];
	 $TGL_LHR = $_POST['tgl_lhr'];
	 $TELP = $_POST['telp'];
	 $JENIS_KLMIN = $_POST['jenis_klmin'];
	 $ALAMAT = $_POST['alamat'];
	 $sql= "UPDATE SIAK_USER_PLUS SET NAMA_LGKP='$NAMA_LGKP', NIK='$NIK', TMPT_LHR='$TMPT_LHR',TGL_LHR=TO_DATE('$TGL_LHR','DD-MM-YYYY'), TELP='$TELP',JENIS_KLMIN='$JENIS_KLMIN',ALAMAT_RUMAH='$ALAMAT' WHERE USER_ID = '$USER_ID'";
	$result=oci_parse($conn222, $sql);
	oci_execute($result);
	?><div class="panel panel-primary">
											<div class="panel-heading">
												Sistem Information Administrator - Ubah Data User
											</div>
										<div class="panel-body" >
									<?php	ECHO "<div class='row'>
								<div class='col-lg-12'>";
						echo "<div class='alert alert-info alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                Selamat, Data Anda Berhasil Di Ubah <a href='#' class='alert-link'>Disduk Capil Kota Bandung !</a>.
                            </div>";
						echo"</div>
				
        </div>
        <!-- /#page-wrapper -->";?>
										<form method="post" name="formstatistik" id="formstatistik" action="indexprofil.php?user=<?php echo htmlentities($_GET['user']) ?>" role="form">
	
																												<!--start row-->
										<div class="row">
											<div class="col-lg-12">
											
                                            <div class="form-group col-lg-4">
											<fieldset disabled>
											<label>User Id</label>
											<div class="form-group input-group">
                                            <span class="input-group-addon">@</span>
                                            <select name="user_id" id="user_id" class="form-control" required>
											<?php Include('../../config/connect223.php');?>
											<?php $sql= "select USER_ID, NAMA_LGKP from SIAK_USER_PLUS WHERE USER_ID = '".$USER_ID."'";
												$stmt = oci_parse($conn222, $sql);
												oci_execute($stmt);
												while (($row = oci_fetch_array($stmt,OCI_ASSOC)) != false) {
                                               	ECHO "<option value='".htmlentities($row['USER_ID'])."'>".htmlentities($row['USER_ID'])."</option>";
												};
												?>
                                            </select>
											</div>
											</fieldset>
											</div>
											
										<!-- Div -->
										<div class="form-group col-lg-4">
											<label>Nama Lengkap</label>
											<?PHP
											$sql= "select NAMA_LGKP, NIK, TMPT_LHR, TO_CHAR(TGL_LHR,'DD-MM-YYYY') AS TGL_LHR, TELP, ALAMAT_RUMAH from SIAK_USER_PLUS WHERE USER_ID = '".$USER_ID."'";
											$stmt = oci_parse($conn222, $sql);
											oci_execute($stmt);
											$row = oci_fetch_array($stmt);
											?>
											<?php $P1 = $row['NAMA_LGKP'];?>
											<?php if($P1):?>
                                            <input name="nama_lgkp" id="nama_lgkp" VALUE="<?php echo $P1 ?>" class="form-control" type="text" placeholder="Nama Lengkap" maxlength="50" required x-moz-errormessage="Insert Nama Lengkap">
											<?php ELSE: ?>
											<input name="nama_lgkp" id="nama_lgkp" class="form-control" type="text" placeholder="Nama Lengkap" maxlength="50" required x-moz-errormessage="Insert Nama Lengkap">
											<?php endif; ?>
											</div>
										<div class="form-group col-lg-4">
											<label>Nik</label>
											<?php $P2 = $row['NIK'];?>
											<?php if($P2):?>
                                            <input name="nik" id="nik" class="form-control" type="text" VALUE="<?php echo $P2 ?>" placeholder="Nik" pattern=".{16,}" data-masked-input="9999999999999999" maxlength="16" required x-moz-errormessage="Isikan Format Nik Dengan Benar">
											<?php ELSE: ?>
											<input name="nik" id="nik" class="form-control" type="text" placeholder="Nik" pattern=".{16,}" data-masked-input="9999999999999999" maxlength="16" required x-moz-errormessage="Isikan Format Nik Dengan Benar">
											<?php endif; ?>
											</div>
											</div>
											</div>
										<div class="row">
										<div class="col-lg-12">	
											
											<div class="form-group col-lg-3">
											<label>Tempat Lahir</label>
											
											<?php $P3 = $row['TMPT_LHR'];?>
											<?php if($P3):?>
                                            <input name="tmpt_lhr" id="tmpt_lhr" class="form-control" type="text" VALUE="<?php echo $P3 ?>" placeholder="Tempat Lahir" maxlength="50" required x-moz-errormessage="Insert Tempat Lahir">
											<?php ELSE: ?>
											<input name="tmpt_lhr" id="tmpt_lhr" class="form-control" type="text" placeholder="Tempat Lahir" maxlength="50" required x-moz-errormessage="Insert Tempat Lahir">
											<?php endif; ?>
											</div>
											<div class="form-group col-lg-3">
											<label>Tanggal Lahir</label>
											<div class="form-group input-group">
											<?php $P4 = $row['TGL_LHR'];?>
											<?php if($P4):?>
                                            <input name="tgl_lhr" id="tgl_lhr" class="form-control" type="text"  VALUE="<?php echo $P4 ?>" placeholder="DD-MM-YYYY" pattern=".{10,}" data-masked-input="99-99-9999" maxlength="50" required x-moz-errormessage="Insert Tanggal Lahir">
											<?php ELSE: ?>
											<input name="tgl_lhr" id="tgl_lhr" class="form-control" type="text" placeholder="DD-MM-YYYY" pattern=".{10,}" data-masked-input="99-99-9999" maxlength="50" required x-moz-errormessage="Insert Tanggal Lahir">
											<?php endif; ?>
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											</div>
											</div>
											<div class="form-group col-lg-3">
											<label>Jenis Kelamin</label>
											<?PHP
											$sql= "select JENIS_KLMIN from SIAK_USER_PLUS WHERE USER_ID = '".$USER_ID."'";
											$stmt = oci_parse($conn222, $sql);
											oci_execute($stmt);
											$row = oci_fetch_array($stmt);
											if($row['JENIS_KLMIN'] == '1')
											{
											?>
											<select name="jenis_klmin" id="jenis_klmin" class="form-control" required>
                                            <option value='1'  selected="selected">Laki-Laki</option>
											<option value='2'>Perempuan</option>
											</select>
											<?PHP
											}ELSE{
											?>
											<select name="jenis_klmin" id="jenis_klmin" class="form-control" required>
                                            <option value='1'>Laki-Laki</option>
											<option value='2' selected="selected">Perempuan</option>
											</select>
											<?PHP
											}
											?>
											</div>
											<div class="form-group col-lg-3">
											<label>Telepon</label>
											<div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
											<?PHP
											$sql= "select NAMA_LGKP, NIK, TMPT_LHR, TO_CHAR(TGL_LHR,'DD-MM-YYYY') AS TGL_LHR, TELP, ALAMAT_RUMAH from SIAK_USER_PLUS WHERE USER_ID = '".$USER_ID."'";
											$stmt = oci_parse($conn222, $sql);
											oci_execute($stmt);
											$row = oci_fetch_array($stmt);
											?>
											<?php $P5 = $row['TELP'];?>
											<?php if($P5):?>
                                            <input name="telp" id="telp" class="form-control" type="text" VALUE="<?php echo $P5 ?>" placeholder="telp" data-masked-input="9999999999999999" maxlength="16" required x-moz-errormessage="Insert Telp">
											<?php ELSE: ?>
											<input name="telp" id="telp" class="form-control" type="text" placeholder="telp" data-masked-input="9999999999999999" maxlength="16" required x-moz-errormessage="Insert Telp">
											<?php endif; ?>
											</div>
											</div>
											</div>
										</div>
										<div class="row">
										<div class="col-lg-12">	
											
											<div class="form-group col-lg-12">
                                            <label>Alamat Rumah</label>
											<?php $P6 = $row['ALAMAT_RUMAH'];?>
											<?php if($P6):?>
                                            <textarea class="form-control" name="alamat" id="alamat" rows="3" type="text" placeholder="Alamat Rumah" required x-moz-errormessage="Insert Alamat"><?php echo $P6 ?></textarea>
											<?php ELSE: ?>
											<textarea class="form-control" name="alamat" id="alamat" rows="3" type="text" placeholder="Alamat Rumah" required x-moz-errormessage="Insert Alamat"></textarea>
											<?php endif; ?>
                                        </div>
											</div>
										</div>
										
										</div>
										<!-- end panel -->
									<div class="panel-footer">
										<button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Update User Data</button>
									</div>
									</form>
									</div> <?php
		
}else{ ?>
	<div class="panel panel-primary">
											<div class="panel-heading">
												Sistem Information Administrator - Ubah Data User
											</div>
										<div class="panel-body" >
										
										<form method="post" name="formstatistik" id="formstatistik" action="indexprofil.php?user=<?php echo htmlentities($_GET['user']) ?>" role="form">
	
																												<!--start row-->
										<div class="row">
											<div class="col-lg-12">
											
                                            <div class="form-group col-lg-4">
											<fieldset disabled>
											<label>User Id</label>
											<div class="form-group input-group">
                                            <span class="input-group-addon">@</span>
                                            <select name="user_id" id="user_id" class="form-control" required>
											<?php Include('../../config/connect223.php');?>
											<?php $sql= "select USER_ID, NAMA_LGKP from SIAK_USER_PLUS WHERE USER_ID = '".$USER_ID."'";
												$stmt = oci_parse($conn222, $sql);
												oci_execute($stmt);
												while (($row = oci_fetch_array($stmt,OCI_ASSOC)) != false) {
                                               	ECHO "<option value='".htmlentities($row['USER_ID'])."'>".htmlentities($row['USER_ID'])."</option>";
												};
												?>
                                            </select>
											</div>
											</fieldset>
											</div>
											
										<!-- Div -->
										<div class="form-group col-lg-4">
											<label>Nama Lengkap</label>
											<?PHP
											$sql= "select NAMA_LGKP, NIK, TMPT_LHR, TO_CHAR(TGL_LHR,'DD-MM-YYYY') AS TGL_LHR, TELP, ALAMAT_RUMAH from SIAK_USER_PLUS WHERE USER_ID = '".$USER_ID."'";
											$stmt = oci_parse($conn222, $sql);
											oci_execute($stmt);
											$row = oci_fetch_array($stmt);
											?>
											<?php $P1 = $row['NAMA_LGKP'];?>
											<?php if($P1):?>
                                            <input name="nama_lgkp" id="nama_lgkp" VALUE="<?php echo $P1 ?>" class="form-control" type="text" placeholder="Nama Lengkap" maxlength="50" required x-moz-errormessage="Insert Nama Lengkap">
											<?php ELSE: ?>
											<input name="nama_lgkp" id="nama_lgkp" class="form-control" type="text" placeholder="Nama Lengkap" maxlength="50" required x-moz-errormessage="Insert Nama Lengkap">
											<?php endif; ?>
											</div>
										<div class="form-group col-lg-4">
											<label>Nik</label>
											<?php $P2 = $row['NIK'];?>
											<?php if($P2):?>
                                            <input name="nik" id="nik" class="form-control" type="text" VALUE="<?php echo $P2 ?>" placeholder="Nik" pattern=".{16,}" data-masked-input="9999999999999999" maxlength="16" required x-moz-errormessage="Isikan Format Nik Dengan Benar">
											<?php ELSE: ?>
											<input name="nik" id="nik" class="form-control" type="text" placeholder="Nik" pattern=".{16,}" data-masked-input="9999999999999999" maxlength="16" required x-moz-errormessage="Isikan Format Nik Dengan Benar">
											<?php endif; ?>
											</div>
											</div>
											</div>
										<div class="row">
										<div class="col-lg-12">	
											
											<div class="form-group col-lg-3">
											<label>Tempat Lahir</label>
											
											<?php $P3 = $row['TMPT_LHR'];?>
											<?php if($P3):?>
                                            <input name="tmpt_lhr" id="tmpt_lhr" class="form-control" type="text" VALUE="<?php echo $P3 ?>" placeholder="Tempat Lahir" maxlength="50" required x-moz-errormessage="Insert Tempat Lahir">
											<?php ELSE: ?>
											<input name="tmpt_lhr" id="tmpt_lhr" class="form-control" type="text" placeholder="Tempat Lahir" maxlength="50" required x-moz-errormessage="Insert Tempat Lahir">
											<?php endif; ?>
											</div>
											<div class="form-group col-lg-3">
											<label>Tanggal Lahir</label>
											<div class="form-group input-group">
											<?php $P4 = $row['TGL_LHR'];?>
											<?php if($P4):?>
                                            <input name="tgl_lhr" id="tgl_lhr" class="form-control" type="text"  VALUE="<?php echo $P4 ?>" placeholder="DD-MM-YYYY" pattern=".{10,}" data-masked-input="99-99-9999" maxlength="50" required x-moz-errormessage="Insert Tanggal Lahir">
											<?php ELSE: ?>
											<input name="tgl_lhr" id="tgl_lhr" class="form-control" type="text" placeholder="DD-MM-YYYY" pattern=".{10,}" data-masked-input="99-99-9999" maxlength="50" required x-moz-errormessage="Insert Tanggal Lahir">
											<?php endif; ?>
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											</div>
											</div>
											<div class="form-group col-lg-3">
											<label>Jenis Kelamin</label>
											<?PHP
											$sql= "select JENIS_KLMIN from SIAK_USER_PLUS WHERE USER_ID = '".$USER_ID."'";
											$stmt = oci_parse($conn222, $sql);
											oci_execute($stmt);
											$row = oci_fetch_array($stmt);
											if($row['JENIS_KLMIN'] == '1')
											{
											?>
											<select name="jenis_klmin" id="jenis_klmin" class="form-control" required>
                                            <option value='1'  selected="selected">Laki-Laki</option>
											<option value='2'>Perempuan</option>
											</select>
											<?PHP
											}ELSE{
											?>
											<select name="jenis_klmin" id="jenis_klmin" class="form-control" required>
                                            <option value='1'>Laki-Laki</option>
											<option value='2' selected="selected">Perempuan</option>
											</select>
											<?PHP
											}
											?>
											</div>
											<div class="form-group col-lg-3">
											<label>Telepon</label>
											<div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
											<?PHP
											$sql= "select NAMA_LGKP, NIK, TMPT_LHR, TO_CHAR(TGL_LHR,'DD-MM-YYYY') AS TGL_LHR, TELP, ALAMAT_RUMAH from SIAK_USER_PLUS WHERE USER_ID = '".$USER_ID."'";
											$stmt = oci_parse($conn222, $sql);
											oci_execute($stmt);
											$row = oci_fetch_array($stmt);
											?>
											<?php $P5 = $row['TELP'];?>
											<?php if($P5):?>
                                            <input name="telp" id="telp" class="form-control" type="text" VALUE="<?php echo $P5 ?>" placeholder="telp" data-masked-input="9999999999999999" maxlength="16" required x-moz-errormessage="Insert Telp">
											<?php ELSE: ?>
											<input name="telp" id="telp" class="form-control" type="text" placeholder="telp" data-masked-input="9999999999999999" maxlength="16" required x-moz-errormessage="Insert Telp">
											<?php endif; ?>
											</div>
											</div>
											</div>
										</div>
										<div class="row">
										<div class="col-lg-12">	
											
											<div class="form-group col-lg-12">
                                            <label>Alamat Rumah</label>
											<?php $P6 = $row['ALAMAT_RUMAH'];?>
											<?php if($P6):?>
                                            <textarea class="form-control" name="alamat" id="alamat" rows="3" type="text" placeholder="Alamat Rumah" required x-moz-errormessage="Insert Alamat"><?php echo $P6 ?></textarea>
											<?php ELSE: ?>
											<textarea class="form-control" name="alamat" id="alamat" rows="3" type="text" placeholder="Alamat Rumah" required x-moz-errormessage="Insert Alamat"></textarea>
											<?php endif; ?>
                                        </div>
											</div>
										</div>
										
										</div>
										<!-- end panel -->
									<div class="panel-footer">
										<button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Update User Data</button>
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