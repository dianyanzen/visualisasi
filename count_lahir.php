<?php
Include('config/connect223.php');
date_default_timezone_set("Asia/Jakarta");
$nowdate = date("d/m/Y");

//COUNT LAHIR
$sqllhr= "SELECT COUNT(BAYI_NO) AS COUNT FROM CAPIL_LAHIR  WHERE PLPR_TGL_LAPOR >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND PLPR_TGL_LAPOR < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtlhr = oci_parse($conn, $sqllhr);
oci_execute($stmtlhr);
$rlhr = oci_fetch_array($stmtlhr);

//TAMPILKAN LAHIR
echo number_format(htmlentities($rlhr['COUNT']),0,',','.');
?>