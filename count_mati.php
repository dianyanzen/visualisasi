<?php
Include('config/connect223.php');
date_default_timezone_set("Asia/Jakarta");
$nowdate = date("d/m/Y");

//COUNT MATI
$sqlmati= "SELECT COUNT(MATI_NO) AS COUNT FROM CAPIL_MATI  WHERE PLPR_TGL_LAPOR >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND PLPR_TGL_LAPOR < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtmati = oci_parse($conn, $sqlmati);
oci_execute($stmtmati);
$rmati = oci_fetch_array($stmtmati);

//TAMPILKAN MATI
echo number_format(htmlentities($rmati['COUNT']),0,',','.');
?>