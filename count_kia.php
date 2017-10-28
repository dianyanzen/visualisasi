<?php
Include('config/connect223.php');
date_default_timezone_set("Asia/Jakarta");
$nowdate = date("d/m/Y");

//COUNT KIA
$sqlkia= "SELECT COUNT(NIK) AS COUNT FROM LTS_KIA  WHERE TGL_CETAK >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND TGL_CETAK < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtkia = oci_parse($conn, $sqlkia);
oci_execute($stmtkia);
$rkia = oci_fetch_array($stmtkia);

//TAMPILKAN KIA
echo number_format(htmlentities($rkia['COUNT']),0,',','.');
?>