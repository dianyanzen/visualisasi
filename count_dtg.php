<?php
Include('config/connect223.php');
date_default_timezone_set("Asia/Jakarta");
$nowdate = date("d/m/Y");

//COUNT DATANG
$sqldatang= "SELECT COUNT(NO_PINDAH) AS COUNT FROM DATANG_HEADER  WHERE CREATED_DATE >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND CREATED_DATE < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtdatang = oci_parse($conn, $sqldatang);
oci_execute($stmtdatang);
$rdatang = oci_fetch_array($stmtdatang);

//TAMPILKAN PINDAH
echo number_format(htmlentities($rdatang['COUNT']),0,',','.');
?>