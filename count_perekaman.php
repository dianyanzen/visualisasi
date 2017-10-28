<?php
Include('config/connect223.php');
date_default_timezone_set("Asia/Jakarta");
$nowdate = date("d/m/Y");

//COUNT PEREKAMAN
$sqlrekam= "SELECT COUNT(NIK) AS COUNT FROM DEMOGRAPHICS_ALL_X  WHERE CURRENT_STATUS_CODE NOT LIKE 'CARD%' AND NAMA_KAB = 'KOTA BANDUNG' AND CREATED >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND CREATED < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtrekam = oci_parse($conn222, $sqlrekam);
oci_execute($stmtrekam);
$rrekam = oci_fetch_array($stmtrekam);

//TAMPILKAN PEREKAMAN
echo number_format(htmlentities($rrekam['COUNT']),0,',','.');
?>