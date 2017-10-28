<?php
Include('config/connect223.php');
date_default_timezone_set("Asia/Jakarta");
$nowdate = date("d/m/Y");

//COUNT PINDAH
$sqlpindah= "SELECT COUNT(NO_PINDAH) AS COUNT FROM PINDAH_HEADER  WHERE CREATED_DATE >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND CREATED_DATE < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtpindah = oci_parse($conn, $sqlpindah);
oci_execute($stmtpindah);
$rpindah = oci_fetch_array($stmtpindah);

//TAMPILKAN PINDAH
echo number_format(htmlentities($rpindah['COUNT']),0,',','.');
?>