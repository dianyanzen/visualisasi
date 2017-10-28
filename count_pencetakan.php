<?php
Include('config/connect223.php');
date_default_timezone_set("Asia/Jakarta");
$nowdate = date("d/m/Y");

//COUNT PENCETAKAN
$sqlcetak= "SELECT COUNT(A.NIK) AS COUNT FROM CARD_MANAGEMENT@DBL2 A INNER JOIN DEMOGRAPHICS_ALL_X B ON A.NIK = B.NIK WHERE B.NAMA_KAB = 'KOTA BANDUNG' AND A.CREATED >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND A.CREATED < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtcetak = oci_parse($conn222, $sqlcetak);
oci_execute($stmtcetak);
$rcetak = oci_fetch_array($stmtcetak);

//TAMPILKAN PENCETAKAN
echo number_format(htmlentities($rcetak['COUNT']),0,',','.');
?>