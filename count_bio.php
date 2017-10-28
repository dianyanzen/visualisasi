<?php
Include('config/connect223.php');
date_default_timezone_set("Asia/Jakarta");
$nowdate = date("d/m/Y");

//COUNT BIODATA
$sqlbio= "select COUNT(NIK) AS COUNT from BIODATA_WNI WHERE TGL_ENTRI >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND TGL_ENTRI < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmtbio = oci_parse($conn, $sqlbio);
oci_execute($stmtbio);
$rbio = oci_fetch_array($stmtbio);
echo number_format(htmlentities($rbio['COUNT']),0,',','.');
?>