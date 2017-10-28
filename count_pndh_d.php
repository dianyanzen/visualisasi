<?php
Include('config/connect223.php');
date_default_timezone_set("Asia/Jakarta");
$nowdate = date("d/m/Y");

//COUNT PINDAH DETAIL
$sqlpindahd= "SELECT COUNT(NIK) AS COUNT FROM PINDAH_DETAIL  WHERE CREATED_DATE >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND CREATED_DATE < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtpindahd = oci_parse($conn, $sqlpindahd);
oci_execute($stmtpindahd);
$rpindahd = oci_fetch_array($stmtpindahd);

//TAMPILKAN PINDAH DETAIL
echo number_format(htmlentities($rpindahd['COUNT']),0,',','.');
?>