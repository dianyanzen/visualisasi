<?php
Include('config/connect223.php');
date_default_timezone_set("Asia/Jakarta");
$nowdate = date("d/m/Y");

//COUNT OPERATOR
$sqlopr= "SELECT COUNT(USER_ID) AS COUNT FROM T5_SESSION";
$stmtopr = oci_parse($conn, $sqlopr);
oci_execute($stmtopr);
$ropr = oci_fetch_array($stmtopr);

//TAMPILKAN OPERATOR
echo number_format(htmlentities($ropr['COUNT']),0,',','.');
?>