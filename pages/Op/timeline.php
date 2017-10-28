<?php
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