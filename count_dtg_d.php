<?php
Include('config/connect223.php');
date_default_timezone_set("Asia/Jakarta");
$nowdate = date("d/m/Y");

//COUNT DATANG DETAIL
$sqldatangd= "SELECT COUNT(NIK) AS COUNT FROM DATANG_DETAIL  WHERE CREATED_DATE >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND CREATED_DATE < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtdatangd = oci_parse($conn, $sqldatangd);
oci_execute($stmtdatangd);
$rdatangd = oci_fetch_array($stmtdatangd);

//TAMPILKAN PINDAH
echo number_format(htmlentities($rdatangd['COUNT']),0,',','.');
?>