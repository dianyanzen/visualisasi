<!doctype html>
<html>
<?php require_once('head.php'); 
error_reporting(E_ERROR | E_PARSE);
$_SESSION['USER_ID'] = $_GET['user'];
$USER_DEC = $_SESSION['USER_ID'];
$USER_ID = base64_decode($USER_DEC);
// Include('../../config/connect223.php');
// date_default_timezone_set("Asia/Jakarta");
// $sql= "SELECT USER_ID, NAMA_LGKP FROM SIAK_USER_PLUS WHERE USER_ID ='".$USER_ID."'";
// $stmt = oci_parse($conn222, $sql);
// oci_execute($stmt);
// $row = oci_fetch_array($stmt);
// $ABSEN_USERID = $row['USER_ID'];
// $ABSEN_NAMA = $row['NAMA_LGKP'];
// $today = date('d-m-Y');
// $ABSEN_TANGGAL = $today;
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

	  <!-- FIRST ROW OF BLOCKS -->     
      <div class="row">

      <!-- USER PROFILE BLOCK -->
        <div class="col-sm-3 col-lg-3">
      		<div class="dash-unit">
	      		<dtitle>Profil Pengguna</dtitle>
	      		<hr>
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
				ECHO "<img src='assets/img/pp/".$row['NIK'].".jpg' alt='Dian Yanzen' class='img-circle' style='width: 80px; height: 80px;'>";
				} 
				else {
				// echo $filename;
				ECHO "<img src='assets/img/default80x80.jpg' alt='Dian Yanzen' class='img-circle' style='width: 80px; height: 80px;'>";
				}
				} else {
				$img = $row['FACE']->load();
				// header("Content-type: image/jpeg");
				// print $img;
				ECHO "<img src='data:image/png;base64,".base64_encode($img)."' class='img-circle' style='width: 80px; height: 80px;'>";
				}
				?>
				</div><!-- /thumbnail -->
				<?php 
					$sql= "SELECT * FROM SIAK_USER_PLUS WHERE USER_ID ='".$USER_ID."'";
					$stmt = oci_parse($conn222, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
				?>
				<h1><?php echo $row['NAMA_DPN'];?></h1>
				<h3><?php echo $row['ALAMAT_RUMAH'];?></h3>
				<br>
					<div class="info-user">
						<a target="_blank" href="indexactivity.php?user=<?php echo htmlentities($_GET['user']) ?>"><span aria-hidden="true" class="li_display fs1"></span></a>
						<a target="_blank" href="user.php?user=<?php echo htmlentities($_GET['user']) ?>"><span aria-hidden="true" class="li_user fs1"></span></a>
						<a target="_blank" href="user.php?user=<?php echo htmlentities($_GET['user']) ?>"><span aria-hidden="true" class="li_key fs1"></span></a>
						<a target="_blank" href="../gis/index.php"><span aria-hidden="true" class="li_location fs1"></span><a>
					</div>
				</div>
        </div>
		<!-- DONUT CHART BLOCK -->
        <div class="col-sm-3 col-lg-3">
      		<div class="dash-unit">
		  		<dtitle>Clock In</dtitle>
		  		<hr>
	        <form id="formcekin" action="indexin.php?user=<?php echo htmlentities($_GET['user']) ?>" method="post">
                      <!--<form method="post" name="cekin" method="post" role="form" action="adminin.php?user=<?php //echo htmlentities($_GET['user']) ?>" id="cekin">-->
					  <input type="hidden" name="absensi" value="ok" />					
					 <a href="#" onclick="document.getElementById('formcekin').submit();" class="col-lg-12 col-md-1">
					<br>
					<br>
                            <div class="row">
                                <div class="text-center">
                                    <i class="fa fa-sign-in fa-4x"></i>
									<div class="huge">Clock In</div>
                                </div>
                                <!--
								<div class="col-xs-10 text-right">
                                    <div class="huge">Datang</div>
                                </div>
								-->
                            </div>
                    
					</a>
					</form>
			</div>
        </div>
		<!-- DONUT CHART BLOCK -->
        <div class="col-sm-3 col-lg-3">
      		<div class="dash-unit">
		  		<dtitle>Clock Out</dtitle>
		  		<hr>
	        	<form id="formcekout" action="indexout.php?user=<?php echo htmlentities($_GET['user']) ?>" method="post">
					<input type="hidden" name="absensi" value="ok" />
					<a href="#" onclick="document.getElementById('formcekout').submit();" class="col-lg-12 col-md-1">
                    <br>
					<br>
					
                            <div class="row">
                                <div class="text-center">
                                    <i class="fa fa-sign-out fa-4x"></i>
									<div class="huge">Clock Out</div>
                                </div>
                                <!--
								<div class="col-xs-10 text-right">
                                    <div class="huge">Datang</div>
                                </div>
								-->
                            </div>
                        
					</a>
					</form>
			</div>
        </div>
		 <div class="col-sm-3 col-lg-3">

      <!-- LOCAL TIME BLOCK -->
      		<div class="half-unit">
	      		<dtitle>Jam</dtitle>
	      		<hr>
		      		<div class="clockcenter">
			      		<digiclock>00:00:00</digiclock>
		      		</div>
			</div>

      <!-- SERVER UPTIME -->
			<div class="half-unit">
	      		<dtitle>REKAP ABSENSI</dtitle>
	      		<hr>
				<div class="cont text-center">
	      		<form id="formstatus" action="indexrekap.php?user=<?php echo htmlentities($_GET['user']) ?>" method="post">
					<input type="hidden" name="status" value="ok" />
                      <a href="#" onclick="document.getElementById('formstatus').submit();">
                                    <p><i class="fa fa-steam-square fa-2x"></i></p>
									<p>Rekap Absensi</p>
                </a>
				</form>
				</div>
			</div>

        </div>
		
      <!-- DONUT CHART BLOCK -->
	  </div>
	  <div class="row" style="display: none;">
        <div class="col-sm-3 col-lg-3">
      		<div class="dash-unit">
		  		<dtitle>Site Bandwidth</dtitle>
		  		<hr>
	        	<div id="load"></div>
	        	<h2>1%</h2>
			</div>
        </div>

      <!-- DONUT CHART BLOCK -->
        <div class="col-sm-3 col-lg-3">
      		<div class="dash-unit">
		  		<dtitle>Disk Space</dtitle>
		  		<hr>
	        	<div id="space"></div>
	        	<h2>65%</h2>
			</div>
        </div>
        
       
      </div><!-- /row -->
      
      
	  <!-- SECOND ROW OF BLOCKS -->     
      <div class="row">

	  <!-- GRAPH CHART - lineandbars.js file -->     
        <div class="col-sm-3 col-lg-3">
      		<div class="dash-unit">
      		<dtitle>Jumlah Input Kartu Keluarga</dtitle>
      		<hr>
			    <div class="section-graph">
			      <div id="chartkk"></div>
			      <br>
			      <div class="graph-info">
			        <i class="graph-arrow"></i>
			        <span class="graph-info-big"><span id='n_rkk'>0</span></span>
			      </div>
			    </div>
			</div>
        </div>
		<!-- GRAPH CHART - lineandbars.js file -->     
        <div class="col-sm-3 col-lg-3">
      		<div class="dash-unit">
      		<dtitle>Jumlah Input Biodata</dtitle>
      		<hr>
			    <div class="section-graph">
			      <div id="chartbio"></div>
			      <br>
			      <div class="graph-info">
			        <i class="graph-arrow"></i>
			        <span class="graph-info-big"><span id='n_rbio'>0</span></span>
			      </div>
			    </div>
			</div>
        </div>
		<!-- GRAPH CHART - lineandbars.js file -->     
        <div class="col-sm-3 col-lg-3">
      		<div class="dash-unit">
      		<dtitle>Jumlah Input Pindah Keluar</dtitle>
      		<hr>
			    <div class="section-graph">
			      <div id="chartpindah"></div>
			      <br>
			      <div class="graph-info">
			        <i class="graph-arrow"></i>
			        <span class="graph-info-big"><span id='n_rpindah'>0</span></span>
					<span class="graph-info-small">(<span id='n_rpindahd'>0</span>)</span>
			      </div>
			    </div>
			</div>
        </div>
		<!-- GRAPH CHART - lineandbars.js file -->     
        <div class="col-sm-3 col-lg-3">
      		<div class="dash-unit">
      		<dtitle>Jumlah Input Pindah Datang</dtitle>
      		<hr>
			    <div class="section-graph">
			      <div id="chartdatang"></div>
			      <br>
			      <div class="graph-info">
			        <i class="graph-arrow"></i>
			        <span class="graph-info-big"><span id='n_rdatang'>0</span></span>
					<span class="graph-info-small">(<span id='n_rdatangd'>0</span>)</span>
			      </div>
			    </div>
			</div>
        </div>
      </div><!-- /row -->
     
 
	  
      
      
	</div> <!-- /container -->
				<?php }?>
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
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="assets/js/lineandbars.js"></script>
    
	<script type="text/javascript" src="assets/js/dash-charts.js"></script>
	<script type="text/javascript" src="assets/js/gauge.js"></script>
	
	<!-- NOTY JAVASCRIPT -->
	<script type="text/javascript" src="assets/js/noty/jquery.noty.js"></script>
	<script type="text/javascript" src="assets/js/noty/layouts/top.js"></script>
	<script type="text/javascript" src="assets/js/noty/layouts/topLeft.js"></script>
	<script type="text/javascript" src="assets/js/noty/layouts/topRight.js"></script>
	<script type="text/javascript" src="assets/js/noty/layouts/topCenter.js"></script>
	
	<!-- You can add more layouts if you want -->
	<script type="text/javascript" src="assets/js/noty/themes/default.js"></script>
    <!-- <script type="text/javascript" src="assets/js/dash-noty.js"></script> This is a Noty bubble when you init the theme-->
	<script type="text/javascript" src="assets/js/highcharts_ori.js"></script>
	<script src="assets/js/jquery.flexslider.js" type="text/javascript"></script>

    <script type="text/javascript" src="assets/js/admin.js"></script>
  
</body></html>