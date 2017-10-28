<?php
Include('config/connect223.php');
date_default_timezone_set("Asia/Jakarta");
$nowdate = date("d/m/Y");

//COUNT KAWIN
$sqlkawin= "SELECT COUNT(KAWIN_NO) AS COUNT FROM CAPIL_KAWIN  WHERE KAWIN_TGL_LAPOR >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND KAWIN_TGL_LAPOR < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtkawin = oci_parse($conn, $sqlkawin);
oci_execute($stmtkawin);
$rkawin = oci_fetch_array($stmtkawin);

//TAMPILKAN KAWIN
echo number_format(htmlentities($rkawin['COUNT']),0,',','.');
?>