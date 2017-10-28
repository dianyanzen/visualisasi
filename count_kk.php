<?php
Include('config/connect223.php');
date_default_timezone_set("Asia/Jakarta");
$nowdate = date("d/m/Y");

//COUNT KELUARGA
$sqlkk= "select COUNT(NO_KK) AS COUNT from DATA_KELUARGA WHERE TGL_INSERTION >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND TGL_INSERTION < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtkk = oci_parse($conn, $sqlkk);
oci_execute($stmtkk);
$rkk = oci_fetch_array($stmtkk);
echo number_format(htmlentities($rkk['COUNT']),0,',','.');
?>