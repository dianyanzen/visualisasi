<?php
/*
$userdb="DISDUK_DB";
$passdb="ADMIN";
$dbname="localhost/XE";

$userdb="BMUSER";
$passdb="technicalbsl7";
$dbname="10.32.73.222:1522/orcl";
*/
$userdb="siakoff";
$passdb="ORA_OFF_700";
$dbname="10.32.73.223:1521/siakdb";		
//error_reporting(E_ERROR | E_PARSE);
$conn = oci_connect($userdb,$passdb,$dbname);
//$userdb2="siakoff";
//$passdb2="ORA_OFF_700";
//$dbname2="10.32.73.222:1521/siakdb";		
//$conn2 = oci_connect($userdb2,$passdb2,$dbname2);
//$userdb2="siakoff";
//$passdb2="ORA_OFF_700";
//$dbname2="10.32.73.222:1521/siakdb";		
//$conn3 = oci_connect($userdb3,$passdb3,$dbname3);


if (!$conn){
	
			echo "<div id='wrapper'>

            <nav class='navbar navbar-default navbar-static-top' role='navigation' style='margin-bottom: 0'>
            
			<div class='navbar-header'>
                <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
                    <span class='sr-only'>Toggle navigation</span>
                </button>
                <a class='navbar-brand' href='index.php'>Disduk Capil Kota Bandung</a>
            </div>
			</nav>
			<div id='page-wrapper'>
            <div class='row'>
                <div class='col-lg-12'>
					                    <h1 class='page-header'>Connection Error<br><small>Sangat Disayangkan Website Tidak Dapat Kami Tampilkan  <i class='fa fa-frown-o fa-fw'></i> </small></h1>
				</div>
				</div>
				<div class='col-lg-12'>
				</div>
			</div>			
			</div>";
			//echo "<div align='center'><h1>Connection Error Tidak Dapat Terhubung Dengan Database<br>";
			//echo "Sangat Disayangkan Website Tidak Dapat Kami Tampilkan</div>";
			exit;
		}
	
/*
$userdbz="DISDUK_DB";
$passdbz="ADMIN";
$dbnamez="localhost/XE";

$userdb="siakoff";
$passdb="ORA_OFF_700";
$dbname="10.32.73.223:1521/siakdb";

$konn = oci_connect($userdbz,$passdbz,$dbnamez);
if (!$konn){
   
		echo "Connection Error Tidak Dapat Terhubung Dengan Database";
		exit;
	
}

$konek = oci_connect($userdb1,$passdb1,$dbname);
if (!$konek){
	echo "Connection Error Database Tidak Terhubung Dengan WebSite";
		exit;
}*/
?>