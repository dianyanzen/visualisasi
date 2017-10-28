<!doctype html>
<html>
<?php require_once('head.php'); 
error_reporting(E_ERROR | E_PARSE);
$_SESSION['USER_ID'] = $_GET['user'];
$USER_DEC = $_SESSION['USER_ID'];
$USER_ID = base64_decode($USER_DEC);
date_default_timezone_set("Asia/Jakarta");
$sekarang = date('d/m/Y h:i:s');

?> 
  <link href="css/style.css" rel="stylesheet">
  <body>
  
  	<!-- NAVIGATION MENU -->
	<?php require_once('nav2.php'); 
					if (isset($_REQUEST['submit'])) //here give the name of your button on which you would like    //to perform action.
					{
					Include('../../config/connect223.php');
					date_default_timezone_set("Asia/Jakarta");
					if($_REQUEST['wall']=="")
					{
					}else{
					$WALL = $_POST['wall'];
					$sql = "SELECT * FROM SIAK_USER_PLUS WHERE USER_ID ='".$USER_ID."'";
					$stmt = oci_parse($conn222, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					$NIK = $row['NIK'];
					$sqlwall = "SELECT * FROM SIAK_REPORT WHERE USER_ID = '$USER_ID' AND TANGGAL = TO_DATE('$sekarang','DD/MM/YYYY HH24:MI:SS') AND REPORT ='$WALL'";
							$resultwall = oci_parse($conn222, $sqlwall);
							oci_execute($resultwall);
							$countwall = oci_fetch($resultwall);
							if($countwall == 0){
							$sqlspam = "SELECT * FROM SIAK_REPORT WHERE USER_ID = '$USER_ID' AND REPORT ='$WALL'";
							$resultspam = oci_parse($conn222, $sqlspam);
							oci_execute($resultspam);
							$countspam = oci_fetch($resultspam);
							if($countspam == 0){
							$sql= "INSERT INTO SIAK_REPORT (USER_ID, NIK, TANGGAL, REPORT) VALUES ('$USER_ID','$NIK',TO_DATE('$sekarang','DD/MM/YYYY HH24:MI:SS'),'$WALL')";
							$result=oci_parse($conn222, $sql);
							oci_execute($result);
							}
							}
					}
					}?>
    
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
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Report Form</h3>
              </div>
              <div class="panel-body">
                	<form method="post" name="formwall" name="formwall" action="indexreport.php?user=<?php echo htmlentities($_GET['user']) ?>" role="form">
                  <div class="form-group">
                    <textarea class="form-control" name="wall" id="wall" rows="3" type="text" placeholder="Write On Wall" required x-moz-errormessage="Write On Wall"></textarea>
                  </div>
                  
                  <div class="pull-right">
                    <div class="btn-toolbar">
                     <button type="submit" id="submit" name="submit" class="btn btn-default">Kirim</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div id='timeline'><?php
			Include('../../config/connect223.php');
			date_default_timezone_set("Asia/Jakarta");
			$sql= "SELECT * FROM (SELECT USER_ID, NIK, TO_CHAR(TANGGAL,'DD FMMonth YYYY') AS TANGGAL_T, REPORT FROM SIAK_REPORT ORDER BY TANGGAL DESC) WHERE  rownum <= 20";
			$stmt = oci_parse($conn222, $sql);
			oci_execute($stmt);
			while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
			$TUSER_ID = $row['USER_ID'];
			$TNIK = $row['NIK'];
			$TTANGGAL = $row['TANGGAL_T'];
			$TREPORT = $row['REPORT'];
			echo "<div class='panel panel-default post'>
              <div class='panel-body'>
                 <div class='row'>
                   <div class='col-sm-2'>
                     <spann class='post-avatar thumbnail'>";
				$Nquery= "SELECT FACE FROM FACES WHERE NIK= '".$TNIK."'";
				$Nstid = oci_parse($conn222, $Nquery);
				oci_execute($Nstid);
				$Nrow = oci_fetch_array($Nstid, OCI_ASSOC+OCI_RETURN_NULLS);
				if (!$Nrow) {
				$filename = 'assets/img/pp/'.htmlentities($TNIK).'.jpg';
				if (file_exists($filename)) {
				ECHO "<img src='assets/img/pp/".htmlentities($TNIK).".jpg' alt='Dian Yanzen' class='img-circle' style='width: 80px; height: 80px;'>";
				} 
				else {
				// echo $filename;
				ECHO "<img src='assets/img/default80x80.jpg' alt='Dian Yanzen' class='img-circle' style='width: 80px; height: 80px;'>";
				}
				} else {
				$img = $Nrow['FACE']->load();
				// header("Content-type: image/jpeg");
				// print $img;
				ECHO "<img src='data:image/png;base64,".base64_encode($img)."' class='img-circle' style='width: 80px; height: 80px;'>";
				}
				ECHO "<div class='text-center'>".$TUSER_ID."</div></spann>
                     <div class='likes text-center'>".$TTANGGAL."</div>
                   </div>
                   <div class='col-sm-10'>
                     <div class='bubble'>
                       <div class='pointer'>
                         <p>".$TREPORT."</p>
                       </div>
                       <div class='pointer-border'></div>
                     </div>
                     <div class='clearfix'></div>
					</div>
                 </div>
              </div>
            </div>"
			;
}
?>
            </div>
            
			
			<!--- Batas -->
          </div>
     
        </div>   
	</div> <!-- /container -->
	<?php }?>


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
	<script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>
	<script src="assets/js/jquery.flexslider.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/js/admin.js"></script>
  <script src="../../js/jquery.masked-input.js"></script>
</body></html>