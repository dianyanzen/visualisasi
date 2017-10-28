<?php
Include('config/connect223.php');
date_default_timezone_set("Asia/Jakarta");
$nowdate = date("d/m/Y");

//COUNT CERAI
$sqlcerai= "SELECT COUNT(CERAI_NO) AS COUNT FROM CAPIL_CERAI  WHERE CERAI_TGL_LAPOR >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND CERAI_TGL_LAPOR < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtcerai = oci_parse($conn, $sqlcerai);
oci_execute($stmtcerai);
$rcerai = oci_fetch_array($stmtcerai);

//TAMPILKAN CERAI
echo number_format(htmlentities($rcerai['COUNT']),0,',','.');
?>